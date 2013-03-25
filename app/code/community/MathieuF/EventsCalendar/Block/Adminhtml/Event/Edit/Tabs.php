<?php
/**
 * @category   MathieuF
 * @package    MathieuF_EventsCalendar
 * @author     Mathieu Fortin <mathieu@calinsetpopotin.com>
 */
class MathieuF_EventsCalendar_Block_Adminhtml_Event_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{

    public function __construct()
    {
        parent::__construct();
        $this->setId('event_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(Mage::helper('mathieufeventscal')->__('Manage Event'));
    }

    protected function _beforeToHtml()
    {
        $this->addTab('form_section', array(
            'label'     => Mage::helper('mathieufeventscal')->__('Event Information'),
            'title'     => Mage::helper('mathieufeventscal')->__('Event Information'),
            'content'   => $this->getLayout()->createBlock('mathieufeventscal/adminhtml_event_edit_tab_form')->toHtml(),
        ));

        return parent::_beforeToHtml();
    }
}
