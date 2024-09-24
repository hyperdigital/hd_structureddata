<?php
namespace Hyperdigital\HdStructureddata\Domain\Model\Structureddata;

use TYPO3\CMS\Core\Database\Connection;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

class SameAs extends AbstractData
{
    public function returnData()
    {
       if (!empty($this->originalRow['url'])) {
           return $this->originalRow['url'];
       }

        return false;
    }
}
