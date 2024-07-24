<?php

$EM_CONF[$_EXTKEY] = array(
    'title' => 'Structured Data',
    'description' => 'Extension for adding structured JSON-LD into page headers',
    'category' => 'fe',
    'author' => 'Martin Pribyl',
    'author_email' => 'developer@hyperdigital.de',
    'author_company' => 'hyperdigita.de and coma.de',
    'shy' => '',
    'priority' => '',
    'module' => '',
    'state' => 'alpha',
    'internal' => '',
    'uploadfolder' => '0',
    'createDirs' => '',
    'modify_tables' => '',
    'clearCacheOnLoad' => 0,
    'lockType' => '',
    'version' => '0.5.0',
    'constraints' => [
        'depends' => [
            'typo3' => '11.0.0-12.4.99',
            'php' => '8.0.0-8.99.99',
            'static-info-tables' => '12.4.0-12.4.99'
        ],
        'conflicts' => [],
        'suggests' => [],
    ],
);
