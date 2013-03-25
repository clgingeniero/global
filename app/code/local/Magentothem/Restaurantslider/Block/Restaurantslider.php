<?php
class Magentothem_Restaurantslider_Block_Restaurantslider extends Mage_Core_Block_Template
{
	public function _prepareLayout()
    {
		return parent::_prepareLayout();
    }
    
    public function getRestaurantslider()     
    { 
        if (!$this->hasData('restaurantslider')) {
            $this->setData('restaurantslider', Mage::registry('restaurantslider'));
        }
        return $this->getData('restaurantslider');
    }
	public function getDataRestaurantslider()
    {
    	$resource = Mage::getSingleton('core/resource');
		$read= $resource->getConnection('core_read');
		$slideTable = $resource->getTableName('restaurantslider');	
		$select = $read->select()
		   ->from($slideTable,array('restaurantslider_id','title','link','description','image','status'))
		   ->where('status=?',1);
		$slide = $read->fetchAll($select);	
		return 	$slide;			
    }
	public function getConfig($att) 
	{
		$config = Mage::getStoreConfig('restaurantslider');
		if (isset($config['restaurantslider_config']) ) {
			$value = $config['restaurantslider_config'][$att];
			return $value;
		} else {
			throw new Exception($att.' value not set');
		}
	}
}