<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

Tx_Extbase_Utility_Extension::configurePlugin(
	$_EXTKEY,
	'Pi1',
	array(
		'Booking' => 'calendar, list, show, new, create, edit, update, delete, filterItems, filter',
		'Resource' => 'list, show, new, create, edit, update, filterItems, filter',
	),
	array(
		'Booking' => 'list, create, update, delete, categoryFilter',
		'Resource' => 'create, update, delete',
	)
);

?>