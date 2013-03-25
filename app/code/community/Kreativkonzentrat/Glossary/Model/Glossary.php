<?php

class Kreativkonzentrat_Glossary_Model_Glossary extends Mage_Core_Model_Abstract {

	protected $_glossaryCollection;

	public function _construct() {
		parent::_construct();
		$this->_init('glossary/glossary');
	}

	public function FindGlossaryEntry($request) {
		$collection = Mage::getModel('glossary/glossary')->getCollection()
				->addFilter('status', 1)
				->addStoreFilter(Mage :: app()->getStore());
		foreach ($collection as $item) {
			if(strcasecmp(urlencode($item['title']), $request) == 0)
				return $item->getID();
		}
		return false;
	}

	public function getUrl(){
		return Mage::app()->getStore()->getUrl('glossary/entry') . urlencode($this->getTitle());
	}

	public function getTitles() {
		$collection = Mage::getModel('glossary/glossary')->getCollection()
			->addStoreFilter(Mage :: app()->getStore());
		$titles = array();
		foreach ($collection as $item) {
			$titles[] = '/(?!(?:[^<]+>|[^>]+<\/a>))(' . htmlentities(str_replace("/", "", $item['title']), ENT_COMPAT, "UTF-8") . ')/i';
		}
		return $titles;
	}

	public function getFilteredCollection() {
		return Mage::getModel('glossary/glossary')->getCollection()
			->addFilter('status', 1)
			->addStoreFilter(Mage :: app()->getStore());
	}

}