<?php

class Magentothem_Restaurantslider_Block_Adminhtml_Restaurantslider_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{

  public function __construct()
  {
      parent::__construct();
      $this->setId('restaurantslider_tabs');
      $this->setDestElementId('edit_form');
      $this->setTitle(Mage::helper('restaurantslider')->__('Item Information'));
  }

  protected function _beforeToHtml()
  {
      $this->addTab('form_section', array(
          'label'     => Mage::helper('restaurantslider')->__('Item Information'),
          'title'     => Mage::helper('restaurantslider')->__('Item Information'),
          'content'   => $this->getLayout()->createBlock('restaurantslider/adminhtml_restaurantslider_edit_tab_form')->toHtml(),
      ));
     
      return parent::_beforeToHtml();
  }
}