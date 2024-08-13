<?php
defined('TYPO3') || die();

(function () {
    $GLOBALS['TCA']['tx_hdstructureddata_domain_model_structureddata']['palettes']['sitelinkssearchbox'] = [
        'showitem' => 'url,--linebreak--,search_parameter'
    ];

    $GLOBALS['TCA']['tx_hdstructureddata_domain_model_structureddata']['types']['sitelinkssearchbox'] = [
        'showitem' => '--palette--;;type,--palette--;LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.palette.sitelinkssearchbox;sitelinkssearchbox,
            --div--;LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.div.access,--palette--;;access,',
        'columnsOverrides' => [
            'url' => [
                'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.url.sitelinkssearchbox',
                'description' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.url.sitelinkssearchbox.description',
                'config' => [
                    'required' => true,
                ]
            ],
            'search_parameter' => [
                'config' => [
                    'required' => true,
                ]
            ]
        ]
    ];

    $GLOBALS['TCA']['tx_hdstructureddata_domain_model_structureddata']['columns']['type']['config']['items'][] = [
        'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.type.sitelinkssearchbox',
        'value' => 'sitelinkssearchbox'
    ];
    $GLOBALS['TCA']['tx_hdstructureddata_domain_model_structureddata']['ctrl']['typeicon_classes']['sitelinkssearchbox'] = 'hd_structureddata_search';
    $GLOBALS['TCA']['tx_hdstructureddata_domain_model_structureddata']['columns']['datatype_note']['config']['parameters']['sitelinkssearchbox'] = 'EXT:hd_structureddata/Resources/Private/Templates/DataTypeNotes/Sitelinkssearchbox.html';
})();
