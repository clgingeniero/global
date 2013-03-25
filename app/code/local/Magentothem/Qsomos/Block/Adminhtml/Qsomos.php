<?php
/*------------------------------------------------------------------------
# Websites: http://www.plazathemes.com/
-------------------------------------------------------------------------*/ 
class Magentothem_Qsomos_Block_Adminhtml_Qsomos extends Mage_Adminhtml_Block_Widget_Grid_Container
{
  public function __construct()
  {
    $this->_controller = 'adminhtml_qsomos';
    $this->_blockGroup = 'qsomos';
    $this->_headerText = Mage::helper('qsomos')->__('Item Manager');
    $this->_addButtonLabel = Mage::helper('qsomos')->__('Add Item');
    parent::__construct();
  }
}