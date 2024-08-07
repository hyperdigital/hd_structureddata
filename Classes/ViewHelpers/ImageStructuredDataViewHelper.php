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
        if (!empty($arguments['image'])) {
            if ($image instanceof FileReference) {
                self::outputOfFileReference($image, $arguments);
            } elseif ($image instanceof File) {
                self::outputOfFile($image, $arguments);
            }
        }

        return '';
    }

    public static function outputOfFileReference($image, $arguments)
    {
        self::outputOfFile($image->getOriginalFile(), $arguments);
    }

    public static function outputOfFile($image, $arguments)
    {
        $metaData = $image->getMetaData();
        if (
            $image->getType() == 2 &&
            ($metaData['creator'] || $metaData['credit_text'] || $metaData['copyright_notice']  || $metaData['license'])
        ) {
            if (empty($arguments['uri'])) {
                $metaData['publicUrl'] = $image->getPublicUrl();
            } else {
                $metaData['publicUrl'] = $arguments['uri'];
            }
            $result = GeneralUtility::makeInstance(\Hyperdigital\HdStructureddata\Domain\Model\Structureddata\Image::class)->setOriginalRow($metaData)->returnData();

            if (!empty($result)) {
                $output = '<script type="application/ld+json">'.json_encode($result).'</script>';
                $pageRenderer = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Page\PageRenderer::class);
                $pageRenderer->addHeaderData($output);
            }
        }
    }
}
