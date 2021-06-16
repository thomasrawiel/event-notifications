<?php

namespace TRAW\EventNotifications\Events\Cache;

use TRAW\EventDispatch\Events\Cache\ClearCacheEvent;
use TRAW\EventNotifications\Service\NotificationService;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Class ClearCacheEventListener
 * @package TRAW\EventNotifications\Events\Cache
 */
class ClearCacheEventListener extends \TRAW\EventDispatch\Events\Cache\ClearCacheEventListener
{
    /**
     * Method is automatically called when the event is triggered
     *
     * @param ClearCacheEvent $event
     */
    public function __invoke(ClearCacheEvent $event)
    {
        if ($this->eventListenerIsActive()) {
            $notificationService = GeneralUtility::makeInstance(NotificationService::class, $event);
            $notificationService->sendNotifications();
        }
    }
}