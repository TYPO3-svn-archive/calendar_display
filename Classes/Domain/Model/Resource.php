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
	 * bookedResourcesNumber
	 *
	 * @var integer bookedResourcesNumber
	 */
	protected $bookedResourcesNumber;
	
	/**
	 * availableNumber
	 *
	 * @var integer $availableNumber
	 */
	protected $availableNumber;
	
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
		return $this->availableNumber;
	}

	/**
	 * Setter for availableNumber
	 *
	 * @param integer availableNumber
	 */
	public function setAvailableNumber($availableNumber) {
		$this->availableNumber = $availableNumber;
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
	 * Setter for bookedResourcesNumber
	 * 
	 * @param integer $bookedResourcesNumber bookedResourcesNumber
	 * @return void
	 */
	public function setBookedResourcesNumber($bookedResourcesNumber) {
		$this->bookedResourcesNumber = $bookedResourcesNumber;
	}
	
 	/**
	 * Getter for bookedResourcesNumber
	 *
	 * @return integer bookedResourcesNumber
	 */
	public function getBookedResourcesNumber() {
		return $this->bookedResourcesNumber;
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