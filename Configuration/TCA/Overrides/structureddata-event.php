<?php
defined('TYPO3') || die();

(function () {
    $GLOBALS['TCA']['tx_hdstructureddata_domain_model_structureddata']['palettes']['event'] = [
        'showitem' => 'title,status,--linebreak--,start_date,end_date,--linebreak--,locations,--linebreak--,description,--linebreak--,images,--linebreak--,offers,--linebreak--,sameas,--linebreak--,organizers,--linebreak--,organizers_pointer,--linebreak--,performers'
    ];

    $GLOBALS['TCA']['tx_hdstructureddata_domain_model_structureddata']['types']['event'] = [
        'showitem' => '--palette--;;type,--palette--;;event,
            --div--;LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.div.access,--palette--;;access,',
        'columnsOverrides' => [
            'title' => [
                'config' => [
                    'required' => true
                ]
            ],
            'sameas' => [
                'description' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.sameas.description.event',
            ],
            'start_date' => [
                'config' => [
                    'required' => true
                ]
            ],
            'locations' => [
                'config' => [
                    'minitems' => 1
                ]
            ],
            'images' => [
                'description' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:recommended'
            ],
            'end_date' => [
                'description' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:recommended',
            ],
            'description' => [
                'description' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:recommended',
            ],
            'offers'=> [
                'description' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:recommended',
            ],
            'performers' => [
                'description' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:recommended',
            ],
            'status' => [
                'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.status.event',
                'config' => [
                    'default' => 'EventScheduled',
                    'items' => [
                        [
                            'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.status.event.EventScheduled',
                            'value' => 'EventScheduled'
                        ],
                        [
                            'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.status.event.EventCancelled',
                            'value' => 'EventCancelled'
                        ],
                        [
                            'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.status.event.EventMovedOnline',
                            'value' => 'EventMovedOnline'
                        ],
                        [
                            'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.status.event.EventPostponed',
                            'value' => 'EventPostponed'
                        ],
                        [
                            'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.status.event.EventRescheduled',
                            'value' => 'EventRescheduled'
                        ],
                    ]
                ]
            ]
        ],
    ];

    $GLOBALS['TCA']['tx_hdstructureddata_domain_model_structureddata']['columns']['type']['config']['items'][] = [
        'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.type.event',
        'value' => 'event'
    ];
    $GLOBALS['TCA']['tx_hdstructureddata_domain_model_structureddata']['ctrl']['typeicon_classes']['event'] = 'hd_structureddata_event';
})();
