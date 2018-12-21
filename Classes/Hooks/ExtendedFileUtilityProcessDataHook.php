<?php

namespace Kitzberger\SolrfalRename\Hooks;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Utility\File\ExtendedFileUtility;
use TYPO3\CMS\Core\Utility\File\ExtendedFileUtilityProcessDataHookInterface;

class ExtendedFileUtilityProcessDataHook implements ExtendedFileUtilityProcessDataHookInterface
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
     * Post-process a file action.
     *
     * @param string $action The action
     * @param array $cmdArr The parameter sent to the action handler
     * @param array $result The results of all calls to the action handler
     * @param \TYPO3\CMS\Core\Utility\File\ExtendedFileUtility $parentObject Parent object
     * @return void
     */
    public function processData_postProcessAction($action, array $cmdArr, array $result, ExtendedFileUtility $parentObject)
    {
    	if ($action === 'rename') {
			$this->objectManager = GeneralUtility::makeInstance(\TYPO3\CMS\Extbase\Object\ObjectManager::class);
			$this->itemRepository = $this->objectManager->get(\ApacheSolrForTypo3\Solrfal\Queue\ItemRepository::class);
    		$this->itemRepository->markFileUpdated((int)$cmdArr['data']);
    	}
    }
}
