<?php

class Bestchoice_Recipe_Model_Mysql4_Recipe extends Mage_Core_Model_Mysql4_Abstract
{
    public function _construct()
    {    
        // Note that the recipe_id refers to the key field in your database table.
        $this->_init('recipe/recipe', 'recipe_id');
    }
}