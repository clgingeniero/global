<?php
/**
 * @category   MathieuF
 * @package    MathieuF_EventsCalendar
 * @author     Mathieu Fortin <mathieu@calinsetpopotin.com>
 */

$this->startSetup()->run("
CREATE TABLE {$this->getTable('mathieufeventscal_event')} (
  `event_id` int(10) unsigned NOT NULL auto_increment,
  `date_from` datetime NOT NULL,
  `date_to` datetime NOT NULL,
  `title` varchar(255) NOT NULL,
  `details` text NOT NULL,
  PRIMARY KEY  (`event_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8
")->endSetup();
