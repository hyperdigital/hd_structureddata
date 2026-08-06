<?php
defined('TYPO3') || die();

return [
    'ctrl' => [
        'title' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata_shipping',
        'label' => 'shipping_destination',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'versioningWS' => true,
        'sortby' => 'sorting',
        'languageField' => 'sys_language_uid',
        'transOrigPointerField' => 'l10n_parent',
        'transOrigDiffSourceField' => 'l10n_diffsource',
        'translationSource' => 'l10n_source',
        'delete' => 'deleted',
        'iconfile' => 'EXT:hd_structureddata/Resources/Public/Icons/product.svg',
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
            'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata_shipping.palette.access',
            'showitem' => 'hidden, --linebreak--,starttime,endtime,--linebreak--,fe_group,'
        ],
        'base' => [
            'showitem' => 'shipping_destination, shipping_rate, shipping_currency,--linebreak--,handling_time_min, handling_time_max,--linebreak--,transit_time_min, transit_time_max'
        ],
    ],
    'types' => [
        '0' => [
            'showitem' => '--palette--;;base,
            --div--;LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata_shipping.div.access,--palette--;;access,'
        ]
    ],
    'columns' => [
        'fieldname' => [
            'config' => [
                'type' => 'input'
            ],
        ],
        'shipping_destination' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata_shipping.columns.shipping_destination',
            'description' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata_shipping.columns.shipping_destination.description',
            'config' => [
                'type' => 'input',
                'eval' => 'trim',
                'required' => true,
            ]
        ],
        'shipping_rate' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata_shipping.columns.shipping_rate',
            'config' => [
                'type' => 'number',
                'format' => 'decimal',
            ]
        ],
        'shipping_currency' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata_shipping.columns.shipping_currency',
            'config' => [
                'type' => 'input',
                'eval' => 'trim',
                'valuePicker' => [
                    'items' => \Hyperdigital\HdStructureddata\Service\TcaService::valuePickerItems([
                        ['label' => 'EUR', 'value' => 'EUR'],
                        ['label' => 'USD', 'value' => 'USD'],
                    ]),
                ],
            ]
        ],
        'handling_time_min' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata_shipping.columns.handling_time_min',
            'description' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata_shipping.columns.handling_time_min.description',
            'config' => [
                'type' => 'number',
            ]
        ],
        'handling_time_max' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata_shipping.columns.handling_time_max',
            'config' => [
                'type' => 'number',
            ]
        ],
        'transit_time_min' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata_shipping.columns.transit_time_min',
            'description' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata_shipping.columns.transit_time_min.description',
            'config' => [
                'type' => 'number',
            ]
        ],
        'transit_time_max' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata_shipping.columns.transit_time_max',
            'config' => [
                'type' => 'number',
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
                'foreign_table' => 'tx_hdstructureddata_domain_model_structureddata_shipping',
                'foreign_table_where' =>
                    'AND {#tx_hdstructureddata_domain_model_structureddata_shipping}.{#pid}=###CURRENT_PID###'
                    . ' AND {#tx_hdstructureddata_domain_model_structureddata_shipping}.{#sys_language_uid} IN (-1,0)',
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
