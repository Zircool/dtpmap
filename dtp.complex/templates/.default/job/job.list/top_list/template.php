<?  if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();  ?>
<?
foreach($arResult['ITEMS'] as $arItem):

?>
	<div class="top-block">
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
		<a href="<?=$arItem['DETAIL_PAGE_URL']?>" class="top-block-name"><?=$arItem['NAME']?></a>
	</div>
<?endforeach;?>
