<?php


namespace TRAW\EventNotifications\Events\Database;


use TRAW\EventDispatch\Events\AbstractEvent;
use TRAW\EventNotifications\Utility\NotificationServiceUtility;

/**
 * Class MoveRecordEventListener
 * @package TRAW\EventNotifications\Events\Database
 */
class MoveRecordEventListener extends \TRAW\EventDispatch\Events\Database\MoveRecordEventListener
{
    public function invokeEventAction(AbstractEvent $event)
    {
        NotificationServiceUtility::sendNotifications($event);
    }
}