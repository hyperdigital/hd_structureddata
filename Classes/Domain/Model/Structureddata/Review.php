<?php
namespace Hyperdigital\HdStructureddata\Domain\Model\Structureddata;

use Hyperdigital\HdStructureddata\Domain\Model\Structureddata\Organization\Restaurant;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class Review extends AbstractData
{
    public function returnData()
    {
        $return = [];
        $return['@context'] = 'https://schema.org';
        $return['@type'] = 'Review';
        $subtype = $this->originalRow['subtype'] ?? '';

        // Every reviewable subtype carries a rating; only the ones that describe a
        // concrete thing also produce an itemReviewed node.
        $itemReviewed = false;
        if ($subtype === 'Restaurant') {
            // The only organization subtype with properties of its own
            $itemReviewed = GeneralUtility::makeInstance(Restaurant::class)->setOriginalRow($this->originalRow)->returnData();
        } elseif ($subtype === 'Organization' || in_array($subtype, Organization::ALLOWED_SUBTYPES, true)) {
            $itemReviewed = GeneralUtility::makeInstance(Organization::class)->setOriginalRow($this->originalRow)->returnData();
        }

        if ($subtype !== '') {
            $rating = $this->getRating('Rating');
            if ($rating) {
                $return['reviewRating'] = $rating;
            }
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
}
