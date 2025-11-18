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
    'version' => '1.0.2',
    'constraints' => [
        'depends' => [
            'typo3' => '13.0.0-13.4.99',
            'php' => '8.0.0-8.99.99',
            'static_info_tables' => '13.0.0-13.4.99'
        ],
        'conflicts' => [],
        'suggests' => [],
    ],
);
