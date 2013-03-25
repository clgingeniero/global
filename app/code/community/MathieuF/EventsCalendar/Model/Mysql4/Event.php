<?php
/**
 * @category   MathieuF
 * @package    MathieuF_EventsCalendar
 * @author     Mathieu Fortin <mathieu@calinsetpopotin.com>
 */
class MathieuF_EventsCalendar_Model_Mysql4_Event extends Mage_Core_Model_Mysql4_Abstract
{
    protected function _construct()
    {
        $this->_init('mathieufeventscal/event', 'event_id');
    }
}
