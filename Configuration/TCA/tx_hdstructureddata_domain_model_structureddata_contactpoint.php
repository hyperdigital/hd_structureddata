<?php
defined('TYPO3') || die();

return [
    'ctrl' => [
        'title' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata_contactpoint',
        'label' => 'contact_type',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'versioningWS' => true,
        'sortby' => 'sorting',
        'languageField' => 'sys_language_uid',
        'transOrigPointerField' => 'l10n_parent',
        'transOrigDiffSourceField' => 'l10n_diffsource',
        'translationSource' => 'l10n_source',
        'delete' => 'deleted',
        'iconfile' => 'EXT:hd_structureddata/Resources/Public/Icons/person.svg',
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
            'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata_contactpoint.palette.access',
            'showitem' => 'hidden, --linebreak--,starttime,endtime,--linebreak--,fe_group,'
        ],
        'base' => [
            'showitem' => 'contact_type,--linebreak--,telephone, email,--linebreak--,area_served, available_language'
        ],
    ],
    'types' => [
        '0' => [
            'showitem' => '--palette--;;base,
            --div--;LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata_contactpoint.div.access,--palette--;;access,'
        ]
    ],
    'columns' => [
        'fieldname' => [
            'config' => [
                'type' => 'input'
            ],
        ],
        'contact_type' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata_contactpoint.columns.contact_type',
            'description' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata_contactpoint.columns.contact_type.description',
            'config' => [
                'type' => 'input',
                'eval' => 'trim',
                'required' => true,
                'valuePicker' => [
                    'items' => \Hyperdigital\HdStructureddata\Service\TcaService::valuePickerItems([
                        ['label' => 'customer service', 'value' => 'customer service'],
                        ['label' => 'technical support', 'value' => 'technical support'],
                        ['label' => 'billing support', 'value' => 'billing support'],
                        ['label' => 'sales', 'value' => 'sales'],
                        ['label' => 'reservations', 'value' => 'reservations'],
                    ]),
                ],
            ]
        ],
        'telephone' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata_contactpoint.columns.telephone',
            'config' => [
                'type' => 'input',
                'eval' => 'trim',
            ]
        ],
        'email' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata_contactpoint.columns.email',
            'config' => [
                'type' => 'input',
                'eval' => 'trim',
            ]
        ],
        'area_served' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata_contactpoint.columns.area_served',
            'description' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata_contactpoint.columns.area_served.description',
            'config' => [
                'type' => 'input',
                'eval' => 'trim',
            ]
        ],
        'available_language' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata_contactpoint.columns.available_language',
            'description' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata_contactpoint.columns.available_language.description',
            'config' => [
                'type' => 'input',
                'eval' => 'trim',
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
                'foreign_table' => 'tx_hdstructureddata_domain_model_structureddata_contactpoint',
                'foreign_table_where' =>
                    'AND {#tx_hdstructureddata_domain_model_structureddata_contactpoint}.{#pid}=###CURRENT_PID###'
                    . ' AND {#tx_hdstructureddata_domain_model_structureddata_contactpoint}.{#sys_language_uid} IN (-1,0)',
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
