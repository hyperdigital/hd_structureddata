<?php

declare(strict_types=1);

namespace Hyperdigital\HdStructureddata\ViewHelpers;

use Hyperdigital\HdStructureddata\Domain\Model\Structureddata\Article;
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
        $parentUid = $arguments['parentUid'] ?? 0;
        if (!empty($arguments['object'])) {
            if ($localizedUid = $arguments['object']->_getProperty('_localizedUid')){
                $parentUid = $localizedUid;
            } else {
                $parentUid = $arguments['object']->getUid();
            }
        }

        if ($parentUid) {
            $conf = [
                'tableName' => $arguments['tablename'],
                'fieldName' => $arguments['fieldname'],
                'parentUid' => $parentUid,
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

        return '';
    }
}
