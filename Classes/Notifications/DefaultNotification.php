<?php

namespace TRAW\EventNotifications\Notifications;


use TRAW\EventDispatch\Events\AbstractEvent;
use TRAW\EventNotifications\Domain\Model\Notification;

class DefaultNotification implements NotificationInterface
{

    public function sendNotification(AbstractEvent $event, Notification $notification)
    {
        // TODO: Implement sendNotifications() method.
    }

    public function formatMessageForNotificationType(array $message): string
    {
        return "";
    }
}