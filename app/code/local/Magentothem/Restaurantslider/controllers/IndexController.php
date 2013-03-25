<?php
class Magentothem_Restaurantslider_IndexController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
    	
    	/*
    	 * Load an object by id 
    	 * Request looking like:
    	 * http://site.com/restaurantslider?id=15 
    	 *  or
    	 * http://site.com/restaurantslider/id/15 	
    	 */
    	/* 
		$restaurantslider_id = $this->getRequest()->getParam('id');

  		if($restaurantslider_id != null && $restaurantslider_id != '')	{
			$restaurantslider = Mage::getModel('restaurantslider/restaurantslider')->load($restaurantslider_id)->getData();
		} else {
			$restaurantslider = null;
		}	
		*/
		
		 /*
    	 * If no param we load a the last created item
    	 */ 
    	/*
    	if($restaurantslider == null) {
			$resource = Mage::getSingleton('core/resource');
			$read= $resource->getConnection('core_read');
			$restaurantsliderTable = $resource->getTableName('restaurantslider');
			
			$select = $read->select()
			   ->from($restaurantsliderTable,array('restaurantslider_id','title','content','status'))
			   ->where('status',1)
			   ->order('created_time DESC') ;
			   
			$restaurantslider = $read->fetchRow($select);
		}
		Mage::register('restaurantslider', $restaurantslider);
		*/

			
		$this->loadLayout();     
		$this->renderLayout();
    }
}