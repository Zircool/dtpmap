<?php
if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true)die();

/**
 * @global CMain $APPLICATION
 * @param array $arParams
 * @param array $arResult
 * @param CBitrixComponent $this
 */
$arResult['PATCH'] = $this->GetPath();
/*
 * Подключаем библиотеку 
 */
$APPLICATION->AddHeadScript($arResult['PATCH'].'/dropzone/dropzone.min.js');
$APPLICATION->SetAdditionalCSS($arResult['PATCH'].'/dropzone/dropzone.min.css');
$APPLICATION->SetAdditionalCSS($arResult['PATCH'].'/dropzone/basic.min.css');

CJSCore::Init(array('ajax'));

$this->IncludeComponentTemplate();

