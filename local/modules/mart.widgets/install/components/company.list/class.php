<?php

use Bitrix\Main\ArgumentException;
use Bitrix\Main\ArgumentNullException;
use Bitrix\Main\Config\Option;
use Bitrix\Main\ModuleManager;
use Bitrix\Main\SystemException;
use Mart\Widgets\Tools\Crm\Company;

/**
 * Класс компонента наследованный от CBitrixComponent
 */
class CompanyList extends CBitrixComponent
{
	/**
	 * Назавние модуля
	 * Вынесено в константу из-за частого использования в рамках компонента
	 */
	const MODULE_NAME = "mart.widgets";

	/**
	 * Главный метод компонента отвечающий за его исполнение
	 *
	 * @return void
	 * @throws ArgumentNullException
	 * @throws SystemException
	 */
	public function executeComponent(): void
	{
		$this->prepareComponentParams();
		$this->fillResultData();
		$this->includeComponentTemplate();
	}

	/**
	 * Инициализация параметров компонента с помощью настроек модуля
	 *
	 * @return void
	 * @throws ArgumentNullException
	 * @throws SystemException
	 */
	public function prepareComponentParams(): void
	{
		if (ModuleManager::isModuleInstalled(static::MODULE_NAME)) {
			$moduleOptions = Option::getForModule(static::MODULE_NAME);
			$this->arParams = [
				"QUANTITY_ELEMENTS" => $moduleOptions["quantity"],
				"ACTIVITY" => $moduleOptions["activity"],
				"BLOCK_HEIGHT" => $moduleOptions["block_height"],
			];
		} else {
			throw new SystemException("Module " . static::MODULE_NAME . " is not installed");
		}
	}

	/**
	 * Метод заполения результирующего массива данных с пробросом параметров из настроек модуля
	 *
	 * @return void
	 * @throws SystemException
	 * @throws ArgumentException
	 */
	public function fillResultData(): void
	{
		$this->arResult["COMPANY_LIST"] = Company::getCompanyListByFilter([], $this->arParams["QUANTITY_ELEMENTS"]);
		foreach ($this->arResult["COMPANY_LIST"] as &$company) {
			$company["URL"] = Company::generateDetailUrl($company); //Добавление каждой компании ссылки на детальную страницу
		}
	}
}