<?php B_PROLOG_INCLUDED === true || die();

IncludeModuleLangFile(__FILE__);

use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Application;
use Bitrix\Main\IO\Directory;


Loc::loadMessages(__FILE__);

class mart_widgets extends CModule
{
	const MODULE_ID = 'mart.widgets';
	var $MODULE_ID = 'mart.widgets';
	var $MODULE_VERSION;
	var $MODULE_VERSION_DATE;
	var $MODULE_NAME;
	var $MODULE_DESCRIPTION;
	var $PARTNER_NAME;
	var $PARTNER_URI;

	/**
	 * custom.widgets constructor.
	 *
	 * Конструктор модуля:
	 * Инициализация ключевых переменных для правильного отображения в административной панели
	 */
	public function __construct()
	{
		$arModuleVersion = [];
		include(dirname(__FILE__) . "/version.php");
		$this->MODULE_VERSION = $arModuleVersion["VERSION"];
		$this->MODULE_VERSION_DATE = $arModuleVersion["VERSION_DATE"];
		$this->MODULE_NAME = Loc::getMessage("MART.WIDGETS.MODULE_NAME");
		$this->MODULE_DESCRIPTION = Loc::getMessage("MART.WIDGETS.MODULE_DESC");

		$this->PARTNER_NAME = Loc::getMessage("MART.WIDGETS.PARTNER_NAME");
		$this->PARTNER_URI = Loc::getMessage("CUSTOM.WIDGETS.PARTNER_URI");
	}

	/**
	 * Метод для установки модуля
	 * Регистрируется модуль и производится установка файлов компонента
	 *
	 * @return void
	 */
	public function doInstall(): void
	{
		registerModule(static::MODULE_ID);
		$this->installFiles();
	}

	/**
	 * Метод деинсталяции модуля
	 * Удаление установленных файлов снятие модуля с регистрации
	 *
	 * @return void
	 */
	public function doUninstall(): void
	{
		$this->uninstallFiles();
		unRegisterModule(static::MODULE_ID);
	}

	/**
	 * Метод установки файлов модуля, а имено копирование их в директорию bitrix/components
	 *
	 * @return void
	 */
	public function installFiles(): void
	{
		$root = Application::getDocumentRoot();
		CopyDirFiles(
			__DIR__ . '/components',
			$root . '/bitrix/components/' . static::MODULE_ID,
			true,
			true
		);
	}

	/**
	 * Метод удаления файлов добавленных при установке
	 *
	 * @return void
	 */
	public function uninstallFiles(): void
	{
		$root = Application::getDocumentRoot();
		Directory::deleteDirectory($root . '/bitrix/components/' . static::MODULE_ID);
	}
}