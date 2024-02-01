<?php
defined('TYPO3') || die();

(function () {
    $GLOBALS['TCA']['tx_hdstructureddata_domain_model_structureddata']['palettes']['faq'] = [
        'showitem' => 'faqs'
    ];

    $GLOBALS['TCA']['tx_hdstructureddata_domain_model_structureddata']['types']['faq'] = [
        'showitem' => '--palette--;;type,--palette--;;faq,
            --div--;LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.div.access,--palette--;;access,',
    ];

    $GLOBALS['TCA']['tx_hdstructureddata_domain_model_structureddata']['columns']['type']['config']['items'][] = [
        'label' => 'LLL:EXT:hd_structureddata/Resources/Private/Language/locallang_be.xlf:tx_hdstructureddata_domain_model_structureddata.columns.type.faq',
        'value' => 'faq'
    ];
    $GLOBALS['TCA']['tx_hdstructureddata_domain_model_structureddata']['ctrl']['typeicon_classes']['faq'] = 'hd_structureddata_faq';
})();
