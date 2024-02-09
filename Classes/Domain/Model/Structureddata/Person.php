<?php
namespace Hyperdigital\HdStructureddata\Domain\Model\Structureddata;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;

class Person extends AbstractData
{
    public function returnData()
    {
        $return = [];
        $return['@context'] = 'https://schema.org';
        switch ($this->originalRow['type']) {
            case 'PerformingGroup':
                $return['@type'] = 'PerformingGroup';
                break;
            default:
                $return['@type'] = 'Person';
                break;
        }
        $return['name'] = $this->originalRow['name'];
        if (!empty($this->originalRow['url'])) {
            $url = $this->getUrl($this->originalRow['url']);

            if (!empty($url)) {
                $return['url'] = $url;
            }
        }

        return $return;
    }
}
