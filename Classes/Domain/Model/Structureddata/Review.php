<?php
namespace Hyperdigital\HdStructureddata\Domain\Model\Structureddata;

use Hyperdigital\HdStructureddata\Domain\Model\Structureddata\Organization\Restaurant;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

class Review extends AbstractData
{
    public function returnData()
    {
        $return = [];
        $return['@context'] = 'https://schema.org';
        $return['@type'] = 'Review';
        switch ($this->originalRow['subtype']) {
            case 'Restaurant':
                $itemReviewed = GeneralUtility::makeInstance(Restaurant::class)->setOriginalRow($this->originalRow)->returnData();
                $rating = $this->reviewRating();
                if ($rating) {
                    $return['reviewRating'] = $rating;
                }
                break;
            case 'Organization':
                $itemReviewed = GeneralUtility::makeInstance(Organization::class)->setOriginalRow($this->originalRow)->returnData();
                $rating = $this->reviewRating();
                if ($rating) {
                    $return['reviewRating'] = $rating;
                }
                break;
            case 'reviewedItem':
                $rating = $this->reviewRating();
                if ($rating) {
                    $return['reviewRating'] = $rating;
                }
                break;
        }

        if (!empty($itemReviewed)) {
            $return['itemReviewed'] = $itemReviewed;
        }

        if (!empty($this->originalRow['positive_notes'])) {
            $notes = $this->getReviewNotes($this->originalRow['uid'], 'positive_notes', 'tx_hdstructureddata_domain_model_structureddata');
            if (!empty($notes)) {
                $return['positiveNotes'] = [
                    '@type' => 'ItemList',
                    'itemListElement' => $notes
                ];
            }
        }
        if (!empty($this->originalRow['negative_notes'])) {
            $notes = $this->getReviewNotes($this->originalRow['uid'], 'negative_notes', 'tx_hdstructureddata_domain_model_structureddata');
            if (!empty($notes)) {
                $return['negativeNotes'] = [
                    '@type' => 'ItemList',
                    'itemListElement' => $notes
                ];
            }
        }

        if (!empty($this->originalRow['authors'])) {
            $people = $this->getPeople($this->originalRow['uid'], 'authors', 'tx_hdstructureddata_domain_model_structureddata');
            if (!empty($people)) {
                $return['author'] = $people;
            }
        }

        return $return;
    }

    protected function reviewRating()
    {
        $return = [];
        $return['@type'] = 'Rating';
        if (!is_null($this->originalRow['rating_value'])) {
            $return['ratingValue'] = $this->originalRow['rating_value'];
        }
        if (!is_null($this->originalRow['rating_count'])) {
            $return['ratingCount'] = $this->originalRow['rating_count'];
        }
        if (!is_null($this->originalRow['best_rating'])) {
            $return['bestRating'] = $this->originalRow['best_rating'];
        }
        if (!is_null($this->originalRow['worst_rating'])) {
            $return['worstRating'] = $this->originalRow['worst_rating'];
        }

        if (count($return) < 2) {
            return false;
        }
        return $return;
    }
}
