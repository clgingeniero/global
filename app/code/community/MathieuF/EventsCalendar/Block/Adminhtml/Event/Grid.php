<?php
/**
 * @category   MathieuF
 * @package    MathieuF_EventsCalendar
 * @author     Mathieu Fortin <mathieu@calinsetpopotin.com>
 */
class MathieuF_EventsCalendar_Block_Adminhtml_Event_Grid extends Mage_Adminhtml_Block_Widget_Grid
{

    public function __construct()
    {
        parent::__construct();
        $this->setId('locationsGrid');
        $this->setDefaultSort('location_id');
        $this->setDefaultDir('ASC');
        $this->setSaveParametersInSession(true);
    }

    protected function _prepareCollection()
    {
        $this->setCollection(Mage::getModel('mathieufeventscal/event')->getCollection());
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $this->addColumn('event_id', array(
            'header'    => Mage::helper('mathieufeventscal')->__('ID'),
            'align'     => 'right',
            'width'     => '50px',
            'index'     => 'event_id',
            'type'      => 'number',
        ));

        $this->addColumn('title', array(
            'header'    => Mage::helper('mathieufeventscal')->__('Title'),
            'align'     => 'left',
            'index'     => 'title',
        ));

        $this->addColumn('date_from', array(
            'header'    => Mage::helper('mathieufeventscal')->__('Date From'),
            'align'     => 'left',
            'index'     => 'date_from',
//            'type'      => 'datetime',
            'type'      => 'date',
        ));

        $this->addColumn('date_to', array(
            'header'    => Mage::helper('mathieufeventscal')->__('Date To'),
            'align'     => 'left',
            'index'     => 'date_to',
//            'type'      => 'datetime',
            'type'      => 'date',
        ));

        return parent::_prepareColumns();
    }

    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    }

}
