<?php

declare(strict_types=1);

namespace Hyperdigital\HdStructureddata\Service;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Resource\File;
use TYPO3\CMS\Core\Resource\FileReference;
use TYPO3\CMS\Core\Resource\OriginalFileReference;

class ImageMetadataService
{
    public static function parseImage($image, $arguments)
    {
        if (!empty($image)) {
            if ($image instanceof FileReference) {
                return self::outputOfFileReference($image, $arguments);
            } elseif ($image instanceof File) {
                return self::outputOfFile($image, $arguments);
            } elseif (is_array($image) && !empty($image['id'])) {
                $resourceFactory = GeneralUtility::makeInstance(ResourceFactory::class);
                $file = $resourceFactory->getFileObjectFromCombinedIdentifier($image['id']);
                if ($file) {
                    return self::outputOfFile($file, $arguments);
                }
            }
        }
    }

    public static function outputOfFileReference($image, $arguments)
    {
        return self::outputOfFile($image->getOriginalFile(), $arguments);
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

            if ($arguments['output']) {
                $result = GeneralUtility::makeInstance(\Hyperdigital\HdStructureddata\Domain\Model\Structureddata\Image::class)->setOriginalRow($metaData)->returnData();

                if (!empty($result)) {
                    $output = '<script type="application/ld+json">' . json_encode($result) . '</script>';
                    $pageRenderer = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Page\PageRenderer::class);
                    $pageRenderer->addHeaderData($output);
                }
            } else {
                return $metaData;
            }
        }
    }
}