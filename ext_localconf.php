<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

Tx_Extbase_Utility_Extension::configurePlugin(
	$_EXTKEY,
	'Pi1',
	array(
		'Booking' => 'calendar, list, show, new, create, edit, update, delete',
		'Resource' => 'list, show, new, create, edit, update, delete',
	),
	array(
		'Booking' => 'list, create, update, delete',
		'Resource' => 'create, update, delete',
	)
);

?>