<?php

namespace TRAW\EventNotifications\Events\Cache;

use TRAW\EventDispatch\Events\AbstractEvent;
use TRAW\EventDispatch\Events\Cache\ClearCacheEvent;
use TRAW\EventNotifications\Service\NotificationService;
use TRAW\EventNotifications\Utility\NotificationServiceUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Class ClearCacheEventListener
 * @package TRAW\EventNotifications\Events\Cache
 */
class ClearCacheEventListener extends \TRAW\EventDispatch\Events\Cache\ClearCacheEventListener
{public function invokeEventAction(AbstractEvent $event)
{
    NotificationServiceUtility::sendNotifications($event);
}
}