<?php

/* * *************************************************************
 *  Copyright notice
 *
 *  (c) 2011 Fabien Udriot
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
 * ************************************************************* */

/**
 * View helper for rendering script
 *
 * = Examples =
 */
class Tx_CalendarDisplay_ViewHelpers_Display_BookedResourcesViewHelper extends Tx_Fluid_Core_ViewHelper_AbstractViewHelper {

	/**
	 * Define whether a resource should be displayed.
	 *
	 * @param Tx_CalendarDisplay_Domain_Model_Event $event
	 * @param Tx_CalendarDisplay_Domain_Model_Resource $resource
	 * @return boolean
	 */
	public function render($event, $resource) {
		$result = '0';

		if ($event) {
			$bookings = $event->getBooking();
			foreach ($bookings as $booking) {
				$_resource = $booking->getResources()->current();

				if ($_resource->getUid() == $resource->getUid()) {
					$result = $booking->getNumber();
					break;
				}
			}
		}
		return $result;
	}
}
?>