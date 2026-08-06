<?php
namespace Hyperdigital\HdStructureddata\Domain\Model\Structureddata;

class Vehicle extends AbstractData
{
    public function returnData()
    {
        $return = [];
        $return['@context'] = 'https://schema.org';
        $return['@type'] = 'Vehicle';
        $return['name'] = $this->originalRow['title'] ?? '';
        if (!empty($this->originalRow['description'])) {
            $return['description'] = $this->originalRow['description'];
        }
        if (!empty($this->originalRow['brands'])) {
            $brands = $this->getBrands($this->originalRow['uid'], 'brands', 'tx_hdstructureddata_domain_model_structureddata');
            if (!empty($brands)) {
                $return['brand'] = $brands;
            }
        }
        if (!empty($this->originalRow['images'])) {
            $images = $this->getImages($this->originalRow['uid'], 'images', 'tx_hdstructureddata_domain_model_structureddata');
            if (!empty($images)) {
                $return['image'] = $images;
            }
        }
        if (!empty($this->originalRow['sku'])) {
            $return['sku'] = $this->originalRow['sku'];
        }
        if (!empty($this->originalRow['vehicle_model_date'])) {
            $return['vehicleModelDate'] = $this->originalRow['vehicle_model_date'];
        }
        if (!empty($this->originalRow['vehicle_engine'])) {
            $return['vehicleEngine'] = $this->originalRow['vehicle_engine'];
        }
        if (!empty($this->originalRow['vehicle_transmission'])) {
            $return['vehicleTransmission'] = $this->originalRow['vehicle_transmission'];
        }
        if (!empty($this->originalRow['vehicle_fuel_type'])) {
            $return['fuelType'] = $this->originalRow['vehicle_fuel_type'];
        }
        if (!is_null($this->originalRow['vehicle_mileage'] ?? null)) {
            $return['mileageFromOdometer'] = ['@type' => 'QuantitativeValue', 'value' => (int)$this->originalRow['vehicle_mileage'], 'unitCode' => 'KMT'];
        }
        if (!is_null($this->originalRow['vehicle_seating_capacity'] ?? null)) {
            $return['vehicleSeatingCapacity'] = (int)$this->originalRow['vehicle_seating_capacity'];
        }
        if (!empty($this->originalRow['url'])) {
            $temp = $this->getUrl($this->originalRow['url']);
            if (!empty($temp)) {
                $return['url'] = $temp;
            }
        }
        if (!empty($this->originalRow['offers'])) {
            $offers = $this->getOffers($this->originalRow['uid'], 'offers', 'tx_hdstructureddata_domain_model_structureddata');
            if (!empty($offers)) {
                $return['offers'] = $offers;
            }
        }

        return $return;
    }
}
