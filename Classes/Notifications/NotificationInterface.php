<?php


namespace TRAW\EventNotifications\Notifications;


use TRAW\EventDispatch\Events\AbstractEvent;
use TRAW\EventNotifications\Domain\Model\Notification;

interface NotificationInterface
{
    public function sendNotification(AbstractEvent $event, Notification $notification);
}