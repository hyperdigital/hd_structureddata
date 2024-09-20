<?php
namespace Hyperdigital\HdStructureddata\Domain\Model\Structureddata;

use TYPO3\CMS\Core\Database\Connection;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

class Identifier extends AbstractData
{
    public function returnData()
    {
        $return = [];
        $return['@type'] = 'PropertyValue';
        if (!empty($this->originalRow['name'])) {
            $return['name'] = $this->originalRow['name'];
        }
        if (!empty($this->originalRow['value'])) {
            $return['value'] = $this->originalRow['value'];
        }

        return $return;
    }
}
