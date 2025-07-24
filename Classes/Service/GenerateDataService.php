<?php

declare(strict_types=1);

namespace Hyperdigital\HdStructureddata\Service;

use Hyperdigital\HdStructureddata\UserFunctions\StructuredDataPrint;
use TYPO3\CMS\Core\Page\PageRenderer;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

class GenerateDataService
{
    public function generateDataFromObject($tablename, $fieldname, $object)
    {
        if (method_exists($object, '_getProperty') && $localizedUid = $object->_getProperty('_localizedUid')){
            $parentUid = $localizedUid;
        } else {
            $parentUid = $object->getUid();
        }

        $this->generateData($tablename, $fieldname, $parentUid);
    }

    public function generateDataFromUid($tablename, $fieldname, $uid)
    {
        $this->generateData($tablename, $fieldname, $uid);
    }

    protected function generateData($tablename, $fieldname, $uid)
    {
        if ($uid) {
            $conf = [
                'tableName' => $tablename,
                'fieldName' => $fieldname,
                'parentUid' => $uid,
            ];
            $structuredDataPrint = GeneralUtility::makeInstance(StructuredDataPrint::class);
            $content = $structuredDataPrint->printTags('', $conf);

            if (!empty($content)) {
                /** @var PageRenderer $pageRenderer */
                $pageRenderer = GeneralUtility::makeInstance(PageRenderer::class);
                // Add the content to the header section
                $pageRenderer->addHeaderData($content);
            }
        }
    }
}