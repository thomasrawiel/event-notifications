<?php
defined('TYPO3_MODE') or die('Access denied.');
$lll = 'LLL:EXT:event_notifications/Resources/Private/Language/locallang_tca.xlf:';

return [
    'ctrl' => [
        'title' => $lll . 'tx_eventnotifications_domain_model_notification',
        'descriptionColumn' => 'notes',
        'label' => 'title',
        'hideAtCopy' => true,
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'versioningWS' => false,
        'origUid' => 't3_origuid',
        'rootLevel' => 1,
        'security' => [
            'ignoreWebMountRestriction' => true,
            'ignoreRootLevelRestriction' => true,
        ],
        'type' => 'type',
        'typeicon_column' => 'type',
        'typeicon_classes' => [
            'default' => 'ext-eventnotifications-type-default',
            '1' => 'ext-eventnotifications-type-email',
            '2' => 'ext-eventnotifications-type-teams',
        ],
        'useColumnsForDefaultValues' => 'type',
        'default_sortby' => 'ORDER BY sorting DESC',
        'sortby' => 'sorting',
        'delete' => 'deleted',
        'enablecolumns' => [
            'disabled' => 'hidden',
            'starttime' => 'starttime',
            'endtime' => 'endtime'
        ],
        'iconfile' => 'EXT:event_notifications/Resources/Public/Icons/Extension.svg',
        'searchFields' => 'uid,title',
    ],
    'types' => [
        0 => [
            'showitem' => "
                --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general, --palette--;;general,
                --div--;${lll}tab.events, --palette--;;events,
                --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access, --palette--;;visibility"
        ],
        \TRAW\EventNotifications\Utility\TcaUtility::NOTIFICATION_TYPE_EMAIL => [
            'showitem' => "
                --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general, --palette--;;general,             
                --div--;${lll}tab.events, --palette--;;events,
                --div--;Microsoft Teams, --palette--;;email,
                --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access, --palette--;;visibility"
        ],
        \TRAW\EventNotifications\Utility\TcaUtility::NOTIFICATION_TYPE_TEAMS => [
            'showitem' => "
                --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general, --palette--;;general,
                --div--;${lll}tab.events, --palette--;;events,
                --div--;Microsoft Teams, --palette--;;teams,
                --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access, --palette--;;visibility"
        ],

    ],
    'palettes' => [
        'general' => [
            'showitem' => 'type,--linebreak--,title,--linebreak--,notes',
        ],
        'events' => [
            'showitem' => 'events',
        ],
        'teams' => [
            'showitem' => 'teams_webhook_url'
        ],
        'email' => [
            'showitem' => '',
        ],
        'visibility' => [
            'showitem' => 'hidden, --linebreak--, starttime, endtime'
        ],
    ],
    'columns' => [
        'hidden' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.enabled',
            'config' => [
                'type' => 'check',
                'renderType' => 'checkboxToggle',
                'items' => [
                    [
                        0 => '',
                        1 => '',
                        'invertStateDisplay' => true
                    ]
                ],
            ]
        ],
        'starttime' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.starttime',
            'config' => [
                'type' => 'input',
                'renderType' => 'inputDateTime',
                'eval' => 'datetime,int',
                'default' => 0
            ]
        ],
        'endtime' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.endtime',
            'config' => [
                'type' => 'input',
                'renderType' => 'inputDateTime',
                'eval' => 'datetime,int',
                'default' => 0,
                'range' => [
                    'upper' => mktime(0, 0, 0, 1, 1, 2038)
                ]
            ]
        ],
        'cruser_id' => [
            'label' => 'cruser_id',
            'config' => [
                'type' => 'passthrough'
            ]
        ],
        'crdate' => [
            'label' => 'crdate',
            'config' => [
                'type' => 'input',
                'renderType' => 'inputDateTime',
                'eval' => 'datetime',
            ]
        ],
        'tstamp' => [
            'label' => 'tstamp',
            'config' => [
                'type' => 'input',
                'renderType' => 'inputDateTime',
                'eval' => 'datetime',
            ]
        ],
        'sorting' => [
            'label' => 'sorting',
            'config' => [
                'type' => 'passthrough',
            ]
        ],
        'title' => [
            'exclude' => false,
            'label' => $lll . 'title',
            'config' => [
                'type' => 'input',
                'size' => 60,
                'max' => 255,
                'eval' => 'required',
            ],
        ],
        'type' => [
            'exclude' => false,
            'label' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_tca.xlf:pages.doktype_formlabel',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    [$lll . 'tx_eventnotifications_domain_model_notification.type.I.0', 0, 'ext-eventnotifications-type-default'],
                ],
                'itemsProcFunc' => \TRAW\EventNotifications\Utility\TcaUtility::class . '->getNotificationTypes',
                'itemsProcConfig' => [
                    'languageKey' => "${lll}tx_eventnotifications_domain_model_notification.type.I.",
                ],
                'fieldWizard' => [
                    'selectIcons' => [
                        'disabled' => false,
                    ],
                ],
                'size' => 1,
                'maxitems' => 1,
            ]
        ],
        'notes' => [
            'label' => $lll . 'notes',
            'config' => [
                'type' => 'text',
                'rows' => 4,
                'cols' => 23
            ]
        ],
        'events' => [
            'exclude' => false,
            'label' => $lll . 'events',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectMultipleSideBySide',
                'items' => [],
                'itemsProcFunc' => \TRAW\EventNotifications\Utility\TcaUtility::class . '->getEventSelectItems',
                'itemsProcConfig' => [
                    'languageKey' => "${lll}events.type.",
                ],
            ],
        ],
        'teams_webhook_url' => [
            'exclude' => false,
            'displayCond' => 'FIELD:type:=:1',
            'label' => $lll . 'teams_webhook_url',
            'config' => [
                'type' => 'input',
                'renderType' => 'inputLink',
                'eval' => 'trim,required',
                'fieldControl' => [
                    'linkPopup' => [
                        'options' => [
                            'title' => $lll . 'teams_webhook_url',
                            'blindLinkFields' => 'class,params,target,title',
                            'blindLinkOptions' => 'file,folder,mail,page,spec,telephone',
                        ],
                    ],
                ],
            ]
        ]
    ],
];