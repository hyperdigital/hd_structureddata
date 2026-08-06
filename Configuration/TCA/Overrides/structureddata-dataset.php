<?php
defined('TYPO3') || die();

(function () {
    $GLOBALS['TCA']['tx_hdstructureddata_domain_model_structureddata']['palettes']['dataset'] = [
        'showitem' => 'title,--linebreak--,description,--linebreak--,keywords,--linebreak--,url, license_url,--linebreak--,date_published, date_modified,--linebreak--,identifier,--linebreak--,organizers, organizers_pointer'
    ];

    $GLOBALS['TCA']['tx_hdstructureddata_domain_model_structureddata']['types']['dataset'] = [
        'showitem' => '--palette--;;type,--palette--;;dataset,
            --div--;LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.div.access,--palette--;;access,',
        'columnsOverrides' => [
            'title' => [
                'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.title.dataset',
                'config' => [
                    'eval' => 'trim',
                    'required' => true
                ]
            ],
            'description' => [
                'description' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:recommended'
            ],
            'license_url' => [
                'description' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:recommended'
            ],
        ]
    ];

    $GLOBALS['TCA']['tx_hdstructureddata_domain_model_structureddata']['columns']['type']['config']['items'][] = [
        'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.type.dataset',
        'value' => 'dataset'
    ];
    $GLOBALS['TCA']['tx_hdstructureddata_domain_model_structureddata']['ctrl']['typeicon_classes']['dataset'] = 'hd_structureddata_dataset';
})();
