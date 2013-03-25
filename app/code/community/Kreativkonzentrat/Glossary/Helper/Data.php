<?php

class Kreativkonzentrat_Glossary_Helper_Data extends Mage_Core_Helper_Abstract
{
	public function getGlossaryIndexUrl()
	{
		return $this->_getUrl('glossary');
	}
}