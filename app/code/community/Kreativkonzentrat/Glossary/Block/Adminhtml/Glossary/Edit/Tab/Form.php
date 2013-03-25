<?php

class Kreativkonzentrat_Glossary_Block_Adminhtml_Glossary_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form {

	protected function _prepareForm() {
		$model = Mage::registry('glossary_data');
		$form = new Varien_Data_Form();
		$this->setForm($form);
		$fieldset = $form->addFieldset('glossary_form', array('legend' => Mage::helper('glossary')->__('Glossary Entry')));

		$fieldset->addField('title', 'text', array(
			'label' => Mage::helper('cms')->__('Title'),
			'class' => 'required-entry',
			'required' => true,
			'name' => 'title',
		));
		if (!Mage::app()->isSingleStoreMode()) {
			$fieldset->addField('store_id', 'multiselect', array(
				'name' => 'stores[]',
				'label' => Mage::helper('cms')->__('Store View'),
				'title' => Mage::helper('cms')->__('Store View'),
				'required' => true,
				'values' => Mage::getSingleton('adminhtml/system_store')->getStoreValuesForForm(false, true),
			));
		} else {
			$fieldset->addField('store_id', 'hidden', array(
				'name' => 'stores[]',
				'value' => Mage::app()->getStore(true)->getId()
			));
			$model->setStoreId(Mage::app()->getStore(true)->getId());
		}
		$fieldset->addField('metakeywords', 'text', array(
			'label' => Mage::helper('glossary')->__('Meta Keywords'),
			'required' => false,
			'name' => 'metakeywords',
		));

		$fieldset->addField('metadescription', 'text', array(
			'label' => Mage::helper('glossary')->__('Meta Description'),
			'required' => false,
			'name' => 'metadescription',
		));

		$fieldset->addField('filename', 'file', array(
			'label' => Mage::helper('glossary')->__('File'),
			'required' => false,
			'name' => 'filename',
		));

		$fieldset->addField('status', 'select', array(
			'label' => Mage::helper('cms')->__('Status'),
			'name' => 'status',
			'values' => array(
				array(
					'value' => 1,
					'label' => Mage::helper('cms')->__('Enabled'),
				),
				array(
					'value' => 0,
					'label' => Mage::helper('cms')->__('Disabled'),
				),
			),
		));

		$fieldset->addField('glossary_content', 'editor', array(
			'name' => 'glossary_content',
			'label' => Mage::helper('cms')->__('Content'),
			'title' => Mage::helper('cms')->__('Content'),
			'style' => 'width:700px; height:500px;',
			'config' => Mage::getSingleton('cms/wysiwyg_config')->getConfig(),
			'required' => true,
		));

		if (Mage::getSingleton('adminhtml/session')->getGlossaryData()) {
			$form->setValues(Mage::getSingleton('adminhtml/session')->getGlossaryData());
			Mage::getSingleton('adminhtml/session')->setGlossaryData(null);
		} elseif (Mage::registry('glossary_data')) {
			$form->setValues(Mage::registry('glossary_data')->getData());
			$this->setForm($form);
		}
		return parent::_prepareForm();
	}

}