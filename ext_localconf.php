<?php

use IWAG\IwImmo\Controller\SearchController;
use IWAG\IwImmo\Controller\ListController;
use IWAG\IwImmo\Controller\DetailController;
use IWAG\IwImmo\Controller\ContactController;
use IWAG\IwImmo\Controller\CalculatorController;
use TYPO3\CMS\Core\Configuration\Exception\ExtensionConfigurationExtensionNotConfiguredException;
use TYPO3\CMS\Core\Configuration\ExtensionConfiguration;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Utility\ExtensionUtility;

if (!defined('TYPO3_MODE')) {
  die ('Access denied.');
}


if (!isset($GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['iw_immo']['apiDomain']) || empty($GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['iw_immo']['apiDomain'])) {
  $GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['iw_immo']['apiDomain'] = 'http://api.immowelt.de';
}

try {
  $confArr = GeneralUtility::makeInstance(ExtensionConfiguration::class)
    ->get('iw_immo');
} catch (ExtensionConfigurationExtensionNotConfiguredException $e) {
  $confArr = [];
}

ExtensionUtility::configurePlugin(
  'IwImmo',
  'search',
  [
    SearchController::class => 'index',
  ],
  [
    SearchController::class => 'index',
  ]
);
ExtensionUtility::configurePlugin(
  'IwImmo',
  'list',
  [
    ListController::class => 'index',
  ],
  [
    ListController::class => 'index',
  ]
);
ExtensionUtility::configurePlugin(
  'IwImmo',
  'detail',
  [
    DetailController::class => 'show',
  ],
  [
    DetailController::class => 'show',
  ]
);
ExtensionUtility::configurePlugin(
  'IwImmo',
  'contact',
  [
    ContactController::class => 'index,confirmation,send',
  ],
  [
    ContactController::class => 'index,confirmation,send',
  ]
);
ExtensionUtility::configurePlugin(
  'IwImmo',
  'calculator',
  [
    CalculatorController::class => 'index',
  ],
  [
    CalculatorController::class => 'index',
  ]
);

if (!isset($GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['iw_immo']['apiDomain']) || empty($GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['iw_immo']['apiDomain'])) {
  $GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['iw_immo']['apiDomain'] = 'http://api.immowelt.de';
}

if ($confArr['includeJQueryUI'] != 0) {

  if ($confArr['includeJQueryUILocalization'] == 1) {
    ExtensionManagementUtility::addTypoScript('iw_immo', 'setup', '
            page.includeJSlibs {
                #jqueryUIlocalization = https://ajax.aspnetcdn.com/ajax/jquery.ui/' . trim($confArr['includeJQueryUI']) . '/i18n/jquery-ui-i18n.min.js
                jqueryUIlocalization = //ajax.googleapis.com/ajax/libs/jqueryui/' . trim($confArr['includeJQueryUI']) . '/i18n/jquery-ui-i18n.min.js
                jqueryUIlocalization.external = 1
                jqueryUIlocalization.type       = text/javascript
                jqueryUIlocalization.forceOnTop     = 1
                jqueryUIlocalization.excludeFromConcatenation = 1
                jqueryUIlocalization.disableCompression = 1
            }
        ');
  }

  if ($confArr['includeJQueryUIStyles'] == 1) {
    ExtensionManagementUtility::addTypoScript('iw_immo', 'setup', '
            page.includeCSS {
                #jqueryUiStyles = http://code.jquery.com/ui/' . trim($confArr['includeJQueryUI']) . '/themes/smoothness/jquery-ui.css
                jqueryUiStyles = //ajax.googleapis.com/ajax/libs/jqueryui/' . trim($confArr['includeJQueryUI']) . '/themes/smoothness/jquery-ui.css
                jqueryUiStyles.external = 1
                jqueryUiStyles.excludeFromConcatenation = 1
                jqueryUiStyles.disableCompression = 1
            }
        ');
  }

  ExtensionManagementUtility::addTypoScript('iw_immo', 'setup', '
            page.includeJSlibs {
                #jqueryUI = http://ajax.aspnetcdn.com/ajax/jquery.ui/' . trim($confArr['includeJQueryUI']) . '/jquery-ui.min.js
                jqueryUI = //ajax.googleapis.com/ajax/libs/jqueryui/' . trim($confArr['includeJQueryUI']) . '/jquery-ui.min.js
                jqueryUI.external = 1
                jqueryUI.type       = text/javascript
                jqueryUI.forceOnTop     = 1
                jqueryUI.excludeFromConcatenation = 1
                jqueryUI.disableCompression = 1
            }
        ');
}

// jQuery Validation einbinden
if ($confArr['includeJQueryValidation'] != 0) {
  ExtensionManagementUtility::addTypoScript('iw_immo', 'setup', '
            page.includeJSlibs {
                # das gibts nur von MS
                jqueryValidation = //ajax.aspnetcdn.com/ajax/jquery.validate/' . trim($confArr['includeJQueryValidation']) . '/jquery.validate.min.js
                jqueryValidation.external = 1
                jqueryValidation.type       = text/javascript
                jqueryValidation.forceOnTop     = 1
                jqueryValidation.excludeFromConcatenation = 1
                jqueryValidation.disableCompression = 1
            }
        ');
}

if ($confArr['includeJQuery'] != 0) {
  ExtensionManagementUtility::addTypoScript('iw_immo', 'setup', '
            page.includeJSlibs {
                #jquery = http://ajax.aspnetcdn.com/ajax/jQuery/jquery-' . trim($confArr['includeJQuery']) . '.min.js
                jquery = //ajax.googleapis.com/ajax/libs/jquery/' . trim($confArr['includeJQuery']) . '/jquery.min.js
                jquery.type         = text/javascript
                jquery.external = 1
                jquery.forceOnTop   = 1
                jquery.excludeFromConcatenation = 1
                jquery.disableCompression = 1
            }
        ');
}

ExtensionUtility::registerTypeConverter('IWAG\IwImmo\Property\TypeConverter\ListsSearchDemandConverter');
ExtensionUtility::registerTypeConverter('IWAG\IwImmo\Property\TypeConverter\ExposeConverter');


// cache registrieren für objekte
if (!is_array($GLOBALS['TYPO3_CONF_VARS']['SYS']['caching']['cacheConfigurations']['iw_immo' . '_api'])) {
  $GLOBALS['TYPO3_CONF_VARS']['SYS']['caching']['cacheConfigurations']['iw_immo' . '_api'] = [
    'backend' => '\TYPO3\CMS\Core\Cache\Backend\TransientMemoryBackend',
  ];
}
