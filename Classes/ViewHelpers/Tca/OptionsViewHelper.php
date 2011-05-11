<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2010 Franz Koch <typo3@elements-net.de>, Koch & Koch GbR
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
 * Is fetching property values from TCA
 *
 * @license http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public License, version 3 or later
 */
class Tx_CalendarDisplay_ViewHelpers_Tca_OptionsViewHelper extends Tx_Fluid_Core_ViewHelper_AbstractViewHelper {
	/**
	 * Is returning select values for a property of category or its value
	 * 
	 * @param mixed $value The value of category 
	 * @return mixed The select options as array or the value of category
	 */
	public function render($value = NULL) {   		
		$tableName = 'tx_calendardisplay_domain_model_resource';
		$columnName = 'category';
		global $GLOBALS;
   		t3lib_div::loadTCA($tableName);   		
		$selectOptions = array();
		$columnConfig = $GLOBALS['TCA'][$tableName]['columns'][$columnName]['config'];
		if ($columnConfig['type'] == 'select' && count($columnConfig['items']) && !$columnConfig['foreign_table']) {
			foreach ($columnConfig['items'] as $option) {
				$selectOptions[$option[1]] = Tx_Extbase_Utility_Localization::translate($option[0], $this->controllerContext->getRequest()->getControllerExtensionName());
			}
		}
		
		return $value ? $selectOptions[$value] : $selectOptions; 
	}
}


?>