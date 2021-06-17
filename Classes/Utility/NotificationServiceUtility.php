<?php


namespace TRAW\EventNotifications\Utility;


use TRAW\EventDispatch\Events\AbstractEvent;
use TRAW\EventNotifications\Notifications\DefaultNotification;
use TRAW\EventNotifications\Notifications\MsTeamsNotification;
use TRAW\EventNotifications\Service\Notifications\DefaultNotificationService;
use TRAW\EventNotifications\Service\Notifications\NotificationMSTeamsService;
use TRAW\EventNotifications\Service\NotificationService;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Class NotificationServiceUtility
 * @package TRAW\EventNotifications\Utility
 */
class NotificationServiceUtility
{
    /**
     * @param int $type
     * @return mixed|null
     */
    public static function getNotificationService(int $type)
    {
        $services = [
            DefaultNotification::class,
            MsTeamsNotification::class
        ];

        return $services[$type] ?? DefaultNotification::class;
    }

    public static function sendNotifications(AbstractEvent $event) {
        $notificationService = GeneralUtility::makeInstance(NotificationService::class, $event);
        $notificationService->sendNotifications();
    }
}