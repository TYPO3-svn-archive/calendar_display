<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

$TCA['tx_calendardisplay_domain_model_booking'] = array(
	'ctrl' => $TCA['tx_calendardisplay_domain_model_booking']['ctrl'],
	'interface' => array(
		'showRecordFieldList'	=> 'resources,number',
	),
	'types' => array(
		'1' => array('showitem'	=> 'resources,number'),
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
		'resources' => array(
			'exclude'	=> 0,
			'label'		=> 'LLL:EXT:calendar_display/Resources/Private/Language/locallang_db.xml:tx_calendardisplay_domain_model_booking.resources',
			'config'	=> array(
				'type' => 'select',
				'foreign_table' => 'tx_calendardisplay_domain_model_resource',
				'MM' => 'tx_calendardisplay_booking_resource_mm',
				'size' => 1,
				'minitems' => 1,
				'maxitems' => 1,
				'wizards' => array(
					'_PADDING' => 1,
					'_VERTICAL' => 0,
					'edit' => array(
						'type' => 'popup',
						'title' => 'Edit',
						'script' => 'wizard_edit.php',
						'icon' => 'edit2.gif',
						'popup_onlyOpenIfSelected' => 1,
						'JSopenParams' => 'height=350,width=580,status=0,menubar=0,scrollbars=1',
						),
					'add' => Array(
						'type' => 'script',
						'title' => 'Create new',
						'icon' => 'add.gif',
						'params' => array(
							'table'=>'tx_calendardisplay_domain_model_resource',
							'pid' => '###CURRENT_PID###',
							'setValue' => 'prepend'
							),
						'script' => 'wizard_add.php',
					),
				),
			),
		),
		'number' => array(
			'exclude'	=> 0,
			'label'		=> 'LLL:EXT:calendar_display/Resources/Private/Language/locallang_db.xml:tx_calendardisplay_domain_model_booking.number',
			'config'	=> array(
				'type' => 'input',
				'size' => 4,
				'eval' => 'int,required',
			),
		),		
		'event' => array(
			'config' => array(
				'type'	=> 'passthrough',
			),
		),
	),
);
?>