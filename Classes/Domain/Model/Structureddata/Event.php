<?php
namespace Hyperdigital\HdStructureddata\Domain\Model\Structureddata;

use TYPO3\CMS\Core\Database\Connection;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

class Event extends AbstractData
{
    public function returnData()
    {
        $return = [];
        $return['@context'] = 'https://schema.org';
        $return['@type'] = 'Event';
        switch ($this->originalRow['status']) {
            case 'EventCancelled':
                $return['eventStatus'] = 'https://schema.org/EventCancelled';
                break;
            case 'EventMovedOnline':
                $return['eventStatus'] = 'https://schema.org/EventMovedOnline';
                break;
            case 'EventPostponed':
                $return['eventStatus'] = 'https://schema.org/EventPostponed';
                break;
            case 'EventRescheduled':
                $return['eventStatus'] = 'https://schema.org/EventRescheduled';
                break;
            case 'EventScheduled':
                $return['eventStatus'] = 'https://schema.org/EventScheduled';
                break;
        }

        if (!empty($this->originalRow['title'])) {
            $return['name'] = $this->originalRow['title'];
        }

        if (!is_null($this->originalRow['start_date']) && !is_null($this->originalRow['end_date'])) {
            $dateStart = new \DateTime($this->originalRow['start_date']);
            $dateEnd = new \DateTime($this->originalRow['end_date']);
            $interval = $dateStart->diff($dateEnd);
            if ($interval->days > 1) {
                $return['startDate'] = $dateStart->format('Y-m-d');
                $return['endDate'] = $dateEnd->format('Y-m-d');
            } else {
                $return['startDate'] = $dateStart->format(DATE_ATOM);
                $return['endDate'] = $dateEnd->format(DATE_ATOM);
            }
        } else if (!is_null($this->originalRow['start_date'])) {
            $dateStart = new \DateTime($this->originalRow['start_date']);
            $return['startDate'] = $dateStart->format(DATE_ATOM);
        } else if (!is_null($this->originalRow['end_date'])) {
            $dateEnd = new \DateTime($this->originalRow['end_date']);
            $return['endDate'] = $dateEnd->format(DATE_ATOM);
        }

        if (!empty($this->originalRow['description'])) {
            $return['description'] = $this->originalRow['description'];
        }

        if (!empty($this->originalRow['images'])) {
            $images = $this->getImages($this->originalRow['uid'], 'images', 'tx_hdstructureddata_domain_model_structureddata');
            if (!empty($images)) {
                $return['image'] = $images;
            }
        }

        if (!empty($this->originalRow['locations'])) {
            $locations = $this->getLocations($this->originalRow['uid'], 'locations', 'tx_hdstructureddata_domain_model_structureddata');
            $isOnline = false;
            $isOffline = false;
            foreach ($locations as $location) {
                switch ($location['@type']) {
                    case 'VirtualLocation':
                        $isOnline = true;
                        break;
                    default:
                        $isOffline = true;
                }
            }
            if (!empty($locations)) {
                $return['location'] = $locations;
            }

            if ($isOffline && $isOnline) {
                $return['eventAttendanceMode'] = 'https://schema.org/MixedEventAttendanceMode';
            } else if ($isOnline) {
                $return['eventAttendanceMode'] = 'https://schema.org/OnlineEventAttendanceMode';
            } else {
                $return['eventAttendanceMode'] = 'https://schema.org/OfflineEventAttendanceMode';
            }
        }

        if (!empty($this->originalRow['offers'])) {
            $offers = $this->getOffers($this->originalRow['uid'], 'offers', 'tx_hdstructureddata_domain_model_structureddata');
            if (!empty($offers)) {
                $return['offers'] = $offers;
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
            $return['organizer'] = $organizers;
        }

        if (!empty($this->originalRow['performers'])) {
            $temp = $this->getPeople($this->originalRow['uid'], 'performers', 'tx_hdstructureddata_domain_model_structureddata');
            if (!empty($temp)) {
                $return['performer'] = $temp;
            }
        }

            return $return;
    }
}
