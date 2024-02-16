<?php
namespace Hyperdigital\HdStructureddata\Domain\Model\Structureddata;

use TYPO3\CMS\Core\Database\Connection;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

class Offer extends AbstractData
{


    public function returnData()
    {
        $return = [];
        $return['@type'] = 'Offer';
        switch($this->originalRow['availability']) {
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
        $return['price'] = $this->originalRow['price'];
        if (!empty($this->originalRow['price_currency'])) {
            $return['priceCurrency'] = strtoupper($this->originalRow['price_currency']);
        }
        if(!is_null($this->originalRow['valid_from'])) {
            $date = new \DateTime($this->originalRow['valid_from']);
            $return['validFrom'] = $date->format(DATE_ATOM);
        }
        if(!is_null($this->originalRow['valid_until'])) {
            $date = new \DateTime($this->originalRow['valid_until']);
            $return['priceValidUntil'] = $date->format(DATE_ATOM);
        }
        if (!empty($this->originalRow['url'])) {
            $return['url'] = $this->getUrl($this->originalRow['url']);
        }

        return $return;
    }
}
