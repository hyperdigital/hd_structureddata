<?php
defined('TYPO3') || die();

(function () {
    $GLOBALS['TCA']['tx_hdstructureddata_domain_model_structureddata']['palettes']['person'] = [
        'showitem' => 'subtype,--linebreak--,title, job_title,--linebreak--,description,--linebreak--,email, telephone,--linebreak--,url,--linebreak--,images,--linebreak--,addresses,--linebreak--,sameas,--linebreak--,organizers_pointer'
    ];

    $GLOBALS['TCA']['tx_hdstructureddata_domain_model_structureddata']['types']['person'] = [
        'showitem' => '--palette--;;type,--palette--;;person,
            --div--;LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.div.access,--palette--;;access,',
        'columnsOverrides' => [
            'title' => [
                'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.title.person',
                'config' => [
                    'eval' => 'trim',
                    'required' => true
                ]
            ],
            'images' => [
                'description' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:recommended'
            ],
            'subtype' => [
                'config' => [
                    'items' => [
                        [
                            'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.subtype.person.person',
                            'value' => 'Person'
                        ],
                        [
                            'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.subtype.person.performingGroup',
                            'value' => 'PerformingGroup'
                        ]
                    ]
                ]
            ],
            'organizers_pointer' => [
                'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.organizers_pointer.person'
            ],
        ]
    ];

    $GLOBALS['TCA']['tx_hdstructureddata_domain_model_structureddata']['columns']['type']['config']['items'][] = [
        'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.type.person',
        'value' => 'person'
    ];
    $GLOBALS['TCA']['tx_hdstructureddata_domain_model_structureddata']['ctrl']['typeicon_classes']['person'] = 'hd_structureddata_person';
})();
