<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

Tx_Extbase_Utility_Extension::configurePlugin(
	$_EXTKEY,
	'Pi1',
	array(
		'Event' => 'calendar, list, show, new, create, edit, update, delete, filterItems, filter',
		'Booking' => '',
		'Resource' => 'list, show, new, create, edit, update, filterItems, filter',
	),
	array(
		'Event' => 'list, create, update, delete, categoryFilter',
		'Booking' => '',
		'Resource' => 'create, update, delete',
	)
);

?>