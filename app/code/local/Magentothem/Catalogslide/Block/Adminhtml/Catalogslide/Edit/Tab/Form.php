<?php
/*------------------------------------------------------------------------
# Websites: http://www.plazathemes.com/
-------------------------------------------------------------------------*/ 
class Magentothem_Catalogslide_Block_Adminhtml_Catalogslide_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
  protected function _prepareForm()
  {
      $form = new Varien_Data_Form();
      $this->setForm($form);
      $fieldset = $form->addFieldset('catalogslide_form', array('legend'=>Mage::helper('catalogslide')->__('Item information')));
     
      $fieldset->addField('title', 'text', array(
          'label'     => Mage::helper('catalogslide')->__('Title'),
          'required'  => false,
          'name'      => 'title',
      ));
	  
	  $fieldset->addField('link', 'text', array(
          'label'     => Mage::helper('catalogslide')->__('Link'),
          'required'  => false,
          'name'      => 'link',
      ));

      $fieldset->addField('image', 'file', array(
          'label'     => Mage::helper('catalogslide')->__('Image'),
          'required'  => false,
          'name'      => 'image',
	  ));
		
      $fieldset->addField('status', 'select', array(
          'label'     => Mage::helper('catalogslide')->__('Status'),
          'name'      => 'status',
          'values'    => array(
              array(
                  'value'     => 1,
                  'label'     => Mage::helper('catalogslide')->__('Enabled'),
              ),

              array(
                  'value'     => 2,
                  'label'     => Mage::helper('catalogslide')->__('Disabled'),
              ),
          ),
      ));
     
      $fieldset->addField('description', 'editor', array(
          'name'      => 'description',
          'label'     => Mage::helper('catalogslide')->__('Description'),
          'title'     => Mage::helper('catalogslide')->__('Description'),
          'style'     => 'width:700px; height:500px;',
          'wysiwyg'   => false,
          'required'  => false,
      ));
     
      if ( Mage::getSingleton('adminhtml/session')->getCatalogslideData() )
      {
          $form->setValues(Mage::getSingleton('adminhtml/session')->getCatalogslideData());
          Mage::getSingleton('adminhtml/session')->setCatalogslideData(null);
      } elseif ( Mage::registry('catalogslide_data') ) {
          $form->setValues(Mage::registry('catalogslide_data')->getData());
      }
      return parent::_prepareForm();
  }
}