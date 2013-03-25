<?php

class Magentothem_Qsomos_Model_Qsomos extends Mage_Core_Model_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('qsomos/qsomos');
    }
}