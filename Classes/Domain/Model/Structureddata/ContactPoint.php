<?php
namespace Hyperdigital\HdStructureddata\Domain\Model\Structureddata;

use TYPO3\CMS\Core\Utility\GeneralUtility;

class ContactPoint extends AbstractData
{
    public function returnData()
    {
        // No @context here: this object is always emitted as a nested node of a
        // parent object, which already carries the context.
        $return = [];

        $return['@type'] = 'ContactPoint';

        if (!empty($this->originalRow['contact_type'])) {
            $return['contactType'] = $this->originalRow['contact_type'];
        }
        if (!empty($this->originalRow['telephone'])) {
            $return['telephone'] = $this->originalRow['telephone'];
        }
        if (!empty($this->originalRow['email'])) {
            $return['email'] = $this->originalRow['email'];
        }
        if (!empty($this->originalRow['area_served'])) {
            $return['areaServed'] = GeneralUtility::trimExplode(',', $this->originalRow['area_served'], true);
        }
        if (!empty($this->originalRow['available_language'])) {
            $return['availableLanguage'] = GeneralUtility::trimExplode(',', $this->originalRow['available_language'], true);
        }

        if (count($return) < 2) {
            return [];
        }

        return $return;
    }
}
