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
 * Validator for Tx_CalendarDisplay_Domain_Model_Event
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class Tx_CalendarDisplay_Domain_Validator_EventValidator extends Tx_Extbase_Validation_Validator_AbstractValidator {

	/**
	 * If the given blog is valid
	 *
	 * @param Tx_CalendarDisplay_Domain_Model_Event $newEvent
	 * @return boolean true
	 */
	public function isValid($newEvent) {
		$isValid = true;
		if ($newEvent->getTimeBegin() == NULL || $newEvent->getTimeBegin() == '') {
			$this->addError(Tx_Extbase_Utility_Localization::translate('tx_calendardisplay_domain_model_event.time_begin.required', 'CalendarDisplay'), 2);
			$isValid = false;
		}
		if ($newEvent->getTimeEnd() == NULL || $newEvent->getTimeEnd() == '') {
			$this->addError(Tx_Extbase_Utility_Localization::translate('tx_calendardisplay_domain_model_event.time_end.required', 'CalendarDisplay'), 2);
			$isValid = false;
		}
		if ($newEvent->getTimeBegin() >= $newEvent->getTimeEnd()) {
			$this->addError(Tx_Extbase_Utility_Localization::translate('tx_calendardisplay_domain_model_event.time_begin_end_rank', 'CalendarDisplay'), 2);
			$isValid = false;
		}
		return $isValid;
	}

}
?>