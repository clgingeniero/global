<?php
class Bestchoice_Recipe_Block_Recipe extends Mage_Core_Block_Template
{
	public function _prepareLayout()
    {
		return parent::_prepareLayout();
    }
    
     public function getRecipe()     
     { 
        if (!$this->hasData('recipe')) {
            $this->setData('recipe', Mage::registry('recipe'));
        }
        return $this->getData('recipe');
        
    }
}