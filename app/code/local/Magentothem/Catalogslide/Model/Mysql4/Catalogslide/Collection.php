<?php

class Magentothem_Catalogslide_Model_Mysql4_Catalogslide_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('catalogslide/catalogslide');
    }
}