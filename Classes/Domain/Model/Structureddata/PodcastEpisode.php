<?php
namespace Hyperdigital\HdStructureddata\Domain\Model\Structureddata;

class PodcastEpisode extends AbstractData
{
    public function returnData()
    {
        $return = [];
        $return['@context'] = 'https://schema.org';
        $return['@type'] = 'PodcastEpisode';
        $return['name'] = $this->originalRow['title'] ?? '';
        if (!empty($this->originalRow['description'])) {
            $return['description'] = $this->originalRow['description'];
        }
        if (!is_null($this->originalRow['episode_number'] ?? null)) {
            $return['episodeNumber'] = (int)$this->originalRow['episode_number'];
        }
        if (!empty($this->originalRow['series_name'])) {
            $return['partOfSeries'] = ['@type' => 'PodcastSeries', 'name' => $this->originalRow['series_name']];
        }
        if (!empty($this->originalRow['date_published'])) {
            $date = new \DateTime($this->originalRow['date_published']);
            $return['datePublished'] = $date->format(DATE_ATOM);
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
        if (!empty($this->originalRow['images'])) {
            $images = $this->getImages($this->originalRow['uid'], 'images', 'tx_hdstructureddata_domain_model_structureddata');
            if (!empty($images)) {
                $return['image'] = $images;
            }
        }
        if (!empty($this->originalRow['medias'])) {
            $audio = $this->getImages($this->originalRow['uid'], 'medias', 'tx_hdstructureddata_domain_model_structureddata', true);
            if (!empty($audio)) {
                $return['associatedMedia'] = ['@type' => 'MediaObject', 'contentUrl' => $audio];
            }
        }

        return $return;
    }
}
