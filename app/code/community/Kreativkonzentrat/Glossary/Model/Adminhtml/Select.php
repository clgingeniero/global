<?php

class Kreativkonzentrat_Glossary_Model_Adminhtml_Select {

	public function toOptionArray() {
		return array(
			array('value' => 1, 'label' => Mage::helper('core')->__('Yes')),
			array('value' => 0, 'label' => Mage::helper('core')->__('No')),
		);
	}

}