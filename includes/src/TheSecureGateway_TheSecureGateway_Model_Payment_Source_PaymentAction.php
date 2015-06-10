<?php

class TheSecureGateway_TheSecureGateway_Model_Payment_Source_PaymentAction
{
    public function toOptionArray()
    {
        return array(
            array(
                'value' => TheSecureGateway_TheSecureGateway_Model_Payment::ACTION_AUTHORIZE,
                'label' => 'Authorize Only'
            ),
            array(
                'value' => TheSecureGateway_TheSecureGateway_Model_Payment::ACTION_AUTHORIZE_CAPTURE,
                'label' => 'Authorize and Capture'
            ),
        );
    }
}
