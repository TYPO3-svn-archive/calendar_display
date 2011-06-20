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
 * Resource
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */

 class Tx_CalendarDisplay_Domain_Model_Resource extends Tx_Extbase_DomainObject_AbstractEntity {

	/**
	 * name
	 *
	 * @var string $name
	 * @validate NotEmpty
	 */
	protected $name;

	/**
	 * number
	 *
	 * @var integer $number
	 * @validate NotEmpty
	 */
	protected $number;
	
	/**
	 * image
	 *
	 * @var string $image
	 */
	protected $image;
	
	/**
	 * bookingNumber
	 *
	 * @var integer bookingNumber
	 */
	protected $bookingNumber;
	
	/**
	 * availableNumber
	 *
	 * @var integer $availableNumber
	 */
	protected $availableNumber;
	
	/**
	 * availableDateBegin
	 *
	 * @var integer $availableDateBegin
	 */
	protected $availableDateBegin;
	
	/**
	 * category
	 *
	 * @var Tx_CalendarDisplay_Domain_Model_ResourceCategory $category
	 */
	protected $category;

	/**
	 * Setter for name
	 *
	 * @param string $name name
	 * @return void
	 */
	public function setName($name) {
		$this->name = $name;
	}

	/**
	 * Getter for name
	 *
	 * @return string name
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * Setter for number
	 *
	 * @param string $number number
	 * @return void
	 */
	public function setNumber($number) {
		$this->number = $number;
	}

	/**
	 * Getter for number
	 *
	 * @return string number
	 */
	public function getNumber() {
		return $this->number;
	}
	
 	/**
	 * Setter for image
	 *
	 * @param string $image image
	 * @return void
	 */
	public function setImage($image) {
		$this->image = $image;
	}

	/**
	 * Getter for image
	 *
	 * @return string image
	 */
	public function getImage() {
		return $this->image;
	}
	
	/**
	 * Getter for availableNumber
	 *
	 * @return integer availableNumber
	 */
	public function getAvailableNumber() {
		$eventRepository = t3lib_div::makeInstance('Tx_CalendarDisplay_Domain_Repository_EventRepository');
		$events = $eventRepository->getAllByTimeEnd($this->getAvailableDateBegin());
		#$events = $eventRepository->getAllByTimeRange($this->getAvailableDateBegin(), $this->getAvailableDateEnd());
		$numResourceBooking = 0;
		foreach ($events as $event) {
			$bookings = $event->getBooking();
			foreach ($bookings as $booking) {
				foreach ($booking->getResources() as $resource) {
					if ($this->getUid() == $resource->getUid()) {
						$numResourceBooking += $booking->getNumber();
					}
				}				
			}		
		}
		$this->availableNumber = $this->getNumber() - $numResourceBooking;
		return $this->availableNumber;
	}
	
	/**
	 * Getter for totalAvailableNumber
	 *
	 * @return integer totalAvailableNumber
	 */
	public function getTotalAvailableNumber() {
		return $this->getAvailableNumber() + $this->getBookingNumber();
	}
	
 	/**
	 * Adds a Resource
	 *
	 * @param Tx_CalendarDisplay_Domain_Model_Resource the Resource to be added
	 * @return void
	 */
	public function addResource(Tx_CalendarDisplay_Domain_Model_Resource $resource) {
		$this->resources->attach($resource);
	}

	/**
	 * Removes a Resource
	 *
	 * @param Tx_CalendarDisplay_Domain_Model_Resource the Resource to be removed
	 * @return void
	 */
	public function removeResource(Tx_CalendarDisplay_Domain_Model_Resource $resourceToRemove) {
		$this->resources->detach($resourceToRemove);
	}
	
 	/**
	 * Setter for bookingNumber
	 * 
	 * @param integer $bookingNumber bookingNumber
	 * @return void
	 */
	public function setBookingNumber($bookingNumber) {
		$this->bookingNumber = $bookingNumber;
	}
	
 	/**
	 * Getter for bookingNumber
	 *
	 * @return integer bookingNumber
	 */
	public function getBookingNumber() {

		return $this->bookingNumber;
	}
	
 	/**
	 * Setter for availableDateBegin
	 * 
	 * @param integer $availableDateBegin availableDateBegin
	 * @return void
	 */
	public function setAvailableDateBegin($availableDateBegin = NULL) {
		if ($availableDateBegin) {
			$this->availableDateBegin = $availableDateBegin;
		} else {
			$this->availableDateBegin = strtotime('now');
		}
	}
	
 	/**
	 * Getter for availableDateBegin
	 *
	 * @return integer availableDateBegin
	 */
	public function getAvailableDateBegin() {		
		return $this->availableDateBegin ? $this->availableDateBegin : strtotime('now');
	}
	
 	/**
	 * Setter for category
	 *
	 * @param Tx_CalendarDisplay_Domain_Model_ResourceCategory $category category
	 * @return void
	 */
	public function setCategory($category) {
		$this->category = $category;
	}

	/**
	 * Getter for category
	 *
	 * @return Tx_CalendarDisplay_Domain_Model_ResourceCategory category
	 */
	public function getCategory() {
		return $this->category;
	}

	/**
	 * The constructor of this Resource
	 *
	 * @return void
	 */
	public function __construct() {

	}
}
?>