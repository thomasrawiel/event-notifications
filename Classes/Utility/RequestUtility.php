<?php

namespace TRAW\EventNotifications\Utility;

use Psr\Http\Message\ResponseInterface;
use TYPO3\CMS\Core\Http\RequestFactory;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class RequestUtility
{
    protected RequestFactory $requestFactory;

    public function __construct()
    {
        $this->requestFactory = GeneralUtility::makeInstance(RequestFactory::class);
    }

    public function postToWebhook($webhook, $message)
    {
        $response = $this->sendRequest($webhook, 'POST', json_encode($message));
    }

    /**
     * @param $endPoint
     * @param string $method
     * @param array $additionalHeaders
     * @param array $additionalParams
     * @param null $body
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