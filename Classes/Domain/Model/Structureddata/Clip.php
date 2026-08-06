<?php
namespace Hyperdigital\HdStructureddata\Domain\Model\Structureddata;


class Clip extends AbstractData
{
    public function returnData()
    {
        $return = [];
        $return['@context'] = 'https://schema.org';
        $return['@type'] = 'Clip';
        $return['name'] = $this->originalRow['name'] ?? '';
        $return['startOffset'] = $this->originalRow['start_offset'] ?? 0;

        if (!is_null($this->originalRow['end_offset'] ?? null)) {
            $return['endOffset'] = $this->originalRow['end_offset'];
        }

        if (!empty($this->originalRow['url'])) {
            $url = $this->getUrl($this->originalRow['url']);
            $return['url'] = $url;
        }

        return $return;
    }
}
