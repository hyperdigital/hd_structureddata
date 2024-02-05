<?php
namespace Hyperdigital\HdStructureddata\UserFunctions;

use Hyperdigital\HdStructureddata\Domain\Model\Structureddata\Article;
use Hyperdigital\HdStructureddata\Domain\Model\Structureddata\Faq;
use Hyperdigital\HdStructureddata\Domain\Model\Structureddata\LearningVideo;
use Hyperdigital\HdStructureddata\Domain\Model\Structureddata\Organization;
use Hyperdigital\HdStructureddata\Domain\Model\Structureddata\Review;
use Hyperdigital\HdStructureddata\Domain\Model\Structureddata\Video;
use TYPO3\CMS\Core\Database\Connection;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Context\Context;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

class StructuredDataPrint
{
    protected $pid = 0;
    protected $sysLanguageUid = 0;

    public function __construct()
    {
        $context = GeneralUtility::makeInstance(Context::class);

        $this->pid = $GLOBALS['TYPO3_REQUEST']?->getAttribute('routing')?->getPageId();
        $this->sysLanguageUid = $context->getPropertyFromAspect('language', 'id');


    }

    /**
     * Output the current time in red letters
     *
     * @param string          Empty string (no content to process)
     * @param array           TypoScript configuration
     * @return        string          HTML output, showing the current server time.
     */
    public function printTags(string $content, array $conf)
    {
        $output = [];

        $structuredData = $this->getAllStructuredData($conf);
        foreach ($structuredData as $data) {
            if (!empty($data)) {
                $output[] = '<script type="application/ld+json">'.json_encode($data).'</script>';
            }
        }

        return implode('', $output);
    }

    public function getAllStructuredData($conf)
    {
        $return = [];
        $where = [];
        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)
            ->getQueryBuilderForTable('tx_hdstructureddata_domain_model_structureddata');

        if (empty($conf['tableName'])) {
            $where = [
                $queryBuilder->expr()->eq('pid', $queryBuilder->createNamedParameter($this->pid, Connection::PARAM_INT)),
                $queryBuilder->expr()->eq('sys_language_uid',  $queryBuilder->createNamedParameter($this->sysLanguageUid, Connection::PARAM_INT))
            ];
        } else {
            $tableName = $conf['tableName'] ?? 'pages';
            $fieldName = $conf['fieldName'] ?? 'structured_data';
            $parentUid = $this->getParentUid($conf['parentUid'] ?? '');
            $parentUidField = 'foreign_uid';
            $tableField = 'tablename';
            $parentField = 'fieldname';

            if (empty($parentUid)) {
                return '';
            }

            $where = [
                $queryBuilder->expr()->eq($tableField,  $queryBuilder->createNamedParameter($tableName)),
                $queryBuilder->expr()->eq($parentUidField,  $queryBuilder->createNamedParameter($parentUid, Connection::PARAM_INT)),
                $queryBuilder->expr()->eq('sys_language_uid',  $queryBuilder->createNamedParameter($this->sysLanguageUid, Connection::PARAM_INT))
            ];
            if (!empty($parentField)) {
                $where[] = $queryBuilder->expr()->eq($parentField,  $queryBuilder->createNamedParameter($fieldName));
            }
        }

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
                $return[] = $this->getSpecificStructuredData($row);
            }
        }

        return $return;
    }

    public function getParentUid($conf)
    {

        if (substr($conf, 0, 3) == 'GP:') {
            $parts = GeneralUtility::trimExplode('|', substr($conf, 3));
            $queryParams = $GLOBALS['TYPO3_REQUEST']->getQueryParams();
            foreach ($parts as $part) {
                if (!empty($queryParams[$part])) {
                    $queryParams = $queryParams[$part];
                }
            }
            return (int) $queryParams;
        }

        return (int) $conf;
    }

    /**
     * @param $row - database row from tx_hdstructureddata_domain_model_structureddata
     */
    public function getSpecificStructuredData($row)
    {
        $return = false;

        switch ($row['type']) {
            case 'article':
                $return = GeneralUtility::makeInstance(Article::class)->setOriginalRow($row)->returnData();
                break;
            case 'faq':
                $return = GeneralUtility::makeInstance(Faq::class)->setOriginalRow($row)->returnData();
                break;
            case 'organization':
                switch ($row['subtype']) {
                    case 'Restaurant':
                        $return = GeneralUtility::makeInstance(Organization\Restaurant::class)->setOriginalRow($row)->returnData();
                        break;
                    default:
                        $return = GeneralUtility::makeInstance(Organization::class)->setOriginalRow($row)->returnData();
                        break;
                }
                break;
            case 'video':
                $return = GeneralUtility::makeInstance(Video::class)->setOriginalRow($row)->returnData();
                break;
            case 'review':
                $return = GeneralUtility::makeInstance(Review::class)->setOriginalRow($row)->returnData();
                break;
        }

        return $return;
    }
}
