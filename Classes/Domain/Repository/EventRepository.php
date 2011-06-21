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
 * Repository for Tx_CalendarDisplay_Domain_Model_Event
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */

 class Tx_CalendarDisplay_Domain_Repository_EventRepository extends Tx_Extbase_Persistence_Repository {
 	/**
	 * Gets events following by $category and $keyword
	 *
	 * @param integer $category Category
	 * @param string $keyword Keyword
	 * @return array of Tx_CalendarDisplay_Domain_Model_Event
	 */
	public function filter($category = NULL, $keyword = '', $timeBegin = NULL) {
		$query = $this->createQuery();
		if ($category) {
			$constraint = $query->equals('booking.resources.category', $category);
		}

		if ($keyword) {
			$constraintKeyword = $query->logicalOr($query->like('note', '%' . $keyword . '%'), $query->like('booking.resources.name', '%' . $keyword . '%'));
			if ($constraint) {
				$constraint = $query->logicalAnd($constraint, $constraintKeyword);
			} else {
				$constraint = $constraintKeyword;
			}
		}

		if ($timeBegin) {

			$constraintTime = $query->greaterThanOrEqual('time_begin',  strtotime($timeBegin));
			if ($constraint) {
				$constraint = $query->logicalAnd($constraint, $constraintTime);
			} else {
				$constraint = $constraintTime;
			}
		}

		return $query->matching($constraint)
			->setOrderings(array('time_begin' => Tx_Extbase_Persistence_QueryInterface::ORDER_ASCENDING))
			->execute();
	}

	/**
	 * Gets all events which has start from the $timeBegin
	 *
	 * @param integer $timeBegin Unix timestamp
	 * @return array of Tx_CalendarDisplay_Domain_Model_Event
	 */
 	public function findAllByTimeBegin($timeBegin) {
		$query = $this->createQuery();
		$constraint = $query->greaterThanOrEqual('time_begin', $timeBegin);

		return $query->matching($constraint)
			->setOrderings(array('time_begin' => Tx_Extbase_Persistence_QueryInterface::ORDER_ASCENDING))
			->execute();
	}

 	/**
	 * Gets all events which has start from the $timeEnd
	 *
	 * @param integer $timeEnd Unix timestamp
	 * @return array of Tx_CalendarDisplay_Domain_Model_Event
	 */
 	public function findAllByTimeEnd($timeEnd) {
		$query = $this->createQuery();
		$constraint = $query->greaterThanOrEqual('time_end', $timeEnd);

		return $query->matching($constraint)
					->setOrderings(array('time_begin' => Tx_Extbase_Persistence_QueryInterface::ORDER_ASCENDING))
					->execute();
	}

 	/**
	 * Gets all events which as start from the $timeEnd
	 *
	 * @param integer $timeBegin Unix timestamp
	 * @param integer $timeEnd Unix timestamp
	 * @return array of Tx_CalendarDisplay_Domain_Model_Event
	 */
 	public function findAllByTimeRange($timeBegin, $timeEnd) {

		$query = $this->createQuery();
		$constraint = array();
		$constraint = $query->logicalAnd(
			$query->greaterThanOrEqual('time_begin', $timeBegin),
			$query->lessThanOrEqual('time_end', $timeEnd)
		);

		return $query->matching($constraint)
					->setOrderings(array('time_begin' => Tx_Extbase_Persistence_QueryInterface::ORDER_ASCENDING))
					->execute();
	}
}
?>