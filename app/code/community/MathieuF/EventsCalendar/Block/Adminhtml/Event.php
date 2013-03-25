<?php
/**
 * @category   MathieuF
 * @package    MathieuF_EventsCalendar
 * @author     Mathieu Fortin <mathieu@calinsetpopotin.com>
 */
class MathieuF_EventsCalendar_Block_Adminhtml_Event extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $this->_blockGroup = 'mathieufeventscal';
        $this->_controller = 'adminhtml_event';
        $this->_headerText = Mage::helper('mathieufeventscal')->__('Manage Events Calendar');
        $this->_addButtonLabel = Mage::helper('mathieufeventscal')->__('Add New Event');
        parent::__construct();
    }

}
