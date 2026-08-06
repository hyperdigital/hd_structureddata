<?php
namespace Hyperdigital\HdStructureddata\Domain\Model\Structureddata;

class GeoCoordinates extends AbstractData
{
    public function returnData()
    {
        // No @context here: GeoCoordinates is always emitted as a nested node of a
        // parent object, which already carries the context.
        $return = [];

        if (is_null($this->originalRow['latitude'] ?? null) || is_null($this->originalRow['longitude'] ?? null)) {
            return $return;
        }

        $return['@type'] = 'GeoCoordinates';
        $return['latitude'] = $this->originalRow['latitude'];
        $return['longitude'] = $this->originalRow['longitude'];

        return $return;
    }
}
