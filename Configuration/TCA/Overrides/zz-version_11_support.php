<?php
$version = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Information\Typo3Version::class);
if ($version->getMajorVersion() == 11) {
    $parseTables = [
        'tx_hdstructureddata_domain_model_structureddata',
        'tx_hdstructureddata_domain_model_structureddata_address',
        'tx_hdstructureddata_domain_model_structureddata_brand',
        'tx_hdstructureddata_domain_model_structureddata_clip',
        'tx_hdstructureddata_domain_model_structureddata_faq',
        'tx_hdstructureddata_domain_model_structureddata_location',
        'tx_hdstructureddata_domain_model_structureddata_offer',
        'tx_hdstructureddata_domain_model_structureddata_openinghour',
        'tx_hdstructureddata_domain_model_structureddata_person',
        'tx_hdstructureddata_domain_model_structureddata_reviewnote',
        'tx_hdstructureddata_domain_model_structureddata_courseinstance',
        'tx_hdstructureddata_domain_model_structureddata_identifier',
        'tx_hdstructureddata_domain_model_structureddata_sameas',
        'sys_file_metadata'
    ];

    function replaceSelectV12BySelectV11($table) {

        foreach ($GLOBALS['TCA'][$table]['columns'] as $key => $field) {
            if (!empty($field['config']['type'])) {
                if ($field['config']['type'] == 'select' || ($field['config']['type'] == 'check' && isset($field['config']['renderType']) && $field['config']['renderType'] == 'checkboxToggle')) {
                    if (!empty($field['config']['items'])) {
                        $originalItems = $field['config']['items'];
                        $newItems = [];
                        foreach ($originalItems as $item) {
                            if (isset($item['label']) && isset($item['value'])) {
                                $newItems[] = [$item['label'], $item['value']];
                            } else if (isset($item[0]) && isset($item[1])) {
                                $newItems[] = [$item[0], $item[1]];
                            }
                        }

                        $GLOBALS['TCA'][$table]['columns'][$key]['config']['items'] = $newItems;
                    }
                }
            }
        }
        foreach ($GLOBALS['TCA'][$table]['types'] as $type => $settings) {
            if(!empty($settings['columnsOverrides'])) {
                foreach ($settings['columnsOverrides'] as $key => $field) {
                    if (!empty($field['config']['type'])) {
                        if (
                            ($field['config']['type'] && $field['config']['type'] == 'select')
                            || (empty($field['config']['type']) && $GLOBALS['TCA'][$table]['columns'][$key]['config']['type'] == 'select')
                        ) {
                            $originalItems = $field['config']['items'];
                            $newItems = [];
                            foreach ($originalItems as $item) {
                                $newItems[] = [$item['label'], $item['value']];
                            }

                            $GLOBALS['TCA'][$table]['types'][$type]['columnsOverrides'][$key]['config']['items'] = $newItems;
                        }
                    }
                    if (!empty($field['config']['overrideChildTca']['columns'])) {
                        foreach ($field['config']['overrideChildTca']['columns'] as $childCol => $childField) {
                            if (!empty($childField['config']['items'])) {
                                $originalSubitems = $childField['config']['items'];
                                $newSubitems = [];
                                foreach ($originalSubitems as $item) {
                                    $newSubitems[] = [$item['label'], $item['value']];
                                }

                                $GLOBALS['TCA'][$table]['types'][$type]['columnsOverrides'][$key]['config']['overrideChildTca']['columns'][$childCol]['config']['items'] = $newSubitems;

                            }
                        }
                    }
                }
            }
        }
    }

    function replaceV12DateByV11Date ($table) {
        foreach ($GLOBALS['TCA'][$table]['columns'] as $key => $field) {
            if (!empty($field['config']['renderType'])) {
                if (!empty($field['config']['renderType']) && $field['config']['renderType'] == 'inputDateTime') {
                    if (!empty($GLOBALS['TCA'][$table]['columns'][$key]['config']['eval'])) {
                        $GLOBALS['TCA'][$table]['columns'][$key]['config']['eval'] .= ',';
                    } else {
                        $GLOBALS['TCA'][$table]['columns'][$key]['config']['eval'] = '';
                    }
                    $GLOBALS['TCA'][$table]['columns'][$key]['config']['eval'] .= 'datetime';
                }
            }
        }
        foreach ($GLOBALS['TCA'][$table]['types'] as $type => $settings) {
            if(!empty($settings['columnsOverrides'])) {
                foreach ($settings['columnsOverrides'] as $key => $field) {
                    if (!empty($field['config']['renderType'])) {
                        if (
                            !empty($field['config']['renderType']) && $field['config']['renderType'] == 'inputDateTime'
                        ) {
                            if (!empty($GLOBALS['TCA'][$table]['types'][$type]['columnsOverrides'][$key]['config']['eval'])) {
                                $GLOBALS['TCA'][$table]['types'][$type]['columnsOverrides'][$key]['config']['eval'] .= ',';
                            } else {
                                $GLOBALS['TCA'][$table]['types'][$type]['columnsOverrides'][$key]['config']['eval'] = '';
                            }
                            $GLOBALS['TCA'][$table]['types'][$type]['columnsOverrides'][$key]['config']['eval'] .= 'datetime';
                        }
                    }
                }
            }
        }
    }

    function replaceV12NullableV11Nullable($table) {
        foreach ($GLOBALS['TCA'][$table]['columns'] as $key => $field) {
            if (!empty($field['config']['nullable'])) {
                if (!empty($GLOBALS['TCA'][$table]['columns'][$key]['config']['eval'])) {
                    $GLOBALS['TCA'][$table]['columns'][$key]['config']['eval'] .= ',';
                } else {
                    $GLOBALS['TCA'][$table]['columns'][$key]['config']['eval'] = '';
                }
                $GLOBALS['TCA'][$table]['columns'][$key]['config']['eval'] .= 'null';
            }
        }
        foreach ($GLOBALS['TCA'][$table]['types'] as $type => $settings) {
            if(!empty($settings['columnsOverrides'])) {
                foreach ($settings['columnsOverrides'] as $key => $field) {
                    if (!empty($field['config']['nullable'])) {
                        if (!empty($GLOBALS['TCA'][$table]['types'][$type]['columnsOverrides'][$key]['config']['eval'])) {
                            $GLOBALS['TCA'][$table]['types'][$type]['columnsOverrides'][$key]['config']['eval'] .= ',';
                        } else {
                            $GLOBALS['TCA'][$table]['types'][$type]['columnsOverrides'][$key]['config']['eval'] = '';
                        }
                        $GLOBALS['TCA'][$table]['types'][$type]['columnsOverrides'][$key]['config']['eval'] .= 'null';
                    }
                }
            }
        }
    }

    function replaceV12FileV11Upload($table) {
        foreach ($GLOBALS['TCA'][$table]['columns'] as $key => $field) {
            if ($field['config']['type'] == 'file') {

                if (is_array($field['config']['allowed'])) {
                    $allowed = [];
                    foreach ($field['config']['allowed'] as $tempAllowed) {
                        switch ($tempAllowed) {
                            case 'common-image-types':
                                $allowed[] = $GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext'];
                                break;
                            default:
                                $allowed[] = $tempAllowed;
                        }
                    }
                    $allowed = implode(',', $allowed);
                } else {
                    switch ($field['config']['allowed']) {
                        case 'common-image-types':
                            $allowed = $GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext'];
                            break;
                        default:
                            $allowed = $field['config']['allowed'];
                    }
                }

                unset($field['config']['type']);
                unset($field['config']['renderType']);

                $config = \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
                    $key,
                    $field['config'],
                    $allowed
                );

                $GLOBALS['TCA'][$table]['columns'][$key]['config'] = $config;
            }
        }
        foreach ($GLOBALS['TCA'][$table]['types'] as $type => $settings) {
            if(!empty($settings['columnsOverrides'])) {
                foreach ($settings['columnsOverrides'] as $key => $field) {
                    if (!empty($field['config']['type']) && $field['config']['type'] == 'file') {

                        switch ($field['config']['allowed']) {
                            case 'common-image-types':
                                $allowed = $GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext'];
                                break;
                            default:
                                $allowed = $field['config']['allowed'];
                        }

                        unset($field['config']['type']);
                        unset($field['config']['renderType']);

                        $config = \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
                            $key,
                            $field['config'],
                            $allowed
                        );

                        $GLOBALS['TCA'][$table]['types'][$type]['columnsOverrides'][$key]['config'] = $config;
                    }
                }
            }
        }
    }

    function replaceV12SpecialInputs11($table)
    {
        if (!empty($GLOBALS['TCA'][$table]['types'])) {
            foreach ($GLOBALS['TCA'][$table]['columns'] as $key => $field) {
                if (!empty($field['config']['type'])) {
                    if ($field['config']['type'] == 'link') {
                        $GLOBALS['TCA'][$table]['columns'][$key]['config']['type'] = 'input';
                        $GLOBALS['TCA'][$table]['columns'][$key]['config']['renderType'] = 'inputLink';
                    } else if ($field['config']['type'] == 'email') {
                        $GLOBALS['TCA'][$table]['columns'][$key]['config']['type'] = 'input';

                    } else if ($field['config']['type'] == 'number') {
                        $GLOBALS['TCA'][$table]['columns'][$key]['config']['type'] = 'input';
                        if (!empty($GLOBALS['TCA'][$table]['columns'][$key]['config']['eval'])) {
                            $GLOBALS['TCA'][$table]['columns'][$key]['config']['eval'] .= ',';
                        } else {
                            $GLOBALS['TCA'][$table]['columns'][$key]['config']['eval'] = '';
                        }
                        if (!empty($field['config']['format']) && $field['config']['format'] == 'decimal') {
                            $GLOBALS['TCA'][$table]['columns'][$key]['config']['eval'] .= 'double2';
                        } else {
                            $GLOBALS['TCA'][$table]['columns'][$key]['config']['eval'] .= 'int';
                        }
                    }
                }
            }
        }
        if (!empty($GLOBALS['TCA'][$table]['types'])) {
            foreach ($GLOBALS['TCA'][$table]['types'] as $type => $settings) {
                if (!empty($settings['columnsOverrides'])) {
                    foreach ($settings['columnsOverrides'] as $key => $field) {
                        if (!empty($field['config']['type'])) {
                            if ($field['config']['type'] == 'link') {
                                $GLOBALS['TCA'][$table]['types'][$type]['columnsOverrides'][$key]['config']['type'] = 'input';
                                $GLOBALS['TCA'][$table]['types'][$type]['columnsOverrides'][$key]['config']['renderType'] = 'inputLink';
                            } else if ($field['config']['type'] == 'email') {
                                $GLOBALS['TCA'][$table]['types'][$type]['columnsOverrides'][$key]['config']['type'] = 'input';
                            } else if ($field['config']['type'] == 'number') {
                                $GLOBALS['TCA'][$table]['types'][$type]['columnsOverrides'][$key]['config']['type'] = 'input';
                                if (!empty($GLOBALS['TCA'][$table]['types'][$type]['columnsOverrides'][$key]['config']['eval'])) {
                                    $GLOBALS['TCA'][$table]['types'][$type]['columnsOverrides'][$key]['config']['eval'] .= ',';
                                } else {
                                    $GLOBALS['TCA'][$table]['types'][$type]['columnsOverrides'][$key]['config']['eval'] = '';
                                }
                                if (!empty($field['config']['format']) && $field['config']['format'] == 'decimal') {
                                    $GLOBALS['TCA'][$table]['types'][$type]['columnsOverrides'][$key]['config']['eval'] .= 'double2';
                                } else {
                                    $GLOBALS['TCA'][$table]['types'][$type]['columnsOverrides'][$key]['config']['eval'] .= 'int';
                                }
                            }
                        }
                    }
                }
            }
        }
    }

    foreach ($parseTables as $table) {
        replaceSelectV12BySelectV11($table);
        replaceV12DateByV11Date($table);
        replaceV12NullableV11Nullable($table);
        replaceV12FileV11Upload($table);
        replaceV12SpecialInputs11($table);
    }
}
