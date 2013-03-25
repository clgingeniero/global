<?php
/*------------------------------------------------------------------------
# Websites: http://www.plazathemes.com/
-------------------------------------------------------------------------*/ 
class Magentothem_Qsomos_Block_Qsomos extends Mage_Core_Block_Template
{
	public function _prepareLayout()
    {
		return parent::_prepareLayout();
    }
    
     public function getQsomos()     
     { 
        if (!$this->hasData('qsomos')) {
            $this->setData('qsomos', Mage::registry('qsomos'));
        }
        return $this->getData('qsomos');
        
    }
	public function getDataQsomos()
    {
    	$resource = Mage::getSingleton('core/resource');
		$read= $resource->getConnection('core_read');
		$slideTable = $resource->getTableName('qsomos');	
		$select = $read->select()
		   ->from($slideTable,array('qsomos_id','title','link','description','image','status'))
		   ->where('status=?',1);
		$slide = $read->fetchAll($select);	
		return 	$slide;			
    }
	public function getConfig($att) 
	{
		$config = Mage::getStoreConfig('qsomos');
		if (isset($config['qsomos_config']) ) {
			$value = $config['qsomos_config'][$att];
			return $value;
		} else {
			throw new Exception($att.' value not set');
		}
	}
}