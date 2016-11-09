<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();

/*
 *  Параметры 
 */

$APPLICATION->AddHeadScript("//api-maps.yandex.ru/2.1/?load=package.full&lang=ru-RU", true);
$APPLICATION->AddHeadScript("/bitrix/templates/dtpmap/js/dropzone.js", true);
$APPLICATION->SetAdditionalCSS("/bitrix/templates/dtpmap/css/dropzone.css");

 
if(!CModule::IncludeModule("iblock")){
		return;
	}
	
	

	$arSelect = Array("ID", "NAME", "PREVIEW_TEXT","DETAIL_TEXT","PROPERTY_LAT","PROPERTY_LNG","DETAIL_PICTURE");
	$arFilter = Array("IBLOCK_ID"=>11,"ACTIVE"=>"Y","ACTIVE_DATE"=>"Y");
	$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>20), $arSelect);
	while($ar = $res->GetNext())
	{
		$ar['PIC'] = CFile::GetPath($ar["DETAIL_PICTURE"]);
		$ar['TEXT'] = str_replace ('\r\n',' ',$ar['DETAIL_TEXT']);
		$arResult['ITEMS'][] = $ar;
	}
	
	
	

//самое интересное - в шаблоне компонента
$this->IncludeComponentTemplate();
?>