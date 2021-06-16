<?php
/**
 *  Copyright notice
 *
 *  (c) 2021 Thomas Rawiel <.t.rawiel@lingner.com>
 *
 * All rights reserved
 *
 * This script is part of the TYPO3 project. The TYPO3 project is
 * free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 * The GNU General Public License can be found at
 * http://www.gnu.org/copyleft/gpl.html.
 *
 * This script is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * This copyright notice MUST APPEAR in all copies of the script!
 */

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
        $this->sendRequest($webhook, 'POST', $message);
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

        $response = $this->requestFactory->request(
            $requestUrl,
            $method,
            $options
        );

        return $response->getStatusCode() === 200 && $response->getReasonPhrase() === "OK" ? $response : null;
    }
}