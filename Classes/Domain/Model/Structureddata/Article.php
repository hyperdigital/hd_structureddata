<?php
namespace Hyperdigital\HdStructureddata\Domain\Model\Structureddata;

use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

class Article extends AbstractData
{
    public function returnData()
    {
        $return = [];
        $return['@context'] = 'https://schema.org';
        switch ($this->originalRow['subtype']) {
            case 'NewsArticle':
                $return['@type'] = 'NewsArticle';
                break;
            case 'BlogPosting':
                $return['@type'] = 'BlogPosting';
                break;
            default:
                $return['@type'] = 'Article';
                break;
        }
        $return['headline'] = $this->originalRow['title'];
        if (!empty($this->originalRow['authors'])) {
            $people = $this->getPeople($this->originalRow['uid'], 'authors', 'tx_hdstructureddata_domain_model_structureddata');
            if (!empty($people)) {
                $return['author'] = $people;
            }
        }
        if (!empty($this->originalRow['images'])) {
            $images = $this->getImages($this->originalRow['uid'], 'images', 'tx_hdstructureddata_domain_model_structureddata');
            if (!empty($images)) {
                $return['image'] = $images;
            }
        }
        if (!empty($this->originalRow['date_published'])) {
            $date = new \DateTime($this->originalRow['date_published']);
            $return['datePublished'] = $date->format(DATE_ATOM);
        }
        if (!empty($this->originalRow['date_modified'])) {
            $date = new \DateTime($this->originalRow['date_modified']);
            $return['dateModified'] = $date->format(DATE_ATOM);
        }
        if (!empty($this->originalRow['abstract'])) {
            $return['abstract'] = $this->originalRow['abstract'];
        }

        return $return;
    }
}
