<?php
namespace Hyperdigital\HdStructureddata\Domain\Model\Structureddata;

use Hyperdigital\HdStructureddata\Domain\Model\Structureddata\Organization\Restaurant;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

class SitelinkSearchbox extends AbstractData
{
    public function updateData()
    {
        if (!empty($this->originalRow['search_parameter']) && !empty($this->originalRow['url'])) {
            $searchParameter = $this->originalRow['search_parameter'];
            $searchParameter = str_replace(' ', '', $searchParameter);
            // remove `=` and ` ` from the string
            $searchParameterTemp = GeneralUtility::trimExplode('=', $searchParameter);
            if (count($searchParameterTemp) < 3) {
                $searchParameter = implode('', $searchParameterTemp);
            }

            $url = $this->getUrl($this->originalRow['url']);

            if ($url) {
                $parsedUrl = parse_url($url);
                if (isset($parsedUrl['query'])) {
                    $separator = '&';
                } else {
                    $separator = '?';
                }
                $newQueryParam = str_replace('###SWORD###', '{search_term_string}', $searchParameter);
                $url = $url . $separator . $newQueryParam;
                
                $data = [];
                $data['@type'] = 'SearchAction';
                $data['target'] = [
                    '@type' => 'EntryPoint',
                    'urlTemplate' => $url
                ];
                $data['query-input'] = 'required name=search_term_string';

                \Hyperdigital\HdStructureddata\Domain\Model\Structureddata\Website::setData('potentialAction', $data);
            }
        }
    }
}