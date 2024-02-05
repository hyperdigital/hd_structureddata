<?php
namespace Hyperdigital\HdStructureddata\Domain\Model\Structureddata;

use TYPO3\CMS\Core\Database\Connection;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;
use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;

abstract class AbstractData
{
    protected $originalRow = [];

    public function setOriginalRow($row)
    {
        $this->originalRow = $row;

        return $this;
    }

    public function returnData()
    {
        return false;
    }

    protected function getUrl($typolink)
    {
        $contentObjectRenderer = $contentObjectRenderer ?? GeneralUtility::makeInstance(ContentObjectRenderer::class);
        $url = $contentObjectRenderer->createUrl(['parameter' => $typolink, 'forceAbsoluteUrl' => true]);

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

    protected function getImages($uid, $field, $table, $single = false)
    {
        $fileRepository = GeneralUtility::makeInstance(\TYPO3\CMS\Core\Resource\FileRepository::class);
        $fileObjects = $fileRepository->findByRelation($table, $field, $uid);
        $return = [];
        foreach ($fileObjects as $fileObject) {

            $url = $this->getUrl($fileObject->getPublicUrl());
            if ($url) {
                $return[] = $url;
            }
        }

        if ($single) {
            return $return[0] ?? false;
        }

        return $return;
    }
}
