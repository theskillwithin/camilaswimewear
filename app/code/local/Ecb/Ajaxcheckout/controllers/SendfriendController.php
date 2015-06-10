<?php
require_once 'Mage/Sendfriend/controllers/ProductController.php';
class Ecb_Ajaxcheckout_SendfriendController extends Mage_Sendfriend_ProductController
{
    public function ajaxsendAction()
    {
        $response = array();
        if (!$this->_validateFormKey()) {
            $response['code'] = "wishlist";
            $response['status'] = "error";
            $response['message'] = $this->__('Form key invalid.');
            //return $this->_redirect('*/*/send', array('_current' => true));
        }
        $product    = $this->_initProduct();
        $model      = $this->_initSendToFriendModel();
        $data       = $this->getRequest()->getPost();

        if (!$product || !$data) {
            $response['code'] = "wishlist";
            $response['status'] = "error";
            $response['message'] = $this->__('There were some problems with the data.');
            //$this->_forward('noRoute');
            //return;
        }

        $categoryId = $this->getRequest()->getParam('cat_id', null);
        if ($categoryId) {
            $category = Mage::getModel('catalog/category')
                ->load($categoryId);
            $product->setCategory($category);
            Mage::register('current_category', $category);
        }

        $model->setSender($this->getRequest()->getPost('sender'));
        $model->setRecipients($this->getRequest()->getPost('recipients'));
        $model->setProduct($product);

        try {
            $validate = $model->validate();
            if ($validate === true) {
                $model->send();
                Mage::getSingleton('catalog/session')->addSuccess($this->__('The link to a friend was sent.'));
                $response['code'] = "wishlist";
                $response['status'] = "success";
                $response['message'] = $product->getProductUrl();
                $this->getResponse()->setBody(Mage::helper('core')->jsonEncode($response));
                return;
                //$this->_redirectSuccess($product->getProductUrl());
                //return;
            }
            else {
                if (is_array($validate)) {
                    foreach ($validate as $errorMessage) {
                        Mage::getSingleton('catalog/session')->addError($errorMessage);
                        $response['code'] = "wishlist";
                        $response['status'] = "error";
                        $response['message'] = $errorMessage;
                    }
                }
                else {
                    Mage::getSingleton('catalog/session')->addError($this->__('There were some problems with the data.'));
                    $response['code'] = "wishlist";
                    $response['status'] = "error";
                    $response['message'] = $this->__('There were some problems with the data.');
                }
            }
        }
        catch (Mage_Core_Exception $e) {
            Mage::getSingleton('catalog/session')->addError($e->getMessage());
            $response['code'] = "wishlist";
            $response['status'] = "error";
            $response['message'] = $this->__('There were some problems with the data.');
        }
        catch (Exception $e) {
            Mage::getSingleton('catalog/session')
                ->addException($e, $this->__('Some emails were not sent.'));
             $response['code'] = "wishlist";
            $response['status'] = "error";
            $response['message'] = $this->__('Some emails were not sent.');
        }

        // save form data
        Mage::getSingleton('catalog/session')->setSendfriendFormData($data);

        $this->getResponse()->setBody(Mage::helper('core')->jsonEncode($response));
        return;

        //$this->_redirectError(Mage::getURL('*/*/send', array('_current' => true)));

    }
}
