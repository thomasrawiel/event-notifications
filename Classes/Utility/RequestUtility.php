<?php

namespace TRAW\EventNotifications\Utility;

use Psr\Http\Message\ResponseInterface;
use TYPO3\CMS\Core\Http\RequestFactory;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Class RequestUtility
 * @package TRAW\EventNotifications\Utility
 */
class RequestUtility
{
    /**
     * @var RequestFactory|object|\Psr\Log\LoggerAwareInterface|\TYPO3\CMS\Core\SingletonInterface
     */
    protected RequestFactory $requestFactory;

    /**
     * RequestUtility constructor.
     */
    public function __construct()
    {
        $this->requestFactory = GeneralUtility::makeInstance(RequestFactory::class);
    }

    /**
     * @param string $webhook
     * @param array $message
     */
    public function postToWebhook(string $webhook, string $message)
    {
        if ($this->messageIsJson($message)) {
            $this->sendRequest($webhook, 'POST', $message);
        }
    }

    protected function messageIsJson(string $message): bool
    {
        json_decode($message);
        return json_last_error() === JSON_ERROR_NONE;
    }

    /**
     * @param $requestUrl
     * @param string $method
     * @param null $body
     * @param array $additionalHeaders
     * @param array $additionalParams
     * @return ResponseInterface|null
     */
    protected function sendRequest($requestUrl, string $method = "GET", $body = null, $additionalHeaders = [], $additionalParams = []): ?ResponseInterface
    {
        $headers = [
            'Content-Type: application/json',
            'Content-Length: ' . strlen($body)
        ];

        if (!empty($additionalHeaders) && is_array($additionalHeaders)) {
            $headers = array_merge($headers, $additionalHeaders);
        }

        $options = [
            'headers' => $headers,
        ];

        if (!is_null($body)) {
            $options['body'] = $body;
        }

        if (!empty($additionalParams)) {
            foreach ($additionalParams as $param => $paramValue) {
                $requestUrl .= $param === array_key_first($additionalParams) ? '?' : '&';
                $requestUrl .= "$param=$paramValue";
            }
        }
        //todo: catch timeouts/ unavailable
        $response = $this->requestFactory->request(
            $requestUrl,
            $method,
            $options
        );

        return $response->getStatusCode() === 200 && $response->getReasonPhrase() === "OK" ? $response : null;
    }
}