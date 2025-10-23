<?php


namespace TRAW\EventNotifications\Message;

use TRAW\EventDispatch\Events\AbstractEvent;

/**
 * Interface MessageInterface
 * @package TRAW\EventNotifications\Message
 */
interface MessageInterface
{
    /**
     * MessageInterface constructor.
     * @param AbstractEvent $event
     */
    public function __construct(AbstractEvent $event);

    /**
     * @return string
     */
    public function getTitle(): string;

    /**
     * @return string
     */
    public function getText(): string;

    /**
     * @return array
     */
    public function getDetailData(): array;

    /**
     * @return array
     */
    public function getMessageData(): array;
}