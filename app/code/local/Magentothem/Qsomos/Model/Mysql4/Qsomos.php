<?php

class Magentothem_Qsomos_Model_Mysql4_Qsomos extends Mage_Core_Model_Mysql4_Abstract
{
    public function _construct()
    {    
        // Note that the qsomos_id refers to the key field in your database table.
        $this->_init('qsomos/qsomos', 'qsomos_id');
    }
}