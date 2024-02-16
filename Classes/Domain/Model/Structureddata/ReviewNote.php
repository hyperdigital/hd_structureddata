<?php
namespace Hyperdigital\HdStructureddata\Domain\Model\Structureddata;

use TYPO3\CMS\Core\Database\Connection;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

class ReviewNote extends AbstractData
{
    public function returnData()
    {
        $return = [];
        $return['@type'] = 'ListItem';
        $return['name'] = $this->originalRow['name'];

        return $return;
    }
}
