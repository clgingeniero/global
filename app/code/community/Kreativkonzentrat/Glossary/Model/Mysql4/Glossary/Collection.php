<?php

class Kreativkonzentrat_Glossary_Model_Mysql4_Glossary_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract {

	public function _construct() {
		parent::_construct();
		$this->_init('glossary/glossary');
	}

	public function setAlphabeticalOrder() {
		$this->getSelect()->order('title ASC');
		return $this;
	}

	public function addStoreFilter($store) {
		if ($store instanceof Mage_Core_Model_Store) {
			$store = array($store->getId());
		}
		$test = $this->getSelect()->join(
						array('store_table' => $this->getTable('glossary_store')), 'main_table.glossary_id = store_table.glossary_id', array()
				)
				->where('store_table.store_id in (?)', array(0, $store));
		//echo ($test->__toString());
		return $this;
	}

	protected function _afterLoad() {
		$items = $this->getColumnValues('glossary_id');
		if (count($items)) {
			$select = $this->getConnection()->select()->from($this->getTable('glossary_store'))
					->where($this->getTable('glossary_store') . '.glossary_id IN (?)', $items);
			if ($result = $this->getConnection()->fetchPairs($select)) {
				foreach ($this as $item) {
					if (!isset($result[$item->getData('glossary_id')])) {
						continue;
					}
					if ($result[$item->getData('glossary_id')] == 0) {
						$stores = Mage::app()->getStores(false, true);
						$storeId = current($stores)->getId();
						$storeCode = key($stores);
					} else {
						$storeId = $result[$item->getData('glossary_id')];
						$storeCode = Mage::app()->getStore($storeId)->getCode();
					}
					$item->setData('_first_store_id', $storeId);
					$item->setData('store_code', $storeCode);
				}
			}
		}
		parent::_afterLoad();
	}
}