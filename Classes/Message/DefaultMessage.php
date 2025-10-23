<?php


namespace TRAW\EventNotifications\Message;


use TRAW\EventDispatch\Domain\Model\BackendUserInfo;
use TRAW\EventDispatch\Events\AbstractEvent;

/**
 * Class DefaultMessage
 * @package TRAW\EventNotifications\Message
 */
class DefaultMessage implements MessageInterface
{
    /**
     * @var string
     */
    protected string $title = 'default';
    /**
     * @var string
     */
    protected string $text = 'default';
    /**
     * @var array
     */
    protected array $detailData = [];

    /**
     * @var AbstractEvent
     */
    protected AbstractEvent $event;

    /**
     * @var BackendUserInfo
     */
    protected BackendUserInfo $backendUserInfo;

    /**
     * @param AbstractEvent $event
     */
    public function __construct(AbstractEvent $event)
    {
        $this->event = $event;
        $this->backendUserInfo = $event->getBackendUser();
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * @return array
     */
    public function getDetailData(): array
    {
        return $this->detailData;
    }

    /**
     * @return array[]
     */
    public function getMessageData(): array
    {
        return [
            [
                'activityTitle' => $this->title,
                'text' => $this->text,
            ]
        ];
    }

    /**
     * @return string
     */
    protected function createUserName(): string
    {
        if (empty($this->backendUserInfo->getRealName())) {
            $username = $this->backendUserInfo->getUsername();
        } else {
            $username = $this->backendUserInfo->getRealName() . " (" . $this->backendUserInfo->getUsername() . ")";
        }

        if ($this->backendUserInfo->isAdmin()) {
            if ($this->backendUserInfo->isSystemMaintainer()) {
                $username .= ' [SUPER-ADMIN]';
            } else {
                $username .= ' [ADMIN]';
            }
        }


        return $username;
    }
}