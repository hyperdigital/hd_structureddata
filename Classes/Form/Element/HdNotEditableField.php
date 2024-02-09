<?php

declare(strict_types=1);

namespace Hyperdigital\HdStructureddata\Form\Element;

use TYPO3\CMS\Backend\Form\Element\AbstractFormElement;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Utility\StringUtility;

class HdNotEditableField extends AbstractFormElement
{
    public function render(): array
    {
        $row = $this->data['databaseRow'];
        $parameterArray = $this->data['parameterArray'];

        $fieldInformationResult = $this->renderFieldInformation();
        $fieldInformationHtml = $fieldInformationResult['html'];
        $resultArray = $this->mergeChildReturnIntoExistingResult($this->initializeResultArray(), $fieldInformationResult, false);

        $fieldId = StringUtility::getUniqueId('formengine-textarea-');

        $attributes = [
            'id' => $fieldId,
            'name' => htmlspecialchars($parameterArray['itemFormElName']),
            'data-formengine-input-name' => htmlspecialchars($parameterArray['itemFormElName']),
        ];


        $itemValue = $parameterArray['itemFormElValue'];

        $html = [];
        $html[] = '<div class="formengine-field-item t3js-formengine-field-item" style="padding: 5px; background-color: ' . $color . ';">';
        $html[] = $fieldInformationHtml;
        $html[] =   '<div class="form-wizards-wrap">';
        $html[] =      '<div class="form-wizards-element">';
        $html[] =         '<div class="form-control-wrap">';
        $html[] =           '<b>'.strtoupper($itemValue).'</b>';
        $html[] =            '<input type="hidden" value="' . htmlspecialchars($itemValue, ENT_QUOTES) . '" ';
        $html[] =               GeneralUtility::implodeAttributes($attributes, true);
        $html[] =            ' />';
        $html[] =         '</div>';
        $html[] =      '</div>';
        $html[] =   '</div>';
        $html[] = '</div>';
        $resultArray['html'] = implode(LF, $html);

        return $resultArray;
    }
}
