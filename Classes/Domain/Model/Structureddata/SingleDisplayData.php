<?php
namespace Hyperdigital\HdStructureddata\Domain\Model\Structureddata;

use TYPO3\CMS\Core\Database\Connection;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

class SingleDisplayData extends AbstractData
{
    public static function getData()
    {
        if (!empty(self::$singleDisplayData)) {
            return self::$singleDisplayData;
        }
    }
}