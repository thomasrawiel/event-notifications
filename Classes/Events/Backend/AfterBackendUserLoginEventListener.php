<?php

namespace TRAW\EventNotifications\Events\Backend;

use TRAW\EventDispatch\Events\AbstractEventListener;
use TRAW\EventDispatch\Events\Backend\BackendUserLoginEvent;
use TRAW\EventNotifications\Domain\Repository\NotificationRepository;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class AfterBackendUserLoginEventListener extends AbstractEventListener
{
    /**
     * @var NotificationRepository
     */
    protected NotificationRepository $notificationRepository;

    public function injectNotificationRepository(NotificationRepository $notificationRepository)
    {
        $this->notificationRepository = $notificationRepository;
    }

    public function __invoke(BackendUserLoginEvent $event)
    {

    }
}