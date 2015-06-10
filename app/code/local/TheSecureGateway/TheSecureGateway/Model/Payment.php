<?php

/** 
 * Notice we are not creating a totally new payment type, but extend the original Credit card payment 
 * To write something totally new, you should extend from the Abstract one! 
 */  
class TheSecureGateway_TheSecureGateway_Model_Payment extends Mage_Payment_Model_Method_Cc  
{  
	protected $_isGateway = true;  
	protected $_canAuthorize = true;  
	protected $_canCapture = true;  
	protected $_canUseCheckout = true;  
  
	protected $_code = "thesecuregateway";  
	protected $_formBlockType = 'thesecuregateway/payment_form_thesecuregateway';  
  
	protected function proccess(Varien_Object $payment, $amount, $tsg_method)
	{
		try{
			//Get order
			$order = $payment->getOrder();
			
			//Get billing info
			$billing = $order->getBillingAddress();
			$billing_country_iso3 = Mage::getModel('directory/country')->load($billing->getCountry())->getIso3Code();
			
			//Get shipping info		
			$shipping = $order->getShippingAddress();
			$shipping_country_iso3 = Mage::getModel('directory/country')->load($shipping->getCountry())->getIso3Code();
			
			//Get Url
			$url = $this->getConfigData('url');
			
			//Get product desciptions
			Mage::getSingleton('core/session', array('name'=>'frontend'));
			$session = Mage::getSingleton('checkout/session');
			$description = "";
			foreach ($session->getQuote()->getAllItems() as $item) {
				$description .= $item->getName() . '(qty: ' . $item->getQty() . ') + ';
			}
			$description = substr($description, 0, -2);
			$description = htmlspecialchars($description, 0, "UTF-8");
			
			//Populate xml transaction request that contains all of the data to be sent to TSG
			$post_data ="<transaction>".
							"<api_key>".$this->getConfigData('key')."</api_key>".
							"<type>".$tsg_method."</type>".
							"<card>".$payment->getCcNumber()."</card>".
							"<csc>".$payment->getCcCid()."</csc>".
							"<exp_date>".sprintf('%02d',$payment->getCcExpMonth()) . substr($payment->getCcExpYear(),-2,2)."</exp_date>".
							"<amount>".$amount."</amount>".
							"<avs_address>".$billing->getStreet(1)."</avs_address>".
							"<avs_zip>".$billing->getPostcode()."</avs_zip>".
							"<email>".$order->getCustomerEmail()."</email>".
							"<customer_id>".$billing->getCustomerId()."</customer_id>".
							"<order_number>".$order->getIncrementId()."</order_number>".
							"<purchase_order></purchase_order>".
							"<invoice></invoice>".
							"<client_ip>".$order->getRemoteIp()."</client_ip>".
							"<description><![CDATA[".utf8_encode(substr($description,0,253))."]]></description>".
							"<comments>".""."</comments>".
							"<billing>".
								"<first_name><![CDATA[".utf8_encode($billing->getFirstname())."]]></first_name>".
								"<last_name><![CDATA[".utf8_encode($billing->getLastname())."]]></last_name>".
								"<company>".$billing->getCompany()."</company>".
								"<street>".$billing->getStreet(1)."</street>".
								"<street2>".$billing->getStreet(2)."</street2>".
								"<city>".$billing->getCity()."</city>".
								"<state>".$billing->getRegionCode()."</state>".
								"<zip>".$billing->getPostcode()."</zip>".
								"<country>".$billing_country_iso3."</country>".
								"<phone>".$billing->getTelephone()."</phone>".
							"</billing>".
							"<shipping>".
								"<first_name><![CDATA[".utf8_encode($shipping->getFirstname())."]]></first_name>".
								"<last_name><![CDATA[".utf8_encode($shipping->getLastname())."]]></last_name>".
								"<company>".$shipping->getCompany()."</company>".
								"<street>".$shipping->getStreet(1)."</street>".
								"<street2>".$shipping->getStreet(2)."</street2>".
								"<city>".$shipping->getCity()."</city>".
								"<state>".$shipping->getRegionCode()."</state>".
								"<zip>".$shipping->getPostcode()."</zip>".
								"<country>".$shipping_country_iso3."</country>".
								"<phone>".$shipping->getTelephone()."</phone>".
							"</shipping>".
						"</transaction>";
			
			// SEND DATA BY CURL SECTION
			// Post order info data to TSG, make sure you have curl installed
			unset($response);
			
			//Init Curl
			$curl = curl_init($url);
			
			//Curl Settings
			curl_setopt($curl, CURLOPT_TIMEOUT, 15);
			if( !ini_get('safe_mode') )
				set_time_limit(3000);
			curl_setopt($curl, CURLOPT_VERBOSE, 0);
			curl_setopt($curl, CURLOPT_HEADER, 0);
			curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
			curl_setopt($curl, CURLOPT_POST, 1);
			curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: text/xml'));
			curl_setopt($curl, CURLOPT_POSTFIELDS, $post_data);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

			//Execute Request
			$response = curl_exec($curl);
			
			//Debug
			if($this->getConfigData('debug')){
				$post_data_masked = str_replace("<card>".$payment->getCcNumber()."</card>", "<card>".$this->maskCreditCard($payment->getCcNumber())."</card>",$post_data);
				$post_data_masked = str_replace("<csc>".$payment->getCcCid()."</csc>", "<csc></csc>", $post_data_masked);
				Mage::log("TheSecureGateway REQUEST:" . $post_data_masked);
				Mage::log("TheSecureGateway RESPONSE:" . $response);
			}
		
			//Bad Response
			if (curl_error($curl)) {
				throw new Exception('Request to Gateway CURL ERROR: ' . curl_errno($curl) . '::' . curl_error($curl));
			} 
			//Good Response
			elseif ($response) {
				$transaction = new SimpleXMLElement($response);
				if($transaction){
					//Approved
					if($transaction->result_code == "0000"){
						$this->setStore($payment->getOrder()->getStoreId());  
						$payment->setStatus(self::STATUS_APPROVED);  
						$payment->setAmount($amount);  
						$payment->setTransactionId($transaction->id);
						$payment->setTransactionAdditionalInfo(Mage_Sales_Model_Order_Payment_Transaction::RAW_DETAILS, array('Transaction Id'=>strval($transaction->id),"Authorization Code"=>strval($transaction->authorization_code), "TSG Method"=>strval($tsg_method)));
					}
					//Non Approved
					else {  
						//Response Error
						$transaction_code = "";
						if($transaction->error_code)
							$transaction_code = $transaction->error_code;
						if($transaction->result_code)
							$transaction_code = $transaction->result_code;
						$response_summary	 =	"Transaction Result = ".$transaction->result."\n".
												$transaction->display_message."\n".
												"Result Code = ".$transaction;
						
						throw new Exception($response_summary);
					}  
				}
				//Bad Response (Non XML)
				else{
					throw new Exception('Bad Gateway Response');
				}
			}	
			//Response Empty			
			else {
				throw new Exception('Empty Gateway Response');
			}
			
			curl_close($curl);
		
		} catch (Exception $e) {  
			$payment->setStatus(self::STATUS_ERROR);  
			$payment->setAmount($amount);  
			$payment->setLastTransId($order->getIncrementId());  
			$this->setStore($payment->getOrder()->getStoreId());  
			Mage::log("TheSecureGateway ERROR:" . $e->getMessage());
			Mage::throwException($e->getMessage());  
		}  
		
		return $this;
	}
	
	public function capture(Varien_Object $payment, $amount)  
	{  
		return $this->proccess($payment, $amount, 'Sale');
	}
	
	public function authorize(Varien_Object $payment, $amount)  
	{  
		return $this->proccess($payment, $amount, 'Auth');
	}
	
	//Mask Credit Card Number
	function maskCreditCard($cc){
	    // Get the cc Length
	    $cc_length = strlen($cc);
	    if($cc_length == 16){
			// Replace all characters of credit card except the last four and dashes
			for($i=4; $i<$cc_length-4; $i++){
				if($cc[$i] == '-'){continue;}
				$cc[$i] = 'X';
			}
		}
	    // Return the masked Credit Card #
	    return $cc;
	}
}  