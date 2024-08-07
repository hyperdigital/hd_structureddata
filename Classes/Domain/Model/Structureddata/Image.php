<?php
namespace Hyperdigital\HdStructureddata\Domain\Model\Structureddata;

use TYPO3\CMS\Core\Database\Connection;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

class Image extends AbstractData
{


    public function returnData()
    {
        $return = [];
        $return['@context'] = 'https://schema.org/';
        $return['@type'] = 'ImageObject';
        $return['contentUrl'] = $this->getUrl($this->originalRow['publicUrl']);
        if (!empty($this->originalRow['license'])) {
            $return['license'] = $this->getUrl($this->originalRow['license']);
        }
        if (!empty($this->originalRow['acquire_license_page'])) {
            $return['acquireLicensePage'] = $this->getUrl($this->originalRow['acquire_license_page']);
        }
        if (!empty($this->originalRow['credit_text'])) {
            $return['creditText'] = $this->originalRow['credit_text'];
        }
        if (!empty($this->originalRow['copyright_notice'])) {
            $return['copyrightNotice'] = $this->originalRow['copyright_notice'];
        }
        if (!empty($this->originalRow['creator'])) {
            $people = $this->getPeople($this->originalRow['uid'], 'creator', 'sys_file_metadata');
            if (!empty($people)) {
                $return['creator'] = $people;
            }
        }


        return $return;
    }
}
