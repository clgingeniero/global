<?php
/*------------------------------------------------------------------------
# Websites: http://www.plazathemes.com
-------------------------------------------------------------------------*/ 
class Magentothem_Catalogslide_Block_Adminhtml_Catalogslide_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{

  public function __construct()
  {
      parent::__construct();
      $this->setId('catalogslide_tabs');
      $this->setDestElementId('edit_form');
      $this->setTitle(Mage::helper('catalogslide')->__('Item Information'));
  }

  protected function _beforeToHtml()
  {
      $this->addTab('form_section', array(
          'label'     => Mage::helper('catalogslide')->__('Item Information'),
          'title'     => Mage::helper('catalogslide')->__('Item Information'),
          'content'   => $this->getLayout()->createBlock('catalogslide/adminhtml_catalogslide_edit_tab_form')->toHtml(),
      ));
     
      return parent::_beforeToHtml();
  }
}