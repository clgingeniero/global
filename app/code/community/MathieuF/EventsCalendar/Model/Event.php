<?php
/**
 * @category   MathieuF
 * @package    MathieuF_EventsCalendar
 * @author     Mathieu Fortin <mathieu@calinsetpopotin.com>
 */
class MathieuF_EventsCalendar_Model_Event extends Mage_Core_Model_Abstract
{
    protected function _construct()
    {
        $this->_init('mathieufeventscal/event');
    }

    protected function _beforeSave()
    {
        if (!$this->getDetails()) {
            $this->setDetails($this->getDetailsDisplay());
        }

        $this->setDetails(str_replace(array("\n", "\r"), " ", $this->getDetails()));

        parent::_beforeSave();
    }

}
