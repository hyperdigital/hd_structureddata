<?php
namespace Hyperdigital\HdStructureddata\Domain\Model\Structureddata;

class SoftwareApplication extends AbstractData
{
    public function returnData()
    {
        $return = [];
        $return['@context'] = 'https://schema.org';
        $return['@type'] = 'SoftwareApplication';
        $return['name'] = $this->originalRow['title'] ?? '';
        if (!empty($this->originalRow['description'])) {
            $return['description'] = $this->originalRow['description'];
        }
        if (!empty($this->originalRow['application_category'])) {
            $return['applicationCategory'] = $this->originalRow['application_category'];
        }
        if (!empty($this->originalRow['operating_system'])) {
            $return['operatingSystem'] = $this->originalRow['operating_system'];
        }
        if (!empty($this->originalRow['url'])) {
            $url = $this->getUrl($this->originalRow['url']);
            if (!empty($url)) {
                $return['url'] = $url;
            }
        }
        if (!empty($this->originalRow['images'])) {
            $images = $this->getImages($this->originalRow['uid'], 'images', 'tx_hdstructureddata_domain_model_structureddata');
            if (!empty($images)) {
                $return['image'] = $images;
            }
        }
        if (!empty($this->originalRow['offers'])) {
            $offers = $this->getOffers($this->originalRow['uid'], 'offers', 'tx_hdstructureddata_domain_model_structureddata');
            if (!empty($offers)) {
                $return['offers'] = $offers;
            }
        }

        $rating = $this->getRating('AggregateRating');
        if (!empty($rating)) {
            $return['aggregateRating'] = $rating;
        }

        return $return;
    }
}
