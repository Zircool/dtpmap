<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?php

$arWaterMark = Array(
	array(
	"name" => "watermark",
	"position" => "topleft", // Положение
	"type" => "image",
	"size" => "real",
	"file" => $_SERVER["DOCUMENT_ROOT"] . '/upload/watermark.png', // Путь к картинке
	"fill" => "exact",
	"precision" => 100,
    )
);

if(!empty($arResult['PROPERTIES']['IMG']['VALUE'])){
	foreach($arResult['PROPERTIES']['IMG']['VALUE'] as $fid){
		$arImg = CFile::GetFileArray($fid);

		if($arImg['WIDTH']> 905){
			$arResize = CFile::ResizeImageGet($arImg, array('width'=>905, 'height'=>1205), BX_RESIZE_IMAGE_PROPORTIONAL, true,$arWaterMark);
			$arResize['SRC'] = $arResize['src'];
			$arImg = $arResize;
		}else{
			$arImg['WIDTH'] = $arImg['WIDTH'] -1;
			$arImg['HEIGHT'] = $arImg['HEIGHT']-1;
			$arResize = CFile::ResizeImageGet($arImg, array('width'=>$arImg['WIDTH'], 'height'=>$arImg['HEIGHT']), BX_RESIZE_IMAGE_PROPORTIONAL, true,$arWaterMark);
			$arResize['SRC'] = $arResize['src'];
			$arImg = $arResize;
		}
		$arResult['IMG'][$fid] = $arImg;
		
	}
}


if(!empty($arResult['TAGS'])){
	$arResult['ARRAY_TAGS'] = explode(",", $arResult['TAGS']);
	array_map('trim', $arResult['ARRAY_TAGS']);
}



$this->__component->SetResultCacheKeys(array(
	"NAME",
	"PREVIEW_TEXT",
	"IMG",
	"DETAIL_PAGE_URL",
	"IPROPERTY_VALUES",
	"TIMESTAMP_X"
));


?>