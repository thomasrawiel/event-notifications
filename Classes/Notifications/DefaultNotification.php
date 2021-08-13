<?php

namespace TRAW\EventNotifications\Notifications;


use TRAW\EventDispatch\Events\AbstractEvent;
use TRAW\EventNotifications\Domain\Model\Dto\EmConfiguration;
use TRAW\EventNotifications\Domain\Model\Notification;
use TRAW\EventNotifications\Service\SettingsService;

class DefaultNotification implements NotificationInterface
{
    protected EmConfiguration $settings;

    public function __construct()
    {
        $this->settings = SettingsService::getSettings();
    }


    public function sendNotification(AbstractEvent $event, Notification $notification)
    {
        // TODO: Implement sendNotifications() method.
    }

    public function formatMessageForNotificationType(array $message): string
    {
        return "";
    }
}