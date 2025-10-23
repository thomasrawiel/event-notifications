<?php


namespace TRAW\EventNotifications\Message;


use TRAW\EventDispatch\Events\AbstractEvent;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;

class MoveRecordMessage extends DefaultMessage
{
    public function __construct(AbstractEvent $event)
    {
        parent::__construct($event);
        $this->title = LocalizationUtility::translate($event->getType() . '.title', 'EventNotifications') ?? $event->getType();
        $this->text = LocalizationUtility::translate($event->getType() . '.text', 'EventNotifications', [0 => $this->createUserName()]) ?? 'error: localize key: ' . $event->getType() . '.text';
    }
}