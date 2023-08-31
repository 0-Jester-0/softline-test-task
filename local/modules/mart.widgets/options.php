<?php defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED === true ?: die();

use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Loader;

Loc::loadMessages(__FILE__);

global $APPLICATION, $USER;

$module_id = "mart.widgets";
Loader::includeModule($module_id);

/**
 * Массив настроек модуля для дальнейшего рендеринга в административной панели
 *
 * @var array $options
 */
$options = [
	"general" => [
		Loc::getMessage("MART.WIDGETS.WIDGETS_SETTINGS"),
		[
			"activity",
			Loc::getMessage("MART.WIDGETS.ACTIVITY"),
			"",
			["checkbox"]
		],
        [
			"quantity",
			Loc::getMessage("MART.WIDGETS.QUANTITY_ELEMENTS"),
			"",
			["text", 3]
        ],
		[
			"block_height",
			Loc::getMessage("MART.WIDGETS.BLOCK_HEIGHT"),
			"",
			["text", 3]
		]
	],
];

/**
 * Массив с информацией о табах в настройках модуля
 *
 * @var array $tabs
 */
$tabs = [
	[
		"DIV" => "general",
		"TAB" => Loc::getMessage("MART.WIDGETS.TAB_GENERAL"),
		"TITLE" => Loc::getMessage("MART.WIDGETS.TAB_GENERAL")
	],
];

/** Сохранение значений полей в настройках модуля */
if ($USER->IsAdmin()) {
	if (check_bitrix_sessid() && strlen($_POST["save"]) > 0) {
		foreach ($options as $option) {
			__AdmSettingsSaveOptions($module_id, $option);
		}
		LocalRedirect($APPLICATION->GetCurPageParam());
	}
}

/**
 * Инициализация табов с настройками модуля
 * @var CAdminTabControl $tabControl
 */
$tabControl = new CAdminTabControl("tabControl", $tabs);
$tabControl->Begin();
?>

<!-- Форма с настройками модуля в административной панели -->
<form method="POST"
      action="<?php echo $APPLICATION->GetCurPage() ?>?mid=<?= htmlspecialcharsbx($mid) ?>&lang=<?= LANGUAGE_ID ?>">
	<?php $tabControl->BeginNextTab(); ?>
	<?php __AdmSettingsDrawList($module_id, $options["general"]); ?>
	<?php $tabControl->Buttons(array("btnApply" => false, "btnCancel" => false, "btnSaveAndAdd" => false)); ?>
	<?= bitrix_sessid_post(); ?>
	<?php $tabControl->End(); ?>
</form>
