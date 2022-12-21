<?php


namespace TRAW\EventNotifications\Utility;


use TRAW\EventDispatch\Events\AbstractEvent;
use TRAW\EventNotifications\Notifications\DefaultNotification;
use TRAW\EventNotifications\Notifications\EmailNotification;
use TRAW\EventNotifications\Notifications\MsTeamsNotification;
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
     * @return string
     */
    public static function getNotificationService(int $type): string
    {
        $services = [
            DefaultNotification::class,
            MsTeamsNotification::class,
            EmailNotification::class,
        ];

        return $services[$type] ?? DefaultNotification::class;
    }

    public static function sendNotifications(AbstractEvent $event) {
        $notificationService = GeneralUtility::makeInstance(NotificationService::class, $event);
        $notificationService->sendNotifications();
    }
}