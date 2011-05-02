<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2011 Fabien Udriot <fabien.udriot@ecodev.ch>, Ecodev
*  	
*  All rights reserved
*
*  This script is part of the TYPO3 project. The TYPO3 project is
*  free software; you can redistribute it and/or modify
*  it under the terms of the GNU General Public License as published by
*  the Free Software Foundation; either version 3 of the License, or
*  (at your option) any later version.
*
*  The GNU General Public License can be found at
*  http://www.gnu.org/copyleft/gpl.html.
*
*  This script is distributed in the hope that it will be useful,
*  but WITHOUT ANY WARRANTY; without even the implied warranty of
*  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*  GNU General Public License for more details.
*
*  This copyright notice MUST APPEAR in all copies of the script!
***************************************************************/


/**
 * Controller for the Resource object
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */

 class Tx_CalendarDisplay_Controller_ResourceController extends Tx_Extbase_MVC_Controller_ActionController {

	/**
	 * resourceRepository
	 *
	 * @var Tx_CalendarDisplay_Domain_Repository_ResourceRepository
	 */
	protected $resourceRepository;

	/**
	 * Initializes the current action
	 *
	 * @return void
	 */
	protected function initializeAction() {
		$this->resourceRepository = t3lib_div::makeInstance('Tx_CalendarDisplay_Domain_Repository_ResourceRepository');
	}

	/**
	 * Displays all Resources
	 *
	 * @return string The rendered list view
	 */
	public function listAction() {
		$resources = $this->resourceRepository->findAll();
		
		if(count($resources) < 1){
			$settings = $this->configurationManager->getConfiguration(Tx_Extbase_Configuration_ConfigurationManagerInterface::CONFIGURATION_TYPE_FRAMEWORK);
			if(empty($settings['persistence']['storagePid'])){
				$this->flashMessageContainer->add('No storagePid configured!');
			}
		}
		
		$this->view->assign('resources', $resources);
	}

	/**
	 * Displays a single Resource
	 *
	 * @param Tx_CalendarDisplay_Domain_Model_Resource $resource the Resource to display
	 * @return string The rendered view
	 */
	public function showAction(Tx_CalendarDisplay_Domain_Model_Resource $resource) {
		$this->view->assign('resource', $resource);
	}

	/**
	 * Creates a new Resource and forwards to the list action.
	 *
	 * @param Tx_CalendarDisplay_Domain_Model_Resource $newResource a fresh Resource object which has not yet been added to the repository
	 * @return string An HTML form for creating a new Resource
	 * @dontvalidate $newResource
	 */
	public function newAction(Tx_CalendarDisplay_Domain_Model_Resource $newResource = null) {
		$this->view->assign('newResource', $newResource);
	}

	/**
	 * Creates a new Resource and forwards to the list action.
	 *
	 * @param Tx_CalendarDisplay_Domain_Model_Resource $newResource a fresh Resource object which has not yet been added to the repository
	 * @return void
	 */
	public function createAction(Tx_CalendarDisplay_Domain_Model_Resource $newResource) {
		$this->resourceRepository->add($newResource);
		$this->flashMessageContainer->add('Your new Resource was created.');
		
			
		
		$this->redirect('list');
	}

	/**
	 * Updates an existing Resource and forwards to the index action afterwards.
	 *
	 * @param Tx_CalendarDisplay_Domain_Model_Resource $resource the Resource to display
	 * @return string A form to edit a Resource
	 */
	public function editAction(Tx_CalendarDisplay_Domain_Model_Resource $resource) {
		$this->view->assign('resource', $resource);
	}

	/**
	 * Updates an existing Resource and forwards to the list action afterwards.
	 *
	 * @param Tx_CalendarDisplay_Domain_Model_Resource $resource the Resource to display
	 * @return
	 */
	public function updateAction(Tx_CalendarDisplay_Domain_Model_Resource $resource) {
		$this->resourceRepository->update($resource);
		$this->flashMessageContainer->add('Your Resource was updated.');
		$this->redirect('list');
	}

	/**
	 * Deletes an existing Resource
	 *
	 * @param Tx_CalendarDisplay_Domain_Model_Resource $resource the Resource to be deleted
	 * @return void
	 */
	public function deleteAction(Tx_CalendarDisplay_Domain_Model_Resource $resource) {
		$this->resourceRepository->remove($resource);
		$this->flashMessageContainer->add('Your Resource was removed.');
		$this->redirect('list');
	}

}
?>