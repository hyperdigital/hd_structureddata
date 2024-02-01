<?php
defined('TYPO3') || die();

(function () {
    $GLOBALS['TCA']['tx_hdstructureddata_domain_model_structureddata']['palettes']['video'] = [
        'showitem' => 'title,--linebreak--,description,--linebreak--,medias,--linebreak--,images, --linebreak--, clips,'
    ];

    $GLOBALS['TCA']['tx_hdstructureddata_domain_model_structureddata']['types']['video'] = [
        'showitem' => '--palette--;;type,--palette--;;video,
            --div--;LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.div.access,--palette--;;access,',
        'columnsOverrides' => [
            'title' => [
                'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.title.video',
                'config' => [
                    'eval' => 'trim',
                    'required' => true
                ]
            ],
            'description' => [
                'config' => [
                    'description' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:recommended'
                ]
            ],
            'medias' => [
                'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.medias.video',
                'config' => [
                    'minitems' => 1,
                    'maxitems' => 1,
                    'allowed' => 'mp4,avi,webm,ogg,mov,youtube,vimeo'
                ]
            ],
            'images' => [
                'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.images.video',
                'config' => [
                    'minitems' => 1,
                ]
            ]
        ]
    ];

    $GLOBALS['TCA']['tx_hdstructureddata_domain_model_structureddata']['columns']['type']['config']['items'][] = [
        'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.type.video',
        'value' => 'video'
    ];
    $GLOBALS['TCA']['tx_hdstructureddata_domain_model_structureddata']['ctrl']['typeicon_classes']['video'] = 'hd_structureddata_video';
})();
