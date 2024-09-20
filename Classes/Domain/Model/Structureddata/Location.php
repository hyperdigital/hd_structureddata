<?php
namespace Hyperdigital\HdStructureddata\Domain\Model\Structureddata;

use TYPO3\CMS\Core\Database\Connection;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

class Location extends AbstractData
{


    public function returnData()
    {
        $return = [];
        switch ($this->originalRow['type']) {
            case 'VirtualLocation':
                $return['@type'] = 'VirtualLocation';
                if (!empty($this->originalRow['url'])) {
                    $return['url'] = $this->getUrl($this->originalRow['url']);
                }
                break;
            case 'Place':
                $return['@type'] = 'Place';
                if (!empty($this->originalRow['name'])) {
                    $return['name'] = $this->originalRow['name'];
                }
                if (!empty($this->originalRow['addresses'])) {
                    $address = $this->getAddresses($this->originalRow['uid'], 'addresses', 'tx_hdstructureddata_domain_model_structureddata_location');
                    if (!empty($address)) {
                        $return['address'] = $address;
                    }
                }
                break;
            case 'Remote':
                // This is used only for JOBS right now and it's not real output
                $return['_type'] = 'Remote';
                if (!empty($this->originalRow['addresses'])) {
                    $address = $this->getAddresses($this->originalRow['uid'], 'addresses', 'tx_hdstructureddata_domain_model_structureddata_location');
                    if (!empty($address)) {
                        $return['address'] = $address;
                    }
                }
        }

        return $return;
    }
}
