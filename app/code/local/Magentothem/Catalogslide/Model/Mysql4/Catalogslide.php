<?php

class Magentothem_Catalogslide_Model_Mysql4_Catalogslide extends Mage_Core_Model_Mysql4_Abstract
{
    public function _construct()
    {    
        // Note that the catalogslide_id refers to the key field in your database table.
        $this->_init('catalogslide/catalogslide', 'catalogslide_id');
    }
}