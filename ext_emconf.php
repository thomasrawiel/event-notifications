<?php
$EM_CONF[$_EXTKEY] = [
    'title' => 'Event Notifications',
    'description' => '',
    'category' => 'be',
    'author' => 'Thomas Rawiel',
    'author_email' => 'thomas.rawiel@gmail.com',
    'state' => 'experimental',
    'clearCacheOnLoad' => 0,
    'version' => '0.0.1',
    'constraints' => [
        'depends' => [
            'typo3' => '10.4.0-0.0.0',
            'event_dispatch' => '',
        ],
        'conflicts' => [
        ],
        'suggests' => [
        ],
    ],
];