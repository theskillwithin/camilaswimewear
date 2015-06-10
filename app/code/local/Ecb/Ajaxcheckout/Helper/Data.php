<?php
class Ecb_Ajaxcheckout_Helper_Data extends Mage_Core_Helper_Abstract
{
    public function getAjaxEnable()
    {
        return (bool) Mage::getStoreConfig('ajaxcheckout/general/ajax_enabled');
    }
    public function getPopupWidth()
    {
        return (int) Mage::getStoreConfig('ajaxcheckout/general/ajax_size_width');
    }
    public function getPopupHeight()
    {
        return (int) Mage::getStoreConfig('ajaxcheckout/general/ajax_size_height');
    }

    public function getCartEnable()
    {
        return (bool) Mage::getStoreConfig('ajaxcheckout/preview/preview_enabled');
    }
    public function getProductCount()
    {
        $count = (int) Mage::getStoreConfig('ajaxcheckout/preview/preview_count');
        if($count == ""){
            return 2;
        } else {
            return $count;
        }
    }
    public function getTargetLink()
    {
        return Mage::getStoreConfig('ajaxcheckout/preview/preview_target');
    }

    public function getItemCart()
    {
        $items = array();
        $cart = Mage::getModel('sales/quote_item')->getCollection()->setQuote(Mage::getModel('checkout/cart')->getQuote())
        ->addFieldToSelect('*')
        ->addOrder('updated_at', 'desc');
        foreach ($cart as $item){
            if (!$item->isDeleted() && !$item->getParentItemId()) {
                $items[] = $item;
            }
        }
        return $items;
    }

    public function getItemCartASC()
    {
        $items = array();
        $cart = Mage::getModel('sales/quote_item')->getCollection()->setQuote(Mage::getModel('checkout/cart')->getQuote())
        ->addFieldToSelect('*')
        ->addOrder('updated_at', 'asc');
        foreach ($cart as $item){
            if (!$item->isDeleted() && !$item->getParentItemId()) {
                $items[] = $item;
            }
        }
        return $items;
    }
}
