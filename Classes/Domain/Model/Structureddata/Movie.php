<?php
namespace Hyperdigital\HdStructureddata\Domain\Model\Structureddata;

class Movie extends AbstractData
{
    public function returnData()
    {
        $return = [];
        $return['@context'] = 'https://schema.org';
        $return['@type'] = 'Movie';
        $return['name'] = $this->originalRow['title'] ?? '';
        if (!empty($this->originalRow['description'])) {
            $return['description'] = $this->originalRow['description'];
        }
        if (!empty($this->originalRow['images'])) {
            $images = $this->getImages($this->originalRow['uid'], 'images', 'tx_hdstructureddata_domain_model_structureddata');
            if (!empty($images)) {
                $return['image'] = $images;
            }
        }
        if (!empty($this->originalRow['authors'])) {
            $people = $this->getPeople($this->originalRow['uid'], 'authors', 'tx_hdstructureddata_domain_model_structureddata');
            if (!empty($people)) {
                $return['director'] = $people;
            }
        }
        if (!empty($this->originalRow['performers'])) {
            $people = $this->getPeople($this->originalRow['uid'], 'performers', 'tx_hdstructureddata_domain_model_structureddata');
            if (!empty($people)) {
                $return['actor'] = $people;
            }
        }
        if (!empty($this->originalRow['date_published'])) {
            $date = new \DateTime($this->originalRow['date_published']);
            $return['dateCreated'] = $date->format(DATE_ATOM);
        }
        if (!is_null($this->originalRow['duration_minutes'] ?? null) && (int)$this->originalRow['duration_minutes'] > 0) {
            $minutes = (int)$this->originalRow['duration_minutes'];
            $return['duration'] = 'PT' . (intdiv($minutes, 60) ? intdiv($minutes, 60) . 'H' : '') . ($minutes % 60 ? $minutes % 60 . 'M' : '');
        }
        if (!empty($this->originalRow['url'])) {
            $temp = $this->getUrl($this->originalRow['url']);
            if (!empty($temp)) {
                $return['url'] = $temp;
            }
        }

        $rating = $this->getRating('AggregateRating');
        if (!empty($rating)) {
            $return['aggregateRating'] = $rating;
        }

        if (!empty($this->originalRow['reviews'])) {
            $reviews = $this->getReviews($this->originalRow['uid'], 'reviews', 'tx_hdstructureddata_domain_model_structureddata');
            if (!empty($reviews)) {
                $return['review'] = $reviews;
            }
        }

        return $return;
    }
}
