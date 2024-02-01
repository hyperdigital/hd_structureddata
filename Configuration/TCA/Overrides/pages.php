<?php
defined('TYPO3') || die();

(function () {
    $tempColumns = [
        'hd_structured_data' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:pages.hd_structured_data',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_hdstructureddata_domain_model_structureddata',
                'foreign_field' => 'foreign_uid',
                'foreign_sortby' => 'sorting',
                'foreign_table_field' => 'tablename',
                'foreign_match_fields' => [
                    'fieldname' => 'hd_structured_data',
                ],
                'behaviour' => [
                    'allowLanguageSynchronization' => true
                ],
            ],
        ]
    ];

    $GLOBALS['TCA']['pages']['palettes']['hd_structured_data'] = ['showitem' => 'hd_structured_data'];

    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns("pages", $tempColumns);

    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes('pages', '
    --div--;LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:pages.palette.hd_structured_data, --palette--;;hd_structured_data,
   ');
})();
