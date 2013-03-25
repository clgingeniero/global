<?php

class Kreativkonzentrat_Glossary_IndexController extends Mage_Core_Controller_Front_Action {

	public function indexAction() {
		$this->loadLayout();
		$glossary_id = $this->getRequest()->getParam('id');
		if ($glossary_id != null && $glossary_id != '') {
			$glossary = Mage::getModel('glossary/glossary')->load($glossary_id)->getData();
		} else {
			$glossary = Mage::getModel('glossary/glossary')->getFilteredCollection();
			$this->getLayout()->getBlock('glossary_toolbar')
				->addOrderToAvailableOrders('title','Title')
				->setOrder('title')
				->setDefaultOrder('title')
				->setCollection($glossary);
			$this->getLayout()->getBlock('product_list_toolbar_pager')
				->setCollection($glossary);
		}

		Mage::register('glossary', $glossary);
		$this->renderLayout();
	}

	public function viewAction() {
		$glossary_id = $this->getRequest()->getParam('id');

		if ($glossary_id != null) {
			$glossary = Mage::getModel('glossary/glossary');
			$glossary->load($glossary_id);
			Mage::register('glossary', $glossary);
		}
		$this->loadLayout();
		$this->renderLayout();
	}

}