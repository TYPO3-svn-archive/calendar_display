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
 * Repository for Tx_CalendarDisplay_Domain_Model_Resource
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */

 class Tx_CalendarDisplay_Domain_Repository_ResourceRepository extends Tx_Extbase_Persistence_Repository {

 	/**
	 * Gets resoureces following by $category and $$keyword
	 *
	 * @param integer $category Category
	 * @param string $keyword Keyword
	 * @return array of Tx_CalendarDisplay_Domain_Model_Resource
	 */
	public function filterItems($category = NULL, $keyword = '') {
		$query = $this->createQuery();
		if ($category) {
			$constraint = $query->equals('category', $category);
		}

		if ($keyword) {
			$constraintKeyword = $query->logicalOr($query->like('name', '%' . $keyword . '%'), $query->like('category.name', '%' . $keyword . '%'));
			if ($constraint) {
				$constraint = $query->logicalAnd($constraint, $constraintKeyword);
			} else {
				$constraint = $constraintKeyword;
			}
		}

		return $query->matching($constraint)
			->setOrderings(array('name' => Tx_Extbase_Persistence_QueryInterface::ORDER_ASCENDING))
			->execute();
	}
}
?>