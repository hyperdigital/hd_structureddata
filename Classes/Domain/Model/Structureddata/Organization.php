<?php
namespace Hyperdigital\HdStructureddata\Domain\Model\Structureddata;

use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

class Organization extends AbstractData
{
    public function returnData()
    {
        $return = [];
        $return['@context'] = 'https://schema.org';
        $return['@type'] = 'Organization';
        $return['name'] = $this->originalRow['title'] ?? '';
        $return['telephone'] = $this->originalRow['telephone'] ?? '';
        if (!empty($this->originalRow['email'])) {
            $return['email'] = $this->originalRow['email'];
        }
        if (!empty($this->originalRow['vat_id'])) {
            $return['vatID'] = $this->originalRow['vat_id'];
        }
        if (!empty($this->originalRow['tax_id'])) {
            $return['taxID'] = $this->originalRow['tax_id'];
        }
        if (!empty($this->originalRow['legal_name'])) {
            $return['legalName'] = $this->originalRow['legal_name'];
        }
        if (!empty($this->originalRow['description'])) {
            $return['description'] = $this->originalRow['description'];
        }
        if (!empty($this->originalRow['price_range'])) {
            $return['priceRange'] = $this->originalRow['price_range'];
        }
         if (!empty($this->originalRow['date_published'])) {
             $date = new \DateTime($this->originalRow['date_published']);
             $return['foundingDate'] = $date;
         }
        if (!empty($this->originalRow['url'])) {
            $url = $this->getUrl($this->originalRow['url']);
            $return['url'] = $url;
        }
        if (!empty($this->originalRow['images'])) {
            $images = $this->getImages($this->originalRow['uid'], 'images', 'tx_hdstructureddata_domain_model_structureddata');
            if (!empty($images)) {
                $return['image'] = $images;
            }
        }
        if (!empty($this->originalRow['logo'])) {
            $image = $this->getImages($this->originalRow['uid'], 'logo', 'tx_hdstructureddata_domain_model_structureddata', true);
            if (!empty($image)) {
                $return['logo'] = $image;
            }
        }
        if (!empty($this->originalRow['addresses'])) {
            $address = $this->getAddresses($this->originalRow['uid'], 'addresses', 'tx_hdstructureddata_domain_model_structureddata');
            if (!empty($address)) {
                $return['address'] = $address;
            }
        }
        if (!empty($this->originalRow['opening_hours'])) {
            $openingHours = $this->getOpeningHours($this->originalRow['uid'], 'opening_hours', 'tx_hdstructureddata_domain_model_structureddata');
            if (!empty($openingHours)) {
                $return['openingHoursSpecification'] = $openingHours;
            }
        }
        if (!empty($this->originalRow['sameas'])) {
            $sameas = $this->getSameas($this->originalRow['uid'], 'sameas', 'tx_hdstructureddata_domain_model_structureddata');
            if (!empty($sameas)) {
                $return['sameAs'] = $sameas;
            }
        }

        return $return;
    }
}
