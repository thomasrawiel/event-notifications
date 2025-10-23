<?php


namespace TRAW\EventNotifications\Events\Database;


use TRAW\EventDispatch\Events\AbstractEvent;
use TRAW\EventNotifications\Utility\NotificationServiceUtility;

/**
 * Class AfterDatabaseOperationEventListener
 * @package TRAW\EventNotifications\Events\Database
 */
class AfterDatabaseOperationEventListener extends \TRAW\EventDispatch\Events\Database\AfterDatabaseOperationEventListener
{
    /**
     * @param AbstractEvent $event
     * @return mixed|void
     */
    public function invokeEventAction(AbstractEvent $event)
    {
        NotificationServiceUtility::sendNotifications($event);
    }
}