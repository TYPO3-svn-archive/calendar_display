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
 * FeUser
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */

class Tx_CalendarDisplay_Domain_Model_FeUser extends Tx_Extbase_DomainObject_AbstractEntity {
	/**
	 * username
	 * 
	 * @var string $username
	 */
	protected $username;
	
	/**
	 * email
	 * 
	 * @var string $email
	 * @valivate EmailAddress
	 */
	protected $email;
	
	/**
	 * telephone
	 * 
	 * @var string $telephone
	 */
	protected $telephone;
	
	/**
	 * setter for username
	 * 
	 * @param string $username username
	 * @return void
	 */
	public function setUsername($username) {
		$this->username = $username;
	}
	
	/**
	 * getter for username
	 * 
	 * @return string useranem  
	 */
	public function getUsername() {
		return $this->username;
	} 

	/**
	 * setter for email
	 * 
	 * @param string $email email
	 * @return void
	 */
	public function setEmail($email) {
		$this->email = $email;
	}
	
	/**
	 * getter for email
	 * 
	 * @return string email  
	 */
	public function getEmail() {
		return $this->email;
	} 
	
	/**
	 * setter for telephone
	 * 
	 * @param string $telephone telephone
	 * @return void
	 */
	public function setTelephone($telephone) {
		$this->telephone = telephone;
	}
	
	/**
	 * getter for telephone
	 * 
	 * @return string telephone  
	 */
	public function getTelephone() {
		return $this->telephone;
	}
}
?>