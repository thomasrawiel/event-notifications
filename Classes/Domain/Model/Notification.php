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
    protected string $title = '';
    /**
     * @var int
     */
    protected int $type = 0;
    /**
     * @var string
     */
    protected string $events = '';

    protected string $teamsWebhookUrl = '';

    /**
     * @return string
     */
    public function getTeamsWebhookUrl(): string
    {
        return $this->teamsWebhookUrl;
    }

    /**
     * @param string $teamsWebhookUrl
     */
    public function setTeamsWebhookUrl(string $teamsWebhookUrl): void
    {
        $this->teamsWebhookUrl = $teamsWebhookUrl;
    }

    /**
     * @return int
     */
    public function getUid(): int
    {
        return $this->uid;
    }

    /**
     * @param int $uid
     */
    public function setUid(int $uid): void
    {
        $this->uid = $uid;
    }

    /**
     * @return int
     */
    public function getPid(): int
    {
        return $this->pid;
    }

    /**
     * @param int $pid
     */
    public function setPid(int $pid): void
    {
        $this->pid = $pid;
    }


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