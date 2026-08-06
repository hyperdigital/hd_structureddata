<?php
namespace Hyperdigital\HdStructureddata\Domain\Model\Structureddata;

use TYPO3\CMS\Core\Database\Connection;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Utility\GeneralUtility;

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
        foreach (['gtin8', 'gtin13', 'gtin14', 'mpn'] as $identifierField) {
            if (!empty($this->originalRow[$identifierField])) {
                $return[$identifierField] = $this->originalRow[$identifierField];
            }
        }
        foreach (['product_size' => 'size', 'product_color' => 'color', 'product_material' => 'material', 'product_pattern' => 'pattern'] as $column => $property) {
            if (!empty($this->originalRow[$column])) {
                $return[$property] = $this->originalRow[$column];
            }
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

        $rating = $this->getRating('AggregateRating');
        if (!empty($rating)) {
            $return['aggregateRating'] = $rating;
        }

        return $return;
    }
}
