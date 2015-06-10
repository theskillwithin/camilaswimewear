<?php

class TheSecureGateway_TheSecureGateway_Block_Payment_Form_TheSecureGateway extends Mage_Payment_Block_Form_Cc
{
    protected function _construct()
    {
        parent::_construct();
        //Where do you think the association with phtml and classes were made?
        $this->setTemplate('thesecuregateway/payment/form/thesecuregateway.phtml'); //This time "/" does not define the namespace but file system!
    }

}