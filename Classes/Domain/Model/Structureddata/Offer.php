<?php
namespace Hyperdigital\HdStructureddata\Domain\Model\Structureddata;

use TYPO3\CMS\Core\Database\Connection;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class Offer extends AbstractData
{


    public function returnData()
    {
        $return = [];
        $return['@type'] = 'Offer';
        switch($this->originalRow['availability'] ?? '') {
            case 'InStock':
                $return['availability'] = 'https://schema.org/InStock';
                break;
            case 'SoldOut':
                $return['availability'] = 'https://schema.org/SoldOut';
                break;
            case 'PreOrder':
                $return['availability'] = 'https://schema.org/PreOrder';
                break;
        }
        if (isset($this->originalRow['price']) && $this->originalRow['price'] !== '') {
            $return['price'] = $this->originalRow['price'];
        }
        if (!empty($this->originalRow['price_currency'])) {
            $return['priceCurrency'] = strtoupper($this->originalRow['price_currency']);
        }
        if(!is_null($this->originalRow['valid_from'] ?? null)) {
            $date = new \DateTime($this->originalRow['valid_from']);
            $return['validFrom'] = $date->format(DATE_ATOM);
        }
        if(!is_null($this->originalRow['valid_until'] ?? null)) {
            $date = new \DateTime($this->originalRow['valid_until']);
            $return['priceValidUntil'] = $date->format(DATE_ATOM);
        }
        if (!empty($this->originalRow['url'])) {
            $return['url'] = $this->getUrl($this->originalRow['url']);
        }
        if (!empty($this->originalRow['category'])) {
            $return['category'] = $this->originalRow['category'];
        }
        if (!empty($this->originalRow['shipping_details'])) {
            $shipping = $this->getShippingDetails($this->originalRow['uid'], 'shipping_details', 'tx_hdstructureddata_domain_model_structureddata_offer');
            if (!empty($shipping)) {
                $return['shippingDetails'] = $shipping;
            }
        }
        if (!empty($this->originalRow['return_policy'])) {
            $returnPolicy = $this->getReturnPolicies($this->originalRow['uid'], 'return_policy', 'tx_hdstructureddata_domain_model_structureddata_offer');
            if (!empty($returnPolicy)) {
                $return['hasMerchantReturnPolicy'] = reset($returnPolicy);
            }
        }

        return $return;
    }
}
