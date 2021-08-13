<?php


namespace TRAW\EventNotifications\Utility;


use HaydenPierce\ClassFinder\ClassFinder;
use Psr\EventDispatcher\EventDispatcherInterface;
use TRAW\EventNotifications\Domain\Model\Dto\EmConfiguration;
use TRAW\EventNotifications\Service\SettingsService;
use TYPO3\CMS\Extbase\Reflection\ObjectAccess;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;

/**
 * Class EventsRegistry
 * @package TRAW\EventNotifications\Events
 */
class TcaUtility implements EventDispatcherInterface
{
    /**
     * @var EmConfiguration
     */
    protected EmConfiguration $settings;
    /**
     * @var \TRAW\EventDispatch\Domain\Model\Dto\EmConfiguration
     */
    protected \TRAW\EventDispatch\Domain\Model\Dto\EmConfiguration $eventListenerSettings;

    public const NOTIFICATION_TYPE_EMAIL = 2;
    public const NOTIFICATION_TYPE_TEAMS = 1;

    /**
     * EventsRegistry constructor.
     */
    public function __construct()
    {
        $this->settings = SettingsService::getSettings();
        $this->eventListenerSettings = SettingsService::getEventListenerSettings();
    }

    /**
     * @param array $configuration
     */
    public function getNotificationTypes(array &$configuration)
    {
        $classes = ClassFinder::getClassesInNamespace('TRAW\EventNotifications\Notifications');



        if($this->settings->getEnableEmailNotifications()) {
            $configuration['items'][] = [
                LocalizationUtility::translate($configuration['config']['itemsProcConfig']['languageKey'] . '1') ?? 'email',
                self::NOTIFICATION_TYPE_EMAIL,
                'ext-eventnotifications-type-email',
            ];
        }
        if($this->settings->getEnableMsTeamsNotifications()) {
            $configuration['items'][] = [
                LocalizationUtility::translate($configuration['config']['itemsProcConfig']['languageKey'] . '2') ?? 'teams',
                self::NOTIFICATION_TYPE_TEAMS,
                'ext-eventnotifications-type-teams',
            ];
        }
    }

    /**
     * @param array $configuration
     */
    public function getEventSelectItems(array &$configuration)
    {
        foreach (ObjectAccess::getGettableProperties($this->eventListenerSettings) as $propertyName => $propertyValue) {
            if ($propertyValue > 0) {
                $configuration['items'][] = [
                    LocalizationUtility::translate($configuration['config']['itemsProcConfig']['languageKey'] . $propertyName) ?? $propertyName,
                    $propertyName,
                ];
            }
        }
    }

    public function dispatch(object $event)
    {

    }
}