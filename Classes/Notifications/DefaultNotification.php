<?php

namespace TRAW\EventNotifications\Notifications;


use TRAW\EventDispatch\Events\AbstractEvent;
use TRAW\EventNotifications\Domain\Model\Notification;

class DefaultNotification extends AbstractNotification
{

    public function sendNotification(AbstractEvent $event, Notification $notification)
    {
        // TODO: Implement sendNotifications() method.
    }
}