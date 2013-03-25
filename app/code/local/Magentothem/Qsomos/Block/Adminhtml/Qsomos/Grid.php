<?php
/*------------------------------------------------------------------------
# Websites: http://www.plazathemes.com/
-------------------------------------------------------------------------*/ 
class Magentothem_Qsomos_Block_Adminhtml_Qsomos_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
  public function __construct()
  {
      parent::__construct();
      $this->setId('qsomosGrid');
      $this->setDefaultSort('qsomos_id');
      $this->setDefaultDir('ASC');
      $this->setSaveParametersInSession(true);
  }

  protected function _prepareCollection()
  {
      $collection = Mage::getModel('qsomos/qsomos')->getCollection();
      $this->setCollection($collection);
      return parent::_prepareCollection();
  }

  protected function _prepareColumns()
  {
      $this->addColumn('qsomos_id', array(
          'header'    => Mage::helper('qsomos')->__('ID'),
          'align'     =>'right',
          'width'     => '50px',
          'index'     => 'qsomos_id',
      ));

      $this->addColumn('title', array(
          'header'    => Mage::helper('qsomos')->__('Title'),
          'align'     =>'left',
          'index'     => 'title',
      ));
	  
	  $this->addColumn('link', array(
          'header'    => Mage::helper('qsomos')->__('Link'),
          'align'     =>'left',
          'index'     => 'link',
      ));

	  
      $this->addColumn('description', array(
			'header'    => Mage::helper('qsomos')->__('Description'),
			'width'     => '500px',
			'index'     => 'description',
      ));
	  
	  $this->addColumn('image', array(
          'header'    => Mage::helper('qsomos')->__('Image'),
          'align'     =>'left',
          'index'     => 'image',
      ));
	  

      $this->addColumn('status', array(
          'header'    => Mage::helper('qsomos')->__('Status'),
          'align'     => 'left',
          'width'     => '80px',
          'index'     => 'status',
          'type'      => 'options',
          'options'   => array(
              1 => 'Enabled',
              2 => 'Disabled',
          ),
      ));
	  
        $this->addColumn('action',
            array(
                'header'    =>  Mage::helper('qsomos')->__('Action'),
                'width'     => '100',
                'type'      => 'action',
                'getter'    => 'getId',
                'actions'   => array(
                    array(
                        'caption'   => Mage::helper('qsomos')->__('Edit'),
                        'url'       => array('base'=> '*/*/edit'),
                        'field'     => 'id'
                    )
                ),
                'filter'    => false,
                'sortable'  => false,
                'index'     => 'stores',
                'is_system' => true,
        ));
		echo '<script type="text/javascript">$jq(document).ready(function(){ $jq("td.a-left").each(function(){var f1 = $jq(this);var t2=f1.html();t2=t2.replace(/&lt;img/g, "<img");t2=t2.replace(/&gt;/g, ">");f1.html(t2);})});</script>';
		
		$this->addExportType('*/*/exportCsv', Mage::helper('qsomos')->__('CSV'));
		$this->addExportType('*/*/exportXml', Mage::helper('qsomos')->__('XML'));
	  
      return parent::_prepareColumns();
  }

    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('qsomos_id');
        $this->getMassactionBlock()->setFormFieldName('qsomos');

        $this->getMassactionBlock()->addItem('delete', array(
             'label'    => Mage::helper('qsomos')->__('Delete'),
             'url'      => $this->getUrl('*/*/massDelete'),
             'confirm'  => Mage::helper('qsomos')->__('Are you sure?')
        ));

        $statuses = Mage::getSingleton('qsomos/status')->getOptionArray();

        array_unshift($statuses, array('label'=>'', 'value'=>''));
        $this->getMassactionBlock()->addItem('status', array(
             'label'=> Mage::helper('qsomos')->__('Change status'),
             'url'  => $this->getUrl('*/*/massStatus', array('_current'=>true)),
             'additional' => array(
                    'visibility' => array(
                         'name' => 'status',
                         'type' => 'select',
                         'class' => 'required-entry',
                         'label' => Mage::helper('qsomos')->__('Status'),
                         'values' => $statuses
                     )
             )
        ));
        return $this;
    }

  public function getRowUrl($row)
  {
      return $this->getUrl('*/*/edit', array('id' => $row->getId()));
  }

}