<?php


namespace TRAW\EventNotifications\Service;


use TRAW\EventDispatch\Events\AbstractEvent;
use TRAW\EventNotifications\Domain\Model\Notification;
use TRAW\EventNotifications\Domain\Repository\NotificationRepository;
use TRAW\EventNotifications\Notifications\AbstractNotification;
use TRAW\EventNotifications\Utility\NotificationServiceUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Class NotificationService
 * @package TRAW\EventNotifications\Service
 */
class NotificationService
{
    /**
     * @var AbstractEvent
     */
    protected AbstractEvent $event;

    /**
     * @var NotificationRepository
     */
    protected NotificationRepository $notificationRepository;

    /**
     * @var array
     */
    protected array $notifications = [];

    /**
     * NotificationService constructor.
     * @param AbstractEvent $event
     */
    public function __construct(AbstractEvent $event)
    {
        $this->event = $event;
        $this->notificationRepository = new NotificationRepository();

        $this->getNotifications();
    }

    /**
     * Determine Notification to use and forward event and notification
     */
    public function sendNotifications()
    {
        /** @var Notification $notification */
        foreach ($this->notifications as $notification) {
            /** @var AbstractNotification $notificationService */
            //todo: class_exists($notification->getType())
            $notificationService = GeneralUtility::makeInstance(NotificationServiceUtility::getNotificationService($notification->getType()));
            $notificationService->sendNotification($this->event, $notification);
        }
    }

    /**
     *  get Notifications from Db that match the event type
     */
    protected function getNotifications()
    {
        $this->notifications = $this->notificationRepository->findByType($this->event->getType());
    }
}