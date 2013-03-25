<?php

class Kreativkonzentrat_Glossary_Block_Glossary_Navigation extends Mage_Core_Block_Template {

	public function _construct() {
		$this->setCacheLifetime(3600);
		$this->setCacheKey('glossary_letter_navigation_store_default');
	}

	public function getCacheKey() {
		return 'glossary_letter_navigation_' . Mage::app()->getStore()->getId();
	}

	public function _prepareLayout() {
		return parent::_prepareLayout();
	}

	public function buildNavigation() {
		$store = Mage :: app()->getStore();
		if ($store instanceof Mage_Core_Model_Store) {
			$store = array($store->getId());
		}
		$store2 = implode(",", $store);
		$resource = Mage::getSingleton('core/resource');
		$read = $resource->getConnection('core_read');
		$glossaryTable = $resource->getTableName('glossary');
		$storeTable = $resource->getTableName('glossary_store');
		$conn = Mage::getSingleton('core/resource')->getConnection('core_read');
		$results = array();
		foreach($conn->fetchAll("SELECT DISTINCT letter 
			FROM `$glossaryTable`INNER JOIN `$storeTable`
			ON $glossaryTable.glossary_id = $storeTable.glossary_id
			WHERE (glossary_store.store_id IN (0, $store2))
			ORDER BY letter;
        ") as $letter){
			$results[] = $letter['letter'];
		};
		return $results;
	}

}