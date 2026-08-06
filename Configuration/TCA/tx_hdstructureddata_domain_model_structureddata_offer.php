<?php
defined('TYPO3') || die();

return [
    'ctrl' => [
        'title' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata_offer',
        'label' => 'availability',
        'label_alt' => 'price,valid_from,valid_until',
        'label_alt_force' => true,
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'versioningWS' => true,
        'sortby' => 'sorting',
        'languageField' => 'sys_language_uid',
        'transOrigPointerField' => 'l10n_parent',
        'transOrigDiffSourceField' => 'l10n_diffsource',
        'translationSource' => 'l10n_source',
        'delete' => 'deleted',
        'iconfile' => 'EXT:hd_structureddata/Resources/Public/Icons/clock.svg',
        'enablecolumns' => [
            'disabled' => 'hidden',
            'starttime' => 'starttime',
            'endtime' => 'endtime',
            'fe_group' => 'fe_group'
        ],
        'hideTable' => true,
        'security' => [
            'ignorePageTypeRestriction' => true,
        ],
    ],
    'palettes' => [
        'access' => [
            'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata_offer.palette.access',
            'showitem' => 'hidden, --linebreak--,starttime,endtime,--linebreak--,fe_group,'
        ],
        'base' => [
            'showitem' => 'availability,--linebreak--,valid_from,valid_until,--linebreak--,price,price_currency,category,--linebreak--,url,--linebreak--,shipping_details,--linebreak--,return_policy'
        ],
    ],
    'types' => [
        '0' => [
            'showitem' => '--palette--;;type,--palette--;;base,
            --div--;LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata_offer.div.access,--palette--;;access,'
        ],
    ],
    'columns' => [
        'fieldname' => [
            'config' => [
                'type' => 'input'
            ],
        ],
        'availability' => [
            'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata_offer.columns.availability',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'default' => 'InStock',
                'items' => [
                    [
                        'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata_offer.columns.availability.InStock',
                        'value' => 'InStock'
                    ],
                    [
                        'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata_offer.columns.availability.SoldOut',
                        'value' => 'SoldOut'
                    ],
                    [
                        'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata_offer.columns.availability.PreOrder',
                        'value' => 'PreOrder'
                    ]
                ]
            ]
        ],
        'url' => [
            'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata_offer.columns.url',
            'description' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:recommended',
            'config' => [
                'type' => 'link',
                'appearance' => [
                    'allowedOptions' => ['params'],
                ],
            ]
        ],
        'price' => [
            'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata_offer.columns.price',
            'description' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:recommended',
            'config' => [
                'default' => 0,
                'type' => 'number',
                'format' => 'decimal',
            ]
        ],
        'price_currency' => [
            'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata_offer.columns.priceCurrency',
            'description' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:recommended',
            'config' => [
                'type' => 'input',
                'valuePicker' => [
                    'items' => \Hyperdigital\HdStructureddata\Service\TcaService::valuePickerItems([
                        [
                            'label' => 'EUR',
                            'value' => 'EUR',
                        ],
                        [
                            'label' => 'USD',
                            'value' => 'USD',
                        ],
                    ]),
                ],
            ]
        ],
        'category' => [
            'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata_offer.columns.category',
            'description' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata_offer.columns.category.description',
            'config' => [
                'type' => 'input',
                'valuePicker' => [
                    'items' => \Hyperdigital\HdStructureddata\Service\TcaService::valuePickerItems([
                        [
                            'label' => 'Paid',
                            'value' => 'Paid',
                        ],
                        [
                            'label' => 'Free',
                            'value' => 'Free',
                        ],
                    ]),
                ],
            ]
        ],
        'valid_from' => [
            'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata_offer.columns.valid_from',
            'description' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:recommended',
            'config' => [
                'type' => 'datetime',
                'dbType' => 'datetime',
                'nullable' => true,
            ]
        ],
        'valid_until' => [
            'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata_offer.columns.valid_until',
            'description' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:recommended',
            'config' => [
                'type' => 'datetime',
                'dbType' => 'datetime',
                'nullable' => true,
            ]
        ],
        'shipping_details' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata_offer.columns.shipping_details',
            'description' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata_offer.columns.shipping_details.description',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_hdstructureddata_domain_model_structureddata_shipping',
                'foreign_field' => 'foreign_uid',
                'foreign_sortby' => 'sorting',
                'foreign_table_field' => 'tablename',
                'foreign_match_fields' => [
                    'fieldname' => 'shipping_details',
                ],
                'behaviour' => [
                    'allowLanguageSynchronization' => true
                ],
            ]
        ],
        'return_policy' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata_offer.columns.return_policy',
            'description' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata_offer.columns.return_policy.description',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_hdstructureddata_domain_model_structureddata_returnpolicy',
                'foreign_field' => 'foreign_uid',
                'foreign_sortby' => 'sorting',
                'foreign_table_field' => 'tablename',
                'foreign_match_fields' => [
                    'fieldname' => 'return_policy',
                ],
                'maxitems' => 1,
                'behaviour' => [
                    'allowLanguageSynchronization' => true
                ],
            ]
        ],
        'hidden' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.enabled',
            'config' => [
                'type' => 'check',
                'renderType' => 'checkboxToggle',
                'items' => [
                    [
                        'label' => '',
                        'invertStateDisplay' => true
                    ]
                ],
            ]
        ],
        'starttime' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.starttime',
            'config' => [
                'type' => 'datetime',
                'default' => 0,
            ],
            'l10n_mode' => 'exclude',
            'l10n_display' => 'defaultAsReadonly',
        ],
        'endtime' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.endtime',
            'config' => [
                'type' => 'datetime',
                'default' => 0,
                'range' => [
                    'upper' => mktime(0, 0, 0, 1, 1, 2038),
                ],
            ],
            'l10n_mode' => 'exclude',
            'l10n_display' => 'defaultAsReadonly',
        ],
        'fe_group' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.fe_group',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectMultipleSideBySide',
                'size' => 5,
                'maxitems' => 20,
                'items' => [
                    [
                        'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.hide_at_login',
                        'value' => -1,
                    ],
                    [
                        'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.any_login',
                        'value' => -2,
                    ],
                    [
                        'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.usergroups',
                        'value' => '--div--',
                    ],
                ],
                'exclusiveKeys' => '-1,-2',
                'foreign_table' => 'fe_groups',
            ],
        ],
        'sys_language_uid' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.language',
            'config' => [
                'type' => 'language',
                'renderType' => 'selectSingle',
                'items' => [
                    [
                        'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.allLanguages',
                        'value' => -1,
                        'icon' => 'flags-multiple',
                    ],
                ],
                'default' => 0,
            ],
        ],
        't3ver_label' => [
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.versionLabel',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'max' => 255,
            ],
        ],
        'l10n_parent' => [
            'displayCond' => 'FIELD:sys_language_uid:>:0',
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.l18n_parent',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    [
                        'label' => '',
                        'value' => 0,
                    ],
                ],
                'foreign_table' => 'tx_hdstructureddata_domain_model_structureddata_offer',
                'foreign_table_where' =>
                    'AND {#tx_hdstructureddata_domain_model_structureddata_offer}.{#pid}=###CURRENT_PID###'
                    . ' AND {#tx_hdstructureddata_domain_model_structureddata_offer}.{#sys_language_uid} IN (-1,0)',
                'default' => 0,
            ],
        ],
        'l10n_diffsource' => [
            'config' => [
                'type' => 'passthrough',
            ],
        ],
        'l10n_source' => [
            'config' => [
                'type' => 'passthrough',
            ],
        ],
    ],
];
