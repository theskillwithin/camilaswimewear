<?php
class TheSecureGateway_TheSecureGateway_IndexController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
    	
    	/*
    	 * Load an object by id 
    	 * Request looking like:
    	 * http://site.com/thesecuregateway?id=15 
    	 *  or
    	 * http://site.com/thesecuregateway/id/15 	
    	 */
    	/* 
		$thesecuregateway_id = $this->getRequest()->getParam('id');

  		if($thesecuregateway_id != null && $thesecuregateway_id != '')	{
			$thesecuregateway = Mage::getModel('thesecuregateway/thesecuregateway')->load($thesecuregateway_id)->getData();
		} else {
			$thesecuregateway = null;
		}	
		*/
		
		 /*
    	 * If no param we load a the last created item
    	 */ 
    	/*
    	if($thesecuregateway == null) {
			$resource = Mage::getSingleton('core/resource');
			$read= $resource->getConnection('core_read');
			$thesecuregatewayTable = $resource->getTableName('thesecuregateway');
			
			$select = $read->select()
			   ->from($thesecuregatewayTable,array('thesecuregateway_id','title','content','status'))
			   ->where('status',1)
			   ->order('created_time DESC') ;
			   
			$thesecuregateway = $read->fetchRow($select);
		}
		Mage::register('thesecuregateway', $thesecuregateway);
		*/

			
		$this->loadLayout();     
		$this->renderLayout();
    }
}