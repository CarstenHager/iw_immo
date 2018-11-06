<?php
	if (!defined('TYPO3_MODE')) {
		die ('Access denied.');
	}


	if (!isset($GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['iw_immo']['apiDomain']) || empty($GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['iw_immo']['apiDomain'])) {
		$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['iw_immo']['apiDomain'] = 'http://api.immowelt.de';
	}

	$confArr = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY]);


	\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
		'IWAG.' . $_EXTKEY,
		'search',
		array(
			'Search' => 'index',
		),
		array(
			'Search' => 'index',
		)
	);
	\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
		'IWAG.' . $_EXTKEY,
		'list',
		array(
			'List' => 'index',
		),
		array(
			'List' => 'index',
		)
	);
    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
        'IWAG.' . $_EXTKEY,
        'detail',
        array(
            'Detail' => 'show',
        ),
		array(
			'Detail' => 'show',
		)
    );
    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
        'IWAG.' . $_EXTKEY,
        'contact',
        array(
            'Contact' => 'index,confirmation,send',
        ),
		array(
			'Contact' => 'index,confirmation,send',
		)
    );
    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
        'IWAG.' . $_EXTKEY,
        'calculator',
        array(
            'Calculator' => 'index',
        ),
		array(
			'Calculator' => 'index',
		)
    );

	if (!isset($GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['iw_immo']['apiDomain']) || empty($GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['iw_immo']['apiDomain'])) {
		$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['iw_immo']['apiDomain'] = 'http://api.immowelt.de';
	}

	if ($confArr['includeJQueryUI'] != 0) {

		if ($confArr['includeJQueryUILocalization'] == 1) {
			\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTypoScript($_EXTKEY, 'setup', '
            page.includeJSlibs {
                #jqueryUIlocalization = https://ajax.aspnetcdn.com/ajax/jquery.ui/' . trim($confArr['includeJQueryUI']) . '/i18n/jquery-ui-i18n.min.js
                jqueryUIlocalization = //ajax.googleapis.com/ajax/libs/jqueryui/' . trim($confArr['includeJQueryUI']) . '/i18n/jquery-ui-i18n.min.js
                jqueryUIlocalization.external = 1
                jqueryUIlocalization.type 		= text/javascript
                jqueryUIlocalization.forceOnTop 	= 1
                jqueryUIlocalization.excludeFromConcatenation = 1
                jqueryUIlocalization.disableCompression = 1
            }
        ');
		}

		if ($confArr['includeJQueryUIStyles'] == 1) {
			\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTypoScript($_EXTKEY, 'setup', '
            page.includeCSS {
                #jqueryUiStyles = http://code.jquery.com/ui/' . trim($confArr['includeJQueryUI']) . '/themes/smoothness/jquery-ui.css
                jqueryUiStyles = //ajax.googleapis.com/ajax/libs/jqueryui/' . trim($confArr['includeJQueryUI']) . '/themes/smoothness/jquery-ui.css
                jqueryUiStyles.external = 1
                jqueryUiStyles.excludeFromConcatenation = 1
                jqueryUiStyles.disableCompression = 1
            }
        ');
		}

		\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTypoScript($_EXTKEY, 'setup', '
            page.includeJSlibs {
                #jqueryUI = http://ajax.aspnetcdn.com/ajax/jquery.ui/' . trim($confArr['includeJQueryUI']) . '/jquery-ui.min.js
                jqueryUI = //ajax.googleapis.com/ajax/libs/jqueryui/' . trim($confArr['includeJQueryUI']) . '/jquery-ui.min.js
                jqueryUI.external = 1
                jqueryUI.type 		= text/javascript
                jqueryUI.forceOnTop 	= 1
                jqueryUI.excludeFromConcatenation = 1
                jqueryUI.disableCompression = 1
            }
        ');
	}

	// jQuery Validation einbinden
	if ($confArr['includeJQueryValidation'] != 0) {
		\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTypoScript($_EXTKEY, 'setup', '
            page.includeJSlibs {
                # das gibts nur von MS
                jqueryValidation = //ajax.aspnetcdn.com/ajax/jquery.validate/' . trim($confArr['includeJQueryValidation']) . '/jquery.validate.min.js
                jqueryValidation.external = 1
                jqueryValidation.type 		= text/javascript
                jqueryValidation.forceOnTop 	= 1
                jqueryValidation.excludeFromConcatenation = 1
                jqueryValidation.disableCompression = 1
            }
        ');
	}

	if ($confArr['includeJQuery'] != 0) {
		\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTypoScript($_EXTKEY, 'setup', '
            page.includeJSlibs {
                #jquery = http://ajax.aspnetcdn.com/ajax/jQuery/jquery-' . trim($confArr['includeJQuery']) . '.min.js
                jquery = //ajax.googleapis.com/ajax/libs/jquery/' . trim($confArr['includeJQuery']) . '/jquery.min.js
                jquery.type 		= text/javascript
                jquery.external = 1
                jquery.forceOnTop 	= 1
                jquery.excludeFromConcatenation = 1
                jquery.disableCompression = 1
            }
        ');
	}

	\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerTypeConverter('IWAG\IwImmo\Property\TypeConverter\ListsSearchDemandConverter');
	\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerTypeConverter('IWAG\IwImmo\Property\TypeConverter\ExposeConverter');


	// cache registrieren für objekte
	if (!is_array($GLOBALS['TYPO3_CONF_VARS']['SYS']['caching']['cacheConfigurations'][$_EXTKEY . '_api'])) {
		$GLOBALS['TYPO3_CONF_VARS']['SYS']['caching']['cacheConfigurations'][$_EXTKEY . '_api'] = array(
			'backend' => '\TYPO3\CMS\Core\Cache\Backend\TransientMemoryBackend'
		);
	}
?>
