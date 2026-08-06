<?php
defined('TYPO3') || die();

$searchParamPickerValues = \Hyperdigital\HdStructureddata\Service\SearchParamService::getTcaPickerValuesForSearchParam();

return [
    'ctrl' => [
        'title' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata',
        'label' => 'type',
        'label_alt' => 'title',
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
        'iconfile' => 'EXT:hd_structureddata/Resources/Public/Icons/Extension.svg',
        'enablecolumns' => [
            'disabled' => 'hidden',
            'starttime' => 'starttime',
            'endtime' => 'endtime',
            'fe_group' => 'fe_group'
        ],
        'security' => [
            'ignorePageTypeRestriction' => true,
        ],
        'type' => 'type',
        'typeicon_column' => 'type',
        'typeicon_classes' => [
            'default' => 'hd_structureddata',
        ]
    ],
    'palettes' => [
        'access' => [
            'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.palette.access',
            'showitem' => 'hidden, --linebreak--,starttime,endtime,--linebreak--,fe_group,'
        ],
        'type' => [
            'showitem' => 'type,--linebreak--,datatype_note'
        ],
    ],
    'types' => [
        '0' => [
            'showitem' => '--palette--;;type,
            --div--;LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.div.access,--palette--;;access,'
        ]
    ],
    'columns' => [
        'fieldname' => [
            'config' => [
                'type' => 'input'
            ],
        ],
        'datatype_note' => [
            'config' => [
                'type' => 'user',
                'renderType' => 'hdDescriptionField',
                'parameters' => [
                    // key (== type value) => path to HTML template
                ]
            ]
        ],
        'type' => [
            'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.type',
            'onChange' => 'reload',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    // Added over overrides to let it be scalable
                ]
            ]
        ],
        'subtype' => [
            'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.subtype',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    // Added over overrides to let it be scalable
                    ['label' => '', 'value' => '']
                ]
            ]
        ],
        'identifier' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.identifier',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_hdstructureddata_domain_model_structureddata_identifier',
                'foreign_field' => 'foreign_uid',
                'foreign_sortby' => 'sorting',
                'foreign_table_field' => 'tablename',
                'foreign_match_fields' => [
                    'fieldname' => 'identifier',
                ],
                'behaviour' => [
                    'allowLanguageSynchronization' => true
                ],
            ],
        ],
        'title' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.title',
            'config' => [
                'type' => 'input',
            ]
        ],
        'sku' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.sku',
            'config' => [
                'type' => 'input',
            ]
        ],
        'gtin14' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.gtin14',
            'config' => [
                'type' => 'input',
            ]
        ],
        'legal_name' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.legal_name',
            'description' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.legal_name.description',
            'config' => [
                'type' => 'input',
            ]
        ],
        'telephone' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.telephone',
            'config' => [
                'type' => 'input',
            ]
        ],
        'start_date' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.start_date',
            'config' => [
                'type' => 'datetime',
                'dbType' => 'datetime',
                'nullable' => true,
            ]
        ],
        'end_date' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.end_date',
            'config' => [
                'type' => 'datetime',
                'dbType' => 'datetime',
                'nullable' => true,
            ]
        ],
        'date_published' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.date_published',
            'config' => [
                'type' => 'datetime',
                'dbType' => 'datetime',
                'nullable' => true,
            ]
        ],
        'date_modified' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.date_modified',
            'config' => [
                'type' => 'datetime',
                'dbType' => 'datetime',
                'nullable' => true,
            ]
        ],
        'status' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.status',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle'
            ]
        ],
        'abstract' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.abstract',
            'config' => [
                'type' => 'text',
            ]
        ],
        'description' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.description',
            'config' => [
                'type' => 'text',
            ]
        ],
        'authors' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.authors',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_hdstructureddata_domain_model_structureddata_person',
                'foreign_field' => 'foreign_uid',
                'foreign_sortby' => 'sorting',
                'foreign_table_field' => 'tablename',
                'foreign_match_fields' => [
                    'fieldname' => 'authors',
                ],
                'behaviour' => [
                    'allowLanguageSynchronization' => true
                ],
            ],
        ],
        'images' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.images',
            'config' => [
                'type' => 'file',
                'allowed' => 'common-image-types'
            ]
        ],
        'medias' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.medias',
            'config' => [
                'type' => 'file',
                'allowed' => ['common-image-types', 'mov', 'mp4', 'avi', 'webm']
            ]
        ],
        'logo' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.logo',
            'config' => [
                'type' => 'file',
                'maxitems' => 1,
                'allowed' => 'common-image-types'
            ]
        ],
        'email' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.email',
            'config' => [
                'type' => 'input',
            ]
        ],
        'url' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.url',
            'config' => [
                'type' => 'link',
                'appearance' => [
                    'allowedOptions' => ['params'],
                ],
            ]
        ],
        'search_parameter' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.search_parameter',
            'description' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.search_parameter.description',
            'config' => [
                'type' => 'input',
                'size' => 35,
                'valuePicker' => [
                    'items' => $searchParamPickerValues
                ]
            ]
        ],
        'sameas' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.sameas',
            'description' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.sameas.description',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_hdstructureddata_domain_model_structureddata_sameas',
                'foreign_field' => 'foreign_uid',
                'foreign_sortby' => 'sorting',
                'foreign_table_field' => 'tablename',
                'foreign_match_fields' => [
                    'fieldname' => 'sameas',
                ],
                'behaviour' => [
                    'allowLanguageSynchronization' => true
                ],
            ],
        ],
        'faqs' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.faqs',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_hdstructureddata_domain_model_structureddata_faq',
                'foreign_field' => 'foreign_uid',
                'foreign_sortby' => 'sorting',
                'foreign_table_field' => 'tablename',
                'foreign_match_fields' => [
                    'fieldname' => 'faqs',
                ],
                'behaviour' => [
                    'allowLanguageSynchronization' => true
                ],
            ],
        ],
        'locations' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.locations',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_hdstructureddata_domain_model_structureddata_location',
                'foreign_field' => 'foreign_uid',
                'foreign_sortby' => 'sorting',
                'foreign_table_field' => 'tablename',
                'foreign_match_fields' => [
                    'fieldname' => 'locations',
                ],
                'behaviour' => [
                    'allowLanguageSynchronization' => true
                ],
            ],
        ],
        'addresses' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.addresses',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_hdstructureddata_domain_model_structureddata_address',
                'foreign_field' => 'foreign_uid',
                'foreign_sortby' => 'sorting',
                'foreign_table_field' => 'tablename',
                'foreign_match_fields' => [
                    'fieldname' => 'addresses',
                ],
                'behaviour' => [
                    'allowLanguageSynchronization' => true
                ],
            ],
        ],
        'geo' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.geo',
            'description' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:recommended',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_hdstructureddata_domain_model_structureddata_geo',
                'foreign_field' => 'foreign_uid',
                'foreign_sortby' => 'sorting',
                'foreign_table_field' => 'tablename',
                'foreign_match_fields' => [
                    'fieldname' => 'geo',
                ],
                'maxitems' => 1,
                'behaviour' => [
                    'allowLanguageSynchronization' => true
                ],
            ],
        ],
        'negative_notes' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.negative_notes',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_hdstructureddata_domain_model_structureddata_reviewnote',
                'foreign_field' => 'foreign_uid',
                'foreign_sortby' => 'sorting',
                'foreign_table_field' => 'tablename',
                'foreign_match_fields' => [
                    'fieldname' => 'negative_notes',
                ],
                'behaviour' => [
                    'allowLanguageSynchronization' => true
                ],
            ],
        ],
        'positive_notes' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.positive_notes',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_hdstructureddata_domain_model_structureddata_reviewnote',
                'foreign_field' => 'foreign_uid',
                'foreign_sortby' => 'sorting',
                'foreign_table_field' => 'tablename',
                'foreign_match_fields' => [
                    'fieldname' => 'positive_notes',
                ],
                'behaviour' => [
                    'allowLanguageSynchronization' => true
                ],
            ],
        ],
        'offers' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.offers',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_hdstructureddata_domain_model_structureddata_offer',
                'foreign_field' => 'foreign_uid',
                'foreign_sortby' => 'sorting',
                'foreign_table_field' => 'tablename',
                'foreign_match_fields' => [
                    'fieldname' => 'offers',
                ],
                'behaviour' => [
                    'allowLanguageSynchronization' => true
                ],
            ],
        ],
        'organizers' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.organizers',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_hdstructureddata_domain_model_structureddata',
                'foreign_field' => 'foreign_uid',
                'foreign_sortby' => 'sorting',
                'foreign_table_field' => 'tablename',
                'foreign_match_fields' => [
                    'fieldname' => 'organizers',
                ],
                'behaviour' => [
                    'allowLanguageSynchronization' => true
                ],
                'overrideChildTca' => [
                    'columns' => [
                        'type' => [
                            'config' => [
                                'type' => 'user',
                                'renderType' => 'hdNotEditableField',
                                'default' => 'organization'
                            ]
                        ],
                        'telephone' => [
                            'config' => [
                                'required' => false,
                            ]
                        ]
                    ]
                ]
            ],
        ],
        'reviews' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.reviews',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_hdstructureddata_domain_model_structureddata',
                'foreign_field' => 'foreign_uid',
                'foreign_sortby' => 'sorting',
                'foreign_table_field' => 'tablename',
                'foreign_match_fields' => [
                    'fieldname' => 'reviews',
                ],
                'behaviour' => [
                    'allowLanguageSynchronization' => true
                ],
                'overrideChildTca' => [
                    'columns' => [
                        'type' => [
                            'config' => [
                                'type' => 'user',
                                'renderType' => 'hdNotEditableField',
                                'default' => 'review'
                            ]
                        ],
                        'subtype' => [
                            'config' => [
                                'type' => 'user',
                                'renderType' => 'hdNotEditableField',
                                'default' => 'reviewedItem',
                                'items' => [
                                    [
                                        'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.review.subtypes.reviewedItem',
                                        'value' => 'reviewedItem',
                                    ],
                                ]
                            ]
                        ],
                    ],
                    'types' => [
                        'review' => [
                            'showitem' => '--palette--;;type,--palette--;;review,
                            --div--;LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.div.access,--palette--;;access,'
                        ]
                    ]
                ]
            ],
        ],
        'organizers_pointer' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.organizers_pointer',
            'config' => [
                'type' => 'group',
                'allowed' => 'tx_hdstructureddata_domain_model_structureddata',
                'foreign_table' => 'tx_hdstructureddata_domain_model_structureddata',
                'MM' => 'tx_hdstructureddata_structureddata_organizers_mm',
                'multiple' => true,
                'suggestOptions' => [
                    'tx_hdstructureddata_domain_model_structureddata' => [
                        'searchCondition' => 'AND type = "organization"'
                    ]
                ]
            ]
        ],
        'pointed_as_organizer' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.pointed_as_organizer',
            'config' => [
                'type' => 'group',
                'allowed' => 'tx_hdstructureddata_domain_model_structureddata',
                'foreign_table' => 'tx_hdstructureddata_domain_model_structureddata',
                'MM_opposite_field' => 'organizers_pointer',
                'MM' => 'tx_hdstructureddata_structureddata_organizers_mm',
                'multiple' => true,
                'readOnly' => true,
            ]
        ],
        'clips' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.clips',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_hdstructureddata_domain_model_structureddata_clip',
                'foreign_field' => 'foreign_uid',
                'foreign_sortby' => 'sorting',
                'foreign_table_field' => 'tablename',
                'foreign_match_fields' => [
                    'fieldname' => 'clips',
                ],
                'behaviour' => [
                    'allowLanguageSynchronization' => true
                ],
            ],
        ],
        'vat_id' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.vat_id',
            'config' => [
                'type' => 'input',
            ]
        ],
        'tax_id' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.tax_id',
            'config' => [
                'type' => 'input',
            ]
        ],
        'rating_value' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.rating_value',
            'config' => [
                'type' => 'number',
                'format' => 'decimal',
                'nullable' => true,
            ]
        ],
        'rating_count' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.rating_count',
            'config' => [
                'type' => 'number',
                'nullable' => true,
            ]
        ],
        'best_rating' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.best_rating',
            'description' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.best_rating.description',
            'config' => [
                'type' => 'number',
                'nullable' => true,
            ]
        ],
        'worst_rating' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.worse_rating',
            'description' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.worse_rating.description',
            'config' => [
                'type' => 'number',
                'nullable' => true,
            ]
        ],
        'price_range' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.price_range',
            'description' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.price_range.description',
            'config' => [
                'type' => 'input',
            ]
        ],
        'price_min' => [
            'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.priceMin',
            'description' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:recommended',
            'config' => [
                'type' => 'number',
                'format' => 'decimal',
                'nullable' => true,
            ]
        ],
        'price_max' => [
            'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.priceMax',
            'config' => [
                'type' => 'number',
                'format' => 'decimal',
                'nullable' => true,
            ]
        ],
        'price_currency' => [
            'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.priceCurrency',
            'description' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:recommended',
            'config' => [
                'type' => 'input',
                'valuePicker' => [
                    'items' => \Hyperdigital\HdStructureddata\Service\TcaService::valuePickerItems([
                        ['label' => 'EUR', 'value' => 'EUR'],
                        ['label' => 'USD', 'value' => 'USD'],
                    ]),
                ],
            ]
        ],
        'price_unit' => [
            'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.price_unit',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    [
                        'label' => '',
                        'value' => ''
                    ],
                    [
                        'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.price_unit.HOUR',
                        'value' => 'HOUR'
                    ],
                    [
                        'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.price_unit.DAY',
                        'value' => 'DAY'
                    ],
                    [
                        'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.price_unit.WEEK',
                        'value' => 'WEEK'
                    ],
                    [
                        'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.price_unit.MONTH',
                        'value' => 'MONTH'
                    ],
                    [
                        'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.price_unit.YEAR',
                        'value' => 'YEAR'
                    ],
                ],
            ]
        ],
        'employment_type' => [
            'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.employment_type',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectCheckBox',
                'items' => [
                    [
                        'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.employment_type.FULL_TIME',
                        'value' => 'FULL_TIME'
                    ],
                    [
                        'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.employment_type.PART_TIME',
                        'value' => 'PART_TIME'
                    ],
                    [
                        'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.employment_type.CONTRACTOR',
                        'value' => 'CONTRACTOR'
                    ],
                    [
                        'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.employment_type.TEMPORARY',
                        'value' => 'TEMPORARY'
                    ],
                    [
                        'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.employment_type.INTERN',
                        'value' => 'INTERN'
                    ],
                    [
                        'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.employment_type.VOLUNTEER',
                        'value' => 'VOLUNTEER'
                    ],
                    [
                        'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.employment_type.PER_DIEM',
                        'value' => 'PER_DIEM'
                    ],
                    [
                        'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.employment_type.OTHER',
                        'value' => 'OTHER'
                    ],
                ],
            ]
        ],
        'application_category' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.application_category',
            'description' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.application_category.description',
            'config' => [
                'type' => 'input',
                'valuePicker' => [
                    'items' => \Hyperdigital\HdStructureddata\Service\TcaService::valuePickerItems([
                        ['label' => 'BusinessApplication', 'value' => 'BusinessApplication'],
                        ['label' => 'GameApplication', 'value' => 'GameApplication'],
                        ['label' => 'MultimediaApplication', 'value' => 'MultimediaApplication'],
                        ['label' => 'DeveloperApplication', 'value' => 'DeveloperApplication'],
                        ['label' => 'EducationalApplication', 'value' => 'EducationalApplication'],
                        ['label' => 'HealthApplication', 'value' => 'HealthApplication'],
                        ['label' => 'SecurityApplication', 'value' => 'SecurityApplication'],
                        ['label' => 'UtilitiesApplication', 'value' => 'UtilitiesApplication'],
                        ['label' => 'WebApplication', 'value' => 'WebApplication'],
                        ['label' => 'MobileApplication', 'value' => 'MobileApplication'],
                    ]),
                ],
            ]
        ],
        'operating_system' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.operating_system',
            'description' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.operating_system.description',
            'config' => [
                'type' => 'input',
                'valuePicker' => [
                    'items' => \Hyperdigital\HdStructureddata\Service\TcaService::valuePickerItems([
                        ['label' => 'Android', 'value' => 'Android'],
                        ['label' => 'iOS', 'value' => 'iOS'],
                        ['label' => 'Windows', 'value' => 'Windows'],
                        ['label' => 'macOS', 'value' => 'macOS'],
                        ['label' => 'Linux', 'value' => 'Linux'],
                    ]),
                ],
            ]
        ],
        'serves_cuisine' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.serves_cuisine',
            'description' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.serves_cuisine.description',
            'config' => [
                'type' => 'input',
            ]
        ],
        'menu' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.menu',
            'config' => [
                'type' => 'link',
                'appearance' => [
                    'allowedOptions' => ['params'],
                ],
            ]
        ],
        'accepts_reservations' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.accepts_reservations',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'nullable' => true,
                'items' => [
                    [
                        'label' => '',
                        'value' => 0
                    ],
                    [
                        'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.accepts_reservations.accepted',
                        'value' => 1
                    ],
                    [
                        'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.accepts_reservations.not_accepted',
                        'value' => -1
                    ]
                ],
            ]
        ],
        'opening_hours' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.opening_hours',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_hdstructureddata_domain_model_structureddata_openinghour',
                'foreign_field' => 'foreign_uid',
                'foreign_sortby' => 'sorting',
                'foreign_table_field' => 'tablename',
                'foreign_match_fields' => [
                    'fieldname' => 'opening_hours',
                ],
                'behaviour' => [
                    'allowLanguageSynchronization' => true
                ],
            ],
        ],
        'courseinstances' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.courseinstances',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_hdstructureddata_domain_model_structureddata_courseinstance',
                'foreign_field' => 'foreign_uid',
                'foreign_sortby' => 'sorting',
                'foreign_table_field' => 'tablename',
                'foreign_match_fields' => [
                    'fieldname' => 'courseinstances',
                ],
                'behaviour' => [
                    'allowLanguageSynchronization' => true
                ],
            ],
        ],
        'brands' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.brands',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_hdstructureddata_domain_model_structureddata_brand',
                'foreign_field' => 'foreign_uid',
                'foreign_sortby' => 'sorting',
                'foreign_table_field' => 'tablename',
                'foreign_match_fields' => [
                    'fieldname' => 'brands',
                ],
                'behaviour' => [
                    'allowLanguageSynchronization' => true
                ],
            ],
        ],
        'performers' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.performers',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_hdstructureddata_domain_model_structureddata_person',
                'foreign_field' => 'foreign_uid',
                'foreign_sortby' => 'sorting',
                'foreign_table_field' => 'tablename',
                'foreign_match_fields' => [
                    'fieldname' => 'performers',
                ],
                'behaviour' => [
                    'allowLanguageSynchronization' => true
                ],
            ],
        ],
        'job_title' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.job_title',
            'config' => [
                'type' => 'input',
                'eval' => 'trim',
            ]
        ],
        'speakable' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.speakable',
            'description' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.speakable.description',
            'config' => [
                'type' => 'text',
                'eval' => 'trim',
            ]
        ],
        'prep_time' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.prep_time',
            'description' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.prep_time.description',
            'config' => [
                'type' => 'number',
                'nullable' => true,
            ]
        ],
        'cook_time' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.cook_time',
            'description' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.cook_time.description',
            'config' => [
                'type' => 'number',
                'nullable' => true,
            ]
        ],
        'recipe_yield' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.recipe_yield',
            'description' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.recipe_yield.description',
            'config' => [
                'type' => 'input',
                'eval' => 'trim',
            ]
        ],
        'recipe_category' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.recipe_category',
            'config' => [
                'type' => 'input',
                'eval' => 'trim',
                'valuePicker' => [
                    'items' => \Hyperdigital\HdStructureddata\Service\TcaService::valuePickerItems([
                        ['label' => 'Appetizer', 'value' => 'Appetizer'],
                        ['label' => 'Main course', 'value' => 'Main course'],
                        ['label' => 'Dessert', 'value' => 'Dessert'],
                        ['label' => 'Snack', 'value' => 'Snack'],
                        ['label' => 'Drink', 'value' => 'Drink'],
                    ]),
                ],
            ]
        ],
        'recipe_cuisine' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.recipe_cuisine',
            'config' => [
                'type' => 'input',
                'eval' => 'trim',
            ]
        ],
        'calories' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.calories',
            'description' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.calories.description',
            'config' => [
                'type' => 'number',
                'nullable' => true,
            ]
        ],
        'ingredients' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.ingredients',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_hdstructureddata_domain_model_structureddata_ingredient',
                'foreign_field' => 'foreign_uid',
                'foreign_sortby' => 'sorting',
                'foreign_table_field' => 'tablename',
                'foreign_match_fields' => [
                    'fieldname' => 'ingredients',
                ],
                'behaviour' => [
                    'allowLanguageSynchronization' => true
                ],
            ]
        ],
        'instructions' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.instructions',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_hdstructureddata_domain_model_structureddata_instruction',
                'foreign_field' => 'foreign_uid',
                'foreign_sortby' => 'sorting',
                'foreign_table_field' => 'tablename',
                'foreign_match_fields' => [
                    'fieldname' => 'instructions',
                ],
                'behaviour' => [
                    'allowLanguageSynchronization' => true
                ],
            ]
        ],
        'follower_count' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.follower_count',
            'config' => [
                'type' => 'number',
                'nullable' => true,
            ]
        ],
        'post_count' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.post_count',
            'config' => [
                'type' => 'number',
                'nullable' => true,
            ]
        ],
        'comment_count' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.comment_count',
            'config' => [
                'type' => 'number',
                'nullable' => true,
            ]
        ],
        'service_type' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.service_type',
            'description' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.service_type.description',
            'config' => [
                'type' => 'input',
                'eval' => 'trim',
            ]
        ],
        'area_served' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.area_served',
            'description' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.area_served.description',
            'config' => [
                'type' => 'input',
                'eval' => 'trim',
            ]
        ],
        'isbn' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.isbn',
            'config' => [
                'type' => 'input',
                'eval' => 'trim',
            ]
        ],
        'book_edition' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.book_edition',
            'config' => [
                'type' => 'input',
                'eval' => 'trim',
            ]
        ],
        'book_format' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.book_format',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    [
                        'label' => '',
                        'value' => '',
                    ],
                    [
                        'label' => 'E-book',
                        'value' => 'EBook',
                    ],
                    [
                        'label' => 'Hardcover',
                        'value' => 'Hardcover',
                    ],
                    [
                        'label' => 'Paperback',
                        'value' => 'Paperback',
                    ],
                    [
                        'label' => 'Audiobook',
                        'value' => 'AudiobookFormat',
                    ],
                ],
            ]
        ],
        'duration_minutes' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.duration_minutes',
            'description' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.duration_minutes.description',
            'config' => [
                'type' => 'number',
                'nullable' => true,
            ]
        ],
        'keywords' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.keywords',
            'description' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.keywords.description',
            'config' => [
                'type' => 'input',
                'eval' => 'trim',
            ]
        ],
        'license_url' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.license_url',
            'description' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.license_url.description',
            'config' => [
                'type' => 'link',
            ]
        ],
        'vehicle_model_date' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.vehicle_model_date',
            'description' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.vehicle_model_date.description',
            'config' => [
                'type' => 'input',
                'eval' => 'trim',
            ]
        ],
        'vehicle_mileage' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.vehicle_mileage',
            'config' => [
                'type' => 'number',
                'nullable' => true,
            ]
        ],
        'vehicle_engine' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.vehicle_engine',
            'config' => [
                'type' => 'input',
                'eval' => 'trim',
            ]
        ],
        'vehicle_transmission' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.vehicle_transmission',
            'config' => [
                'type' => 'input',
                'eval' => 'trim',
            ]
        ],
        'vehicle_fuel_type' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.vehicle_fuel_type',
            'config' => [
                'type' => 'input',
                'eval' => 'trim',
                'valuePicker' => [
                    'items' => \Hyperdigital\HdStructureddata\Service\TcaService::valuePickerItems([
                        ['label' => 'Gasoline', 'value' => 'Gasoline'],
                        ['label' => 'Diesel', 'value' => 'Diesel'],
                        ['label' => 'Electric', 'value' => 'Electric'],
                        ['label' => 'Hybrid', 'value' => 'Hybrid'],
                    ]),
                ],
            ]
        ],
        'vehicle_seating_capacity' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.vehicle_seating_capacity',
            'config' => [
                'type' => 'number',
                'nullable' => true,
            ]
        ],
        'episode_number' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.episode_number',
            'config' => [
                'type' => 'number',
                'nullable' => true,
            ]
        ],
        'series_name' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.series_name',
            'config' => [
                'type' => 'input',
                'eval' => 'trim',
            ]
        ],
        'contact_points' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.contact_points',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_hdstructureddata_domain_model_structureddata_contactpoint',
                'foreign_field' => 'foreign_uid',
                'foreign_sortby' => 'sorting',
                'foreign_table_field' => 'tablename',
                'foreign_match_fields' => [
                    'fieldname' => 'contact_points',
                ],
                'behaviour' => [
                    'allowLanguageSynchronization' => true
                ],
            ]
        ],
        'number_of_employees' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.number_of_employees',
            'config' => [
                'type' => 'number',
                'nullable' => true,
            ]
        ],
        'founding_date' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.founding_date',
            'description' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.founding_date.description',
            'config' => [
                'type' => 'datetime',
                'format' => 'date',
                'dbType' => 'datetime',
                'nullable' => true,
            ]
        ],
        'gtin8' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.gtin8',
            'config' => [
                'type' => 'input',
                'eval' => 'trim',
            ]
        ],
        'gtin13' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.gtin13',
            'config' => [
                'type' => 'input',
                'eval' => 'trim',
            ]
        ],
        'mpn' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.mpn',
            'config' => [
                'type' => 'input',
                'eval' => 'trim',
            ]
        ],
        'product_size' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.product_size',
            'config' => [
                'type' => 'input',
                'eval' => 'trim',
            ]
        ],
        'product_color' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.product_color',
            'config' => [
                'type' => 'input',
                'eval' => 'trim',
            ]
        ],
        'product_material' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.product_material',
            'config' => [
                'type' => 'input',
                'eval' => 'trim',
            ]
        ],
        'product_pattern' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.product_pattern',
            'config' => [
                'type' => 'input',
                'eval' => 'trim',
            ]
        ],
        'experience_requirements' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.experience_requirements',
            'description' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.experience_requirements.description',
            'config' => [
                'type' => 'number',
                'nullable' => true,
            ]
        ],
        'educational_requirements' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.educational_requirements',
            'description' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.educational_requirements.description',
            'config' => [
                'type' => 'input',
                'eval' => 'trim',
                'valuePicker' => [
                    'items' => \Hyperdigital\HdStructureddata\Service\TcaService::valuePickerItems([
                        ['label' => 'high school', 'value' => 'high school'],
                        ['label' => 'associate degree', 'value' => 'associate degree'],
                        ['label' => 'bachelor degree', 'value' => 'bachelor degree'],
                        ['label' => 'professional certificate', 'value' => 'professional certificate'],
                        ['label' => 'postgraduate degree', 'value' => 'postgraduate degree'],
                    ]),
                ],
            ]
        ],
        'direct_apply' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.direct_apply',
            'config' => [
                'type' => 'check',
                'renderType' => 'checkboxToggle',
            ]
        ],
        'job_benefits' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.job_benefits',
            'config' => [
                'type' => 'text',
                'eval' => 'trim',
            ]
        ],
        'educational_credential_awarded' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.educational_credential_awarded',
            'config' => [
                'type' => 'input',
                'eval' => 'trim',
            ]
        ],
        'course_workload' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.course_workload',
            'description' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.course_workload.description',
            'config' => [
                'type' => 'number',
                'nullable' => true,
            ]
        ],
        'course_prerequisites' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.course_prerequisites',
            'description' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.course_prerequisites.description',
            'config' => [
                'type' => 'text',
                'eval' => 'trim',
            ]
        ],
        'maximum_attendee_capacity' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.maximum_attendee_capacity',
            'config' => [
                'type' => 'number',
                'nullable' => true,
            ]
        ],
        'is_live_broadcast' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.is_live_broadcast',
            'description' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.is_live_broadcast.description',
            'config' => [
                'type' => 'check',
                'renderType' => 'checkboxToggle',
            ]
        ],
        'broadcast_start_date' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.broadcast_start_date',
            'description' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.broadcast_start_date.description',
            'config' => [
                'type' => 'datetime',
                'dbType' => 'datetime',
                'nullable' => true,
            ]
        ],
        'broadcast_end_date' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.broadcast_end_date',
            'description' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.broadcast_end_date.description',
            'config' => [
                'type' => 'datetime',
                'dbType' => 'datetime',
                'nullable' => true,
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
                'foreign_table' => 'tx_hdstructureddata_domain_model_structureddata',
                'foreign_table_where' =>
                    'AND {#tx_hdstructureddata_domain_model_structureddata}.{#pid}=###CURRENT_PID###'
                    . ' AND {#tx_hdstructureddata_domain_model_structureddata}.{#sys_language_uid} IN (-1,0)',
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
