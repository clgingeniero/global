<?php
/*------------------------------------------------------------------------
# Websites: http://www.plazathemes.com/
-------------------------------------------------------------------------*/ 
class Magentothem_Catalogslide_Block_Catalogslide extends Mage_Core_Block_Template
{
	public function _prepareLayout()
    {
		return parent::_prepareLayout();
    }
    
     public function getCatalogslide()     
     { 
        if (!$this->hasData('catalogslide')) {
            $this->setData('catalogslide', Mage::registry('catalogslide'));
        }
        return $this->getData('catalogslide');
        
    }
	public function getDataCatalogslide()
    {
    	$resource = Mage::getSingleton('core/resource');
		$read= $resource->getConnection('core_read');
		$slideTable = $resource->getTableName('catalogslide');	
		$select = $read->select()
		   ->from($slideTable,array('catalogslide_id','title','link','description','image','status'))
		   ->where('status=?',1);
		$slide = $read->fetchAll($select);	
		return 	$slide;			
    }
	public function getConfig($att) 
	{
		$config = Mage::getStoreConfig('catalogslide');
		if (isset($config['catalogslide_config']) ) {
			$value = $config['catalogslide_config'][$att];
			return $value;
		} else {
			throw new Exception($att.' value not set');
		}
	}
}