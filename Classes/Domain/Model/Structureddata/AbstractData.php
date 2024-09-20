<?php
namespace Hyperdigital\HdStructureddata\Domain\Model\Structureddata;

use Hyperdigital\HdStructureddata\UserFunctions\StructuredDataPrint;
use TYPO3\CMS\Core\Database\Connection;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;
use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;

abstract class AbstractData
{
    protected $originalRow = [];

    public static $singleDisplayData = [];

    public function setOriginalRow($row)
    {
        $this->originalRow = $row;

        return $this;
    }

    public function returnData()
    {
        return false;
    }

    protected function getUrl($typolink, $additionalParams = '')
    {
        $urlParams = ['parameter' => $typolink, 'forceAbsoluteUrl' => true];

        if (!empty($additionalParams)) {
            if (substr($additionalParams, 0, 1) != '&') {
                $additionalParams = '&' . $additionalParams;
            }
            $urlParams['additionalParams'] = $additionalParams;
        }

        $version = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Information\Typo3Version::class);
        if ($version->getMajorVersion() > 11) {
            $contentObjectRenderer = $contentObjectRenderer ?? GeneralUtility::makeInstance(ContentObjectRenderer::class);
            $url = $contentObjectRenderer->createUrl($urlParams);
        } else {
            $url = $GLOBALS['TSFE']->cObj->typoLink_URL($urlParams);
        }

        return $url;
    }

    protected function getPeople($uid, $parentField, $parentTable)
    {
        $return = [];

        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)
            ->getQueryBuilderForTable('tx_hdstructureddata_domain_model_structureddata_person');

        $where = [
            $queryBuilder->expr()->eq('foreign_uid', $queryBuilder->createNamedParameter($uid, Connection::PARAM_INT)),
            $queryBuilder->expr()->eq('tablename',  $queryBuilder->createNamedParameter($parentTable)),
            $queryBuilder->expr()->eq('fieldname',  $queryBuilder->createNamedParameter($parentField))
        ];

        if (\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::isLoaded('workspaces')) {
            $where[] = $queryBuilder->expr()->eq('t3ver_wsid', $queryBuilder->createNamedParameter(0, Connection::PARAM_INT));
        }

        $result = $queryBuilder
            ->select('*')
            ->from('tx_hdstructureddata_domain_model_structureddata_person')
            ->where(
                ...$where
            )
            ->addOrderBy('sorting')
            ->executeQuery();

        while ($row = $result->fetchAssociative()) {
            $GLOBALS['TSFE']->sys_page->versionOL('tx_hdstructureddata_domain_model_structureddata_person',$row);
            if (is_array($row)) {
                $output = GeneralUtility::makeInstance(Person::class)->setOriginalRow($row)->returnData();
                if ($output) {
                    $return[] = $output;
                }
            }
        }

        return $return;
    }

    protected function getAddresses($uid, $parentField, $parentTable)
    {
        $return = [];

        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)
            ->getQueryBuilderForTable('tx_hdstructureddata_domain_model_structureddata_address');

        $where = [
            $queryBuilder->expr()->eq('foreign_uid', $queryBuilder->createNamedParameter($uid, Connection::PARAM_INT)),
            $queryBuilder->expr()->eq('tablename',  $queryBuilder->createNamedParameter($parentTable)),
            $queryBuilder->expr()->eq('fieldname',  $queryBuilder->createNamedParameter($parentField))
        ];

        if (\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::isLoaded('workspaces')) {
            $where[] = $queryBuilder->expr()->eq('t3ver_wsid', $queryBuilder->createNamedParameter(0, Connection::PARAM_INT));
        }

        $result = $queryBuilder
            ->select('*')
            ->from('tx_hdstructureddata_domain_model_structureddata_address')
            ->where(
                ...$where
            )
            ->addOrderBy('sorting')
            ->executeQuery();

        while ($row = $result->fetchAssociative()) {
            $GLOBALS['TSFE']->sys_page->versionOL('tx_hdstructureddata_domain_model_structureddata_address',$row);
            if (is_array($row)) {
                $output = GeneralUtility::makeInstance(Address::class)->setOriginalRow($row)->returnData();
                if ($output) {
                    $return[] = $output;
                }
            }
        }

        return $return;
    }

    protected function getLocations($uid, $parentField, $parentTable)
    {
        $return = [];

        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)
            ->getQueryBuilderForTable('tx_hdstructureddata_domain_model_structureddata_location');

        $where = [
            $queryBuilder->expr()->eq('foreign_uid', $queryBuilder->createNamedParameter($uid, Connection::PARAM_INT)),
            $queryBuilder->expr()->eq('tablename',  $queryBuilder->createNamedParameter($parentTable)),
            $queryBuilder->expr()->eq('fieldname',  $queryBuilder->createNamedParameter($parentField))
        ];

        if (\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::isLoaded('workspaces')) {
            $where[] = $queryBuilder->expr()->eq('t3ver_wsid', $queryBuilder->createNamedParameter(0, Connection::PARAM_INT));
        }

        $result = $queryBuilder
            ->select('*')
            ->from('tx_hdstructureddata_domain_model_structureddata_location')
            ->where(
                ...$where
            )
            ->addOrderBy('sorting')
            ->executeQuery();

        while ($row = $result->fetchAssociative()) {
            $GLOBALS['TSFE']->sys_page->versionOL('tx_hdstructureddata_domain_model_structureddata_location',$row);
            if (is_array($row)) {
                $output = GeneralUtility::makeInstance(Location::class)->setOriginalRow($row)->returnData();
                if ($output) {
                    $return[] = $output;
                }
            }
        }

        return $return;
    }

    protected function getOffers($uid, $parentField, $parentTable)
    {
        $return = [];

        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)
            ->getQueryBuilderForTable('tx_hdstructureddata_domain_model_structureddata_offer');

        $where = [
            $queryBuilder->expr()->eq('foreign_uid', $queryBuilder->createNamedParameter($uid, Connection::PARAM_INT)),
            $queryBuilder->expr()->eq('tablename',  $queryBuilder->createNamedParameter($parentTable)),
            $queryBuilder->expr()->eq('fieldname',  $queryBuilder->createNamedParameter($parentField))
        ];

        if (\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::isLoaded('workspaces')) {
            $where[] = $queryBuilder->expr()->eq('t3ver_wsid', $queryBuilder->createNamedParameter(0, Connection::PARAM_INT));
        }

        $result = $queryBuilder
            ->select('*')
            ->from('tx_hdstructureddata_domain_model_structureddata_offer')
            ->where(
                ...$where
            )
            ->addOrderBy('sorting')
            ->executeQuery();

        while ($row = $result->fetchAssociative()) {
            $GLOBALS['TSFE']->sys_page->versionOL('tx_hdstructureddata_domain_model_structureddata_offer',$row);
            if (is_array($row)) {
                $output = GeneralUtility::makeInstance(Offer::class)->setOriginalRow($row)->returnData();
                if ($output) {
                    $return[] = $output;
                }
            }
        }

        return $return;
    }

    protected function getClips($uid, $parentField, $parentTable)
    {
        $return = [];

        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)
            ->getQueryBuilderForTable('tx_hdstructureddata_domain_model_structureddata_clip');

        $where = [
            $queryBuilder->expr()->eq('foreign_uid', $queryBuilder->createNamedParameter($uid, Connection::PARAM_INT)),
            $queryBuilder->expr()->eq('tablename',  $queryBuilder->createNamedParameter($parentTable)),
            $queryBuilder->expr()->eq('fieldname',  $queryBuilder->createNamedParameter($parentField))
        ];

        if (\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::isLoaded('workspaces')) {
            $where[] = $queryBuilder->expr()->eq('t3ver_wsid', $queryBuilder->createNamedParameter(0, Connection::PARAM_INT));
        }

        $result = $queryBuilder
            ->select('*')
            ->from('tx_hdstructureddata_domain_model_structureddata_clip')
            ->where(
                ...$where
            )
            ->addOrderBy('sorting')
            ->executeQuery();

        while ($row = $result->fetchAssociative()) {
            $GLOBALS['TSFE']->sys_page->versionOL('tx_hdstructureddata_domain_model_structureddata_clip',$row);
            if (is_array($row)) {
                $output = GeneralUtility::makeInstance(Clip::class)->setOriginalRow($row)->returnData();
                if ($output) {
                    $return[] = $output;
                }
            }
        }

        return $return;
    }

    protected function getOpeningHours($uid, $parentField, $parentTable)
    {
        $return = [];

        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)
            ->getQueryBuilderForTable('tx_hdstructureddata_domain_model_structureddata_openinghour');

        $where = [
            $queryBuilder->expr()->eq('foreign_uid', $queryBuilder->createNamedParameter($uid, Connection::PARAM_INT)),
            $queryBuilder->expr()->eq('tablename',  $queryBuilder->createNamedParameter($parentTable)),
            $queryBuilder->expr()->eq('fieldname',  $queryBuilder->createNamedParameter($parentField))
        ];

        if (\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::isLoaded('workspaces')) {
            $where[] = $queryBuilder->expr()->eq('t3ver_wsid', $queryBuilder->createNamedParameter(0, Connection::PARAM_INT));
        }

        $result = $queryBuilder
            ->select('*')
            ->from('tx_hdstructureddata_domain_model_structureddata_openinghour')
            ->where(
                ...$where
            )
            ->addOrderBy('sorting')
            ->executeQuery();

        while ($row = $result->fetchAssociative()) {
            $GLOBALS['TSFE']->sys_page->versionOL('tx_hdstructureddata_domain_model_structureddata_clip',$row);
            if (is_array($row)) {
                $output = GeneralUtility::makeInstance(OpeningHours::class)->setOriginalRow($row)->returnData();
                if ($output) {
                    $return[] = $output;
                }
            }
        }

        return $return;
    }

    protected function getStructuredData($uid, $parentField, $parentTable)
    {
        $return = [];

        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)
            ->getQueryBuilderForTable('tx_hdstructureddata_domain_model_structureddata');

        $where = [
            $queryBuilder->expr()->eq('foreign_uid', $queryBuilder->createNamedParameter($uid, Connection::PARAM_INT)),
            $queryBuilder->expr()->eq('tablename',  $queryBuilder->createNamedParameter($parentTable)),
            $queryBuilder->expr()->eq('fieldname',  $queryBuilder->createNamedParameter($parentField))
        ];

        if (\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::isLoaded('workspaces')) {
            $where[] = $queryBuilder->expr()->eq('t3ver_wsid', $queryBuilder->createNamedParameter(0, Connection::PARAM_INT));
        }

        $result = $queryBuilder
            ->select('*')
            ->from('tx_hdstructureddata_domain_model_structureddata')
            ->where(
                ...$where
            )
            ->addOrderBy('sorting')
            ->executeQuery();

        while ($row = $result->fetchAssociative()) {
            $GLOBALS['TSFE']->sys_page->versionOL('tx_hdstructureddata_domain_model_structureddata',$row);
            if (is_array($row)) {
                $output =  StructuredDataPrint::getSpecificStructuredData($row);
                if ($output) {
                    $return[] = $output;
                }
            }
        }

        return $return;
    }

    protected function getBrands($uid, $parentField, $parentTable)
    {
        $return = [];

        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)
            ->getQueryBuilderForTable('tx_hdstructureddata_domain_model_structureddata_brand');

        $where = [
            $queryBuilder->expr()->eq('foreign_uid', $queryBuilder->createNamedParameter($uid, Connection::PARAM_INT)),
            $queryBuilder->expr()->eq('tablename',  $queryBuilder->createNamedParameter($parentTable)),
            $queryBuilder->expr()->eq('fieldname',  $queryBuilder->createNamedParameter($parentField))
        ];

        if (\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::isLoaded('workspaces')) {
            $where[] = $queryBuilder->expr()->eq('t3ver_wsid', $queryBuilder->createNamedParameter(0, Connection::PARAM_INT));
        }

        $result = $queryBuilder
            ->select('*')
            ->from('tx_hdstructureddata_domain_model_structureddata_brand')
            ->where(
                ...$where
            )
            ->addOrderBy('sorting')
            ->executeQuery();

        while ($row = $result->fetchAssociative()) {
            $GLOBALS['TSFE']->sys_page->versionOL('tx_hdstructureddata_domain_model_structureddata_brand',$row);
            if (is_array($row)) {
                $output = GeneralUtility::makeInstance(Brand::class)->setOriginalRow($row)->returnData();
                if ($output) {
                    $return[] = $output;
                }
            }
        }

        return $return;
    }

    protected function getIdentifiers($uid, $parentField, $parentTable)
    {
        $return = [];

        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)
            ->getQueryBuilderForTable('tx_hdstructureddata_domain_model_structureddata_identifier');

        $where = [
            $queryBuilder->expr()->eq('foreign_uid', $queryBuilder->createNamedParameter($uid, Connection::PARAM_INT)),
            $queryBuilder->expr()->eq('tablename',  $queryBuilder->createNamedParameter($parentTable)),
            $queryBuilder->expr()->eq('fieldname',  $queryBuilder->createNamedParameter($parentField))
        ];

        if (\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::isLoaded('workspaces')) {
            $where[] = $queryBuilder->expr()->eq('t3ver_wsid', $queryBuilder->createNamedParameter(0, Connection::PARAM_INT));
        }

        $result = $queryBuilder
            ->select('*')
            ->from('tx_hdstructureddata_domain_model_structureddata_identifier')
            ->where(
                ...$where
            )
            ->addOrderBy('sorting')
            ->executeQuery();

        while ($row = $result->fetchAssociative()) {
            $GLOBALS['TSFE']->sys_page->versionOL('tx_hdstructureddata_domain_model_structureddata_identifier',$row);
            if (is_array($row)) {
                $output = GeneralUtility::makeInstance(Identifier::class)->setOriginalRow($row)->returnData();
                if ($output) {
                    $return[] = $output;
                }
            }
        }

        return $return;
    }

    protected function getCourseInstances($uid, $parentField, $parentTable)
    {
        $return = [];

        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)
            ->getQueryBuilderForTable('tx_hdstructureddata_domain_model_structureddata_courseinstance');

        $where = [
            $queryBuilder->expr()->eq('foreign_uid', $queryBuilder->createNamedParameter($uid, Connection::PARAM_INT)),
            $queryBuilder->expr()->eq('tablename',  $queryBuilder->createNamedParameter($parentTable)),
            $queryBuilder->expr()->eq('fieldname',  $queryBuilder->createNamedParameter($parentField))
        ];

        if (\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::isLoaded('workspaces')) {
            $where[] = $queryBuilder->expr()->eq('t3ver_wsid', $queryBuilder->createNamedParameter(0, Connection::PARAM_INT));
        }

        $result = $queryBuilder
            ->select('*')
            ->from('tx_hdstructureddata_domain_model_structureddata_courseinstance')
            ->where(
                ...$where
            )
            ->addOrderBy('sorting')
            ->executeQuery();

        while ($row = $result->fetchAssociative()) {
            $GLOBALS['TSFE']->sys_page->versionOL('tx_hdstructureddata_domain_model_structureddata_courseinstance',$row);
            if (is_array($row)) {
                $output = GeneralUtility::makeInstance(Courseinstance::class)->setOriginalRow($row)->returnData();
                if ($output) {
                    $return[] = $output;
                }
            }
        }

        return $return;
    }

    protected function getReviews($uid, $parentField, $parentTable)
    {
        $return = [];

        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)
            ->getQueryBuilderForTable('tx_hdstructureddata_domain_model_structureddata');

        $where = [
            $queryBuilder->expr()->eq('foreign_uid', $queryBuilder->createNamedParameter($uid, Connection::PARAM_INT)),
            $queryBuilder->expr()->eq('tablename',  $queryBuilder->createNamedParameter($parentTable)),
            $queryBuilder->expr()->eq('fieldname',  $queryBuilder->createNamedParameter($parentField)),
            $queryBuilder->expr()->eq('type',  $queryBuilder->createNamedParameter('review'))
        ];

        if (\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::isLoaded('workspaces')) {
            $where[] = $queryBuilder->expr()->eq('t3ver_wsid', $queryBuilder->createNamedParameter(0, Connection::PARAM_INT));
        }

        $result = $queryBuilder
            ->select('*')
            ->from('tx_hdstructureddata_domain_model_structureddata')
            ->where(
                ...$where
            )
            ->addOrderBy('sorting')
            ->executeQuery();

        while ($row = $result->fetchAssociative()) {
            $GLOBALS['TSFE']->sys_page->versionOL('tx_hdstructureddata_domain_model_structureddata',$row);
            if (is_array($row)) {
                $output = GeneralUtility::makeInstance(Review::class)->setOriginalRow($row)->returnData();
                if ($output) {
                    $return[] = $output;
                }
            }
        }

        return $return;
    }

    protected function getReviewNotes($uid, $parentField, $parentTable)
    {
        $return = [];

        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)
            ->getQueryBuilderForTable('tx_hdstructureddata_domain_model_structureddata_reviewnote');

        $where = [
            $queryBuilder->expr()->eq('foreign_uid', $queryBuilder->createNamedParameter($uid, Connection::PARAM_INT)),
            $queryBuilder->expr()->eq('tablename',  $queryBuilder->createNamedParameter($parentTable)),
            $queryBuilder->expr()->eq('fieldname',  $queryBuilder->createNamedParameter($parentField))
        ];

        if (\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::isLoaded('workspaces')) {
            $where[] = $queryBuilder->expr()->eq('t3ver_wsid', $queryBuilder->createNamedParameter(0, Connection::PARAM_INT));
        }

        $result = $queryBuilder
            ->select('*')
            ->from('tx_hdstructureddata_domain_model_structureddata_reviewnote')
            ->where(
                ...$where
            )
            ->addOrderBy('sorting')
            ->executeQuery();

        while ($row = $result->fetchAssociative()) {
            $GLOBALS['TSFE']->sys_page->versionOL('tx_hdstructureddata_domain_model_structureddata_reviewnote',$row);
            if (is_array($row)) {
                $output = GeneralUtility::makeInstance(ReviewNote::class)->setOriginalRow($row)->returnData();
                if ($output) {
                    $output['position'] = count($return) + 1;
                    $return[] = $output;
                }
            }
        }

        return $return;
    }

    protected function getStructuredDataByMM($uid, $joinTable, $limitTypes = [])
    {
        $table = 'tx_hdstructureddata_domain_model_structureddata';

        $return = [];

        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)
            ->getQueryBuilderForTable($table);

        $where = [
            $queryBuilder->expr()->eq('mm.uid_local', $queryBuilder->createNamedParameter($uid, Connection::PARAM_INT)),
        ];
        if (!empty($limitTypes)) {
            $where[] = $queryBuilder->expr()->in('data.type', $queryBuilder->createNamedParameter($limitTypes, Connection::PARAM_STR_ARRAY));

        }

        $result = $queryBuilder->select('data.*')
            ->from('tx_hdstructureddata_domain_model_structureddata', 'data')
            ->leftJoin(
                'data',
                $joinTable,
                'mm',
                $queryBuilder->expr()->eq('data.uid', $queryBuilder->quoteIdentifier('mm.uid_foreign'))
            )
            ->where(
                ...$where
            )
            ->executeQuery();
        while ($row = $result->fetchAssociative()) {
            $GLOBALS['TSFE']->sys_page->versionOL('tx_hdstructureddata_domain_model_structureddata',$row);
            if (is_array($row)) {
                $output =  StructuredDataPrint::getSpecificStructuredData($row);
                if ($output) {
                    $return[] = $output;
                }
            }
        }

        return $return;
    }

    protected function getImages($uid, $field, $table, $single = false, $asObject = false)
    {
        $fileRepository = GeneralUtility::makeInstance(\TYPO3\CMS\Core\Resource\FileRepository::class);
        $fileObjects = $fileRepository->findByRelation($table, $field, $uid);
        $return = [];
        foreach ($fileObjects as $fileObject) {
            if ($asObject) {
                $return[] = $fileObject;
            } else {
                $url = $this->getUrl($fileObject->getPublicUrl());
                if ($url) {
                    $return[] = $url;
                }
            }
        }

        if ($single) {
            return $return[0] ?? false;
        }

        return $return;
    }
}
