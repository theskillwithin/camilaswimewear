<?php
class Ecb_Ajaxcheckout_AjaxController extends Mage_Core_Controller_Front_Action
{
    public function cartAction()
    {
        $_cart = Mage::getSingleton('checkout/cart');
        if(count($_cart->getItems()) > 0){
            $cart_item = $_cart->getItems()->getData();
            $last_item_index = count($_cart->getItems() -1 );
            echo $count;
            $last_item = $cart_item[$last_item_index];
        }

        foreach ($_cart->getItems()  as $_item){
            $_product = Mage::getModel('catalog/product')->load($_item->getProduct()->getId());
            //get custom option code
            $product_options = $_product->getOptions();
            foreach ($product_options as $option){
                if ($option->getTitle() == 'ref option'){
                    $optionId= $option->getId();
                }
            }
            $options = $_item->getOptions();
            foreach ($options as $_option){

                if($_option->getCode() =="info_buyRequest"){
                    $unserialized = unserialize($_option->getValue());
                    $unserialized['options'][$optionId] = "Add new options";
                    $_option->setValue(serialize($unserialized));
                }
                if($_option->getCode() == "option_" . $optionId){
                    $_option->setValue("New one");
                }
                var_dump($_option->getValue());
                echo "-----------------------------";

            }
            $_item->setOptions($options)->save();
            Mage::getSingleton('checkout/cart')->save();
        }
        $quote = Mage::getSingleton('checkout/session')->getQuote();
        $quote->removeItem($last_item['item_id']);
        $_cart->save();
    }

    public function rewriteAction()
    {
        //Mage::getSingleton('catalog/url')->refreshRewrites();
        //Mage::getModel('catalog/product_image')->clearCache();
    }
}
