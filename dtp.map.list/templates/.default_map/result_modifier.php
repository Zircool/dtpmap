<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?php
	foreach($arResult['ITEMS'] as $k=>$arItem){
		if(!empty($arItem['PREVIEW_PICTURE'])){
			$arPic = CFile::ResizeImageGet($arItem['PREVIEW_PICTURE'],array("width"=>200, "height"=>200),BX_RESIZE_IMAGE_EXACT);
			$arResult['ITEMS'][$k]['PREVIEW_PICTURE']['SRC'] = $arPic['src'];
		}elseif(!empty($arItem['PROPERTIES']['IMG']['VALUE'][0])){
			$arPic = CFile::ResizeImageGet(CFile::GetFileArray($arItem['PROPERTIES']['IMG']['VALUE'][0]),array("width"=>200, "height"=>200),BX_RESIZE_IMAGE_PROPORTIONAL_ALT);
			$arResult['ITEMS'][$k]['PREVIEW_PICTURE']['SRC'] = $arPic['src'];
		}
		/*
		 * Генерируем баллун 
		 */
		$strImg ="";
		if(!empty($arResult['ITEMS'][$k]['PREVIEW_PICTURE']['SRC'])){
			$strImg = $arResult['ITEMS'][$k]['PREVIEW_PICTURE']['SRC'];
		}else{
			$strImg = SITE_TEMPLATE_PATH."/img/search-results-noimage.png";
		}
		$arResult['ITEMS'][$k]['BODY_YANDEX'] ='<div class="location-marker">'
		.'<div class="marker-event clearfix">'
		.'<span class="marker-photo"><a href="'.$arItem['DETAIL_PAGE_URL'].'"><img src="'.$strImg.'" alt="'.$arItem['NAME'].'"></a></span>'
		.'<span class="marker-date">'.date($DB->DateFormatToPHP(CSite::GetDateFormat("SHORT")), MakeTimeStamp($arItem['DATE_CREATE'])).'</span>'
		.'<span class="marker-location">'.$arItem['PROPERTY_49'].'</span>'
		.'</div>'
		.'<p>'
		.'<a href="'.$arItem['DETAIL_PAGE_URL'].'">'.$arItem['NAME'].'</a>'
		.'</p>'
		.'</div>';
	}
	
?>