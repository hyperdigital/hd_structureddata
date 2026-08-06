<?php
namespace Hyperdigital\HdStructureddata\Domain\Model\Structureddata;

class DiscussionForumPosting extends AbstractData
{
    public function returnData()
    {
        $return = [];
        $return['@context'] = 'https://schema.org';
        $return['@type'] = 'DiscussionForumPosting';
        $return['headline'] = $this->originalRow['title'] ?? '';
        if (!empty($this->originalRow['description'])) {
            $return['text'] = $this->originalRow['description'];
        }
        if (!empty($this->originalRow['authors'])) {
            $people = $this->getPeople($this->originalRow['uid'], 'authors', 'tx_hdstructureddata_domain_model_structureddata');
            if (!empty($people)) {
                $return['author'] = $people;
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
        if (!empty($this->originalRow['images'])) {
            $images = $this->getImages($this->originalRow['uid'], 'images', 'tx_hdstructureddata_domain_model_structureddata');
            if (!empty($images)) {
                $return['image'] = $images;
            }
        }
        if (!empty($this->originalRow['url'])) {
            $temp = $this->getUrl($this->originalRow['url']);
            if (!empty($temp)) {
                $return['url'] = $temp;
            }
        }
        if (!is_null($this->originalRow['comment_count'] ?? null)) {
            $return['commentCount'] = (int)$this->originalRow['comment_count'];
            $return['interactionStatistic'] = [
                '@type' => 'InteractionCounter',
                'interactionType' => 'https://schema.org/CommentAction',
                'userInteractionCount' => (int)$this->originalRow['comment_count']
            ];
        }

        return $return;
    }
}
