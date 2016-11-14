<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

/*--Production by DK 10.10.2013--*/


if(intval($arParams["IBLOCK_ID"])<=0)
	return;


$arPropType = array();

$arParams["IBLOCK_TYPE"] = trim($arParams["IBLOCK_TYPE"]);
if(strlen($arParams["IBLOCK_TYPE"])<=0)
	$arParams["IBLOCK_TYPE"] = "freelance";
$arParams["IBLOCK_ID"] = trim($arParams["IBLOCK_ID"]);
$arParams["SORT_BY1"] = trim($arParams["SORT_BY1"]);
if(strlen($arParams["SORT_BY1"])<=0)
	$arParams["SORT_BY1"] = "ACTIVE_FROM";

if(strlen($arParams["FILTER_NAME"])<=0 || !ereg("^[A-Za-z_][A-Za-z01-9_]*$", $arParams["FILTER_NAME"]))
{
	$arrFilter = array();
}
else
{
	$arrFilter = $GLOBALS[$arParams["FILTER_NAME"]];
	if(!is_array($arrFilter))
		$arrFilter = array();
}


if(!is_array($arParams["FIELD_CODE"]))
	$arParams["FIELD_CODE"] = array();
foreach($arParams["FIELD_CODE"] as $key=>$val)
	if(!$val)
		unset($arParams["FIELD_CODE"][$key]);

if(!is_array($arParams["PROPERTY_CODE"]))
	$arParams["PROPERTY_CODE"] = array();
foreach($arParams["PROPERTY_CODE"] as $key=>$val)
	if($val==="")
		unset($arParams["PROPERTY_CODE"][$key]);

$arParams["DETAIL_URL"]=trim($arParams["DETAIL_URL"]);

$arParams["COUNT"] = intval($arParams["COUNT"]);
if($arParams["COUNT"]<=0)
	$arParams["COUNT"] = 20;

$arParams["CACHE_FILTER"] = $arParams["CACHE_FILTER"]=="Y";
if(!$arParams["CACHE_FILTER"] && count($arrFilter)>0)
	$arParams["CACHE_TIME"] = 0;

$arParams["SET_TITLE"] = $arParams["SET_TITLE"]!="N";

if(strlen($arParams["FILTER_NAME"])<=0 || !preg_match("/^[A-Za-z_][A-Za-z01-9_]*$/", $arParams["FILTER_NAME"]))
{
	$arrFilter = array();
}
else
{
	$arrFilter = $GLOBALS[$arParams["FILTER_NAME"]];
	if(!is_array($arrFilter))
		$arrFilter = array();
}


$arNavParams = array(
		"nPageSize"          => ($arParams["COUNT"] > 0)?$arParams["COUNT"]:20,
		"bDescPageNumbering" => false,
		"bShowAll"           => false,
	);
$arNavigation = CDBResult::GetNavParams($arNavParams);

$arParams['CACHE_TIME'] = (!$arParams['CACHE_TIME'])?0:$arParams['CACHE_TIME'];
$cache = new CPHPCache;
$cache_id = serialize($arParams) . serialize($arNavigation) . serialize($arrFilter) . $this->__templateName . $this->__templatePage . $this->__template;
$cache_path = $GLOBALS['CACHE_MANAGER']->GetCompCachePath($this->__relativePath);

if ($arParams['CACHE_TIME'] > 0 && $cache->InitCache($arParams['CACHE_TIME'], $cache_id, $cache_path)) {
	$Vars = $cache->GetVars();
	foreach ($Vars['arResult'] as $k => $v) {
		$arResult[$k] = $v;
	}
	$GLOBALS['NavNum'] = intval($Vars['NavNum']);

	CBitrixComponentTemplate::ApplyCachedData($Vars['templateCachedData']);
	$cache->Output();
} else {
	if ($arParams['CACHE_TIME'] > 0) {
		$cache->StartDataCache($arParams['CACHE_TIME'], $cache_id);
	}

	if (!CModule::IncludeModule("iblock")) {
		$cache->AbortDataCache();
		ShowError("Модуль инф. блок не установлен =( ");
		return;
	}

	if(is_numeric($arParams["IBLOCK_ID"]))
	{
		$rsIBlock = CIBlock::GetList(array(), array(
			"ACTIVE" => "Y",
			"ID" => $arParams["IBLOCK_ID"],
		));
	}
	else
	{
		$rsIBlock = CIBlock::GetList(array(), array(
			"ACTIVE" => "Y",
			"CODE" => $arParams["IBLOCK_ID"],
			"SITE_ID" => SITE_ID,
		));
	}
	if($arResult = $rsIBlock->GetNext())
	{

		//SELECT
		$arSelect = array_merge($arParams["FIELD_CODE"], array(
			"ID",
            "SHOW_COUNTER",
			"ACTIVE",
			"IBLOCK_ID",
			"IBLOCK_SECTION_ID",
			"NAME",
			"ACTIVE_FROM",
			"DETAIL_PAGE_URL",
			"DETAIL_TEXT",
			"DETAIL_TEXT_TYPE",
			"PREVIEW_TEXT",
			"PREVIEW_TEXT_TYPE",
			"PREVIEW_PICTURE",
			"PROPERTY_SHOW_IN_MAIN",
			"TIMESTAMP_X"
		));
		$bGetProperty = count($arParams["PROPERTY_CODE"])>0;
		if($bGetProperty)
			$arSelect[]="PROPERTY_*";
		//WHERE
		$arFilter = array (
			"IBLOCK_ID" => $arResult["ID"],
			"IBLOCK_LID" => SITE_ID,
			"CHECK_PERMISSIONS" => "Y",
		);

		// Отбор компания
		if(!empty($arParams['COMPANY_ID'])){
			$arFilter['PROPERTY_COMPANY'] = intval($arParams['COMPANY_ID']);
		}

		// Отбор пользователь
		if(!empty($arParams['USER_ID'])){
			$arFilter['PROPERTY_USER_ID'] = intval($arParams['USER_ID']);
		}else{
			$arFilter['ACTIVE'] = "Y";
		}


		//ORDER BY
		$arSort = array(
			$arParams["SORT_BY1"]=>$arParams["SORT_ORDER1"],
		);
		if(!array_key_exists("ID", $arSort))
			$arSort["ID"] = "DESC";


		if(!empty($arrFilter) && is_array($arrFilter)){
			$arFilter = array_merge($arFilter,$arrFilter);
		}


        if (strlen($arParams['QUERY']) && CModule::IncludeModule('search') && (empty($arSort) || ($arSort['PROPERTY_UP_DATE'] == 'DESC' && $arSort['PROPERTY_MDATE'] == 'DESC'))) {
            $arFilter['ID'] = array(-1);
            $search = new CSearch();
            $search->Search(array('QUERY' => $arParams['QUERY'], 'SITE_ID' => SITE_ID, 'MODULE_ID' => 'iblock', 'PARAM2' => $arParams['IBLOCK_ID']), array("CUSTOM_RANK" => "DESC", "RANK" => "DESC"));
            while ($arSearch = $search->Fetch()) {
                $arFilter['ID'][] = $arSearch['ITEM_ID'];
            }

            $search->Search(
                array('QUERY' => $arParams['QUERY'], 'SITE_ID' => SITE_ID, 'MODULE_ID' => 'iblock', 'PARAM2' => $arParams['IBLOCK_ID'], array("CUSTOM_RANK" => "DESC", "RANK" => "DESC")),
                array(),
                array('STEMMING' => false)
            );
            while ($arSearch = $search->Fetch()) {
                $arFilter['ID'][] = $arSearch['ITEM_ID'];
            }
            $arFilter['ID'] = array_unique($arFilter['ID']);
            if(!empty($arParams['ADDITIONAL_FILTER']["ID"])){
                $arFilter['ID'] = array_intersect($arParams['ADDITIONAL_FILTER']["ID"], $arFilter['ID']);
            }
            if(empty($arFilter['ID'])){
                $arFilter['ID'][] = 0;
            }

            $CIBE = CIBlockElement::SubQuery("ID", array('IBLOCK_ID' => $arFilter['IBLOCK_ID']));
            $strSql = $CIBE->GetList($arSort, $arFilter, false, $arNavParams, $arSelect) . (!empty($arFilter['ID']) ? 'ORDER BY FIELD(BE.ID, ' . implode(', ', $arFilter['ID']) . ')' : '');
            preg_match("/(select).*?(from.?.?.?.?.?b_iblock .*?)/uiUs", $strSql, $matches);
            $rsElements = new CIBlockResult();
            $rsElements->NavQuery($strSql, $DB->Query($matches[1] . ' 1 '.$matches[2])->SelectedRowsCount(), $arNavParams);

        } else {
            if (strlen($arParams['QUERY']) && CModule::IncludeModule('search') && !empty($arSort)) {
                $arFilter['ID'] = array(-1);
                $search = new CSearch();
                $search->Search(array('QUERY' => $arParams['QUERY'], 'SITE_ID' => SITE_ID, 'MODULE_ID' => 'iblock', 'PARAM2' => $arParams['IBLOCK_ID']));
                while ($arSearch = $search->Fetch()) {
                    $arFilter['ID'][] = $arSearch['ITEM_ID'];
                }

                $search->Search(
                    array('QUERY' => $arParams['QUERY'], 'SITE_ID' => SITE_ID, 'MODULE_ID' => 'iblock', 'PARAM2' => $arParams['IBLOCK_ID']),
                    array(),
                    array('STEMMING' => false)
                );
                while ($arSearch = $search->Fetch()) {
                    $arFilter['ID'][] = $arSearch['ITEM_ID'];
                }
                $arFilter['ID'] = array_unique($arFilter['ID']);
            }

            $rsElement = CIBlockElement::GetList($arSort, $arFilter, false, $arNavParams, $arSelect);
        }


		$arResult["ITEMS"] = array();
		$rsElement->SetUrlTemplates($arParams["DETAIL_URL"]);
		while($obElement = $rsElement->GetNextElement()){
			$arItem = $obElement->GetFields();

            $arButtons = CIBlock::GetPanelButtons(
				$arItem["IBLOCK_ID"],
				$arItem["ID"],
				0,
				array("SECTION_BUTTONS"=>false, "SESSID"=>false)
			);
			$arItem["EDIT_LINK"] = $arButtons["edit"]["edit_element"]["ACTION_URL"];
			$arItem["DELETE_LINK"] = $arButtons["edit"]["delete_element"]["ACTION_URL"];

			if(array_key_exists("PREVIEW_PICTURE", $arItem))
				$arItem["PREVIEW_PICTURE"] = CFile::GetFileArray($arItem["PREVIEW_PICTURE"]);
			if(array_key_exists("DETAIL_PICTURE", $arItem))
				$arItem["DETAIL_PICTURE"] = CFile::GetFileArray($arItem["DETAIL_PICTURE"]);

			$arItem["FIELDS"] = array();
			foreach($arParams["FIELD_CODE"] as $code)
				if(array_key_exists($code, $arItem))
					$arItem["FIELDS"][$code] = $arItem[$code];

			$arItem["PROPERTIES"] = $obElement->GetProperties();
			$arItem["DISPLAY_PROPERTIES"]=array();
			foreach($arParams["PROPERTY_CODE"] as $pid)
			{
				$prop = &$arItem["PROPERTIES"][$pid];
				if((is_array($prop["VALUE"]) && count($prop["VALUE"])>0) ||
				   (!is_array($prop["VALUE"]) && strlen($prop["VALUE"])>0))
				{
					$arItem["DISPLAY_PROPERTIES"][$pid] = CIBlockFormatProperties::GetDisplayValue($arItem, $prop, "freelance_out");

					if($prop['PROPERTY_TYPE']=="E"){
						if(!empty($prop['VALUE'])){
							$arPropType[] = $prop['VALUE'];
						}
					}
				}
			}

			$arResult["ITEMS"][] = $arItem;
		}

		if(count($arPropType)>0){
			$res = CIBlockElement::GetList($arSort = Array("SORT"=>"ASC", "ID"=>"ASC"), $arFilter = array("ID" => array_unique($arPropType)), false, false, $arSelect = array("ID","NAME"));
			while($ob = $res->GetNextElement()){
				$arFields = $ob->GetFields();
				$arResult['PROP_ELEMENT'][$arFields['ID']] = $arFields['NAME'];
			}

		}

		$rsElement->nPageWindow = $arParams["COUNT"];
		$arResult["NAV_STRING"] = $rsElement->GetPageNavStringEx($navComponentObject, $arParams["PAGER_TITLE"], $arParams["PAGER_TEMPLATE"], $arParams["PAGER_SHOW_ALWAYS"]);
		if ($arParams['CACHE_TIME'] > 0){
			$cache->EndDataCache(array('templateCachedData' => $this->GetTemplateCachedData(), 'arResult' => $arResult, 'NavNum' => $GLOBALS['NavNum']));
		}

	}


}
$this->IncludeComponentTemplate();
?>
