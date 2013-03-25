<?php
class Magentothem_Restaurantslider_Block_Adminhtml_Restaurantslider extends Mage_Adminhtml_Block_Widget_Grid_Container
{
  public function __construct()
  {
    $this->_controller = 'adminhtml_restaurantslider';
    $this->_blockGroup = 'restaurantslider';
    $this->_headerText = Mage::helper('restaurantslider')->__('Item Manager');
    $this->_addButtonLabel = Mage::helper('restaurantslider')->__('Add Item');
    parent::__construct();
  }
}