<?php
namespace Hyperdigital\HdStructureddata\Domain\Model\Structureddata;

use TYPO3\CMS\Core\Database\Connection;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

class JobPosting extends AbstractData
{
    public function returnData()
    {
        $return = [];
        $return['@context'] = 'https://schema.org';
        $return['@type'] = 'JobPosting';
        $return['title'] = $this->originalRow['title'];
        if (!empty($this->originalRow['description'])) {
            $return['description'] = $this->originalRow['description'];
        }
        if (!empty($this->originalRow['date_published'])) {
            $date = new \DateTime($this->originalRow['date_published']);
            $return['datePosted'] = $date->format(DATE_ATOM);
        }
        if (!empty($this->originalRow['date_modified'])) {
            $date = new \DateTime($this->originalRow['date_modified']);
            $return['dateModified'] = $date->format(DATE_ATOM);
        }

        if (!empty($this->originalRow['end_date'])) {
            $date = new \DateTime($this->originalRow['end_date']);
            $return['validThrough'] = $date->format(DATE_ATOM);
        }

        $organizers = [];
        if (!empty($this->originalRow['organizers'])) {
            $tempOrgs = $this->getStructuredData($this->originalRow['uid'], 'organizers', 'tx_hdstructureddata_domain_model_structureddata');
            if (!empty($tempOrgs)) {
                $organizers = $tempOrgs;
            }
        }
        if (!empty($this->originalRow['organizers_pointer'])) {
            $tempOrgs = $this->getStructuredDataByMM($this->originalRow['uid'], 'tx_hdstructureddata_structureddata_organizers_mm', ['organization', 'person']);
            if (!empty($tempOrgs)) {
                foreach ($tempOrgs as $tempOrg) {
                    $organizers[] = $tempOrg;
                }
            }
        }
        if (!empty($organizers)) {
            $return['hiringOrganization'] = $organizers;
        }

        if (!empty($this->originalRow['identifier'])) {
            $identifiers = $this->getIdentifiers($this->originalRow['uid'], 'identifier', 'tx_hdstructureddata_domain_model_structureddata');
            if (!empty($identifiers)) {
                $return['identifier'] = $identifiers;
            }
        }

        if (!empty($this->originalRow['locations'])) {
            $locations = $this->getLocations($this->originalRow['uid'], 'locations', 'tx_hdstructureddata_domain_model_structureddata');
            if (!empty($locations)) {
                $realLocations = [];
                $applicantLocationRequirements = [];
                $hasRemote = false;
                foreach ($locations as $location) {
                    if (!empty($location['_type'])) {
                        // Currently only REMOTE
                        $hasRemote = true;
                        $applicantLocationRequirements[] = $location['address'];
                    } else {
                        $realLocations[] = $location;
                    }
                }
                if (!empty($realLocations)) {
                    $return['jobLocation'] = $realLocations;
                }
                if (!empty($applicantLocationRequirements)) {
                    $return['applicantLocationRequirements'] = $applicantLocationRequirements;
                }
                if ($hasRemote) {
                    $return['jobLocationType'] = 'TELECOMMUTE';
                }
            }
        }

        if (!is_null($this->originalRow['price_min'])) {
            if (is_null($this->originalRow['price_max']) || $this->originalRow['price_min'] == $this->originalRow['price_max']) {
                $value = [
                    '@type' => 'QuantitativeValue',
                    'value' => $this->originalRow['price_min']
                ];
            } else {
                $value = [
                    '@type' => 'QuantitativeValue',
                    'minValue' => $this->originalRow['price_min'],
                    'maxValue' => $this->originalRow['price_max']
                ];
            }
            
            if (!empty($this->originalRow['price_unit'])) {
                $value['unitText'] = $this->originalRow['price_unit'];
            }

            $return['baseSalary'] = [
                '@type' => 'MonetaryAmount',
                'value' => $value
            ];

            if (!empty($this->originalRow['price_currency'])) {
                $return['baseSalary']['currency'] = $this->originalRow['price_currency'];
            }

            if (!empty($this->originalRow['employment_type'])) {
                $return['employmentType'] = GeneralUtility::trimExplode(',', $this->originalRow['employment_type']);
            }
        }

        return $return;
    }
}