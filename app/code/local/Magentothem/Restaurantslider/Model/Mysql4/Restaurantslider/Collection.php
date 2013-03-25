<?php

class Magentothem_Restaurantslider_Model_Mysql4_Restaurantslider_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('restaurantslider/restaurantslider');
    }
}