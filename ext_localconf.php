<?php
$GLOBALS['TYPO3_CONF_VARS']['SYS']['formEngine']['nodeRegistry']['hdNotEditableField'] = [
    'nodeName' => 'hdNotEditableField',
    'priority' => 40,
    'class' => \Hyperdigital\HdStructureddata\Form\Element\HdNotEditableField::class ,
];
$GLOBALS['TYPO3_CONF_VARS']['SYS']['formEngine']['nodeRegistry']['hdDescriptionField'] = [
    'nodeName' => 'hdDescriptionField',
    'priority' => 40,
    'class' => \Hyperdigital\HdStructureddata\Form\Element\HdDescriptionField::class ,
];



$GLOBALS['TYPO3_CONF_VARS']['SYS']['fluid']['namespaces']['f'][] = 'Hyperdigital\HdStructureddata\ViewHelpers';
