<?php


namespace TRAW\EventNotifications\Domain\Factory;


use TRAW\EventNotifications\Domain\Model\Notification;
use TYPO3\CMS\Extbase\Reflection\ObjectAccess;

/**
 * Class NotificationFactory
 * @package TRAW\EventNotifications\Domain\Factory
 */
class NotificationFactory
{
    /**
     * @return array
     */
    public static function getSettableProperties(): array
    {
        return ObjectAccess::getSettablePropertyNames(new Notification());
    }

    /**
     * @param array $data
     * @return Notification
     */
    public static function buildModelFromData(array $data): Notification
    {
        $notification = new Notification();
        $propertyNames = ObjectAccess::getSettablePropertyNames($notification);

        foreach ($propertyNames as $propertyName) {
            $propertyValue = $data[$propertyName];
            if (!in_array($propertyName, ['uid', 'pid'])) {
                settype($propertyValue, gettype($notification->_getProperty($propertyName)));
            }

            $notification->_setProperty($propertyName, $propertyValue);
        }

        return $notification;
    }
}