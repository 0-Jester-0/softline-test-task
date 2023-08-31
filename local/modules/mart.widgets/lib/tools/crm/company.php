<?php

namespace Mart\Widgets\Tools\Crm;

use Bitrix\Crm\CompanyTable;
use Bitrix\Crm\Widget\Data\Company\DataSource;
use Bitrix\Sale\Internals\EO_Company;

class Company
{
	/**
	 * Метод получения списка компаний с дополнительной фильтрацией и установкой лимита
	 *
	 * @param array $filter
	 * @param int $limit
	 * @return mixed
	 * @throws \Bitrix\Main\ArgumentException
	 * @throws \Bitrix\Main\SystemException
	 */
	public static function getCompanyListByFilter(array $filter = [], int $limit = 0)
	{
		$query = CompanyTable::query()->setSelect(["*"]);

		if ($filter) {
			$query->setFilter($filter);
		} elseif ($limit > 0) {
			$query->setLimit($limit);
		}

		$query->exec();
		return $query->fetchAll();
	}

	/**
	 * Метод генерации ссылки на просмотр детальной информации о компании
	 *
	 * @param array $company
	 * @return string
	 */
	public static function generateDetailUrl(array $company): string
	{
		return "/crm/company/details/{$company["ID"]}/";
	}
}