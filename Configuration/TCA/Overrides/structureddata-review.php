<?php
defined('TYPO3') || die();

(function () {
    $GLOBALS['TCA']['tx_hdstructureddata_domain_model_structureddata']['palettes']['review'] = [
        'showitem' => 'subtype,--linebreak--,title,--linebreak--,authors',
    ];

    $GLOBALS['TCA']['tx_hdstructureddata_domain_model_structureddata']['types']['review'] = [
        'showitem' => '--palette--;;type,--palette--;;review,
            --div--;LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.div.access,--palette--;;access,',
        'columnsOverrides' => [
            'authors' => [
                'config' => [
                    'minitems' => 1,
                ]
            ],
            'title' => [
                'config' => [
                    'required' => true
                ]
            ],
            'subtype' => [
                'config' => [
                    'items' => [
                        [
                            'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.subtype.review.Restaurant',
                            'value' => 'Restaurant'
                        ]
                    ]
                ]
            ],
        ]
    ];

    $GLOBALS['TCA']['tx_hdstructureddata_domain_model_structureddata']['columns']['type']['config']['items'][] = [
        'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.type.review',
        'value' => 'review'
    ];
    $GLOBALS['TCA']['tx_hdstructureddata_domain_model_structureddata']['ctrl']['typeicon_classes']['review'] = 'hd_structureddata_review';
})();
