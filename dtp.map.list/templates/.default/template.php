<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
?>
<?php if(!empty($arResult['ITEMS'])):?>
<div class="row">
		<?php foreach($arResult['ITEMS'] as $arItem):?>
		<?php
			$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
			$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
		?>
		<div class="col-xs-12 col-sm-4 col-md-6 col-lg-4 res-block" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
			<div class="search-results-item">
				<span class="search-results-photo <?if(empty($arItem['PREVIEW_PICTURE'])):?>no-image<?endif;?>"><a href="<?=$arItem['DETAIL_PAGE_URL']?>" title="<?=$arItem['NAME']?>"><img src="<?if(empty($arItem['PREVIEW_PICTURE'])):?><?=SITE_TEMPLATE_PATH?>/img/search-results-noimage.png<?else:?><?=$arItem['PREVIEW_PICTURE']['SRC']?><?endif;?>" alt="<?=$arItem['NAME']?>"></a></span>
				<span class="search-results-date" date="<?=MakeTimeStamp($arItem['PROPERTIES']['DATE']['VALUE'])?>"><?=FormatDate("x", MakeTimeStamp($arItem['PROPERTIES']['DATE']['VALUE']))?></span>
				<a href="<?=$arItem['DETAIL_PAGE_URL']?>"><?=$arItem['NAME']?></a>
				<span class="search-results-location"><a href="<?=$arItem['DETAIL_PAGE_URL']?>"><?=$arItem['PROPERTIES']['ADRESS']['VALUE']?></a></span>
			</div>
		</div>
		<?php endforeach;?>
</div>
<?=$arResult["NAV_STRING"]?>
<?php else:?>
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<div class="search-results-item text-center">
				<br>
				<h1>ПО ВАШЕМУ ЗАПРОСУ НИЧЕГО НЕ НАЙДЕНО</h1>
				<p>Введите другой запрос или воспользуйтесь фильтрами.</p>
			</div>
		</div>
	</div>
<?endif;?>


