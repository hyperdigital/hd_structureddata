<?php

declare(strict_types=1);

namespace Hyperdigital\HdStructureddata\Service;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Resource\File;
use TYPO3\CMS\Core\Resource\FileReference;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

class SearchParamService
{
    /**
     * @return array Value picker items, keyed the way the running TYPO3 version reads them
     */
    public static function getTcaPickerValuesForSearchParam()
    {
        $return = [];

        if (ExtensionManagementUtility::isLoaded('indexed_search')) {
            $return[] = [
                'label' => 'TYPO3 Indexed Search (indexed_search)',
                'value' => urlencode('tx_indexedsearch_pi2%5Baction%5D=search&tx_indexedsearch_pi2[search][sword]=###SWORD###&no_cache=1')
            ];
        }

        if (ExtensionManagementUtility::isLoaded('ke_search')) {
            $return[] = [
                'label' => 'Faceted Search (ke_search)',
                'value' => urlencode('tx_kesearch_pi1[sword]=###SWORD###&no_cache=1')
            ];
        }

        return TcaService::valuePickerItems($return);
    }
}