<?php
defined('TYPO3') || die();

(function () {
    $GLOBALS['TCA']['tx_hdstructureddata_domain_model_structureddata']['palettes']['course'] = [
        'showitem' => 'title,--linebreak--,description,--linebreak--,organizers, --linebreak--, organizers_pointer, --linebreak--, offers,--linebreak--,courseinstances,--linebreak--,images,--linebreak--, url'
    ];

    $GLOBALS['TCA']['tx_hdstructureddata_domain_model_structureddata']['types']['course'] = [
        'showitem' => '--palette--;;type,--palette--;;course,
            --div--;LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.div.access,--palette--;;access,',
        'columnsOverrides' => [
            'title' => [
//                'description' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:recommended',
                'config' => [
                    'eval' => 'trim',
                    'required' => true
                ]
            ],
            'description' => [
//                'description' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:recommended',
                'config' => [
                    'eval' => 'trim',
                    'required' => true
                ]
            ],
        ]
    ];

    $GLOBALS['TCA']['tx_hdstructureddata_domain_model_structureddata']['columns']['type']['config']['items'][] = [
        'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.type.course',
        'value' => 'course'
    ];
    $GLOBALS['TCA']['tx_hdstructureddata_domain_model_structureddata']['ctrl']['typeicon_classes']['course'] = 'hd_structureddata_certificate';
})();
