<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

foreach($arResult['ITEMS'] as $arItem):

if(isZir()){	//echo "<pre>"; print_r($arItem); echo "</pre>";
}


$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
?>
<div class="list-row" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
	<div class="list-row-cell first">
		<?if(is_array($arItem['FIELDS']['PREVIEW_PICTURE'])):?>
			<?if(!empty($arItem['FIELDS']['PREVIEW_PICTURE']['ID'])):?>
				<?	$PP = CFile::ResizeImageGet($arItem['FIELDS']['PREVIEW_PICTURE'], array('width'=>80, 'height'=>80), BX_RESIZE_IMAGE_PROPORTIONAL, true);?>
				<a href="javascript:void(0);" style="background:url('<?=$PP['src']?>') no-repeat center center;background-size: 80px auto;" class="top-block-image"></a>
			<?else:?>
				<a href="javascript:void(0);" class="top-block-image"></a>
			<?endif;?>
	 	<?else:?>
	 		<a href="javascript:void(0);" class="top-block-image"></a>
	  	<?endif;?>
	</div><div class="list-row-cell second">
		<p><a href="<?=$arItem['DETAIL_PAGE_URL']?>"><b><?=$arItem['NAME']?></b></a></p>
		<?if(is_array($arItem['DISPLAY_PROPERTIES']['COMPANY'])):?>
			<?if(!empty($arItem['DISPLAY_PROPERTIES']['COMPANY']['VALUE'])):?>
				<p><a href="javascript:void(0);"><?=$arResult['PROP_ELEMENT'][$arItem['DISPLAY_PROPERTIES']['COMPANY']['VALUE']]?></a></p>
			<?endif;?>
		<?endif;?>
		<p class="grey"></p>
	</div><div class="list-row-cell third">
		<p><b>
		<?if(is_array($arItem['DISPLAY_PROPERTIES']['BUDGET'])):?>
			<?if($arItem['DISPLAY_PROPERTIES']['BUDGET']['VALUE'] > 0 ):?>
				<?if (CModule::IncludeModule("sale")):?>
				от  <?=SaleFormatCurrency($arItem['DISPLAY_PROPERTIES']['BUDGET']['VALUE'], "RUB")?>
				<?else:?>
				от  <?=$arItem['DISPLAY_PROPERTIES']['BUDGET']['VALUE']?> руб.
				<?endif;?>
			<?endif;?>
		<?endif;?>

		<?if(is_array($arItem['DISPLAY_PROPERTIES']['COST'])):?>
			<?if($arItem['DISPLAY_PROPERTIES']['COST']['VALUE'] > 0 ):?>
				<?if (CModule::IncludeModule("sale")):?>
				до  <?=SaleFormatCurrency($arItem['DISPLAY_PROPERTIES']['COST']['VALUE'], "RUB")?>
				<?else:?>
				до  <?=$arItem['DISPLAY_PROPERTIES']['COST']['VALUE']?> руб.
				<?endif;?>
			<?endif;?>
		<?endif;?>

		</b></p>
		<?if(is_array($arItem['DISPLAY_PROPERTIES']['REGION'])):?>
			<?if(!empty($arItem['DISPLAY_PROPERTIES']['REGION']['VALUE'])):?>
				<p class="grey"><?=$arItem['DISPLAY_PROPERTIES']['REGION']['VALUE']?></p>
			<?endif;?>
		<?endif;?>
	</div>
</div>

<?endforeach;?>