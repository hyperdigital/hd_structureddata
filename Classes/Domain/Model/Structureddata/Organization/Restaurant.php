<?php
namespace Hyperdigital\HdStructureddata\Domain\Model\Structureddata\Organization;

use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

class Restaurant extends \Hyperdigital\HdStructureddata\Domain\Model\Structureddata\Organization
{
    public function returnData()
    {
        $return = parent::returnData();
        $return['@type'] = 'Restaurant';
        if (!empty($this->originalRow['serves_cuisine'])) {
            $return['servesCuisine'] = $this->originalRow['serves_cuisine'];
        }

        if ($this->originalRow['accepts_reservations'] == 1) {
            $return['acceptsReservations'] = 'True';
        } else if ($this->originalRow['accepts_reservations'] == -1) {
            $return['acceptsReservations'] = 'False';
        }

        if (!empty($this->originalRow['menu'])) {
            $return['menu'] = $this->getUrl($this->originalRow['menu']);
        }

        return $return;
    }
}
