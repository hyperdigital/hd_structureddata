<?php
namespace Hyperdigital\HdStructureddata\Domain\Model\Structureddata\Organization;


class Restaurant extends \Hyperdigital\HdStructureddata\Domain\Model\Structureddata\Organization
{
    public function returnData()
    {
        $return = parent::returnData();
        $return['@type'] = 'Restaurant';
        if (!empty($this->originalRow['serves_cuisine'])) {
            $return['servesCuisine'] = $this->originalRow['serves_cuisine'];
        }

        if (($this->originalRow['accepts_reservations'] ?? 0) == 1) {
            $return['acceptsReservations'] = 'True';
        } else if (($this->originalRow['accepts_reservations'] ?? 0) == -1) {
            $return['acceptsReservations'] = 'False';
        }

        if (!empty($this->originalRow['menu'])) {
            $return['menu'] = $this->getUrl($this->originalRow['menu']);
        }

        return $return;
    }
}
