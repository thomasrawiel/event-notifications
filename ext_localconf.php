<?php
defined('TYPO3_MODE') or die('Access denied.');
call_user_func(function ($_EXTKEY = 'event_notifications'){
    if (TYPO3_MODE === 'BE') {
        $icons = [
            'ext-eventnotifications-type-default' => 'Extension.svg',
            'ext-eventnotifications-type-email' => 'NotificationTypes/Email.svg',
            'ext-eventnotifications-type-teams' => 'NotificationTypes/MSTeams.svg',
        ];

        $iconRegistry = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Imaging\IconRegistry::class);
        foreach ($icons as $identifier => $fileName) {
            if (!$iconRegistry->isRegistered($identifier)) {
                $iconRegistry->registerIcon(
                    $identifier,
                    \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
                    ['source' => "EXT:${_EXTKEY}/Resources/Public/Icons/${fileName}"]
                );
            }
        }
    }
});