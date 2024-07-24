<?php
namespace Hyperdigital\HdStructureddata\Domain\Model\Structureddata;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;

class Courseinstance extends AbstractData
{
    public function returnData()
    {
        $return = [];
        $return['@context'] = 'https://schema.org';
        $return['@type'] = 'CourseInstance';
        $return['courseMode'] = $this->originalRow['course_mode'];
        $return['courseSchedule'] = [
            '@type' => 'Schedule',
            'repeatCount' => $this->originalRow['course_schedule_repeat_count'] ?? 0,
            'repeatFrequency' => $this->originalRow['course_schedule_repeat_frequency'] ?? 0,
        ];
        if (!empty($this->originalRow['course_schedule_start_date'])) {
            $dateStart = new \DateTime($this->originalRow['course_schedule_start_date']);
            $return['courseSchedule']['startDate'] = $dateStart->format(DATE_ATOM);
        }
        if (!empty($this->originalRow['course_schedule_end_date'])) {
            $dateStart = new \DateTime($this->originalRow['course_schedule_end_date']);
            $return['courseSchedule']['endDate'] = $dateStart->format(DATE_ATOM);
        }
        if (!empty($this->originalRow['instructors'])) {
            $people = $this->getPeople($this->originalRow['uid'], 'instructors', 'tx_hdstructureddata_domain_model_structureddata');
            if (!empty($people)) {
                $return['instructor'] = $people;
            }
        }
        if (!empty($this->originalRow['locations'])) {
            $locations = $this->getLocations($this->originalRow['uid'], 'locations', 'tx_hdstructureddata_domain_model_structureddata');
            if (!empty($locations)) {
                $return['location'] = $locations;
            }
        }

        return $return;
    }
}
