<?php
defined('TYPO3') || die();

(function () {
    $GLOBALS['TCA']['tx_hdstructureddata_domain_model_structureddata']['palettes']['service'] = [
        'showitem' => 'title,--linebreak--,description,--linebreak--,service_type, area_served,--linebreak--,url,--linebreak--,images,--linebreak--,offers,--linebreak--,organizers, organizers_pointer,--linebreak--,rating_value, rating_count,--linebreak--,best_rating, worst_rating'
    ];

    $GLOBALS['TCA']['tx_hdstructureddata_domain_model_structureddata']['types']['service'] = [
        'showitem' => '--palette--;;type,--palette--;;service,
            --div--;LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.div.access,--palette--;;access,',
        'columnsOverrides' => [
            'title' => [
                'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.title.service',
                'config' => [
                    'eval' => 'trim',
                    'required' => true
                ]
            ],
            'service_type' => [
                'description' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:recommended'
            ],
        ]
    ];

    $GLOBALS['TCA']['tx_hdstructureddata_domain_model_structureddata']['columns']['type']['config']['items'][] = [
        'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.type.service',
        'value' => 'service'
    ];
    $GLOBALS['TCA']['tx_hdstructureddata_domain_model_structureddata']['ctrl']['typeicon_classes']['service'] = 'hd_structureddata_service';
})();
