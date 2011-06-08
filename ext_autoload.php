<?php
/* 
 * Register necessary class names with autoloader
 *
 * $Id: ext_autoload.php 38265 2010-09-16 18:36:46Z francois $
 */
$extensionPath = t3lib_extMgm::extPath('calendar_display');
return array(
	'tx_calendardisplay_viewhelpers_scriptviewhelper' => $extensionPath . 'Classes/ViewHelpers/ScriptViewHelper.php',
);
?>
