<?php
namespace Hyperdigital\HdStructureddata\Domain\Model\Structureddata;

class ProfilePage extends AbstractData
{
    public function returnData()
    {
        $return = [];
        $return['@context'] = 'https://schema.org';
        $return['@type'] = 'ProfilePage';
        if (!empty($this->originalRow['date_published'])) {
            $date = new \DateTime($this->originalRow['date_published']);
            $return['dateCreated'] = $date->format(DATE_ATOM);
        }
        if (!empty($this->originalRow['date_modified'])) {
            $date = new \DateTime($this->originalRow['date_modified']);
            $return['dateModified'] = $date->format(DATE_ATOM);
        }
        if (!empty($this->originalRow['authors'])) {
            $people = $this->getPeople($this->originalRow['uid'], 'authors', 'tx_hdstructureddata_domain_model_structureddata');
            if (!empty($people)) {
                $return['mainEntity'] = $people;
            }
        }
        $interaction = [];
        if (!is_null($this->originalRow['follower_count'] ?? null)) {
            $interaction[] = ['@type' => 'InteractionCounter', 'interactionType' => 'https://schema.org/FollowAction', 'userInteractionCount' => (int)$this->originalRow['follower_count']];
        }
        if (!is_null($this->originalRow['post_count'] ?? null)) {
            $interaction[] = ['@type' => 'InteractionCounter', 'interactionType' => 'https://schema.org/WriteAction', 'userInteractionCount' => (int)$this->originalRow['post_count']];
        }
        if (!empty($interaction) && !empty($return['mainEntity'][0])) {
            $return['mainEntity'][0]['interactionStatistic'] = $interaction;
        }

        return $return;
    }
}
