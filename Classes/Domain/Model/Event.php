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
 * Event
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */

 class Tx_CalendarDisplay_Domain_Model_Event extends Tx_Extbase_DomainObject_AbstractEntity {

	/**
	 * timeBegin
	 *
	 * @var DateTime $timeBegin
	 * @validate NotEmpty
	 */
	protected $timeBegin;

	/**
	 * timeEnd
	 *
	 * @var DateTime $timeEnd
	 * @validate NotEmpty
	 */
	protected $timeEnd;

	/**
	 * note
	 *
	 * @var string $note
	 */
	protected $note;
	
	/**
	 * purchaser
	 *
	 * @var Tx_CalendarDisplay_Domain_Model_FeUser $purchaser
	 */
	protected $purchaser;
	
	/**
	 * booking
	 *
	 * @var Tx_Extbase_Persistence_ObjectStorage<Tx_CalendarDisplay_Domain_Model_Booking> $booking
	 */
	protected $booking;
	
	/**
	 * availableResources
	 * 
	 * @var Tx_Extbase_Persistence_ObjectStorage<Tx_CalendarDisplay_Domain_Model_Resource> $availableResources
	 */
	protected $availableResources;

	/**
	 * The constructor.
	 *
	 * @return void
	 */
	public function __construct() {
		//Do not remove the next line: It would break the functionality
		$this->initStorageObjects();
	}

	/**
	 * Initializes all Tx_Extbase_Persistence_ObjectStorage properties.
	 *
	 * @return void
	 */
	protected function initStorageObjects() {
		/**
		* Do not modify this method!
		* It will be rewritten on each save in the kickstarter
		* You may modify the constructor of this class instead
		*/
		$this->booking = new Tx_Extbase_Persistence_ObjectStorage();
	}

	/**
	 * Setter for timeBegin
	 *
	 * @param DateTime $timeBegin timeBegin
	 * @return void
	 */
	public function setTimeBegin($timeBegin) {
		$this->timeBegin = $timeBegin;
	}

	/**
	 * Getter for timeBegin
	 *
	 * @return DateTime timeBegin
	 */
	public function getTimeBegin() {
		return $this->timeBegin;
	}

	/**
	 * Setter for timeEnd
	 *
	 * @param DateTime $timeEnd timeEnd
	 * @return void
	 */
	public function setTimeEnd($timeEnd) {
		$this->timeEnd = $timeEnd;
	}

	/**
	 * Getter for timeEnd
	 *
	 * @return DateTime timeEnd
	 */
	public function getTimeEnd() {
		return $this->timeEnd;
	}

	/**
	 * Setter for note
	 *
	 * @param string $note note
	 * @return void
	 */
	public function setNote($note) {
		$this->note = $note;
	}

	/**
	 * Getter for note
	 *
	 * @return string note
	 */
	public function getNote() {
		return $this->note;
	}
	
 	/**
	 * Setter for purchaser
	 *
	 * @param Tx_CalendarDisplay_Domain_Model_FeUser $purchaser purchaser
	 * @return void
	 */
	public function setPurchaser($purchaser) {
		$this->purchaser = $purchaser;
	}

	/**
	 * Getter for purchaser
	 *
	 * @return Tx_CalendarDisplay_Domain_Model_FeUser purchaser
	 */
	public function getPurchaser() {
		return $this->purchaser;
	}
	
 	/**
	 * Setter for booking
	 *
	 * @param Tx_Extbase_Persistence_ObjectStorage<Tx_CalendarDisplay_Domain_Model_Booking> $booking booking
	 * @return void
	 */
	public function setBooking(Tx_Extbase_Persistence_ObjectStorage $booking) {
		$this->booking = $booking;
	}

	/**
	 * Getter for booking
	 *
	 * @return Tx_Extbase_Persistence_ObjectStorage<Tx_CalendarDisplay_Domain_Model_Booking> booking
	 */
	public function getBooking() {
		return $this->booking;
	}
	
	/**
	 * Gets the boolean value of comparing the TimeBegin and TimeEnd
	 * 
	 * @return boolean
	 */
 	public function getCompareDayBeginDayEnd() {
 		return $this->getTimeBegin()->format('Y-m-d') == $this->getTimeEnd()->format('Y-m-d');
	}
	
	
	/**
	 * Adds a Booking
	 *
	 * @param Tx_CalendarDisplay_Domain_Model_Booking the Booking to be added
	 * @return void
	 */
	public function addBooking(Tx_CalendarDisplay_Domain_Model_Booking $booking) {
		$this->booking->attach($booking);
	}

	/**
	 * Removes a Booking
	 *
	 * @param Tx_CalendarDisplay_Domain_Model_Booking the Booking to be removed
	 * @return void
	 */
	public function removeBooking(Tx_CalendarDisplay_Domain_Model_Booking $bookingToRemove) {
		$this->booking->detach($bookingToRemove);
	}
	
 	/**
	 * Getter for availableResources
	 *
	 * @return Tx_Extbase_Persistence_ObjectStorage<Tx_CalendarDisplay_Domain_Model_Resource> availableResources
	 */
	public function getAvailableResources() {
		$resourceRepository = t3lib_div::makeInstance('Tx_CalendarDisplay_Domain_Repository_ResourceRepository');
		$bookings = $this->getBooking();		
		if ($bookings) {
			foreach ($bookings as $booking) {
				foreach ($booking->getResources() as $resource) {
					$resource->setBookingNumber($booking->getNumber());
				}
			}
		}
		return $resourceRepository->findAll();
	}
}
?>