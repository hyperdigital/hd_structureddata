<?php
namespace Hyperdigital\HdStructureddata\UserFunctions;

use Hyperdigital\HdStructureddata\Domain\Model\Structureddata\Article;
use Hyperdigital\HdStructureddata\Domain\Model\Structureddata\Faq;
use Hyperdigital\HdStructureddata\Domain\Model\Structureddata\LearningVideo;
use Hyperdigital\HdStructureddata\Domain\Model\Structureddata\Organization;
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

    public function printTags()
    {
        $output = [];

        $structuredData = $this->getAllStructuredData();
        foreach ($structuredData as $data) {
            if (!empty($data)) {
                $output[] = '<script type="application/ld+json">'.json_encode($data).'</script>';
            }
        }

        return implode('', $output);
    }

    public function getAllStructuredData()
    {
        $return = [];

        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)
            ->getQueryBuilderForTable('tx_hdstructureddata_domain_model_structureddata');

        $where = [
            $queryBuilder->expr()->eq('pid', $queryBuilder->createNamedParameter($this->pid, Connection::PARAM_INT)),
            $queryBuilder->expr()->eq('sys_language_uid',  $queryBuilder->createNamedParameter($this->sysLanguageUid, Connection::PARAM_INT))
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
                $return[] = $this->getSpecificStructuredData($row);
            }
        }

        return $return;
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
                $return = GeneralUtility::makeInstance(Organization::class)->setOriginalRow($row)->returnData();
                break;
            case 'video':
                $return = GeneralUtility::makeInstance(Video::class)->setOriginalRow($row)->returnData();
                break;
            case 'learningVideo':
                $return = GeneralUtility::makeInstance(LearningVideo::class)->setOriginalRow($row)->returnData();
                break;
        }

        return $return;
    }
}
