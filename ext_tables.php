<?php
if (!defined ('TYPO3_MODE')) die ('Access denied.');


Tx_Extbase_Utility_Extension::registerPlugin(
	$_EXTKEY,
	'Pi1',
	'Calendar Display'
);

//$TCA['tt_content']['types']['list']['subtypes_addlist'][$_EXTKEY . '_pi1'] = 'pi_flexform';
//t3lib_extMgm::addPiFlexFormValue($_EXTKEY . '_pi1', 'FILE:EXT:' . $_EXTKEY . '/Configuration/FlexForms/flexform_pi1.xml');





t3lib_extMgm::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'Calendar Display');




t3lib_extMgm::addLLrefForTCAdescr('tx_calendardisplay_domain_model_resource', 'EXT:calendar_display/Resources/Private/Language/locallang_csh_tx_calendardisplay_domain_model_resource.xml');
t3lib_extMgm::allowTableOnStandardPages('tx_calendardisplay_domain_model_resource');
$TCA['tx_calendardisplay_domain_model_resource'] = array (
	'ctrl' => array (
		'title'             => 'LLL:EXT:calendar_display/Resources/Private/Language/locallang_db.xml:tx_calendardisplay_domain_model_resource',
		'label' 			=> 'name',
		'tstamp' 			=> 'tstamp',
		'crdate' 			=> 'crdate',
		'versioningWS' 		=> 2,
		'versioning_followPages'	=> TRUE,
		'origUid' 			=> 't3_origuid',
		'languageField' 	=> 'sys_language_uid',
		'transOrigPointerField' 	=> 'l18n_parent',
		'transOrigDiffSourceField' 	=> 'l18n_diffsource',
		'delete' 			=> 'deleted',
		'enablecolumns' 	=> array(
			'disabled' => 'hidden'
			),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/Resource.php',
		'iconfile' 			=> t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_calendardisplay_domain_model_resource.gif'
	)
);

t3lib_extMgm::addLLrefForTCAdescr('tx_calendardisplay_domain_model_event', 'EXT:calendar_display/Resources/Private/Language/locallang_csh_tx_calendardisplay_domain_model_event.xml');
t3lib_extMgm::allowTableOnStandardPages('tx_calendardisplay_domain_model_event');
$TCA['tx_calendardisplay_domain_model_event'] = array (
	'ctrl' => array (
		'title'             => 'LLL:EXT:calendar_display/Resources/Private/Language/locallang_db.xml:tx_calendardisplay_domain_model_event',
		'label' 			=> 'time_begin',
		'tstamp' 			=> 'tstamp',
		'crdate' 			=> 'crdate',
		'delete' 			=> 'deleted',
		'enablecolumns' 	=> array(
			'disabled' => 'hidden'
			),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/Event.php',
		'iconfile' 			=> t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_calendardisplay_domain_model_event.gif'
	)
);

t3lib_extMgm::addLLrefForTCAdescr('tx_calendardisplay_domain_model_booking', 'EXT:calendar_display/Resources/Private/Language/locallang_csh_tx_calendardisplay_domain_model_booking.xml');
t3lib_extMgm::allowTableOnStandardPages('tx_calendardisplay_domain_model_booking');
$TCA['tx_calendardisplay_domain_model_booking'] = array (
	'ctrl' => array (
		'title'             => 'LLL:EXT:calendar_display/Resources/Private/Language/locallang_db.xml:tx_calendardisplay_domain_model_booking',
		'label' 			=> 'event',
		'tstamp' 			=> 'tstamp',
		'crdate' 			=> 'crdate',
		'delete' 			=> 'deleted',
		'enablecolumns' 	=> array(
			'disabled' => 'hidden'
			),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/Booking.php',
		'iconfile' 			=> t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_calendardisplay_domain_model_booking.gif'
	)
);

?>