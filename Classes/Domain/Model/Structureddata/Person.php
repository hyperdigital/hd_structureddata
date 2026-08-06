<?php
namespace Hyperdigital\HdStructureddata\Domain\Model\Structureddata;

class Person extends AbstractData
{
    const MAIN_TABLE = 'tx_hdstructureddata_domain_model_structureddata';
    const CHILD_TABLE = 'tx_hdstructureddata_domain_model_structureddata_person';

    /**
     * Which table the current row was read from. Person is usable both as an inline
     * child (authors, performers, creator) and as a structured data record of its own,
     * and the two tables name their columns differently.
     */
    protected $table = self::CHILD_TABLE;

    public function setTable($table)
    {
        $this->table = $table;

        return $this;
    }

    public function returnData()
    {
        $isTopLevel = ($this->table === self::MAIN_TABLE);

        $return = [];
        if ($isTopLevel) {
            // Only a record of its own is a standalone graph node
            $return['@context'] = 'https://schema.org';
        }

        // The child table stores the variant in "type", the main table in "subtype"
        $variant = $isTopLevel ? ($this->originalRow['subtype'] ?? '') : ($this->originalRow['type'] ?? '');
        switch ($variant) {
            case 'PerformingGroup':
                $return['@type'] = 'PerformingGroup';
                break;
            default:
                $return['@type'] = 'Person';
                break;
        }

        $return['name'] = $isTopLevel
            ? ($this->originalRow['title'] ?? '')
            : ($this->originalRow['name'] ?? '');

        if (!empty($this->originalRow['url'])) {
            $url = $this->getUrl($this->originalRow['url']);

            if (!empty($url)) {
                $return['url'] = $url;
            }
        }
        if (!empty($this->originalRow['images'])) {
            $images = $this->getImages($this->originalRow['uid'], 'images', $this->table);
            if (!empty($images)) {
                $return['image'] = $images;
            }
        }

        if (!$isTopLevel) {
            return $return;
        }

        // Columns that only exist on the main record table
        if (!empty($this->originalRow['job_title'])) {
            $return['jobTitle'] = $this->originalRow['job_title'];
        }
        if (!empty($this->originalRow['description'])) {
            $return['description'] = $this->originalRow['description'];
        }
        if (!empty($this->originalRow['email'])) {
            $return['email'] = $this->originalRow['email'];
        }
        if (!empty($this->originalRow['telephone'])) {
            $return['telephone'] = $this->originalRow['telephone'];
        }
        if (!empty($this->originalRow['addresses'])) {
            $address = $this->getAddresses($this->originalRow['uid'], 'addresses', $this->table);
            if (!empty($address)) {
                $return['address'] = $address;
            }
        }
        if (!empty($this->originalRow['organizers_pointer'])) {
            $worksFor = $this->getStructuredDataByMM($this->originalRow['uid'], 'tx_hdstructureddata_structureddata_organizers_mm', ['organization']);
            if (!empty($worksFor)) {
                $return['worksFor'] = $worksFor;
            }
        }
        if (!empty($this->originalRow['sameas'])) {
            $sameas = $this->getSameas($this->originalRow['uid'], 'sameas', $this->table);
            if (!empty($sameas)) {
                $return['sameAs'] = $sameas;
            }
        }

        return $return;
    }
}
