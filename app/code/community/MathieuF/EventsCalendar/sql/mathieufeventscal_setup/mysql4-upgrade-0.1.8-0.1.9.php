<?php
/**
 * @category   MathieuF
 * @package    MathieuF_EventsCalendar
 * @author     Mathieu Fortin <mathieu@calinsetpopotin.com>
 */

$this->startSetup()->run("
ALTER TABLE {$this->getTable('mathieufeventscal_event')}
  ADD COLUMN `store_id` int(4) NULL;
")->endSetup();
?>
