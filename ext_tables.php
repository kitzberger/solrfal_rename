<?php
defined('TYPO3_MODE') || die('Access denied.');

if (TYPO3_MODE == 'BE') {
	$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_extfilefunc.php']['processData']['solrfal_rename'] = \Kitzberger\SolrfalRename\Hooks\ExtendedFileUtilityProcessDataHook::class;
}
