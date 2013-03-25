<?php
/**
 * @category   MathieuF
 * @package    MathieuF_EventsCalendar
 * @author     Mathieu Fortin <mathieu@calinsetpopotin.com>
 */
class MathieuF_EventsCalendar_Block_Adminhtml_Event_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();
        $this->_objectId = 'id';
        $this->_blockGroup = 'mathieufeventscal';
        $this->_controller = 'adminhtml_event';

        $this->_updateButton('save', 'label', Mage::helper('mathieufeventscal')->__('Save Event'));
        $this->_updateButton('delete', 'label', Mage::helper('mathieufeventscal')->__('Delete Event'));

        if( $this->getRequest()->getParam($this->_objectId) ) {
            $model = Mage::getModel('mathieufeventscal/event')
                ->load($this->getRequest()->getParam($this->_objectId));
            Mage::register('event_data', $model);
        }


    }

    public function getHeaderText()
    {
        if( Mage::registry('event_data') && Mage::registry('event_data')->getId() ) {
            return Mage::helper('mathieufeventscal')->__("Edit Event", $this->htmlEscape(Mage::registry('event_data')->getTitle()));
        } else {
            return Mage::helper('mathieufeventscal')->__('New Event');
        }
    }
}
