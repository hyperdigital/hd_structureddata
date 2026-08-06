<?php
defined('TYPO3') || die();

(function () {
    $GLOBALS['TCA']['tx_hdstructureddata_domain_model_structureddata']['palettes']['article'] = [
        'showitem' => 'subtype,--linebreak--,title,--linebreak--,date_published, date_modified,--linebreak--,abstract,--linebreak--, authors,--linebreak--,images,--linebreak--,speakable'
    ];

    $GLOBALS['TCA']['tx_hdstructureddata_domain_model_structureddata']['types']['article'] = [
        'showitem' => '--palette--;;type,--palette--;;article,
            --div--;LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.div.access,--palette--;;access,',
        'columnsOverrides' => [
            'title' => [
                'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.title.article',
                'config' => [
                    'eval' => 'trim',
                    'required' => true
                ]
            ],
            'subtype' => [
                'config' => [
                    'items' => [
                        [
                            'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.subtype.article.article',
                            'value' => 'Article'
                        ],
                        [
                            'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.subtype.article.newsArticle',
                            'value' => 'NewsArticle'
                        ],
                        [
                            'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.subtype.article.blogPosting',
                            'value' => 'BlogPosting'
                        ],
                        [
                            'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.subtype.article.techArticle',
                            'value' => 'TechArticle'
                        ],
                        [
                            'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.subtype.article.scholarlyArticle',
                            'value' => 'ScholarlyArticle'
                        ],
                        [
                            'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.subtype.article.report',
                            'value' => 'Report'
                        ]
                    ]
                ]
            ],
            'authors' => [
                'description' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:recommended'
            ],
            'images' => [
                'description' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:recommended'
            ]
        ]
    ];

    $GLOBALS['TCA']['tx_hdstructureddata_domain_model_structureddata']['columns']['type']['config']['items'][] = [
        'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.type.article',
        'value' => 'article'
    ];
    $GLOBALS['TCA']['tx_hdstructureddata_domain_model_structureddata']['columns']['type']['config']['default'] = 'article';
    $GLOBALS['TCA']['tx_hdstructureddata_domain_model_structureddata']['ctrl']['typeicon_classes']['article'] = 'hd_structureddata_article';
})();
