<?php
defined('TYPO3') || die();

(function () {
    $GLOBALS['TCA']['tx_hdstructureddata_domain_model_structureddata']['palettes']['organization'] = [
        'showitem' => 'subtype, title,legal_name,--linebreak--,
        telephone,email,--linebreak--,
        url,--linebreak--,
        sameas,--linebreak--,
        price_range,serves_cuisine,--linebreak--,
        accepts_reservations,menu,--linebreak--,
        opening_hours,--linebreak--,
        date_published,vat_id,tax_id,--linebreak--,
        description,--linebreak--,
        logo,--linebreak--,
        images,--linebreak--,
        addresses,--linebreak--,
        pointed_as_organizer'
    ];

    $GLOBALS['TCA']['tx_hdstructureddata_domain_model_structureddata']['types']['organization'] = [
        'showitem' => '--palette--;;type,--palette--;;organization,
            --div--;LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.div.access,--palette--;;access,',
        'columnsOverrides' => [
            'title' => [
                'config' => [
                    'required' => true
                ]
            ],
            'telephone' => [
                'config' => [
                    'required' => true
                ]
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
            'images' => [
                'description' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:recommended'
            ],
            'addresses' => [
                'description' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:recommended'
            ],
            'date_published' => [
                'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.date_published.organization',
                'config' => [
                    'format' => 'date',
                ]
            ],
            'subtype' => [
                'onChange' => 'reload',
                'config' => [
                    'items' => [
                        [
                            'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.subtype.review.Organization',
                            'value' => 'Organization',
                        ],
                        [
                            'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.subtype.review.Restaurant',
                            'value' => 'Restaurant',
                        ]
                    ],
                ]
            ],
        ]
    ];

    $GLOBALS['TCA']['tx_hdstructureddata_domain_model_structureddata']['columns']['type']['config']['items'][] = [
        'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.type.organization',
        'value' => 'organization'
    ];
    $GLOBALS['TCA']['tx_hdstructureddata_domain_model_structureddata']['ctrl']['typeicon_classes']['organization'] = 'hd_structureddata_organization';
    $GLOBALS['TCA']['tx_hdstructureddata_domain_model_structureddata']['columns']['datatype_note']['config']['parameters']['organization'] = 'EXT:hd_structureddata/Resources/Private/Templates/DataTypeNotes/Organization.html';

})();
