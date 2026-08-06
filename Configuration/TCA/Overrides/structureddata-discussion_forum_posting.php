<?php
defined('TYPO3') || die();

(function () {
    $GLOBALS['TCA']['tx_hdstructureddata_domain_model_structureddata']['palettes']['discussion_forum_posting'] = [
        'showitem' => 'title,--linebreak--,description,--linebreak--,authors,--linebreak--,date_published, date_modified,--linebreak--,url,--linebreak--,images,--linebreak--,comment_count'
    ];

    $GLOBALS['TCA']['tx_hdstructureddata_domain_model_structureddata']['types']['discussion_forum_posting'] = [
        'showitem' => '--palette--;;type,--palette--;;discussion_forum_posting,
            --div--;LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.div.access,--palette--;;access,',
        'columnsOverrides' => [
            'title' => [
                'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.title.discussion_forum_posting',
                'config' => [
                    'eval' => 'trim',
                    'required' => true
                ]
            ],
            'authors' => [
                'description' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:recommended'
            ],
        ]
    ];

    $GLOBALS['TCA']['tx_hdstructureddata_domain_model_structureddata']['columns']['type']['config']['items'][] = [
        'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.type.discussion_forum_posting',
        'value' => 'discussion_forum_posting'
    ];
    $GLOBALS['TCA']['tx_hdstructureddata_domain_model_structureddata']['ctrl']['typeicon_classes']['discussion_forum_posting'] = 'hd_structureddata_discussion';
})();
