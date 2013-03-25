<?php

class Bestchoice_Recipe_Model_Status extends Varien_Object
{
    const STATUS_ENABLED	= 1;
    const STATUS_DISABLED	= 2;

    static public function getOptionArray()
    {
        return array(
            self::STATUS_ENABLED    => Mage::helper('recipe')->__('Enabled'),
            self::STATUS_DISABLED   => Mage::helper('recipe')->__('Disabled')
        );
    }
}