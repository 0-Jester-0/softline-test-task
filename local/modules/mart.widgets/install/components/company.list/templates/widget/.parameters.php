<?php B_PROLOG_INCLUDED === true || die();

use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

if(!CModule::IncludeModule('mart.widgets'))
	return false;

/**
 * Определение параметров компонента
 *
 * @var array $arComponentParameters
 */
$arComponentParameters = [
	'GROUPS' => [
		'BASE' => Loc::getMessage("MART.WIDGETS_COMPANY_LIST_BASE_SETTINGS")
	],
	'PARAMETERS' => [
		'QUANTITY_ELEMENTS' => [
			'PARENT' => 'BASE',
			'NAME' => Loc::getMessage('MART.WIDGETS_COMPANY_LIST_QUANTITY_PARAM_NAME'),
			"TYPE" => "STRING",
		],
		'ACTIVITY' => [
			'PARENT' => 'BASE',
			'NAME' => Loc::getMessage('MART.WIDGETS_COMPANY_LIST_ACTIVITY_PARAM_NAME'),
			"TYPE" => "BOOL",
		],
		'BLOCK_HEIGHT' => [
			'PARENT' => 'BASE',
			'NAME' => Loc::getMessage('MART.WIDGETS_COMPANY_LIST_BLOCK_HEIGHT_PARAM_NAME'),
			"TYPE" => "STRING",
		],
		'NAME_TEMPLATE' => [
			'TYPE' => 'LIST',
			'NAME' => Loc::getMessage('MART.WIDGETS_TEMPLATE_NAME'),
			'VALUES' => CComponentUtil::GetDefaultNameTemplates(),
			'MULTIPLE' => 'N',
			'ADDITIONAL_VALUES' => 'Y',
			'DEFAULT' => '',
			'PARENT' => 'BASE',
		]
	]
];
