<?php
namespace Hyperdigital\HdStructureddata\UserFunctions;

use Hyperdigital\HdStructureddata\Domain\Model\Structureddata\Article;
use Hyperdigital\HdStructureddata\Domain\Model\Structureddata\Image;
use Hyperdigital\HdStructureddata\Domain\Model\Structureddata\Course;
use Hyperdigital\HdStructureddata\Domain\Model\Structureddata\Event;
use Hyperdigital\HdStructureddata\Domain\Model\Structureddata\Faq;
use Hyperdigital\HdStructureddata\Domain\Model\Structureddata\Organization;
use Hyperdigital\HdStructureddata\Domain\Model\Structureddata\Product;
use Hyperdigital\HdStructureddata\Domain\Model\Structureddata\Review;
use Hyperdigital\HdStructureddata\Domain\Model\Structureddata\Video;
use Hyperdigital\HdStructureddata\Domain\Model\Structureddata\SitelinkSearchbox;
use Hyperdigital\HdStructureddata\Domain\Model\Structureddata\SoftwareApplication;
use Hyperdigital\HdStructureddata\Domain\Model\Structureddata\Book;
use Hyperdigital\HdStructureddata\Domain\Model\Structureddata\Dataset;
use Hyperdigital\HdStructureddata\Domain\Model\Structureddata\DiscussionForumPosting;
use Hyperdigital\HdStructureddata\Domain\Model\Structureddata\Movie;
use Hyperdigital\HdStructureddata\Domain\Model\Structureddata\Person;
use Hyperdigital\HdStructureddata\Domain\Model\Structureddata\PodcastEpisode;
use Hyperdigital\HdStructureddata\Domain\Model\Structureddata\ProfilePage;
use Hyperdigital\HdStructureddata\Domain\Model\Structureddata\Recipe;
use Hyperdigital\HdStructureddata\Domain\Model\Structureddata\Service;
use Hyperdigital\HdStructureddata\Domain\Model\Structureddata\Vehicle;
use Hyperdigital\HdStructureddata\Domain\Model\Structureddata\JobPosting;
use TYPO3\CMS\Core\Attribute\AsAllowedCallable;
use TYPO3\CMS\Core\Database\Connection;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Context\Context;

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
     * Render all structured data of the current scope as JSON-LD script tags.
     *
     * @param string $content Empty string (no content to process)
     * @param array $conf TypoScript configuration
     * @return string The JSON-LD script tags
     */
    #[AsAllowedCallable]
    public function printTags(string $content, array $conf)
    {
        $output = [];

        $structuredData = $this->getAllStructuredData($conf);
        foreach ($structuredData as $data) {
            if (!empty($data)) {
                $output[] = '<script type="application/ld+json">'.json_encode($data).'</script>';
            }
        }

        $singleDisplayData = \Hyperdigital\HdStructureddata\Domain\Model\Structureddata\SingleDisplayData::getData();
        if (!empty($singleDisplayData)) {
            foreach ($singleDisplayData as $data) {
                if (!empty($data)) {
                    $output[] = '<script type="application/ld+json">'.json_encode($data).'</script>';
                }
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
                return [];
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
            \TYPO3\CMS\Backend\Utility\BackendUtility::workspaceOL('tx_hdstructureddata_domain_model_structureddata',$row);
            if (is_array($row)) {
                $temp = self::getSpecificStructuredData($row);
                if (!empty($temp)) {
                    $return[] = $temp;
                }
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
    public static function getSpecificStructuredData($row)
    {
        $return = false;

        switch ($row['type']) {
            case 'article':
                $return = GeneralUtility::makeInstance(Article::class)->setOriginalRow($row)->returnData();
                break;
            case 'course':
                $return = GeneralUtility::makeInstance(Course::class)->setOriginalRow($row)->returnData();
                break;
            case 'event':
                $return = GeneralUtility::makeInstance(Event::class)->setOriginalRow($row)->returnData();
                break;
            case 'faq':
                $return = GeneralUtility::makeInstance(Faq::class)->setOriginalRow($row)->returnData();
                break;
            case 'image':
                $return = GeneralUtility::makeInstance(Image::class)->prepareData($row)->returnData();
                break;
            case 'video':
                $return = GeneralUtility::makeInstance(Video::class)->setOriginalRow($row)->returnData();
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
            case 'product':
                $return = GeneralUtility::makeInstance(Product::class)->setOriginalRow($row)->returnData();
                break;
            case 'review':
                $return = GeneralUtility::makeInstance(Review::class)->setOriginalRow($row)->returnData();
                break;
            case 'sitelinkssearchbox':
                GeneralUtility::makeInstance(SitelinkSearchbox::class)->setOriginalRow($row)->updateData();
                $return = false;
                break;
            case 'job_posting':
                $return = GeneralUtility::makeInstance(JobPosting::class)->setOriginalRow($row)->returnData();
                break;
            case 'person':
                $return = GeneralUtility::makeInstance(Person::class)
                    ->setTable('tx_hdstructureddata_domain_model_structureddata')
                    ->setOriginalRow($row)
                    ->returnData();
                break;
            case 'recipe':
                $return = GeneralUtility::makeInstance(Recipe::class)->setOriginalRow($row)->returnData();
                break;
            case 'profile_page':
                $return = GeneralUtility::makeInstance(ProfilePage::class)->setOriginalRow($row)->returnData();
                break;
            case 'discussion_forum_posting':
                $return = GeneralUtility::makeInstance(DiscussionForumPosting::class)->setOriginalRow($row)->returnData();
                break;
            case 'service':
                $return = GeneralUtility::makeInstance(Service::class)->setOriginalRow($row)->returnData();
                break;
            case 'book':
                $return = GeneralUtility::makeInstance(Book::class)->setOriginalRow($row)->returnData();
                break;
            case 'movie':
                $return = GeneralUtility::makeInstance(Movie::class)->setOriginalRow($row)->returnData();
                break;
            case 'dataset':
                $return = GeneralUtility::makeInstance(Dataset::class)->setOriginalRow($row)->returnData();
                break;
            case 'vehicle':
                $return = GeneralUtility::makeInstance(Vehicle::class)->setOriginalRow($row)->returnData();
                break;
            case 'podcast_episode':
                $return = GeneralUtility::makeInstance(PodcastEpisode::class)->setOriginalRow($row)->returnData();
                break;
            case 'software_application':
                $return = GeneralUtility::makeInstance(SoftwareApplication::class)->setOriginalRow($row)->returnData();
                break;
        }

        return $return;
    }
}
