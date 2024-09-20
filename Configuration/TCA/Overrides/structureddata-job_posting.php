<?php
defined('TYPO3') || die();

(function () {
    $GLOBALS['TCA']['tx_hdstructureddata_domain_model_structureddata']['palettes']['job_posting'] = [
        'showitem' => 'title, --linebreak--,
        identifier, --linebreak--,
        date_published,date_modified,end_date, --linebreak--,
        description,--linebreak--,
        organizers,--linebreak--,organizers_pointer, --linebreak--,
        locations, --linebreak--,
        price_min, price_max, price_currency, price_unit,--linebreak--,
        employment_type, --linebreak--,
        '
    ];

    $GLOBALS['TCA']['tx_hdstructureddata_domain_model_structureddata']['types']['job_posting'] = [
        'showitem' => '--palette--;;type,--palette--;;job_posting,
            --div--;LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.div.access,--palette--;;access,',
        'columnsOverrides' => [
            'title' => [
                'config' => [
                    'eval' => 'trim',
                    'required' => true
                ]
            ],
            'identifier' => [
                'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.identifier.jobposting'
            ],
            'date_published' => [
                'config' => [
                    'required' => true
                ]
            ],
            'end_date' => [
                'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.end_date.jobposting'
            ],
            'organizers' => [
                'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.organizers.jobposting.organization'
            ],
            'organizers_pointer' => [
                'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.organizers.jobposting.organizers_pointer'
            ],
            'locations' => [
                'config' => [
                    'minitems' => 1,
                    'overrideChildTca' => [
                        'columns' => [
                            'type' => [
                                'config' => [
                                    'items' => [
                                        [
                                            'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata_location.columns.type.Place',
                                            'value' => 'Place'
                                        ],
                                        [
                                            'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata_location.columns.type.Remote',
                                            'value' => 'Remote'
                                        ]
                                    ]
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ]
    ];

    $GLOBALS['TCA']['tx_hdstructureddata_domain_model_structureddata']['columns']['type']['config']['items'][] = [
        'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.type.job_posting',
        'value' => 'job_posting'
    ];
    $GLOBALS['TCA']['tx_hdstructureddata_domain_model_structureddata']['ctrl']['typeicon_classes']['job_posting'] = 'hd_structureddata_job';
})();
