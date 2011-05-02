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
 * Controller for the Booking object
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */

 class Tx_CalendarDisplay_Controller_BookingController extends Tx_Extbase_MVC_Controller_ActionController {

	/**
	 * bookingRepository
	 *
	 * @var Tx_CalendarDisplay_Domain_Repository_BookingRepository
	 */
	protected $bookingRepository;

	/**
	 * Initializes the current action
	 *
	 * @return void
	 */
	protected function initializeAction() {
		$this->bookingRepository = t3lib_div::makeInstance('Tx_CalendarDisplay_Domain_Repository_BookingRepository');

	}

	/**
	 * Displays all Bookings in a calendar
	 *
	 * @return string The rendered list view
	 */
	public function calendarAction() {
		$this->view->assign('settings', $this->settings);
	}

	/**
	 * Displays all Bookings
	 *
	 * @return string The rendered list view
	 */
	public function listAction() {
		$bookings = $this->bookingRepository->findAll();
		
		if(count($bookings) < 1){
			$settings = $this->configurationManager->getConfiguration(Tx_Extbase_Configuration_ConfigurationManagerInterface::CONFIGURATION_TYPE_FRAMEWORK);
			if(empty($settings['persistence']['storagePid'])){
				$this->flashMessageContainer->add('No storagePid configured!');
			}
		}
		
		$this->view->assign('bookings', $bookings);
	}

	/**
	 * Displays a single Booking
	 *
	 * @param Tx_CalendarDisplay_Domain_Model_Booking $booking the Booking to display
	 * @return string The rendered view
	 */
	public function showAction(Tx_CalendarDisplay_Domain_Model_Booking $booking) {
		$this->view->assign('booking', $booking);
	}

	/**
	 * Creates a new Booking and forwards to the list action.
	 *
	 * @param Tx_CalendarDisplay_Domain_Model_Booking $newBooking a fresh Booking object which has not yet been added to the repository
	 * @return string An HTML form for creating a new Booking
	 * @dontvalidate $newBooking
	 */
	public function newAction(Tx_CalendarDisplay_Domain_Model_Booking $newBooking = null) {
		$this->view->assign('newBooking', $newBooking);
	}

	/**
	 * Creates a new Booking and forwards to the list action.
	 *
	 * @param Tx_CalendarDisplay_Domain_Model_Booking $newBooking a fresh Booking object which has not yet been added to the repository
	 * @return void
	 */
	public function createAction(Tx_CalendarDisplay_Domain_Model_Booking $newBooking) {
		$this->bookingRepository->add($newBooking);
		$this->flashMessageContainer->add('Your new Booking was created.');
		
			
		
		$this->redirect('list');
	}

	/**
	 * Updates an existing Booking and forwards to the index action afterwards.
	 *
	 * @param Tx_CalendarDisplay_Domain_Model_Booking $booking the Booking to display
	 * @return string A form to edit a Booking
	 */
	public function editAction(Tx_CalendarDisplay_Domain_Model_Booking $booking) {
		$this->view->assign('booking', $booking);
	}

	/**
	 * Updates an existing Booking and forwards to the list action afterwards.
	 *
	 * @param Tx_CalendarDisplay_Domain_Model_Booking $booking the Booking to display
	 * @return
	 */
	public function updateAction(Tx_CalendarDisplay_Domain_Model_Booking $booking) {
		$this->bookingRepository->update($booking);
		$this->flashMessageContainer->add('Your Booking was updated.');
		$this->redirect('list');
	}

	/**
	 * Deletes an existing Booking
	 *
	 * @param Tx_CalendarDisplay_Domain_Model_Booking $booking the Booking to be deleted
	 * @return void
	 */
	public function deleteAction(Tx_CalendarDisplay_Domain_Model_Booking $booking) {
		$this->bookingRepository->remove($booking);
		$this->flashMessageContainer->add('Your Booking was removed.');
		$this->redirect('list');
	}

}
?>