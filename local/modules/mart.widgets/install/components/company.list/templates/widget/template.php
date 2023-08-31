<?php defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED === true ?: die();

/** @var array $arResult */
/** @var array $arParams */

/** Проверка настройки активности взятой из модуля */
if ($arParams["ACTIVITY"] === "Y"):
	$this->setFrameMode(true);
	$this->SetViewTarget("sidebar", 100);
	$frame = $this->createFrame()->begin();
	$this->addExternalCss(SITE_TEMPLATE_PATH . "/css/sidebar.css");

	/**
	 * Подключение стилей bootstrap 5 с помощью bitrix
	 * В идеале bootstrap подключать в шапке шаблона сайта, в данной ситуации можно обойтись и таким подключением
	 *
	 * Также был вариант обойтись битриксовыми стилями
	 */
	$this->addExternalCss("/local/vendor/css/bootstrap.min.css");
	$this->addExternalJs("/local/vendor/js/bootstrap.min.js")
	?>
    <div class="accordion accordion-flush mb-3" id="accordionFlushExample">
        <div class="accordion-item">
            <h2 class="accordion-header mb-0" id="flush-headingOne">
                <button class="accordion-button bg-gradient p-3 collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                    Список компаний
                </button>
            </h2>
            <div id="flush-collapseOne"
                 class="accordion-collapse accordion-body list-group list-group-flush p-0 collapse"
                 aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                <!-- Вывод списка компаний полученного в компоненте -->
				<?php foreach ($arResult["COMPANY_LIST"] as $company): ?>
                    <a href="<?= $company["URL"] ?>"
                       class="list-group-item list-group-item-action list-group-item-primary"
                       style="height: <?= $arParams["BLOCK_HEIGHT"] ?>px">
						<?= $company["TITLE"] ?>
                    </a>
				<?php endforeach; ?>
            </div>
        </div>
    </div>
	<?php
	$frame->end();
	$this->EndViewTarget();
endif;
