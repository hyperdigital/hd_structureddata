<?php

declare(strict_types=1);

namespace Hyperdigital\HdStructureddata\ViewHelpers;

use Hyperdigital\HdStructureddata\Domain\Model\Structureddata\Article;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;
use TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;
use TYPO3Fluid\Fluid\Core\ViewHelper\Traits\CompileWithRenderStatic;

use TYPO3\CMS\Core\Resource\File;
use TYPO3\CMS\Core\Resource\FileReference;
use TYPO3\CMS\Core\Resource\OriginalFileReference;

final class ImageStructuredDataViewHelper extends AbstractViewHelper
{
    use CompileWithRenderStatic;

    protected $escapeOutput = false;

    public function initializeArguments(): void
    {
        $this->registerArgument('image', 'mixed', 'The image where could be parsed data from the original file');
        $this->registerArgument('uri', 'string', 'The image uri, if there should be different then the publicUrl()');
    }

    public static function renderStatic(
        array $arguments,
        \Closure $renderChildrenClosure,
        RenderingContextInterface $renderingContext,
    ): string {
        $image = $arguments['image'];
        \Hyperdigital\HdStructureddata\Service\ImageMetadataService::parseImage($image, ['output' => true, 'uri' => $arguments['uri']]);

        return '';
    }
}
