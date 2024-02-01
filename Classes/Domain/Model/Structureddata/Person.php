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
        $return['@type'] = 'Person';
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
