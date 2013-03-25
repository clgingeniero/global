<?php
class Bestchoice_Recipe_IndexController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
    	print_r(Mage::app()->getRequest()->getParam('url'));
    	/*
    	 * Load an object by id 
    	 * Request looking like:
    	 * http://site.com/recipe?id=15 
    	 *  or
    	 * http://site.com/recipe/id/15 	
    	 */
    	/* 
		$recipe_id = $this->getRequest()->getParam('id');

  		if($recipe_id != null && $recipe_id != '')	{
			$recipe = Mage::getModel('recipe/recipe')->load($recipe_id)->getData();
		} else {
			$recipe = null;
		}	
		*/
		
		 /*
    	 * If no param we load a the last created item
    	 */ 
    	/*
    	if($recipe == null) {
			$resource = Mage::getSingleton('core/resource');
			$read= $resource->getConnection('core_read');
			$recipeTable = $resource->getTableName('recipe');
			
			$select = $read->select()
			   ->from($recipeTable,array('recipe_id','title','content','status'))
			   ->where('status',1)
			   ->order('created_time DESC') ;
			   
			$recipe = $read->fetchRow($select);
		}
		Mage::register('recipe', $recipe);
		*/

			
		$this->loadLayout();     
		$this->renderLayout();
    }
}