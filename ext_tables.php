<?php
defined('TYPO3_MODE') || die('Access denied.');

if (TYPO3_MODE == 'BE') {
	$_EXTCONF = unserialize($_EXTCONF);

	if ($_EXTCONF['flush_on_rename']) {
		$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_extfilefunc.php']['processData']['solrfal_rename'] = \Kitzberger\SolrfalRename\Hooks\ExtendedFileUtilityProcessDataHook::class;
	}

	if ($_EXTCONF['flush_on_metadata_update']) {
		$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_tcemain.php']['processDatamapClass']['solrfal_rename'] = \Kitzberger\SolrfalRename\Hooks\TceMainProcessHook::class;
    }
}
