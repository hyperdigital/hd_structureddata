<?php

declare(strict_types=1);

namespace Hyperdigital\HdStructureddata\ViewHelpers;

use Hyperdigital\HdStructureddata\Service\GenerateDataService;
use TYPO3\CMS\Core\Page\PageRenderer;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;
use TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;
use TYPO3Fluid\Fluid\Core\ViewHelper\Traits\CompileWithRenderStatic;
use Hyperdigital\HdStructureddata\UserFunctions\StructuredDataPrint;

final class GererateStructuredDataViewHelper extends AbstractViewHelper
{
    use CompileWithRenderStatic;

    protected $escapeOutput = false;

    public function initializeArguments(): void
    {
        $this->registerArgument('tablename', 'string', 'Name of the table where are stored the structured data', true);
        $this->registerArgument('fieldname', 'string', 'Name of the column where are in tablename stored the structured data', false, 'structured_data');
        $this->registerArgument('parentUid', 'int', 'UID of the row of the tablename. For translated items use the translated UID, not the parent.', false, 0);
        $this->registerArgument('object', 'object', 'Parent object for which we want the structured data');

    }

    public static function renderStatic(
        array $arguments,
        \Closure $renderChildrenClosure,
        RenderingContextInterface $renderingContext,
    ): string {
        $dataService = GeneralUtility::makeInstance(GenerateDataService::class);

        if (!empty($arguments['object'])) {
            $dataService->generateDataFromObject($arguments['tablename'], $arguments['fieldname'], $arguments['object']);
        } else if (!empty($arguments['parentUid'])) {
            $dataService->generateDataFromUid($arguments['tablename'], $arguments['fieldname'], $arguments['parentUid']);
        }

        return '';
    }
}
