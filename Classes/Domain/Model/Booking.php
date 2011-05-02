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
 * Booking
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */

 class Tx_CalendarDisplay_Domain_Model_Booking extends Tx_Extbase_DomainObject_AbstractEntity {

	/**
	 * timeBegin
	 *
	 * @var integer $timeBegin
	 */
	protected $timeBegin;

	/**
	 * timeEnd
	 *
	 * @var integer $timeEnd
	 */
	protected $timeEnd;

	/**
	 * note
	 *
	 * @var string $note
	 */
	protected $note;

	/**
	 * resources
	 *
	 * @var Tx_Extbase_Persistence_ObjectStorage<Tx_CalendarDisplay_Domain_Model_Resource> $resources
	 */
	protected $resources;

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
		$this->resources = new Tx_Extbase_Persistence_ObjectStorage();
	}

	/**
	 * Setter for timeBegin
	 *
	 * @param integer $timeBegin timeBegin
	 * @return void
	 */
	public function setTimeBegin($timeBegin) {
		$this->timeBegin = $timeBegin;
	}

	/**
	 * Getter for timeBegin
	 *
	 * @return integer timeBegin
	 */
	public function getTimeBegin() {
		return $this->timeBegin;
	}

	/**
	 * Setter for timeEnd
	 *
	 * @param integer $timeEnd timeEnd
	 * @return void
	 */
	public function setTimeEnd($timeEnd) {
		$this->timeEnd = $timeEnd;
	}

	/**
	 * Getter for timeEnd
	 *
	 * @return integer timeEnd
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
	 * Setter for resources
	 *
	 * @param Tx_Extbase_Persistence_ObjectStorage<Tx_CalendarDisplay_Domain_Model_Resource> $resources resources
	 * @return void
	 */
	public function setResources(Tx_Extbase_Persistence_ObjectStorage $resources) {
		$this->resources = $resources;
	}

	/**
	 * Getter for resources
	 *
	 * @return Tx_Extbase_Persistence_ObjectStorage<Tx_CalendarDisplay_Domain_Model_Resource> resources
	 */
	public function getResources() {
		return $this->resources;
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

}
?>