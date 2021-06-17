<?php


namespace TRAW\EventNotifications\Notifications;


use TRAW\EventDispatch\Events\AbstractEvent;
use TRAW\EventNotifications\Domain\Model\Notification;
use TRAW\EventNotifications\Message\DefaultMessage;
use TRAW\EventNotifications\Utility\RequestUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;

/**
 * Class MsTeamsNotification
 * @package TRAW\EventNotifications\Notifications
 */
class MsTeamsNotification extends DefaultNotification
{
    /**
     * @var RequestUtility|object|\Psr\Log\LoggerAwareInterface|\TYPO3\CMS\Core\SingletonInterface
     */
    protected RequestUtility $requestUtility;

    /**
     * MsTeamsNotification constructor.
     */
    public function __construct()
    {
        $this->requestUtility = GeneralUtility::makeInstance(RequestUtility::class);
    }

    /**
     * @param AbstractEvent $event
     * @param Notification $notification
     */
    public function sendNotification(AbstractEvent $event, Notification $notification)
    {
        $webhook = $notification->getTeamsWebhookUrl();

        if (!empty($webhook) && $this->validateWebhookUrl($webhook)) {
            $message = $this->createMessage($event);

            $this->requestUtility->postToWebhook($webhook, $this->createMessage($event));
        }
    }

    /**
     * @param array $message
     * @return string
     */
    public function formatMessageForNotificationType(array $message): string
    {
        return json_encode($message);
    }

    /**
     * @param string $url
     * @return bool
     */
    protected function validateWebhookUrl(string $url): bool
    {
        return filter_var($url, FILTER_VALIDATE_URL) !== false;
    }

    /**
     * @param AbstractEvent $event
     * @return string
     */
    protected function createMessage(AbstractEvent $event): string
    {
        $messageClassName = "TRAW\\EventNotifications\\Message\\" . GeneralUtility::underscoredToUpperCamelCase(
                GeneralUtility::camelCaseToLowerCaseUnderscored($event->getType()) . '_message'
            );
        if (false === class_exists($messageClassName)) {
            $messageClassName = DefaultMessage::class;
        }
        $messageObject = GeneralUtility::makeInstance($messageClassName, $event);
        $messageData = $messageObject->getMessageData();

        if (!empty($messageObject->getDetailData())) {
           $facts = [];
            foreach($messageObject->getDetailData() as $key=>$value) {
                $facts[] = [
                    'name' => $key,
                    'value' => $value,
                ];
            }

            $messageData[] = [
                'facts' => $facts
            ];
        }


        $message = [
            "summary" => "Test summary",
            "@type" => "MessageCard",
            '@context' => "http://schema.org/extensions",
            'themeColor' => '0076D7',
            "sections" => $messageData,
        ];

        return $this->formatMessageForNotificationType($message);
    }

    protected function localize(string $llkey, array $data = [])
    {
        return LocalizationUtility::translate($llkey, "EventNotifications", $data) ?? $llkey;
    }
}