<?php

class Magentothem_Restaurantslider_Model_Mysql4_Restaurantslider extends Mage_Core_Model_Mysql4_Abstract
{
    public function _construct()
    {    
        // Note that the restaurantslider_id refers to the key field in your database table.
        $this->_init('restaurantslider/restaurantslider', 'restaurantslider_id');
    }
}