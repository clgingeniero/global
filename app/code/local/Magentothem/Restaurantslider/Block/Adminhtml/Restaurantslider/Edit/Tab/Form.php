<?php

class Magentothem_Restaurantslider_Block_Adminhtml_Restaurantslider_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
  protected function _prepareForm()
  {
      $form = new Varien_Data_Form();
      $this->setForm($form);
      $fieldset = $form->addFieldset('restaurantslider_form', array('legend'=>Mage::helper('restaurantslider')->__('Item information')));
     
      $fieldset->addField('title', 'text', array(
          'label'     => Mage::helper('restaurantslider')->__('Title'),
          'required'  => false,
          'name'      => 'title',
      ));
	  
	  $fieldset->addField('link', 'text', array(
          'label'     => Mage::helper('restaurantslider')->__('Link'),
          'required'  => false,
          'name'      => 'link',
      ));

      $fieldset->addField('image', 'file', array(
          'label'     => Mage::helper('restaurantslider')->__('Image'),
          'required'  => false,
          'name'      => 'image',
	  ));
		
      $fieldset->addField('status', 'select', array(
          'label'     => Mage::helper('restaurantslider')->__('Status'),
          'name'      => 'status',
          'values'    => array(
              array(
                  'value'     => 1,
                  'label'     => Mage::helper('restaurantslider')->__('Enabled'),
              ),

              array(
                  'value'     => 2,
                  'label'     => Mage::helper('restaurantslider')->__('Disabled'),
              ),
          ),
      ));
     
      $fieldset->addField('description', 'editor', array(
          'name'      => 'description',
          'label'     => Mage::helper('restaurantslider')->__('Description'),
          'title'     => Mage::helper('restaurantslider')->__('Description'),
          'style'     => 'width:700px; height:500px;',
          'wysiwyg'   => false,
          'required'  => false,
      ));
     
      if ( Mage::getSingleton('adminhtml/session')->getRestaurantsliderData() )
      {
          $form->setValues(Mage::getSingleton('adminhtml/session')->getRestaurantsliderData());
          Mage::getSingleton('adminhtml/session')->setRestaurantsliderData(null);
      } elseif ( Mage::registry('restaurantslider_data') ) {
          $form->setValues(Mage::registry('restaurantslider_data')->getData());
      }
      return parent::_prepareForm();
  }
}