<?php
/**
 * @category   MathieuF
 * @package    MathieuF_EventsCalendar
 * @author     Mathieu Fortin <mathieu@calinsetpopotin.com>
 */
class MathieuF_EventsCalendar_Block_Adminhtml_Event_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form();
        $this->setForm($form);
        $store = Mage::app()->getStore()->getId();
        date_default_timezone_set(Mage_Core_Model_Locale::DEFAULT_TIMEZONE);        

        $fieldset = $form->addFieldset('event_form', array(
            'legend'=>Mage::helper('mathieufeventscal')->__('Event Info')
        ));

        $fieldset->addField('title', 'text', array(
            'name'      => 'title',
            'label'     => Mage::helper('mathieufeventscal')->__('Title'),
            'required'  => true,

        ));

        $fieldset->addField('details', 'select', array(
            'name'      => 'details',
            'label'     => Mage::helper('mathieufeventscal')->__('Details to be displayed'),
            'values'    => Mage::getSingleton('adminhtml/system_config_source_cms_page')->toOptionArray(false),
            'value'     => '',
            'note'      => Mage::helper('mathieufeventscal')->__('This information will be shown to visitors to display the event details.'),
        ));

        $fieldset->addField('store_id', 'select', array(
            'name'      => 'store_id',
            'label'     => Mage::helper('core')->__('Store View'),
            'title'     => Mage::helper('core')->__('Store View'),
            'required'  => true,
            'values'    => Mage::getSingleton('adminhtml/system_store')->getStoreValuesForForm(false, true),
        ));

        $fieldset->addField('url', 'text', array(
            'name'      => 'url',
            'label'     => Mage::helper('mathieufeventscal')->__('URL'),
            'note'      => Mage::helper('mathieufeventscal')->__('Leave blank to use CMS page.'),
        ));

        $fieldset->addField('date_from', 'date', array(
            'name'      => 'date_from',
            'label'     => Mage::helper('mathieufeventscal')->__('Event start date'),
            'class'     => 'required-entry',
            'required'  => true,
            'image'     => $this->getSkinUrl('images/grid-cal.gif'),
            'format'    => Mage::app()->getLocale()->getDateTimeFormat(Mage_Core_Model_Locale::FORMAT_TYPE_SHORT)
        ));

        $fieldset->addField('date_to', 'date', array(
            'name'      => 'date_to',
            'label'     => Mage::helper('mathieufeventscal')->__('Event stop date'),
            'class'     => 'required-entry',
            'required'  => true,
            'image'     => $this->getSkinUrl('images/grid-cal.gif'),
            'format'    => Mage::app()->getLocale()->getDateTimeFormat(Mage_Core_Model_Locale::FORMAT_TYPE_SHORT)
        ));

        if (Mage::registry('event_data')) {
            $form->setValues(Mage::registry('event_data')->getData());
        }

        return parent::_prepareForm();
    }
}
