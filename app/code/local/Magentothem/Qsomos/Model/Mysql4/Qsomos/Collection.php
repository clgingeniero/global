<?php

class Magentothem_Qsomos_Model_Mysql4_Qsomos_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('qsomos/qsomos');
    }
}