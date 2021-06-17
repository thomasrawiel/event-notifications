<?php


namespace TRAW\EventNotifications\Events\Database;


use TRAW\EventDispatch\Events\AbstractEvent;
use TRAW\EventNotifications\Utility\NotificationServiceUtility;

/**
 * Class DeleteRecordEventListener
 * @package TRAW\EventNotifications\Events\Database
 */
class DeleteRecordEventListener extends \TRAW\EventDispatch\Events\Database\DeleteRecordEventListener
{public function invokeEventAction(AbstractEvent $event)
{
    NotificationServiceUtility::sendNotifications($event);
}
}