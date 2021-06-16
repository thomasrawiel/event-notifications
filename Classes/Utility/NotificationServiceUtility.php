<?php


namespace TRAW\EventNotifications\Utility;


use TRAW\EventNotifications\Notifications\DefaultNotification;
use TRAW\EventNotifications\Notifications\MsTeamsNotification;
use TRAW\EventNotifications\Service\Notifications\DefaultNotificationService;
use TRAW\EventNotifications\Service\Notifications\NotificationMSTeamsService;

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
            null,
            MsTeamsNotification::class
        ];

        return $services[$type] ?? null;
    }
}