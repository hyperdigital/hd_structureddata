<?php
defined('TYPO3') || die();

(function () {
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile(
        'hd_structureddata',
        'Configuration/TypoScript/',
        'HD Structured data'
    );

})();
