<?php

class Magentothem_Restaurantslider_Model_Restaurantslider extends Mage_Core_Model_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('restaurantslider/restaurantslider');
    }
}