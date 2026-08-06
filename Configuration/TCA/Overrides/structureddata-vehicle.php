<?php
defined('TYPO3') || die();

(function () {
    $GLOBALS['TCA']['tx_hdstructureddata_domain_model_structureddata']['palettes']['vehicle'] = [
        'showitem' => 'title,--linebreak--,description,--linebreak--,brands, sku,--linebreak--,vehicle_model_date, vehicle_mileage,--linebreak--,vehicle_engine, vehicle_transmission,--linebreak--,vehicle_fuel_type, vehicle_seating_capacity,--linebreak--,url,--linebreak--,images,--linebreak--,offers'
    ];

    $GLOBALS['TCA']['tx_hdstructureddata_domain_model_structureddata']['types']['vehicle'] = [
        'showitem' => '--palette--;;type,--palette--;;vehicle,
            --div--;LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.div.access,--palette--;;access,',
        'columnsOverrides' => [
            'title' => [
                'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.title.vehicle',
                'config' => [
                    'eval' => 'trim',
                    'required' => true
                ]
            ],
            'images' => [
                'description' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:recommended'
            ],
            'offers' => [
                'description' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:recommended'
            ],
        ]
    ];

    $GLOBALS['TCA']['tx_hdstructureddata_domain_model_structureddata']['columns']['type']['config']['items'][] = [
        'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.type.vehicle',
        'value' => 'vehicle'
    ];
    $GLOBALS['TCA']['tx_hdstructureddata_domain_model_structureddata']['ctrl']['typeicon_classes']['vehicle'] = 'hd_structureddata_vehicle';
})();
