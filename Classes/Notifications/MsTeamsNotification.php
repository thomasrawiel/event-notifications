<?php


namespace TRAW\EventNotifications\Notifications;


use TRAW\EventDispatch\Events\AbstractEvent;
use TRAW\EventNotifications\Domain\Model\Notification;
use TRAW\EventNotifications\Utility\RequestUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class MsTeamsNotification extends AbstractNotification
{
    protected RequestUtility $requestUtility;

    public function __construct()
    {
        $this->requestUtility = GeneralUtility::makeInstance(RequestUtility::class);
    }

    public function sendNotification(AbstractEvent $event, Notification $notification)
    {
        $webhook = $notification->getTeamsWebhookUrl();

        if(!empty($webhook) && $this->validateWebhookUrl($webhook)) {
            $this->requestUtility->postToWebhook($webhook, $this->message($event));

        }
    }

    protected function validateWebhookUrl(string $url):bool {
        return filter_var($url, FILTER_VALIDATE_URL) !== false;
    }

    protected function message($event) {
        return [
            "summary" => "Test summary",
            "@type" => "MessageCard",
            '@context' => "http://schema.org/extensions",
            'themeColor' => '0076D7',
            "sections" => [
                [
                    'activityTitle' => 'Test headline',
                    'text' => get_class($event),
                ],
//                [
//                    'facts' => [
//                        [
//                            'name' => 'Author',
//                            'value' => get('localuser')
//                        ],
//                        [
//                            'name' => 'Status',
//                            'value' => 'FAILED'
//                        ],
//                        [
//                            'name' => 'Application',
//                            'value' => get('application')
//                        ],
//                        [
//                            'name' => 'Stage',
//                            'value' => input()->getArgument('stage')
//                        ],
//                        [
//                            'name' => 'Branch',
//                            'value' => input()->getOption('branch') ? input()->getOption('branch') : '-'
//                        ],
//                        [
//                            'name' => 'Tag',
//                            'value' => input()->getOption('tag') ? input()->getOption('tag') : '-'
//                        ]
//                    ]
//                ]
            ],
        ];
    }


}