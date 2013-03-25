<?php

class Kreativkonzentrat_Glossary_Block_Adminhtml_Glossary_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs {

	public function __construct() {
		parent::__construct();
		$this->setId('glossary_tabs');
		$this->setDestElementId('edit_form');
		$this->setTitle(Mage::helper('glossary')->__('Glossary Entry'));
	}

	protected function _beforeToHtml() {
		$this->addTab('form_section', array(
			'label' => Mage::helper('glossary')->__('Glossary Entry'),
			'title' => Mage::helper('glossary')->__('Glossary Entry'),
			'content' => $this->getLayout()->createBlock('glossary/adminhtml_glossary_edit_tab_form')->toHtml(),
		));

		return parent::_beforeToHtml();
	}

}