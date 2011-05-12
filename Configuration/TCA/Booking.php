<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

$TCA['tx_calendardisplay_domain_model_booking'] = array(
	'ctrl' => $TCA['tx_calendardisplay_domain_model_booking']['ctrl'],
	'interface' => array(
		'showRecordFieldList'	=> 'time_begin,time_end,note,purchaser,itembooking',
	),
	'types' => array(
		'1' => array('showitem'	=> 'time_begin,time_end,note,purchaser,itembooking'),
	),
	'palettes' => array(
		'1' => array('showitem'	=> ''),
	),
	'columns' => array(
		'sys_language_uid' => array(
			'exclude'			=> 1,
			'label'				=> 'LLL:EXT:lang/locallang_general.php:LGL.language',
			'config'			=> array(
				'type'					=> 'select',
				'foreign_table'			=> 'sys_language',
				'foreign_table_where'	=> 'ORDER BY sys_language.title',
				'items' => array(
					array('LLL:EXT:lang/locallang_general.php:LGL.allLanguages', -1),
					array('LLL:EXT:lang/locallang_general.php:LGL.default_value', 0)
				),
			)
		),
		'l18n_parent' => array(
			'displayCond'	=> 'FIELD:sys_language_uid:>:0',
			'exclude'		=> 1,
			'label'			=> 'LLL:EXT:lang/locallang_general.php:LGL.l18n_parent',
			'config'		=> array(
				'type'			=> 'select',
				'items'			=> array(
					array('', 0),
				),
				'foreign_table' => 'tx_calendardisplay_domain_model_booking',
				'foreign_table_where' => 'AND tx_calendardisplay_domain_model_booking.uid=###REC_FIELD_l18n_parent### AND tx_calendardisplay_domain_model_booking.sys_language_uid IN (-1,0)',
			)
		),
		'l18n_diffsource' => array(
			'config'		=>array(
				'type'		=>'passthrough',
			)
		),
		't3ver_label' => array(
			'displayCond'	=> 'FIELD:t3ver_label:REQ:true',
			'label'			=> 'LLL:EXT:lang/locallang_general.php:LGL.versionLabel',
			'config'		=> array(
				'type'		=>'none',
				'cols'		=> 27,
			)
		),
		'hidden' => array(
			'exclude'	=> 1,
			'label'		=> 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
			'config'	=> array(
				'type'	=> 'check',
			)
		),
		'time_begin' => array(
			'exclude'	=> 0,
			'label'		=> 'LLL:EXT:calendar_display/Resources/Private/Language/locallang_db.xml:tx_calendardisplay_domain_model_booking.time_begin',
			'config'	=> array(
				'type' => 'input',
				'size' => 10,
				'max' => 20,
				'eval' => 'datetime,required',
				'checkbox' => 0,
				'default' => 0
			),
		),
		'time_end' => array(
			'exclude'	=> 0,
			'label'		=> 'LLL:EXT:calendar_display/Resources/Private/Language/locallang_db.xml:tx_calendardisplay_domain_model_booking.time_end',
			'config'	=> array(
				'type' => 'input',
				'size' => 10,
				'max' => 20,
				'eval' => 'datetime,required',
				'checkbox' => 0,
				'default' => 0
			),
		),
		'note' => array(
			'exclude'	=> 0,
			'label'		=> 'LLL:EXT:calendar_display/Resources/Private/Language/locallang_db.xml:tx_calendardisplay_domain_model_booking.note',
			'config'	=> array(
				'type' => 'text',
				'cols' => 40,
				'rows' => 15,
				'eval' => 'trim'
			),
		),
		'purchaser' => array(
			'exclude' => 0,
			'label'		=> 'LLL:EXT:calendar_display/Resources/Private/Language/locallang_db.xml:tx_calendardisplay_domain_model_booking.purchaser',
			'config'  => array(
				'type' => 'select',
				'foreign_table' => 'fe_users',
				'foreign_table_where' => 'AND fe_users.deleted=0 ORDER BY fe_users.username ASC',
				'size' => 1,
				'minitems' => 1,
				'maxitems' => 1,
			)
		),		
		'itembooking' => array(
			'exclude'	=> 0,
			'label'		=> 'LLL:EXT:calendar_display/Resources/Private/Language/locallang_db.xml:tx_calendardisplay_domain_model_booking.item_booking',
			'config'	=> array(
				'type' => 'inline',
				'foreign_table' => 'tx_calendardisplay_domain_model_itembooking',
				'foreign_field' => 'booking',
				'maxitems'      => 9999,
				'appearance' => array(
					'collapse' => 0,
					'newRecordLinkPosition' => 'bottom',
					'showSynchronizationLink' => 1,
					'showPossibleLocalizationRecords' => 1,
					'showAllLocalizationLink' => 1
				),
			),
		),
	),
);
?>