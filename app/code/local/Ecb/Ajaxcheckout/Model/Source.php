<?php
class Ecb_Ajaxcheckout_Model_Source
{
    public function toOptionArray() {
		return array(
            array('value' => 'cart', 'label'=>Mage::helper('adminhtml')->__('Cart page')),
            array('value' => 'checkout', 'label'=>Mage::helper('adminhtml')->__('Checkout page')),
        );
	}
}
