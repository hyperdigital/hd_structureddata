<?php
namespace Hyperdigital\HdStructureddata\Domain\Model\Structureddata;

class HowToStep extends AbstractData
{
    public function returnData()
    {
        // No @context here: this object is always emitted as a nested node of a
        // parent object, which already carries the context.
        $return = [];

        if (empty($this->originalRow['text'])) {
            return [];
        }

        $return['@type'] = 'HowToStep';
        $return['text'] = $this->originalRow['text'];
        if (!empty($this->originalRow['name'])) {
            $return['name'] = $this->originalRow['name'];
        }
        if (!empty($this->originalRow['url'])) {
            $url = $this->getUrl($this->originalRow['url']);
            if (!empty($url)) {
                $return['url'] = $url;
            }
        }

        return $return;
    }
}
