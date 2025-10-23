<?php

namespace TRAW\EventNotifications\Domain\Model\Dto;

use TRAW\EventDispatch\Domain\Model\Dto\AbstractEmConfiguration;
use TYPO3\CMS\Core\Configuration\ExtensionConfiguration;
use TYPO3\CMS\Core\Utility\GeneralUtility;


/**
 * This file is part of the "event_dispatch" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 */

/**
 * Extension Manager configuration
 */
class EmConfiguration extends AbstractEmConfiguration
{
    public function __construct(array $configuration = [])
    {
        if(empty($configuration)) {
            try {
                $extensionConfiguration = GeneralUtility::makeInstance(ExtensionConfiguration::class);
                $configuration = $extensionConfiguration->get('event_notifications');
            } catch (\Exception $exception) {
                // do nothing
            }
        }
        parent::__construct($configuration);
    }

    /**
     * @var int
     */
    protected int $enableEmailNotifications = 0;
    /**
     * @var int
     */
    protected int $enableMsTeamsNotifications = 0;

    /**
     * @return int
     */
    public function getEnableEmailNotifications(): int
    {
        return $this->enableEmailNotifications;
    }

    /**
     * @return int
     */
    public function getEnableMsTeamsNotifications(): int
    {
        return $this->enableMsTeamsNotifications;
    }
}
