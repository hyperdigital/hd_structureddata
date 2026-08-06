<?php
namespace Hyperdigital\HdStructureddata\Domain\Model\Structureddata;

use TYPO3\CMS\Core\Utility\GeneralUtility;

class Service extends AbstractData
{
    public function returnData()
    {
        $return = [];
        $return['@context'] = 'https://schema.org';
        $return['@type'] = 'Service';
        $return['name'] = $this->originalRow['title'] ?? '';
        if (!empty($this->originalRow['description'])) {
            $return['description'] = $this->originalRow['description'];
        }
        if (!empty($this->originalRow['service_type'])) {
            $return['serviceType'] = $this->originalRow['service_type'];
        }
        if (!empty($this->originalRow['area_served'])) {
            $return['areaServed'] = GeneralUtility::trimExplode(',', $this->originalRow['area_served'], true);
        }
        if (!empty($this->originalRow['url'])) {
            $temp = $this->getUrl($this->originalRow['url']);
            if (!empty($temp)) {
                $return['url'] = $temp;
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
        $organizations = [];
        if (!empty($this->originalRow['organizers'])) {
            $temp = $this->getStructuredData($this->originalRow['uid'], 'organizers', 'tx_hdstructureddata_domain_model_structureddata');
            if (!empty($temp)) {
                $organizations = $temp;
            }
        }
        if (!empty($this->originalRow['organizers_pointer'])) {
            $temp = $this->getStructuredDataByMM($this->originalRow['uid'], 'tx_hdstructureddata_structureddata_organizers_mm', ['organization', 'person']);
            if (!empty($temp)) {
                foreach ($temp as $one) {
                    $organizations[] = $one;
                }
            }
        }
        if (!empty($organizations)) {
            $return['provider'] = $organizations;
        }

        $rating = $this->getRating('AggregateRating');
        if (!empty($rating)) {
            $return['aggregateRating'] = $rating;
        }

        return $return;
    }
}
