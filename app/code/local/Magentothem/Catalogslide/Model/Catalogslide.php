<?php

class Magentothem_Catalogslide_Model_Catalogslide extends Mage_Core_Model_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('catalogslide/catalogslide');
    }
}