<?php
namespace Hyperdigital\HdStructureddata\Domain\Model\Structureddata;

use TYPO3\CMS\Core\Database\Connection;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

class Product extends AbstractData
{
    public function returnData()
    {
        $return = [];
        $return['@context'] = 'https://schema.org';
        $return['@type'] = 'Product';
        $return['name'] = $this->originalRow['title'];
        if (!empty($this->originalRow['description'])) {
            $return['description'] = $this->originalRow['description'];
        }
        if (!empty($this->originalRow['sku'])) {
            $return['sku'] = $this->originalRow['sku'];
        }
        if (!empty($this->originalRow['gtin14'])) {
            $return['gtin14'] = $this->originalRow['gtin14'];
        }
        if (!empty($this->originalRow['brands'])) {
            $brands = $this->getBrands($this->originalRow['uid'], 'brands', 'tx_hdstructureddata_domain_model_structureddata');
            if (!empty($brands)) {
                $return['brand'] = $brands;
            }
        }
        if (!empty($this->originalRow['offers'])) {
            $offers = $this->getOffers($this->originalRow['uid'], 'offers', 'tx_hdstructureddata_domain_model_structureddata');
            if (!empty($offers)) {
                $return['offers'] = $offers;
            }
        }
        if (!empty($this->originalRow['images'])) {
            $images = $this->getImages($this->originalRow['uid'], 'images', 'tx_hdstructureddata_domain_model_structureddata');
            if (!empty($images)) {
                $return['image'] = $images;
            }
        }
        if (!empty($this->originalRow['reviews'])) {
            $brands = $this->getReviews($this->originalRow['uid'], 'reviews', 'tx_hdstructureddata_domain_model_structureddata');
            if (!empty($brands)) {
                $return['review'] = $brands;
            }
        }

        $rating = $this->reviewRating();
        if (!empty($rating)) {
            $return['aggregateRating'] = $rating;
        }

        return $return;
    }

    protected function reviewRating()
    {
        $return = [];
        $return['@type'] = 'AggregateRating';
        if (!is_null($this->originalRow['rating_value'])) {
            $return['ratingValue'] = $this->originalRow['rating_value'];
        }
        if (!is_null($this->originalRow['rating_count'])) {
            $return['ratingCount'] = $this->originalRow['rating_count'];
        }
        if (!is_null($this->originalRow['best_rating'])) {
            $return['bestRating'] = $this->originalRow['best_rating'];
        }
        if (!is_null($this->originalRow['worst_rating'])) {
            $return['worstRating'] = $this->originalRow['worst_rating'];
        }

        if (count($return) < 2) {
            return false;
        }
        return $return;
    }
}
