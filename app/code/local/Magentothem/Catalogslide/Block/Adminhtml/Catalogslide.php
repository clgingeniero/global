<?php
/*------------------------------------------------------------------------
# Websites: http://www.plazathemes.com/
-------------------------------------------------------------------------*/ 
class Magentothem_Catalogslide_Block_Adminhtml_Catalogslide extends Mage_Adminhtml_Block_Widget_Grid_Container
{
  public function __construct()
  {
    $this->_controller = 'adminhtml_catalogslide';
    $this->_blockGroup = 'catalogslide';
    $this->_headerText = Mage::helper('catalogslide')->__('Item Manager');
    $this->_addButtonLabel = Mage::helper('catalogslide')->__('Add Item');
    parent::__construct();
  }
}