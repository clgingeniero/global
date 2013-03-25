<?php

class Bestchoice_Recipe_Block_Adminhtml_Recipe_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
  protected function _prepareForm()
  {
      $form = new Varien_Data_Form();
      $this->setForm($form);
      $fieldset = $form->addFieldset('recipe_form', array('legend'=>Mage::helper('recipe')->__('Item information')));
     
      $fieldset->addField('title', 'text', array(
          'label'     => Mage::helper('recipe')->__('Title'),
          'class'     => 'required-entry',
          'required'  => true,
          'name'      => 'title',
      ));

      $fieldset->addField('filename', 'file', array(
          'label'     => Mage::helper('recipe')->__('File'),
          'required'  => false,
          'name'      => 'filename',
	  ));
		
      $fieldset->addField('status', 'select', array(
          'label'     => Mage::helper('recipe')->__('Status'),
          'name'      => 'status',
          'values'    => array(
              array(
                  'value'     => 1,
                  'label'     => Mage::helper('recipe')->__('Enabled'),
              ),

              array(
                  'value'     => 2,
                  'label'     => Mage::helper('recipe')->__('Disabled'),
              ),
          ),
      ));
     
      $fieldset->addField('content', 'editor', array(
          'name'      => 'content',
          'label'     => Mage::helper('recipe')->__('Content'),
          'title'     => Mage::helper('recipe')->__('Content'),
          'style'     => 'width:700px; height:500px;',
          'wysiwyg'   => false,
          'required'  => true,
      ));
     
      if ( Mage::getSingleton('adminhtml/session')->getRecipeData() )
      {
          $form->setValues(Mage::getSingleton('adminhtml/session')->getRecipeData());
          Mage::getSingleton('adminhtml/session')->setRecipeData(null);
      } elseif ( Mage::registry('recipe_data') ) {
          $form->setValues(Mage::registry('recipe_data')->getData());
      }
      return parent::_prepareForm();
  }
}