<?php
namespace Hyperdigital\HdStructureddata\Domain\Model\Structureddata;

use TYPO3\CMS\Core\Utility\GeneralUtility;

class Dataset extends AbstractData
{
    public function returnData()
    {
        $return = [];
        $return['@context'] = 'https://schema.org';
        $return['@type'] = 'Dataset';
        $return['name'] = $this->originalRow['title'] ?? '';
        if (!empty($this->originalRow['description'])) {
            $return['description'] = $this->originalRow['description'];
        }
        if (!empty($this->originalRow['url'])) {
            $temp = $this->getUrl($this->originalRow['url']);
            if (!empty($temp)) {
                $return['url'] = $temp;
            }
        }
        if (!empty($this->originalRow['keywords'])) {
            $return['keywords'] = GeneralUtility::trimExplode(',', $this->originalRow['keywords'], true);
        }
        if (!empty($this->originalRow['license_url'])) {
            $temp = $this->getUrl($this->originalRow['license_url']);
            if (!empty($temp)) {
                $return['license'] = $temp;
            }
        }
        if (!empty($this->originalRow['date_published'])) {
            $date = new \DateTime($this->originalRow['date_published']);
            $return['datePublished'] = $date->format(DATE_ATOM);
        }
        if (!empty($this->originalRow['date_modified'])) {
            $date = new \DateTime($this->originalRow['date_modified']);
            $return['dateModified'] = $date->format(DATE_ATOM);
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
            $return['creator'] = $organizations;
        }
        if (!empty($this->originalRow['identifier'])) {
            $identifiers = $this->getIdentifiers($this->originalRow['uid'], 'identifier', 'tx_hdstructureddata_domain_model_structureddata');
            if (!empty($identifiers)) {
                $return['identifier'] = $identifiers;
            }
        }

        return $return;
    }
}
