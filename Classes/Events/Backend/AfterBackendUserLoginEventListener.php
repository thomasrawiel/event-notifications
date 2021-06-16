<?php

namespace TRAW\EventNotifications\Events\Backend;

use TRAW\EventDispatch\Events\Backend\BackendUserLoginEvent;
use TRAW\EventNotifications\Service\NotificationService;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class AfterBackendUserLoginEventListener extends \TRAW\EventDispatch\Events\Backend\AfterBackendUserLoginEventListener
{
    public function __invoke(BackendUserLoginEvent $event)
    {
        if ($this->eventListenerIsActive()) {
            $notificationService = GeneralUtility::makeInstance(NotificationService::class, $event);
            $notificationService->sendNotifications();
        }
    }
}