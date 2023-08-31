<?php B_PROLOG_INCLUDED === true || die();

use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

$arComponentDescription = [
	"NAME" => Loc::getMessage("MART.WIDGETS_COMPANY_LIST_NAME"),
	"DESCRIPTION" => Loc::getMessage("MART.WIDGETS_COMPANY_LIST_DESC"),
	"PATH" => [
		"ID" => "mart.widgets",
		"NAME" => Loc::getMessage("MART_WIDGETS"),
	],
];
