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
*  the Free Software Foundation; either version 2 of the License, or
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
 * Testcase for class Tx_CalendarDisplay_Domain_Model_Booking.
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @package TYPO3
 * @subpackage Calendar Display
 * 
 * @author Fabien Udriot <fabien.udriot@ecodev.ch>
 */
class Tx_CalendarDisplay_Domain_Model_BookingTest extends Tx_Extbase_Tests_Unit_BaseTestCase {
	/**
	 * @var Tx_CalendarDisplay_Domain_Model_Booking
	 */
	protected $fixture;

	public function setUp() {
		$this->fixture = new Tx_CalendarDisplay_Domain_Model_Booking();
	}

	public function tearDown() {
		unset($this->fixture);
	}
	
	
	/**
	 * @test
	 */
	public function getTimeBeginReturnsInitialValueForInteger() { 
		$this->assertSame(
			0,
			$this->fixture->getTimeBegin()
		);
	}

	/**
	 * @test
	 */
	public function setTimeBeginForIntegerSetsTimeBegin() { 
		$this->fixture->setTimeBegin(12);

		$this->assertSame(
			12,
			$this->fixture->getTimeBegin()
		);
	}
	
	/**
	 * @test
	 */
	public function getTimeEndReturnsInitialValueForInteger() { 
		$this->assertSame(
			0,
			$this->fixture->getTimeEnd()
		);
	}

	/**
	 * @test
	 */
	public function setTimeEndForIntegerSetsTimeEnd() { 
		$this->fixture->setTimeEnd(12);

		$this->assertSame(
			12,
			$this->fixture->getTimeEnd()
		);
	}
	
	/**
	 * @test
	 */
	public function getNoteReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setNoteForStringSetsNote() { 
		$this->fixture->setNote('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getNote()
		);
	}
	
	/**
	 * @test
	 */
	public function getResourcesReturnsInitialValueForObjectStorageContainingTx_CalendarDisplay_Domain_Model_Resource() { 
		$newObjectStorage = new Tx_Extbase_Persistence_ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->fixture->getResources()
		);
	}

	/**
	 * @test
	 */
	public function setResourcesForObjectStorageContainingTx_CalendarDisplay_Domain_Model_ResourceSetsResources() { 
		$resource = new Tx_CalendarDisplay_Domain_Model_Resource();
		$objectStorageHoldingExactlyOneResources = new Tx_Extbase_Persistence_ObjectStorage();
		$objectStorageHoldingExactlyOneResources->attach($resource);
		$this->fixture->setResources($objectStorageHoldingExactlyOneResources);

		$this->assertSame(
			$objectStorageHoldingExactlyOneResources,
			$this->fixture->getResources()
		);
	}
	
	/**
	 * @test
	 */
	public function addResourceToObjectStorageHoldingResources() {
		$resource = new Tx_CalendarDisplay_Domain_Model_Resource();
		$objectStorageHoldingExactlyOneResource = new Tx_Extbase_Persistence_ObjectStorage();
		$objectStorageHoldingExactlyOneResource->attach($resource);
		$this->fixture->addResource($resource);

		$this->assertEquals(
			$objectStorageHoldingExactlyOneResource,
			$this->fixture->getResources()
		);
	}

	/**
	 * @test
	 */
	public function removeResourceFromObjectStorageHoldingResources() {
		$resource = new Tx_CalendarDisplay_Domain_Model_Resource();
		$localObjectStorage = new Tx_Extbase_Persistence_ObjectStorage();
		$localObjectStorage->attach($resource);
		$localObjectStorage->detach($resource);
		$this->fixture->addResource($resource);
		$this->fixture->removeResource($resource);

		$this->assertEquals(
			$localObjectStorage,
			$this->fixture->getResources()
		);
	}
	
}
?>