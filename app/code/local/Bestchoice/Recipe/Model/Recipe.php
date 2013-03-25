<?php

class Bestchoice_Recipe_Model_Recipe extends Mage_Core_Model_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('recipe/recipe');
    }
}