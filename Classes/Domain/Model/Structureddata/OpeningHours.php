<?php
namespace Hyperdigital\HdStructureddata\Domain\Model\Structureddata;

use TYPO3\CMS\Core\Database\Connection;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class OpeningHours extends AbstractData
{


    public function returnData()
    {
        if (empty($this->originalRow['days'])) {
            return [];
        }

        $return = [];
        $return['@type'] = 'OpeningHoursSpecification';
        $return['dayOfWeek'] = GeneralUtility::trimExplode(',', $this->originalRow['days'], true);
        if (!empty($this->originalRow['opens'])) {
            $return['opens'] = $this->originalRow['opens'];
        }
        if (!empty($this->originalRow['closes'])) {
            $return['closes'] = $this->originalRow['closes'];
        }

        return $return;
    }
}
