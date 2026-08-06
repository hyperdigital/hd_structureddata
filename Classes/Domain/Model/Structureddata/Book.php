<?php
namespace Hyperdigital\HdStructureddata\Domain\Model\Structureddata;

class Book extends AbstractData
{
    public function returnData()
    {
        $return = [];
        $return['@context'] = 'https://schema.org';
        $return['@type'] = 'Book';
        $return['name'] = $this->originalRow['title'] ?? '';
        if (!empty($this->originalRow['description'])) {
            $return['description'] = $this->originalRow['description'];
        }
        if (!empty($this->originalRow['authors'])) {
            $people = $this->getPeople($this->originalRow['uid'], 'authors', 'tx_hdstructureddata_domain_model_structureddata');
            if (!empty($people)) {
                $return['author'] = $people;
            }
        }
        if (!empty($this->originalRow['isbn'])) {
            $return['isbn'] = $this->originalRow['isbn'];
        }
        if (!empty($this->originalRow['book_edition'])) {
            $return['bookEdition'] = $this->originalRow['book_edition'];
        }
        if (!empty($this->originalRow['book_format'])) {
            $return['bookFormat'] = 'https://schema.org/' . $this->originalRow['book_format'];
        }
        if (!empty($this->originalRow['date_published'])) {
            $date = new \DateTime($this->originalRow['date_published']);
            $return['datePublished'] = $date->format(DATE_ATOM);
        }
        if (!empty($this->originalRow['url'])) {
            $temp = $this->getUrl($this->originalRow['url']);
            if (!empty($temp)) {
                $return['url'] = $temp;
            }
        }
        if (!empty($this->originalRow['images'])) {
            $images = $this->getImages($this->originalRow['uid'], 'images', 'tx_hdstructureddata_domain_model_structureddata');
            if (!empty($images)) {
                $return['image'] = $images;
            }
        }
        if (!empty($this->originalRow['offers'])) {
            $offers = $this->getOffers($this->originalRow['uid'], 'offers', 'tx_hdstructureddata_domain_model_structureddata');
            if (!empty($offers)) {
                $return['offers'] = $offers;
            }
        }

        $rating = $this->getRating('AggregateRating');
        if (!empty($rating)) {
            $return['aggregateRating'] = $rating;
        }

        return $return;
    }
}
