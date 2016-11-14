<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
	<div class="list-panel">
		<a href="javascript:void(0);" class="grey-button">Соискателям</a><a href="javascript:void(0);" class="grey-button active">Работодателям</a>
		<a href="add/" class="green-button" style="float: right;">Добавить резюме</a>
		<div class="search-box-wrap">
			<div class="search-box">
				<input class="search-input" type="text" name="s" />
			</div>
			<input class="search-button" type="submit" value="Найти"/>
		</div>
	</div>

<div class="list-wrap">
<?foreach($arResult["ITEMS"] as $arItem){?>
	<div class="list-row">
			<div class="list-row-cell first">
				<a href="javascript:void(0);" class="top-block-image"></a>
			</div><div class="list-row-cell second">
				<p><b><?=$arItem["NAME"]?></b></p>
				<p><a href="javascript:void(0);">«Первый Бит»</a></p>
				<p class="grey">Склад</p>
			</div><div class="list-row-cell third">
				<p><b>от 15 000 руб.</b></p>
				<p class="grey">Сыктывкар</p>
			</div>
		</div>
<?}?>
	<center><a href="javascript:void(0);" class="grey-button">Показать еще</a></center>
</div>
