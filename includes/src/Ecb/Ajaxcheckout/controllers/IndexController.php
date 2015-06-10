<?php
require_once 'Mage/Checkout/controllers/CartController.php';
class Ecb_Ajaxcheckout_IndexController extends Mage_Checkout_CartController
{
	public function addAction()
    {
        $cart   = $this->_getCart();
		$params = $this->getRequest()->getParams();
		if($params['isAjax'] == 1){
			$response = array();
			try {
					if (isset($params['qty'])) {
						$filter = new Zend_Filter_LocalizedToNormalized(
						array('locale' => Mage::app()->getLocale()->getLocaleCode())
					);
					$params['qty'] = $filter->filter($params['qty']);
				}
				$product = $this->_initProduct();
				$related = $this->getRequest()->getParam('related_product');
				/*
				 * Check product availability
				 */
				if (!$product) {
					$response['code'] = 'ajaxcart';
					$response['status'] = 'error';
					$response['message'] = $this->__('Unable to find Product ID');
				}
				$cart->addProduct($product, $params);
				if (!empty($related)) {
					$cart->addProductsByIds(explode(',', $related));
				}
				$cart->save();
				$this->_getSession()->setCartWasUpdated(true);
				/*
				 * @todo remove wishlist observer processAddToCart
				 */
				Mage::dispatchEvent('checkout_cart_add_product_complete',
					array('product' => $product, 'request' => $this->getRequest(), 'response' => $this->getResponse())
				);
				if (!$cart->getQuote()->getHasError()){
					$message = $this->__('%s was added to your shopping cart.', Mage::helper('core')->htmlEscape($product->getName()));
					$response['code'] = 'ajaxcart';
					$response['status'] = 'success';
					$response['message'] = $message;

					$this->loadLayout();
					$blockhtml = $this->getLayout()->getBlock('minicart_head')->toHtml();
					//Mage::register('referrer_url', $this->_getRefererUrl());
					$response['blockhtml'] = $blockhtml;
				}
			} catch (Mage_Core_Exception $e) {
				$msg = "";
				if ($this->_getSession()->getUseNotice(true)) {
					$msg = $e->getMessage();
				} else {
					$messages = array_unique(explode("\n", $e->getMessage()));
					foreach ($messages as $message) {
						$msg .= $message . '<br/>';
					}
				}
				$response['code'] = 'ajaxcart';
				$response['status'] = 'error';
				$response['message'] = $msg;
			}
			$this->getResponse()->setBody(Mage::helper('core')->jsonEncode($response));
			return;
		}else{
			return parent::addAction();
		}
    }

	public function testAction(){
		$this->loadLayout();
		$toplink = $this->getLayout()->getBlock('top.links')->toHtml();
		$blockhtml = $this->getLayout()->getBlock('minicart_head')->toHtml();
		echo($blockhtml);
	}

	public function updateItemOptionsAction()
	{
		$cart = $this->_getCart();
        $id = (int) $this->getRequest()->getParam('id');
        $params = $this->getRequest()->getParams();

		if($params['isAjax'] == 1){
			$response = array();
				if (!isset($params['options'])) {$params['options'] = array();}
			try {
				if (isset($params['qty'])) {
					$filter = new Zend_Filter_LocalizedToNormalized(
						array('locale' => Mage::app()->getLocale()->getLocaleCode())
					);
					$params['qty'] = $filter->filter($params['qty']);
				}

				$quoteItem = $cart->getQuote()->getItemById($id);
				if (!$quoteItem) {
					$response['code'] = 'ajaxcart';
					$response['status'] = 'error';
					$response['message'] = $this->__('Quote item is not found.');
				}

				$item = $cart->updateItem($id, new Varien_Object($params));
				if (is_string($item)) {
					Mage::throwException($item);
				}
				if ($item->getHasError()) {
					Mage::throwException($item->getMessage());
				}

				$related = $this->getRequest()->getParam('related_product');
				if (!empty($related)) {
					$cart->addProductsByIds(explode(',', $related));
				}

				$cart->save();

				$this->_getSession()->setCartWasUpdated(true);

				Mage::dispatchEvent('checkout_cart_update_item_complete',
					array('item' => $item, 'request' => $this->getRequest(), 'response' => $this->getResponse())
				);
				if (!$this->_getSession()->getNoCartRedirect(true)) {
					if (!$cart->getQuote()->getHasError()){
						$message = $this->__('%s was updated in your shopping cart.', Mage::helper('core')->htmlEscape($item->getProduct()->getName()));
						$response['code'] = 'ajaxcart';
						$response['status'] = 'success';
						$response['message'] = $message;

						$this->loadLayout();
						$blockhtml = $this->getLayout()->getBlock('minicart_head')->toHtml();
						$response['toplink'] = $blockhtml;
					}
				}
			} catch (Mage_Core_Exception $e) {
				$msg = "";
				if ($this->_getSession()->getUseNotice(true)) {
					//$this->_getSession()->addNotice($e->getMessage());
					$msg = $e->getMessage();
				} else {
					$messages = array_unique(explode("\n test", $e->getMessage()));
					foreach ($messages as $message) {
						$msg .= $message . '<br/>';
					}
				}
				$response['code'] = 'ajaxcart';
				$response['status'] = 'error';
				$response['message'] = $msg;
			}
			$this->getResponse()->setBody(Mage::helper('core')->jsonEncode($response));
			return;
		} else {
			return parent::updateItemOptionsAction();
		}
	}

	public function clearcompareAction()
	{
		$items = Mage::getResourceModel('catalog/product_compare_item_collection');
		$response = array();

        if (Mage::getSingleton('customer/session')->isLoggedIn()) {
            $items->setCustomerId(Mage::getSingleton('customer/session')->getCustomerId());
        } elseif ($this->_customerId) {
            $items->setCustomerId($this->_customerId);
        } else {
            $items->setVisitorId(Mage::getSingleton('log/visitor')->getId());
        }
        /** @var $session Mage_Catalog_Model_Session */
        $session = Mage::getSingleton('catalog/session');
        try {
            $items->clear();
            $session->addSuccess($this->__('The comparison list was cleared.'));
            Mage::helper('catalog/product_compare')->calculate();
			$response['status'] = 'success';
			$response['message'] = 'Clear all';
        } catch (Mage_Core_Exception $e) {
			$response['status'] = 'error';
			$response['message'] = $e->getMessage();
            $session->addError($e->getMessage());
        } catch (Exception $e) {
			$response['status'] = 'error';
			$response['message'] = $this->__('An error occurred while clearing comparison list.');
            $session->addException($e, $this->__('An error occurred while clearing comparison list.'));
        }
		//$this->getResponse()->setBody(Mage::helper('core')->jsonEncode($response));
        //return $response;
		echo '
		<script type="text/javascript">
			window.parent.location.reload();
		</script>
		';
	}

	protected function getCartList()
	{
		$session = Mage::getSingleton('checkout/session');
		$total = $session->getQuote()->getGrandTotal();
		$items = Mage::helper('ajaxcheckout')->getItemCart();
		$count = Mage::helper('ajaxcheckout')->getProductCount();
		$_imagehelper = Mage::helper('catalog/image');
		$i = 1;
		if(count($items) <= 0){
			$html = '<strong>' . $this->__("You have no items in your shopping cart.") . '</strong>';
		} else {
			$html = '<ol class="preview-cart-list">';
			foreach($items as $_item){
			if($i <= $count){
				$_product = Mage::getModel('catalog/product')->load($_item->getProductId());
				$html .= '<li class="preview-cart-item">';
				$html .= '<a class="product-image" href="' . $_product->getProductUrl() . '">';
				$html .= '<img src="' . $_imagehelper->init($_product, 'thumbnail')->resize(40) .'" width="40" height="40" /></a>';
				$html .= '<div class="product-shop"><a class="product-delete btn" href="' . Mage::getUrl('checkout/cart/delete',array('id'=>$_item->getId(),Mage_Core_Controller_Front_Action::PARAM_NAME_URL_ENCODED => Mage::helper('core/url')->getEncodedUrl())) . '">Delete</a>';
				$html .= '<a class="product-edit btn" href="' . Mage::getUrl('checkout/cart/configure',array('id'=>$_item->getId())) . '">Edit<a>';
				$html .= '<p class="product-name"><a href="' . $_product->getProductUrl() .'">' .$_product->getName() . '</a></p>';
				$html .= '<p class="product-price"><strong class="quantity">' . $_item->getQty() . '</strong>x<span class="price">' . Mage::helper('core')->currency($_item->getPrice(), true, false) . '</span></strong></p>';
				$html .= '</div></li>';
				}
				$i++;
			}
			$html .= '</ol>';
		}
		$html .= '<p class="grand_total">'. $this->__("Grand Total:");
		$html .= '<span class="price">'. Mage::helper('core')->currency($total, true, false) . '</span></p>';
		return $html;
	}
}
