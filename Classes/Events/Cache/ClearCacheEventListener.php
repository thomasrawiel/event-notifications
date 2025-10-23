<?php

namespace TRAW\EventNotifications\Events\Cache;

use TRAW\EventDispatch\Events\AbstractEvent;
use TRAW\EventNotifications\Utility\NotificationServiceUtility;

/**
 * Class ClearCacheEventListener
 * @package TRAW\EventNotifications\Events\Cache
 */
class ClearCacheEventListener extends \TRAW\EventDispatch\Events\Cache\ClearCacheEventListener
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