<?php
namespace Hyperdigital\HdStructureddata\Domain\Model\Structureddata;

use TYPO3\CMS\Core\Database\Connection;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

class OpeningHours extends AbstractData
{


    public function returnData()
    {
        $return = [];
        $return['@type'] = 'OpeningHoursSpecification';
        $return['dayOfWeek'] = GeneralUtility::trimExplode(',',$this->originalRow['days']);
        $return['opens'] = $this->originalRow['opens'];
        $return['closes'] = $this->originalRow['closes'];

        return $return;
    }
}
