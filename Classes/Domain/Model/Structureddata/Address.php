<?php
namespace Hyperdigital\HdStructureddata\Domain\Model\Structureddata;

use TYPO3\CMS\Core\Database\Connection;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;

class Address extends AbstractData
{
    public function returnData()
    {
        $return = [];
        $return['@context'] = 'https://schema.org';

        switch ($this->originalRow['type']) {
            case 'PostalAddress':
                $return['@type'] = 'PostalAddress';

                if (!empty($this->originalRow['street_address'])) {
                    $return['streetAddress'] = $this->originalRow['street_address'];
                }
                if (!empty($this->originalRow['address_locality'])) {
                    $return['addressLocality'] = $this->originalRow['address_locality'];
                }
                if (!empty($this->originalRow['postal_code'])) {
                    $return['addressRegion'] = $this->originalRow['postal_code'];
                }
                if (!empty($this->originalRow['address_region'])) {
                    $return['postalCode'] = $this->originalRow['address_region'];
                }
                if (!empty($this->originalRow['address_country'])) {
                    $country = $this->getCountry($this->originalRow['address_country']);
                    if ($country && !empty($country['cn_iso_2'])) {
                        $return['addressCountry'] = $country['cn_iso_2'];
                    }
                }
                break;
        }

        return $return;
    }

    public function getCountry($uid)
    {
        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)
            ->getQueryBuilderForTable('static_countries');

        $result = $queryBuilder
            ->select('*')
            ->from('static_countries')
            ->where(
                $queryBuilder->expr()->eq('uid', $queryBuilder->createNamedParameter($uid, Connection::PARAM_INT)),
            )
            ->executeQuery();

        return $result->fetchAssociative();
    }
}
