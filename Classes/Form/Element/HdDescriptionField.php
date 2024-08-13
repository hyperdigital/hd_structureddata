<?php

declare(strict_types=1);

namespace Hyperdigital\HdStructureddata\Form\Element;

use TYPO3\CMS\Backend\Form\Element\AbstractFormElement;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Utility\StringUtility;
use TYPO3\CMS\Fluid\View\StandaloneView;

class HdDescriptionField extends AbstractFormElement
{
    public function render(): array
    {
        $row = $this->data['databaseRow'];
        $parameterArray = $this->data['parameterArray'];

        $fieldInformationResult = $this->renderFieldInformation();
        $fieldInformationHtml = $fieldInformationResult['html'];
        $resultArray = $this->mergeChildReturnIntoExistingResult($this->initializeResultArray(), $fieldInformationResult, false);

//        $fieldId = StringUtility::getUniqueId('formengine-textarea-');
//
//        $attributes = [
//            'id' => $fieldId,
//            'name' => htmlspecialchars($parameterArray['itemFormElName']),
//            'data-formengine-input-name' => htmlspecialchars($parameterArray['itemFormElName']),
//        ];
//
//
//        $itemValue = $parameterArray['itemFormElValue'];

        if (!empty($row['type'])) {
            if (is_array($row['type'])) {
                if (!empty($row['type'][0])) {
                    $type = $row['type'][0];
                }
            } else {
                $type = $row['type'];
            }
        }

        $html = '';
        if (!empty($type) && !empty($parameterArray['fieldConf']['config']['parameters'][$type])) {
            $path = $parameterArray['fieldConf']['config']['parameters'][$type];
            $absoluteTemplatePath = GeneralUtility::getFileAbsFileName($path);

            try {
                $view = GeneralUtility::makeInstance(StandaloneView::class);
                $view->setTemplatePathAndFilename($absoluteTemplatePath);

                $html = $view->render();
            } catch (\Exception $e) {
                $html = 'Note is not available';
            }
        }

        $resultArray['html'] = $html;

        return $resultArray;
    }
}
