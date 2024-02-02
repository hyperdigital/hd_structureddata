<?php
namespace Hyperdigital\HdStructureddata\Domain\Model\Structureddata;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

class Review extends AbstractData
{
    public function returnData()
    {
        $return = [];
        $return['@context'] = 'https://schema.org';
        $return['@type'] = 'Review';
        switch ($this->originalRow['subtype']) {
            case 'Restaurant':
                $itemReviewed = $this->getRestaurantData();
                break;
        }

        if (!empty($itemReviewed)) {
            $return['itemReviewed'] = $itemReviewed;
        } else {
            return false;
        }

        if (!empty($this->originalRow['authors'])) {
            $people = $this->getPeople($this->originalRow['uid'], 'authors', 'tx_hdstructureddata_domain_model_structureddata');
            if (!empty($people)) {
                $return['author'] = $people;
            }
        }

        return $return;
    }

    public function getRestaurantData()
    {
        $return = [];
        $return['@type'] = 'Restaurant';
        $return['name'] = $this->originalRow['title'];
        if (!empty($this->originalRow['telephone'])) {
            $return['telephone'] = $this->originalRow['telephone'];
        }
        if (!empty($this->originalRow['addresses'])) {
            $address = $this->getAddresses($this->originalRow['uid'], 'addresses', 'tx_hdstructureddata_domain_model_structureddata');
            if (!empty($address)) {
                $return['address'] = $address;
            }
        }

        return $return;
    }
}
