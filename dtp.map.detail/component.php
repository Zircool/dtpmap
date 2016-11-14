<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
if(intval($arParams["IBLOCK_ID"])<=0)
	return;
include_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/classes/general/captcha.php");
if (!CModule::IncludeModule("iblock")) {
    ShowError(GetMessage("IBLOCK_MODULE_NOT_INSTALLED"));
    return;
}

$arParams['CACHE_TIME'] = (!$arParams['CACHE_TIME'])?0:$arParams['CACHE_TIME'];
$cache = new CPHPCache;
$cache_id = serialize($arParams) . serialize($arNavigation) . $this->__templateName . $this->__templatePage . $this->__template;
$cache_path = $GLOBALS['CACHE_MANAGER']->GetCompCachePath($this->__relativePath);

if ($arParams['CACHE_TIME'] > 0 && $cache->InitCache($arParams['CACHE_TIME'], $cache_id, $cache_path)) {
	$Vars = $cache->GetVars();
	foreach ($Vars['arResult'] as $k => $v) {
		$arResult[$k] = $v;
	}
} else {
	if ($arParams['CACHE_TIME'] > 0) {
		$cache->StartDataCache($arParams['CACHE_TIME'], $cache_id);
	}


	if($arParams["ACTIVE_DATE"])
		$arFilter["ACTIVE_DATE"] = "Y";


	$arFilter = array("IBLOCK_ID" => $arParams["IBLOCK_ID"]);
	if(!empty($arParams["ADD_FILTER"])){
		$arFilter = array_merge($arFilter,$arParams["ADD_FILTER"]);
	}

	$arFilter["=ID"] = intval($arParams["ID"]);
    $arResult["USERS"] = array();


	$db_elements = CIBlockElement::GetList(array(), $arFilter, false, array("nTopCount"=>1));

	if($ob_elements = $db_elements->GetNextElement()){
		$arResult["ITEM"] = $ob_elements->GetFields();
		$arResult["ITEM"]["PROPERTIES"] = $ob_elements->GetProperties();

		 $arButtons = CIBlock::GetPanelButtons(
				$arResult["ITEM"]["IBLOCK_ID"],
				$arResult["ITEM"]["ID"],
				0,
				array("SECTION_BUTTONS"=>false, "SESSID"=>false)
			);
		$arResult["ITEM"]["EDIT_LINK"] = $arButtons["edit"]["edit_element"]["ACTION_URL"];
		$arResult["ITEM"]["DELETE_LINK"] = $arButtons["edit"]["delete_element"]["ACTION_URL"];
        foreach($arResult["ITEM"]['PROPERTIES']["USERS"]["VALUE"] as $uid)
            $arResult["USERS"][$uid] = $uid;
		}


	if ($arResult["ITEM"]["PROPERTIES"]["REGION"]["VALUE"]) {
		$arCity = $DB->Query("SELECT NAME FROM b_sale_location L INNER JOIN b_sale_location_city_lang C ON C.CITY_ID = L.CITY_ID WHERE L.ID = ".intval($arResult["ITEM"]["PROPERTIES"]["REGION"]["VALUE"])." AND C.LID = 'ru' LIMIT 1",true)->Fetch();

		$arResult["ITEM"]["PROPERTIES"]["REGION"]["VALUE"] = $arCity["NAME"];
	}

    if(!empty($arResult["USERS"])){
        $dbUsers = $DB->Query("SELECT LOGIN,ID FROM b_user WHERE ID IN (".implode(" , ",$arResult["USERS"]).") ;",true);
        while($arUsers = $dbUsers->Fetch(false,false)){
            $arResult["USERS"][$arUsers["ID"]] = $arUsers;
        }
    }


	if ($arParams['CACHE_TIME'] > 0)
		$cache->EndDataCache(array('arResult' => $arResult, 'NavNum' => $GLOBALS['NavNum']));

}

    CIBlockElement::CounterInc($arResult["ITEM"]['ID']);


$arResult["arSTATUS"] = $arStatus = Moder::GetStatusByID($arResult["ITEM"]["ID"]);

if(empty($arResult["ITEM"]))
	unset($arStatus["ACCESS_DETAIL"]);

if($arStatus["ACCESS_DETAIL"]) {
	if($arStatus["ALERT"])
		echo $arStatus["ALERT"];


	$this->IncludeComponentTemplate();

}else{
	echo ShowAlert('ќшибка!', 'Ёлемент не найден!','danger');
}


?>