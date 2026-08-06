<?php
namespace Hyperdigital\HdStructureddata\Domain\Model\Structureddata;

use Hyperdigital\HdStructureddata\UserFunctions\StructuredDataPrint;
use TYPO3\CMS\Core\Database\Connection;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Utility\GeneralUtility;
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

    /**
     * @param $typolink
     * @param string $additionalParams
     * @return string
     */
    protected function getUrl($typolink, $additionalParams = '')
    {
        $urlParams = ['parameter' => $typolink, 'forceAbsoluteUrl' => true];

        if (!empty($additionalParams)) {
            if (substr($additionalParams, 0, 1) != '&') {
                $additionalParams = '&' . $additionalParams;
            }
            $urlParams['additionalParams'] = $additionalParams;
        }

        $contentObjectRenderer = GeneralUtility::makeInstance(ContentObjectRenderer::class);
        // TYPO3 v14 resolves the content object from the request, so pass it explicitly
        // instead of relying on a global fallback.
        if ($GLOBALS['TYPO3_REQUEST'] ?? null) {
            $contentObjectRenderer->setRequest($GLOBALS['TYPO3_REQUEST']);
        }
        $url = $contentObjectRenderer->createUrl($urlParams);

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
            \TYPO3\CMS\Backend\Utility\BackendUtility::workspaceOL('tx_hdstructureddata_domain_model_structureddata_person', $row);
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
            \TYPO3\CMS\Backend\Utility\BackendUtility::workspaceOL('tx_hdstructureddata_domain_model_structureddata_address', $row);
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
            \TYPO3\CMS\Backend\Utility\BackendUtility::workspaceOL('tx_hdstructureddata_domain_model_structureddata_location', $row);
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
            \TYPO3\CMS\Backend\Utility\BackendUtility::workspaceOL('tx_hdstructureddata_domain_model_structureddata_offer', $row);
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
            \TYPO3\CMS\Backend\Utility\BackendUtility::workspaceOL('tx_hdstructureddata_domain_model_structureddata_clip', $row);
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
            \TYPO3\CMS\Backend\Utility\BackendUtility::workspaceOL('tx_hdstructureddata_domain_model_structureddata_openinghour', $row);
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
            \TYPO3\CMS\Backend\Utility\BackendUtility::workspaceOL('tx_hdstructureddata_domain_model_structureddata', $row);
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
            \TYPO3\CMS\Backend\Utility\BackendUtility::workspaceOL('tx_hdstructureddata_domain_model_structureddata_brand', $row);
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
            \TYPO3\CMS\Backend\Utility\BackendUtility::workspaceOL('tx_hdstructureddata_domain_model_structureddata_identifier',$row);
            if (is_array($row)) {
                $output = GeneralUtility::makeInstance(Identifier::class)->setOriginalRow($row)->returnData();
                if ($output) {
                    $return[] = $output;
                }
            }
        }

        return $return;
    }

    protected function getSameas($uid, $parentField, $parentTable)
    {
        $return = [];

        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)
            ->getQueryBuilderForTable('tx_hdstructureddata_domain_model_structureddata_sameas');

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
            ->from('tx_hdstructureddata_domain_model_structureddata_sameas')
            ->where(
                ...$where
            )
            ->addOrderBy('sorting')
            ->executeQuery();

        while ($row = $result->fetchAssociative()) {
            \TYPO3\CMS\Backend\Utility\BackendUtility::workspaceOL('tx_hdstructureddata_domain_model_structureddata_sameas',$row);
            if (is_array($row)) {
                $output = GeneralUtility::makeInstance(SameAs::class)->setOriginalRow($row)->returnData();
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
            \TYPO3\CMS\Backend\Utility\BackendUtility::workspaceOL('tx_hdstructureddata_domain_model_structureddata_courseinstance',$row);
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
            \TYPO3\CMS\Backend\Utility\BackendUtility::workspaceOL('tx_hdstructureddata_domain_model_structureddata',$row);
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
            \TYPO3\CMS\Backend\Utility\BackendUtility::workspaceOL('tx_hdstructureddata_domain_model_structureddata_reviewnote',$row);
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
            \TYPO3\CMS\Backend\Utility\BackendUtility::workspaceOL('tx_hdstructureddata_domain_model_structureddata',$row);
            if (is_array($row)) {
                $output =  StructuredDataPrint::getSpecificStructuredData($row);
                if ($output) {
                    $return[] = $output;
                }
            }
        }

        return $return;
    }

    protected function getShippingDetails($uid, $parentField, $parentTable)
    {
        $return = [];

        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)
            ->getQueryBuilderForTable('tx_hdstructureddata_domain_model_structureddata_shipping');

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
            ->from('tx_hdstructureddata_domain_model_structureddata_shipping')
            ->where(
                ...$where
            )
            ->addOrderBy('sorting')
            ->executeQuery();

        while ($row = $result->fetchAssociative()) {
            \TYPO3\CMS\Backend\Utility\BackendUtility::workspaceOL('tx_hdstructureddata_domain_model_structureddata_shipping', $row);
            if (is_array($row)) {
                $output = GeneralUtility::makeInstance(OfferShippingDetails::class)->setOriginalRow($row)->returnData();
                if ($output) {
                    $return[] = $output;
                }
            }
        }

        return $return;
    }

    protected function getReturnPolicies($uid, $parentField, $parentTable)
    {
        $return = [];

        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)
            ->getQueryBuilderForTable('tx_hdstructureddata_domain_model_structureddata_returnpolicy');

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
            ->from('tx_hdstructureddata_domain_model_structureddata_returnpolicy')
            ->where(
                ...$where
            )
            ->addOrderBy('sorting')
            ->executeQuery();

        while ($row = $result->fetchAssociative()) {
            \TYPO3\CMS\Backend\Utility\BackendUtility::workspaceOL('tx_hdstructureddata_domain_model_structureddata_returnpolicy', $row);
            if (is_array($row)) {
                $output = GeneralUtility::makeInstance(MerchantReturnPolicy::class)->setOriginalRow($row)->returnData();
                if ($output) {
                    $return[] = $output;
                }
            }
        }

        return $return;
    }

    protected function getIngredients($uid, $parentField, $parentTable)
    {
        $return = [];

        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)
            ->getQueryBuilderForTable('tx_hdstructureddata_domain_model_structureddata_ingredient');

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
            ->from('tx_hdstructureddata_domain_model_structureddata_ingredient')
            ->where(
                ...$where
            )
            ->addOrderBy('sorting')
            ->executeQuery();

        while ($row = $result->fetchAssociative()) {
            \TYPO3\CMS\Backend\Utility\BackendUtility::workspaceOL('tx_hdstructureddata_domain_model_structureddata_ingredient', $row);
            if (is_array($row)) {
                if (!empty($row['name'])) {
                    $return[] = $row['name'];
                }
            }
        }

        return $return;
    }

    protected function getInstructions($uid, $parentField, $parentTable)
    {
        $return = [];

        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)
            ->getQueryBuilderForTable('tx_hdstructureddata_domain_model_structureddata_instruction');

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
            ->from('tx_hdstructureddata_domain_model_structureddata_instruction')
            ->where(
                ...$where
            )
            ->addOrderBy('sorting')
            ->executeQuery();

        while ($row = $result->fetchAssociative()) {
            \TYPO3\CMS\Backend\Utility\BackendUtility::workspaceOL('tx_hdstructureddata_domain_model_structureddata_instruction', $row);
            if (is_array($row)) {
                $output = GeneralUtility::makeInstance(HowToStep::class)->setOriginalRow($row)->returnData();
                if ($output) {
                    $return[] = $output;
                }
            }
        }

        return $return;
    }

    protected function getContactPoints($uid, $parentField, $parentTable)
    {
        $return = [];

        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)
            ->getQueryBuilderForTable('tx_hdstructureddata_domain_model_structureddata_contactpoint');

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
            ->from('tx_hdstructureddata_domain_model_structureddata_contactpoint')
            ->where(
                ...$where
            )
            ->addOrderBy('sorting')
            ->executeQuery();

        while ($row = $result->fetchAssociative()) {
            \TYPO3\CMS\Backend\Utility\BackendUtility::workspaceOL('tx_hdstructureddata_domain_model_structureddata_contactpoint', $row);
            if (is_array($row)) {
                $output = GeneralUtility::makeInstance(ContactPoint::class)->setOriginalRow($row)->returnData();
                if ($output) {
                    $return[] = $output;
                }
            }
        }

        return $return;
    }

    protected function getGeo($uid, $parentField, $parentTable)
    {
        $return = [];

        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)
            ->getQueryBuilderForTable('tx_hdstructureddata_domain_model_structureddata_geo');

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
            ->from('tx_hdstructureddata_domain_model_structureddata_geo')
            ->where(
                ...$where
            )
            ->addOrderBy('sorting')
            ->executeQuery();

        while ($row = $result->fetchAssociative()) {
            \TYPO3\CMS\Backend\Utility\BackendUtility::workspaceOL('tx_hdstructureddata_domain_model_structureddata_geo', $row);
            if (is_array($row)) {
                $output = GeneralUtility::makeInstance(GeoCoordinates::class)->setOriginalRow($row)->returnData();
                if ($output) {
                    $return[] = $output;
                }
            }
        }

        return $return;
    }

    /**
     * Build a schema.org QuantitativeValue out of a min/max column pair.
     *
     * @param string $minColumn Column holding the lower bound
     * @param string $maxColumn Column holding the upper bound
     * @param string $unitCode UN/CEFACT code, e.g. "DAY" or "HUR"
     * @return array|false The node, or false when no bound is set
     */
    protected function quantitativeValue($minColumn, $maxColumn, $unitCode = '')
    {
        $min = $this->originalRow[$minColumn] ?? null;
        $max = $this->originalRow[$maxColumn] ?? null;

        if (is_null($min) && is_null($max)) {
            return false;
        }

        $return = ['@type' => 'QuantitativeValue'];
        if (!is_null($min)) {
            $return['minValue'] = (int)$min;
        }
        if (!is_null($max)) {
            $return['maxValue'] = (int)$max;
        }
        if (!empty($unitCode)) {
            $return['unitCode'] = $unitCode;
        }

        return $return;
    }

    /**
     * Build a schema.org rating node out of the rating_* columns of the current row.
     *
     * @param string $type Either "AggregateRating" (summary of many ratings) or "Rating" (a single one)
     * @return array|false The rating node, or false when no rating value is set at all
     */
    protected function getRating($type = 'AggregateRating')
    {
        $return = [];
        $return['@type'] = $type;
        if (!is_null($this->originalRow['rating_value'] ?? null)) {
            $return['ratingValue'] = $this->originalRow['rating_value'];
        }
        if (!is_null($this->originalRow['rating_count'] ?? null)) {
            $return['ratingCount'] = $this->originalRow['rating_count'];
        }
        if (!is_null($this->originalRow['best_rating'] ?? null)) {
            $return['bestRating'] = $this->originalRow['best_rating'];
        }
        if (!is_null($this->originalRow['worst_rating'] ?? null)) {
            $return['worstRating'] = $this->originalRow['worst_rating'];
        }

        if (count($return) < 2) {
            return false;
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
