<?php

declare(strict_types=1);

namespace Hyperdigital\HdStructureddata\Service;

use TYPO3\CMS\Core\Information\Typo3Version;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class TcaService
{
    /**
     * Return TCA valuePicker items in the shape the running TYPO3 version expects.
     *
     * Up to and including v13 the FormEngine elements that render a value picker
     * (InputTextElement, LinkElement, TextElement) read $item[0] as the label and
     * $item[1] as the value. From v14 on they read $item['label'] and $item['value'].
     * No TcaMigration converts between the two, so the wrong shape produces a
     * TypeError while rendering the record. Always pass value picker items through
     * this method instead of writing them into TCA directly.
     *
     * @param array $items List of ['label' => ..., 'value' => ...] entries
     * @return array The same entries, keyed the way this TYPO3 version reads them
     */
    public static function valuePickerItems(array $items): array
    {
        $isV14OrNewer = GeneralUtility::makeInstance(Typo3Version::class)->getMajorVersion() >= 14;

        $return = [];
        foreach ($items as $item) {
            $label = $item['label'] ?? ($item[0] ?? '');
            $value = $item['value'] ?? ($item[1] ?? '');

            $return[] = $isV14OrNewer
                ? ['label' => $label, 'value' => $value]
                : [$label, $value];
        }

        return $return;
    }
}
