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

        return $return;
    }
}
