<?php

namespace TRAW\EventNotifications\Service;

use TRAW\EventDispatch\Domain\Model\Dto\EmConfiguration as EventListenerSettings;
use TRAW\EventNotifications\Domain\Model\Dto\EmConfiguration as NotificationSettings;

/**
 * Class SettingsService
 * @package TRAW\EventNotifications\Service
 */
class SettingsService extends \TRAW\EventDispatch\Service\SettingsService
{
    /**
     * @return NotificationSettings
     */
    public static function getSettings(): NotificationSettings
    {
        /** @var NotificationSettings $emConfiguration */
        return new NotificationSettings();
    }

    /**
     * MethodAlias
     *
     * @return EventListenerSettings
     */
    public static function getEventListenerSettings(): EventListenerSettings
    {
        return self::getEmSettings();
    }
}