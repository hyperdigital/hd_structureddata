<?php
defined('TYPO3') || die();

(function () {
    $GLOBALS['TCA']['tx_hdstructureddata_domain_model_structureddata']['palettes']['product'] = [
        'showitem' => 'title,--linebreak--,sku,gtin14,--linebreak--,description,--linebreak--,brands,--linebreak--,images,--linebreak--,offers,--linebreak--,reviews,'
    ];
    $GLOBALS['TCA']['tx_hdstructureddata_domain_model_structureddata']['palettes']['product-agregaterating'] = [
        'showitem' => 'rating_value,rating_count,--linebreak--,best_rating,worst_rating'
    ];

    $GLOBALS['TCA']['tx_hdstructureddata_domain_model_structureddata']['types']['product'] = [
        'showitem' => '--palette--;;type,--palette--;;product,--palette--;LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.palette.product-agregaterating;product-agregaterating,
            --div--;LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.div.access,--palette--;;access,',
        'columnsOverrides' => [
            'title' => [
                'config' => [
                    'required' => true
                ]
            ],
        ]
    ];

    $GLOBALS['TCA']['tx_hdstructureddata_domain_model_structureddata']['columns']['type']['config']['items'][] = [
        'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.type.product',
        'value' => 'product'
    ];
    $GLOBALS['TCA']['tx_hdstructureddata_domain_model_structureddata']['ctrl']['typeicon_classes']['product'] = 'hd_structureddata_product';
})();
