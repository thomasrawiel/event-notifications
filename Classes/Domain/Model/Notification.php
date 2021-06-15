<?php


namespace TRAW\EventNotifications\Domain\Model;


/**
 * Class Notification
 * @package TRAW\EventNotifications\Domain\Model
 */
class Notification extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{
    /**
     * @var string
     */
    protected string $title;
    /**
     * @var int
     */
    protected int $type;
    /**
     * @var string
     */
    protected string $events;

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return int
     */
    public function getType(): int
    {
        return $this->type;
    }

    /**
     * @param int $type
     */
    public function setType(int $type): void
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getEvents(): string
    {
        return $this->events;
    }

    /**
     * @param string $events
     */
    public function setEvents(string $events): void
    {
        $this->events = $events;
    }


}