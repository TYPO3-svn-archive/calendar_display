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
 * Controller for the Event object
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */

 class Tx_CalendarDisplay_Controller_EventController extends Tx_Extbase_MVC_Controller_ActionController {

	/**
	 * eventRepository
	 *
	 * @var Tx_CalendarDisplay_Domain_Repository_EventRepository
	 */
	protected $eventRepository;
	
	/**
	 * resourceRepository
	 *
	 * @var Tx_CalendarDisplay_Domain_Repository_ResourceRepository
	 */
	protected $resourceRepository;
	
	/**
	 * resourceCategoryRepository
	 *
	 * @var Tx_CalendarDisplay_Domain_Repository_ResourceCategoryRepository
	 */
	protected $resourceCategoryRepository;
	
	/**
	 * feUserRepository
	 *
	 * @var Tx_CalendarDisplay_Domain_Repository_FeUserRepository
	 */
	protected $feUserRepository;

	/**
	 * Initializes the current action
	 *
	 * @return void
	 */
	protected function initializeAction() {
		$this->eventRepository = t3lib_div::makeInstance('Tx_CalendarDisplay_Domain_Repository_EventRepository');
		$this->resourceRepository = t3lib_div::makeInstance('Tx_CalendarDisplay_Domain_Repository_ResourceRepository');
		$this->resourceCategoryRepository = t3lib_div::makeInstance('Tx_CalendarDisplay_Domain_Repository_ResourceCategoryRepository');
		$this->feUserRepository = t3lib_div::makeInstance('Tx_CalendarDisplay_Domain_Repository_FeUserRepository');
	}

	/**
	 * Displays all Events in a calendar
	 *
	 * @return string The rendered list view
	 */
	public function calendarAction() {
		$this->view->assign('events',  $this->eventRepository->findAll());
		$this->view->assign('currentUser', $this->feUserRepository->findByUid(intval($GLOBALS['TSFE']->fe_user->user['uid'])));	
	}

	/**
	 * Displays all Events
	 *
	 * @return string The rendered list view
	 */
	public function listAction() {
		$events = $this->eventRepository->getAllByTimeBegin(strtotime('day'));
		
		if(count($events) < 1){
			$settings = $this->configurationManager->getConfiguration(Tx_Extbase_Configuration_ConfigurationManagerInterface::CONFIGURATION_TYPE_FRAMEWORK);
			if(empty($settings['persistence']['storagePid'])){
				$this->flashMessageContainer->add('No storagePid configured!');
			}
		}
		
		$this->view->assign('events', $events);
		$this->view->assign('categories' , $this->resourceCategoryRepository->findAll());
		$this->view->assign('currentUser', $this->feUserRepository->findByUid(intval($GLOBALS['TSFE']->fe_user->user['uid'])));		
	}

	/**
	 * Creates a new Event and forwards to the list action.
	 *
	 * @param Tx_CalendarDisplay_Domain_Model_Event $newEvent a fresh Event object which has not yet been added to the repository
	 * @param string $newEvent a referer action, it will redirect to the prevoius action
	 * @return string An HTML form for creating a new Event
	 * @dontvalidate $newEvent
	 */
	public function newAction(Tx_CalendarDisplay_Domain_Model_Event $newEvent = null, $refererAction = 'list') {
		$this->view->assign('newEvent', $newEvent);
		$this->view->assign('resources', $this->resourceRepository->findAll());
		$this->view->assign('categories' , $this->resourceCategoryRepository->findAll());
		$this->view->assign('refererAction', $refererAction);
	}

	/**
	 * Creates a new Event and forwards to the list action.
	 *
	 * @param Tx_CalendarDisplay_Domain_Model_Event $newEvent a fresh Event object which has not yet been added to the repository
	 * @return void
	 */
	public function createAction(Tx_CalendarDisplay_Domain_Model_Event $newEvent) {
		// get current login user if it have right then add the new event
		$currentUser = $this->feUserRepository->findByUid(intval($GLOBALS['TSFE']->fe_user->user['uid']));
		if ($currentUser) {
			$newEvent->setPurchaser($currentUser);			
			$this->eventRepository->add($newEvent);
			$this->flashMessageContainer->add(Tx_Extbase_Utility_Localization::translate('event_created', 'CalendarDisplay'));
		} else {
			$this->flashMessageContainer->add(Tx_Extbase_Utility_Localization::translate('event_not_created', 'CalendarDisplay'));
		}
		$this->redirect($this->request->getArgument('refererAction'));
	}

	/**
	 * Updates an existing Event and forwards to the index action afterwards.
	 *
	 * @param Tx_CalendarDisplay_Domain_Model_Event $event the Event to display
	 * @param string $newEvent a referer action, it will redirect to the prevoius action
	 * @return string A form to edit a Event
	 * @dontvalidate $event
	 */
	public function editAction(Tx_CalendarDisplay_Domain_Model_Event $event, $refererAction = 'list') {
		$this->view->assign('event', $event);
		$this->view->assign('resources', $this->resourceRepository->findAll());
		$this->view->assign('categories' , $this->resourceCategoryRepository->findAll());
		$this->view->assign('refererAction', $refererAction);
	}

	/**
	 * Updates an existing Event and forwards to the list action afterwards.
	 *
	 * @param Tx_CalendarDisplay_Domain_Model_Event $event the Event to display
	 * @return void
	 */
	public function updateAction(Tx_CalendarDisplay_Domain_Model_Event $event) {
		// get current login user if it have right then add the new event
		$currentUser = $this->feUserRepository->findByUid(intval($GLOBALS['TSFE']->fe_user->user['uid']));
		$getPurchaserId = $event->getPurchaser() ? $event->getPurchaser()->getUid() : NULL;
		if ($currentUser->getUid() == $getPurchaserId || $currentUser->getTxCalendardisplayAdmin() == 1) {
			$this->eventRepository->update($event);
			$this->flashMessageContainer->add(Tx_Extbase_Utility_Localization::translate('event_updated', 'CalendarDisplay'));
		} else {
			$this->flashMessageContainer->add(Tx_Extbase_Utility_Localization::translate('event_not_updated', 'CalendarDisplay'));
		}
		$this->redirect($this->request->getArgument('refererAction'));
	}

	/**
	 * Deletes an existing Event
	 *
	 * @param Tx_CalendarDisplay_Domain_Model_Event $event the Event to be deleted
	 * @return void
	 */
	public function deleteAction(Tx_CalendarDisplay_Domain_Model_Event $event) {
		// get current login user if it have right then add the new event
		$currentUser = $this->feUserRepository->findByUid(intval($GLOBALS['TSFE']->fe_user->user['uid']));
		$getPurchaserId = $event->getPurchaser() ? $event->getPurchaser()->getUid() : NULL;
		if ($currentUser->getUid() == $getPurchaserId || $currentUser->getTxCalendardisplayAdmin() == 1) {
			$this->eventRepository->remove($event);
			$this->flashMessageContainer->add(Tx_Extbase_Utility_Localization::translate('event_removed', 'CalendarDisplay'));			
		} else {
			$this->flashMessageContainer->add(Tx_Extbase_Utility_Localization::translate('event_not_removed', 'CalendarDisplay'));
		}
		$this->redirect('list');
	}
	
 	/**
	 * Filter the event list which follows by parameter category, keyword, and timeBegin
	 *
	 * @param integer $category the Category to be filter
	 * @param string $keyword the Keyword 
	 * @param string $dateBegin the dateBegin 
	 * @return void
	 */
	public function filterAction($category = NULL, $keyword = '', $dateBegin = NULL) {
		$this->view->assign('events', $this->eventRepository->filter($category, $keyword, $dateBegin));
		$this->view->assign('currentUser', $this->feUserRepository->findByUid(intval($GLOBALS['TSFE']->fe_user->user['uid'])));
	}
	
 	/**
	 * Filter available item by some parameters category and keyword
	 *
	 * @param integer $category the Category to be filter
	 * @param string $keyword the Keyword
	 * @return void
	 */
	public function filterItemsAction($category = NULL, $keyword = '') {
		$this->view->assign('resources', $this->resourceRepository->filterItems($category, $keyword));
	}
}
?>