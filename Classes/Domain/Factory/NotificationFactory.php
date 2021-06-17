<?php


namespace TRAW\EventNotifications\Domain\Factory;


use TRAW\EventNotifications\Domain\Model\Notification;
use TYPO3\CMS\Core\Utility\GeneralUtility;
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
        $properties = ObjectAccess::getSettablePropertyNames(new Notification());
        foreach ($properties as $key => $property) {
            $properties[$key] = GeneralUtility::camelCaseToLowerCaseUnderscored($property);
        }
        return $properties;
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
            $dbprop = GeneralUtility::camelCaseToLowerCaseUnderscored($propertyName);
            $propertyValue = $data[$dbprop];
            if (!in_array($propertyName, ['uid', 'pid'])) {
                settype($propertyValue, gettype($notification->_getProperty($propertyName)));
            }

            $notification->_setProperty($propertyName, $propertyValue);
        }

        return $notification;
    }
}