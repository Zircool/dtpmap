<?php if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
GLOBAL $lastModified;
//if (!$lastModified){
//	$lastModified = MakeTimeStamp($arResult['TIMESTAMP_X']);
//}else{
//	$lastModified = max($lastModified, MakeTimeStamp($arResult['TIMESTAMP_X']));
//}

$first_img = array_shift($arResult["IMG"]); 

$APPLICATION->AddHeadString('<link href="https://'.SITE_SERVER_NAME.$arResult['DETAIL_PAGE_URL'].'" rel="canonical" />',true);
$APPLICATION->AddHeadString('<link href="https://'.SITE_SERVER_NAME.$arResult['DETAIL_PAGE_URL'].'" rel="amphtml" />',true);

$APPLICATION->AddHeadString('<meta property="og:type" content="website"/>');
$APPLICATION->AddHeadString('<meta property="og:site_name" content="Социальный аналитический центр дорожных происшествий "/>');
$APPLICATION->AddHeadString('<meta property="og:title" content="' . $arResult["IPROPERTY_VALUES"]["ELEMENT_META_TITLE"] . '" />');
$APPLICATION->AddHeadString('<meta property="og:url" content="' . $arResult["DETAIL_PAGE_URL"] . '" />');
$APPLICATION->AddHeadString('<meta property="og:description" content="' . $arResult["IPROPERTY_VALUES"]["ELEMENT_META_DESCRIPTION"] . '" />');
$APPLICATION->AddHeadString('<meta property="og:image" content="' . $first_img["SRC"] . '" />');
?>