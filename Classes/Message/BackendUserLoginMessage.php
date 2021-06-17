<?php

namespace TRAW\EventNotifications\Message;

use TRAW\EventDispatch\Events\AbstractEvent;

/**
 * Class BackendUserLoginMessage
 */
class BackendUserLoginMessage extends DefaultMessage
{
    /**
     * BackendUserLoginMessage constructor.
     * @param AbstractEvent $event
     */
    public function __construct(AbstractEvent $event)
    {
        parent::__construct($event);

        //cant use LocalizationUtility because LanguageService is not loaded at this point
        $this->title = "TYPO3 Backend Login: " . $event->getBackendUser()->getSiteName();
        $this->text = $this->createUserName() . " has logged into the backend from " . $event->getBackendUser()->getRemoteAddress();

        $this->detailData = [
            'User-Agent' => $event->getBackendUser()->getHttpUserAgent(),
            'Accept-Language' => $event->getBackendUser()->getHttpAcceptLanguage(),
        ];
    }
}