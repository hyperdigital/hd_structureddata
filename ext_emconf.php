<?php

$EM_CONF[$_EXTKEY] = array(
    'title' => 'Structured Data',
    'description' => 'Extension for adding structured JSON-LD into page headers',
    'category' => 'fe',
    'author' => 'Martin Pribyl',
    'author_email' => 'developer@hyperdigital.de',
    'author_company' => 'hyperdigital.de and coma.de',
    'shy' => '',
    'priority' => '',
    'module' => '',
    'state' => 'beta',
    'internal' => '',
    'uploadfolder' => '0',
    'createDirs' => '',
    'modify_tables' => '',
    'clearCacheOnLoad' => 0,
    'lockType' => '',
    'version' => '3.0.0',
    'constraints' => [
        'depends' => [
            'typo3' => '13.4.0-14.99.99',
            'php' => '8.2.0-8.5.99',
            'static_info_tables' => '13.4.0-14.99.99'
        ],
        'conflicts' => [],
        'suggests' => [],
    ],
);
