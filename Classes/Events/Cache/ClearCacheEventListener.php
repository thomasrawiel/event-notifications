<?php

namespace TRAW\EventNotifications\Events\Cache;

use TRAW\EventDispatch\Events\AbstractEventListener;
use TRAW\EventDispatch\Events\Cache\ClearCacheEvent;
use TRAW\EventNotifications\Domain\Repository\NotificationRepository;

class ClearCacheEventListener extends AbstractEventListener
{
    /**
     * @var NotificationRepository
     */
    protected NotificationRepository $notificationRepository;


    public function __construct()
    {
        parent::__construct();
        $this->notificationRepository = new NotificationRepository();
    }


    public function __invoke(ClearCacheEvent $event)
    {
    }
}