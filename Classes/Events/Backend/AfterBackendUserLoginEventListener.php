<?php

namespace TRAW\EventNotifications\Events\Backend;


use TRAW\EventDispatch\Events\AbstractEvent;
use TRAW\EventNotifications\Utility\NotificationServiceUtility;

/**
 * Class AfterBackendUserLoginEventListener
 * @package TRAW\EventNotifications\Events\Backend
 */
class AfterBackendUserLoginEventListener extends \TRAW\EventDispatch\Events\Backend\AfterBackendUserLoginEventListener
{
    /**
     * @param AbstractEvent $event
     *
     * @return mixed|void
     */
    public function invokeEventAction(AbstractEvent $event)
    {
        NotificationServiceUtility::sendNotifications($event);
    }
}