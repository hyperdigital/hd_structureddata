<?php
defined('TYPO3') || die();

(function () {
    $tempColumns = [
        'creator' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:sys_file_metadata.creator',
            'description' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:sys_file_metadata.creator.description',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_hdstructureddata_domain_model_structureddata_person',
                'foreign_field' => 'foreign_uid',
                'foreign_sortby' => 'sorting',
                'foreign_table_field' => 'tablename',
                'foreign_match_fields' => [
                    'fieldname' => 'creator',
                ],
                'behaviour' => [
                    'allowLanguageSynchronization' => true
                ],
            ],
        ],
        'credit_text' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:sys_file_metadata.credit_text',
            'description' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:sys_file_metadata.credit_text.description',
            'config' => [
                'type' => 'text',
                'eval' => 'trim'
            ]
        ],
        'copyright_notice' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:sys_file_metadata.copyright_notice',
            'description' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:sys_file_metadata.copyright_notice.description',
            'config' => [
                'type' => 'text',
                'eval' => 'trim'
            ]
        ],
        'license' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:sys_file_metadata.license',
            'description' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:sys_file_metadata.license.description',
            'config' => [
                'type' => 'link',
                'valuePicker' => [
                    'items' => [
                        [
                            'CC BY 4.0 (Share, Adapt)',
                            'https://creativecommons.org/licenses/by/4.0/',
                        ],
                        [
                            'CC BY-NC 4.0 (Share, Adapt, NonCommercial)',
                            'https://creativecommons.org/licenses/by-nc/4.0/',
                        ],
                        [
                            'CC BY-NC-ND 4.0 (Share, NonCommercial)',
                            'https://creativecommons.org/licenses/by-nc-nd/4.0/',
                        ],
                        [
                            'CC BY-NC-SA 4.0 (Share, Adapt, NonCommercial, ShareAlike)',
                            'https://creativecommons.org/licenses/by-nc-sa/4.0/',
                        ],
                        [
                            'CC BY-ND 4.0 (Share)',
                            'https://creativecommons.org/licenses/by-nd/4.0/',
                        ],
                        [
                            'CC BY-SA 4.0 (Share, Adapt, ShareAlike)',
                            'https://creativecommons.org/licenses/by-sa/4.0/',
                        ],
                    ],
                ]
            ]
        ],
        'acquire_license_page' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:sys_file_metadata.acquire_license_page',
            'description' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:sys_file_metadata.acquire_license_page.description',
            'config' => [
                'type' => 'link',
            ]
        ]
    ];

    $GLOBALS['TCA']['sys_file_metadata']['palettes']['hd_structured_data'] = ['showitem' => 'creator,--linebreak--,
    credit_text,--linebreak--,copyright_notice,--linebreak--,license,--linebreak--,acquire_license_page'];

    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns("sys_file_metadata", $tempColumns);

    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes('sys_file_metadata', '
    --div--;LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:pages.palette.hd_structured_data, --palette--;;hd_structured_data,
   ');
})();
