<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
<?php
	global $APPLICATION;
	$APPLICATION->SetTitle("Социальный аналитический центр дорожных происшествий | Страница не найдена");
	//$APPLICATION->RestartBuffer();
	CHTTP::SetStatus("404 Not Found");
?>
<div class="form-section">
	<div class="section-heading text-center">
		<h1>404 ОШИБКА!</h1>
		<p>Запрашиваемая Вами страница на сайте не найдена.Возможно, Вы ошиблись в URL адресе страницы или ссылка, по которой вы перешли, содержала опечатку.</p>
	</div>
</div>