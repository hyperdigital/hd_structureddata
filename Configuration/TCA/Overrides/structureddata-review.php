<?php
defined('TYPO3') || die();

(function () {
    $GLOBALS['TCA']['tx_hdstructureddata_domain_model_structureddata']['palettes']['review'] = [
        'showitem' => 'subtype,--linebreak--,rating_value,rating_count,--linebreak--,best_rating,worst_rating,--linebreak--,authors',
    ];
    $GLOBALS['TCA']['tx_hdstructureddata_domain_model_structureddata']['palettes']['reviewItem'] = [
        'showitem' => 'title,legal_name,--linebreak--,telephone,email,--linebreak--,url,--linebreak--,price_range,serves_cuisine,--linebreak--,accepts_reservations,menu,--linebreak--,opening_hours,--linebreak--,date_published,vat_id,tax_id,--linebreak--,description,--linebreak--,logo,--linebreak--,images,--linebreak--,addresses',

    ];

    $GLOBALS['TCA']['tx_hdstructureddata_domain_model_structureddata']['types']['review'] = [
        'showitem' => '--palette--;;type,--palette--;;review,
        --palette--;LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.palette.reviewItem;reviewItem,
            --div--;LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.div.access,--palette--;;access,',
        'columnsOverrides' => [
            'authors' => [
                'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.authors.review',
                'config' => [
                    'minitems' => 1,
                ]
            ],
            'title' => [
                'config' => [
                    'required' => true
                ]
            ],
            'telephone' => [
                'description' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:recommended'
            ],
            'addresses' => [
                'description' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:recommended',
            ],
            'serves_cuisine' => [
                'displayCond' => [
                    'AND' => [
                        'FIELD:subtype:=:Restaurant',
                    ]
                ],
            ],
            'accepts_reservations' => [
                'displayCond' => [
                    'AND' => [
                        'FIELD:subtype:=:Restaurant',
                    ]
                ],
            ],
            'menu' => [
                'displayCond' => [
                    'AND' => [
                        'FIELD:subtype:=:Restaurant',
                    ]
                ],
            ],
            'subtype' => [
                'onChange' => 'reload',
                'config' => [
                    'items' => [
                        [
                            'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.subtype.review.Organization',
                            'value' => 'Organization',
                            'group' => 'organization'
                        ],
                        [
                            'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.subtype.review.Restaurant',
                            'value' => 'Restaurant',
                            'group' => 'organization'
                        ]
                    ],
                    'itemGroups' => [
                        'organization' =>'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.subtype.review.OrganizationGroup'
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
