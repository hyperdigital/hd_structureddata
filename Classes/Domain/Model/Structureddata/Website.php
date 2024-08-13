<?php
namespace Hyperdigital\HdStructureddata\Domain\Model\Structureddata;

use TYPO3\CMS\Core\Database\Connection;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;
use TYPO3\CMS\Core\Site\SiteFinder;

class Website extends AbstractData
{
    public static function getDefaultData()
    {
        $return = [];
        $return['@context'] = 'https://schema.org';
        $return['@type'] = 'WebSite';

        $pid = $GLOBALS['TYPO3_REQUEST']?->getAttribute('routing')?->getPageId();

        $siteFinder = GeneralUtility::makeInstance(SiteFinder::class);
        $site = $siteFinder->getSiteByPageId($pid);
        $rootPageId = $site->getRootPageId();
        $baseUrl = $site->getBase()->__toString();
        if ($baseUrl) {
            $return['url'] = $baseUrl;
        }

        return $return;
    }

    public static function getData()
    {
        if (!isset(self::$singleDisplayData['website'])) {
            self::$singleDisplayData['website'] = self::getDefaultData();
        }

        return self::$singleDisplayData['website'];
    }

    public static function setData($parameterName, $parameterValue)
    {
        $data = self::getData();

        if (isset($data[$parameterName])) {
            if (is_array($data[$parameterName])) {
                $data[$parameterName][] = $parameterValue;
            } else {
                if (is_array($parameterValue)) {
                    $data[$parameterName] = [$parameterValue];
                } else {
                    $data[$parameterName] = $parameterValue;
                }
            }
        } else {
            if (is_array($parameterValue)) {
                $data[$parameterName] = [$parameterValue];
            } else {
                $data[$parameterName] = $parameterValue;
            }
        }

        self::$singleDisplayData['website'] = $data;
    }
}
