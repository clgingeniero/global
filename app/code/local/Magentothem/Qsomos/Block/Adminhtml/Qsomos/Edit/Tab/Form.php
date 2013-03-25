<?php
/*------------------------------------------------------------------------
# Websites: http://www.plazathemes.com/
-------------------------------------------------------------------------*/ 
class Magentothem_Qsomos_Block_Adminhtml_Qsomos_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
  protected function _prepareForm()
  {
      $form = new Varien_Data_Form();
      $this->setForm($form);
      $fieldset = $form->addFieldset('qsomos_form', array('legend'=>Mage::helper('qsomos')->__('Item information')));
     
      $fieldset->addField('title', 'text', array(
          'label'     => Mage::helper('qsomos')->__('Title'),
          'required'  => false,
          'name'      => 'title',
      ));
	  
	  $fieldset->addField('link', 'text', array(
          'label'     => Mage::helper('qsomos')->__('Link'),
          'required'  => false,
          'name'      => 'link',
      ));

      $fieldset->addField('image', 'file', array(
          'label'     => Mage::helper('qsomos')->__('Image'),
          'required'  => false,
          'name'      => 'image',
	  ));
		
      $fieldset->addField('status', 'select', array(
          'label'     => Mage::helper('qsomos')->__('Status'),
          'name'      => 'status',
          'values'    => array(
              array(
                  'value'     => 1,
                  'label'     => Mage::helper('qsomos')->__('Enabled'),
              ),

              array(
                  'value'     => 2,
                  'label'     => Mage::helper('qsomos')->__('Disabled'),
              ),
          ),
      ));
     
      $fieldset->addField('description', 'editor', array(
          'name'      => 'description',
          'label'     => Mage::helper('qsomos')->__('Description'),
          'title'     => Mage::helper('qsomos')->__('Description'),
          'style'     => 'width:700px; height:500px;',
          'wysiwyg'   => false,
          'required'  => false,
      ));
     
      if ( Mage::getSingleton('adminhtml/session')->getQsomosData() )
      {
          $form->setValues(Mage::getSingleton('adminhtml/session')->getQsomosData());
          Mage::getSingleton('adminhtml/session')->setQsomosData(null);
      } elseif ( Mage::registry('qsomos_data') ) {
          $form->setValues(Mage::registry('qsomos_data')->getData());
      }
      return parent::_prepareForm();
  }
}