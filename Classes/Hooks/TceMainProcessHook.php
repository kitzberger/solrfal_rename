<?php

namespace Kitzberger\SolrfalRename\Hooks;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\DataHandling\DataHandler;

class TceMainProcessHook
{
	/**
	 * @var \TYPO3\CMS\Extbase\Object\ObjectManager
	 */
	protected $objectManager;

	/**
	 * @var \ApacheSolrForTypo3\Solrfal\Queue\ItemRepository
	 */
	protected $itemRepository;

	/**
	 * @param $status
	 * @param $table
	 * @param $id
	 * @param array $fieldArray
	 * @param DataHandler $dataHandler
	 */
	public function processDatamap_afterDatabaseOperations($status, $table, $id, array $fieldArray, DataHandler $dataHandler)
	{
		if ($table === 'sys_file_metadata') {
			if ($status === 'update') {
				$fileRecord = $GLOBALS['TYPO3_DB']->exec_SELECTgetSingleRow('file', $table, 'uid=' . (int)$id);
				if (!empty($fileRecord)) {
					$this->objectManager = GeneralUtility::makeInstance(\TYPO3\CMS\Extbase\Object\ObjectManager::class);
					$this->itemRepository = $this->objectManager->get(\ApacheSolrForTypo3\Solrfal\Queue\ItemRepository::class);
					$this->itemRepository->markFileUpdated((int)$fileRecord['file']);
				}
			}
		}
	}
}
