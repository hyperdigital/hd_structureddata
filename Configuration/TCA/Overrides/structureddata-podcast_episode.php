<?php
defined('TYPO3') || die();

(function () {
    $GLOBALS['TCA']['tx_hdstructureddata_domain_model_structureddata']['palettes']['podcast_episode'] = [
        'showitem' => 'title,--linebreak--,description,--linebreak--,series_name, episode_number,--linebreak--,medias,--linebreak--,date_published, duration_minutes,--linebreak--,url,--linebreak--,images'
    ];

    $GLOBALS['TCA']['tx_hdstructureddata_domain_model_structureddata']['types']['podcast_episode'] = [
        'showitem' => '--palette--;;type,--palette--;;podcast_episode,
            --div--;LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.div.access,--palette--;;access,',
        'columnsOverrides' => [
            'title' => [
                'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.title.podcast_episode',
                'config' => [
                    'eval' => 'trim',
                    'required' => true
                ]
            ],
            'medias' => [
                'description' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:recommended'
            ],
            'series_name' => [
                'description' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:recommended'
            ],
            'medias' => [
                'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.medias.podcast_episode'
            ],
        ]
    ];

    $GLOBALS['TCA']['tx_hdstructureddata_domain_model_structureddata']['columns']['type']['config']['items'][] = [
        'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.type.podcast_episode',
        'value' => 'podcast_episode'
    ];
    $GLOBALS['TCA']['tx_hdstructureddata_domain_model_structureddata']['ctrl']['typeicon_classes']['podcast_episode'] = 'hd_structureddata_podcast';
})();
