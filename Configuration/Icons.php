<?php
declare(strict_types=1);

use TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider;

return [
    'hd_structureddata' => [
        'provider' => SvgIconProvider::class,
        'source' => 'EXT:hd_structureddata/Resources/Public/Icons/Extension.svg',
    ],
    'hd_structureddata_article' => [
        'provider' => SvgIconProvider::class,
        'source' => 'EXT:hd_structureddata/Resources/Public/Icons/article.svg',
    ],
    'hd_structureddata_person' => [
        'provider' => SvgIconProvider::class,
        'source' => 'EXT:hd_structureddata/Resources/Public/Icons/person.svg',
    ],
    'hd_structureddata_faq' => [
        'provider' => SvgIconProvider::class,
        'source' => 'EXT:hd_structureddata/Resources/Public/Icons/faq.svg',
    ],
    'hd_structureddata_organization' => [
        'provider' => SvgIconProvider::class,
        'source' => 'EXT:hd_structureddata/Resources/Public/Icons/organization.svg',
    ],
    'hd_structureddata_video' => [
        'provider' => SvgIconProvider::class,
        'source' => 'EXT:hd_structureddata/Resources/Public/Icons/video.svg',
    ],
];
