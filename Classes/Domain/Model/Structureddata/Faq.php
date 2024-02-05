<?php
namespace Hyperdigital\HdStructureddata\Domain\Model\Structureddata;

use TYPO3\CMS\Core\Database\Connection;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

class Faq extends AbstractData
{
    protected function getFaqs($uid, $parentField, $parentTable)
    {
        $return = [];

        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)
            ->getQueryBuilderForTable('tx_hdstructureddata_domain_model_structureddata_faq');

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
            ->from('tx_hdstructureddata_domain_model_structureddata_faq')
            ->where(
                ...$where
            )
            ->addOrderBy('sorting')
            ->executeQuery();

        while ($row = $result->fetchAssociative()) {
            $GLOBALS['TSFE']->sys_page->versionOL('tx_hdstructureddata_domain_model_structureddata_faq',$row);
            if (is_array($row)) {
                $return[] = $row;
            }
        }

        return $return;
    }

    public function returnData()
    {
        $faqs = $this->getFaqs($this->originalRow['uid'], 'faqs', 'tx_hdstructureddata_domain_model_structureddata');

        $return = [];
        if (!empty($faqs)) {
            $faqContent = [];
            foreach ($faqs as $faq) {
                $temp = [];
                if (!empty($faq['question'])) {
                    $temp['@type'] = 'Question';
                    $temp['name'] = $faq['question'];
                }
                if (!empty($faq['answer'])) {
                    $temp['acceptedAnswer'] = [
                        '@type' => 'Answer',
                        'text' => $faq['answer']
                    ];
                }
                if (count($temp) > 2) {
                    $faqContent[] = $temp;
                }
            }
            if (!empty($faqContent)) {
                $return['@context'] = 'https://schema.org';
                $return['@type'] = 'FAQPage';
                if (!empty($this->originalRow['title'])) {
                    $return['name'] = $this->originalRow['title'];
                }
                $return['mainEntity'] = $faqContent;
            }
        }

        return $return;
    }
}
