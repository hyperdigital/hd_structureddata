<?php
namespace Hyperdigital\HdStructureddata\Domain\Model\Structureddata;


class Course extends AbstractData
{
    public function returnData()
    {
        $return = [];
        $return['@context'] = 'https://schema.org';
        $return['@type'] = 'Course';
        $return['name'] = $this->originalRow['title'] ?? '';
        $return['description'] = $this->originalRow['description'] ?? '';

        if (!empty($this->originalRow['url'])) {
            $url = $this->getUrl($this->originalRow['url']);

            if (!empty($url)) {
                $return['url'] = $url;
            }
        }

        if (!empty($this->originalRow['offers'])) {
            $offers = $this->getOffers($this->originalRow['uid'], 'offers', 'tx_hdstructureddata_domain_model_structureddata');
            if (!empty($offers)) {
                $return['offers'] = $offers;
            }
        }

        if (!empty($this->originalRow['images'])) {
            $images = $this->getImages($this->originalRow['uid'], 'images', 'tx_hdstructureddata_domain_model_structureddata');
            if (!empty($images)) {
                $return['image'] = $images;
            }
        }

        $organizers = [];
        if (!empty($this->originalRow['organizers'])) {
            $tempOrgs = $this->getStructuredData($this->originalRow['uid'], 'organizers', 'tx_hdstructureddata_domain_model_structureddata');
            if (!empty($tempOrgs)) {
                $organizers = $tempOrgs;
            }
        }
        if (!empty($this->originalRow['organizers_pointer'])) {
            $tempOrgs = $this->getStructuredDataByMM($this->originalRow['uid'], 'tx_hdstructureddata_structureddata_organizers_mm', ['organization', 'person']);
            if (!empty($tempOrgs)) {
                foreach ($tempOrgs as $tempOrg) {
                    $organizers[] = $tempOrg;
                }
            }
        }
        if (!empty($organizers)) {
            $return['provider'] = $organizers;
        }
        if (!empty($this->originalRow['educational_credential_awarded'])) {
            $return['educationalCredentialAwarded'] = $this->originalRow['educational_credential_awarded'];
        }
        if (!is_null($this->originalRow['course_workload'] ?? null) && (int)$this->originalRow['course_workload'] > 0) {
            $return['courseWorkload'] = 'PT' . (int)$this->originalRow['course_workload'] . 'H';
        }
        if (!empty($this->originalRow['course_prerequisites'])) {
            $return['coursePrerequisites'] = $this->originalRow['course_prerequisites'];
        }
        if (!empty($this->originalRow['courseinstances'])) {
            $offers = $this->getCourseInstances($this->originalRow['uid'], 'courseinstances', 'tx_hdstructureddata_domain_model_structureddata');
            if (!empty($offers)) {
                $return['hasCourseInstance'] = $offers;
            }
        }

        return $return;
    }
}
