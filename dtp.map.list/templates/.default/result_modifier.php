<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?php
	foreach($arResult['ITEMS'] as $k=>$arItem){
		if(!empty($arItem['PREVIEW_PICTURE'])){
			$arPic = CFile::ResizeImageGet($arItem['PREVIEW_PICTURE'],array("width"=>600, "height"=>300),BX_RESIZE_IMAGE_EXACT);
			$arResult['ITEMS'][$k]['PREVIEW_PICTURE']['SRC'] = $arPic['src'];
		}elseif(!empty($arItem['PROPERTIES']['IMG']['VALUE'][0])){
			$arPic = CFile::ResizeImageGet(CFile::GetFileArray($arItem['PROPERTIES']['IMG']['VALUE'][0]),array("width"=>600, "height"=>300),BX_RESIZE_IMAGE_PROPORTIONAL_ALT);
			$arResult['ITEMS'][$k]['PREVIEW_PICTURE']['SRC'] = $arPic['src'];
		}
	}
	
?>