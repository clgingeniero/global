<?php

class Kreativkonzentrat_Glossary_ViewController extends Mage_Core_Controller_Front_Action {

	public function indexAction() {
		$this->loadLayout();
		$this->renderLayout();
	}

	public function IdAction() {
		$glossary_id = $this->getRequest()->getParam('id');
		if ($glossary_id != null && $glossary_id != '') {
			$glossary = Mage::getModel('glossary/glossary')->load($glossary_id);
			$glossary->getData();
		} else {
			$resource = Mage::getSingleton('core/resource');
			$read = $resource->getConnection('core_read');
			$glossaryTable = $resource->getTableName('glossary');

			$select = $read->select()
					->from($glossaryTable, array('glossary_id', 'title', 'glossary_content', 'status'))
					->where('status', 1)
					->order('title DESC');

			$glossary = $read->fetchRow($select);
		}
		Mage::register('glossary', $glossary);
		$this->loadLayout();
		$this->renderLayout();
	}

	public function popupAction() {
		$glossary_id = $this->getRequest()->getParam('id');
		if ($glossary_id != null && $glossary_id != '') {
			$glossary = Mage::getModel('glossary/glossary')->load($glossary_id);
			$glossary->getData();
		} else {
			$resource = Mage::getSingleton('core/resource');
			$read = $resource->getConnection('core_read');
			$glossaryTable = $resource->getTableName('glossary');

			$select = $read->select()
				->from($glossaryTable, array('glossary_id', 'title', 'glossary_content', 'status'))
				->where('status', 1)
				->order('title DESC');

			$glossary = $read->fetchRow($select);
		}
		Mage::register('glossary', $glossary);
		$this->loadLayout();
		$this->renderLayout();
	}

	public function letterAction() {
		//get letter param
		$params = array_keys($this->getRequest()->getParams());
		if ($params != null) {
			//get only entries with corresponding letter
			$collection = Mage::getModel('glossary/glossary')->getFilteredCollection()->addFieldToFilter('letter', $params[0])->setAlphabeticalOrder();
			/*
			 * sql variant			

			  //select only rows starting with letter param
			  $collection = Mage::getModel('glossary/glossary')->getCollection();

			  $collection->getSelect()->where("lower(left(title,1)='$params[0]')");
			  //debug query

			 */
			//echo ($collection->getSelect()->__toString());
		}
		else
			$collection = Mage::getModel('glossary/glossary')->getFilteredCollection();
		Mage::register('glossary', $collection);
		$this->loadLayout();
		$this->renderLayout();
	}

}