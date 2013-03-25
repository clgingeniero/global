<?php
/*------------------------------------------------------------------------
# Websites: http://www.plazathemes.com
-------------------------------------------------------------------------*/ 
class Magentothem_Qsomos_Block_Adminhtml_Qsomos_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{

  public function __construct()
  {
      parent::__construct();
      $this->setId('qsomos_tabs');
      $this->setDestElementId('edit_form');
      $this->setTitle(Mage::helper('qsomos')->__('Item Information'));
  }

  protected function _beforeToHtml()
  {
      $this->addTab('form_section', array(
          'label'     => Mage::helper('qsomos')->__('Item Information'),
          'title'     => Mage::helper('qsomos')->__('Item Information'),
          'content'   => $this->getLayout()->createBlock('qsomos/adminhtml_qsomos_edit_tab_form')->toHtml(),
      ));
     
      return parent::_beforeToHtml();
  }
}