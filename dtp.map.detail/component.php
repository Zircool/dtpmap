<?php if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

use Bitrix\Main\Context,
	Bitrix\Main\Type\DateTime,
	Bitrix\Main\Loader,
	Bitrix\Iblock;;


if (!CModule::IncludeModule("iblock")) {
	ShowError("Модуль информационных блоков не установлен.");
	return;
}

$APPLICATION->AddHeadScript("//api-maps.yandex.ru/2.1/?load=package.full&lang=ru-RU", true);

$arParams["IBLOCK_TYPE"] = trim($arParams["IBLOCK_TYPE"]);
$arParams["IBLOCK_ID"] = intval($arParams["IBLOCK_ID"]);

$arParams["ID"] = intval($arParams["ID"]);
if($arParams["ID"] > 0 && $arParams["ID"]."" != $arParams["ID"])
{
	if (CModule::IncludeModule("iblock"))
	{
		\Bitrix\Iblock\Component\Tools::process404(
			trim($arParams["MESSAGE_404"]) ?: GetMessage("ELEMENT_NOT_FOUND")
			,true
			,$arParams["SET_STATUS_404"] === "Y"
			,$arParams["SHOW_404"] === "Y"
			,$arParams["FILE_404"]
		);
	}
	return;
}

$arParams["META_KEYWORDS"]=trim($arParams["META_KEYWORDS"]);
if(strlen($arParams["META_KEYWORDS"])<=0)
	$arParams["META_KEYWORDS"] = "-";
$arParams["META_DESCRIPTION"]=trim($arParams["META_DESCRIPTION"]);
if(strlen($arParams["META_DESCRIPTION"])<=0)
	$arParams["META_DESCRIPTION"] = "-";
$arParams["BROWSER_TITLE"]=trim($arParams["BROWSER_TITLE"]);
if(strlen($arParams["BROWSER_TITLE"])<=0)
	$arParams["BROWSER_TITLE"] = "-";

$arParams["SET_TITLE"] = $arParams["SET_TITLE"]!="N"; //Turn on by default
$arParams["SET_LAST_MODIFIED"] = $arParams["SET_LAST_MODIFIED"]==="Y";

$arParams['CACHE_TIME'] = (!$arParams['CACHE_TIME'])?0:$arParams['CACHE_TIME'];
$cache = new CPHPCache;
$cache_id = serialize($arParams) . serialize($arNavigation) . $this->__templateName . $this->__templatePage . $this->__template;
$cache_path = $GLOBALS['CACHE_MANAGER']->GetCompCachePath($this->__relativePath);

if($arParams["SHOW_WORKFLOW"] || $this->StartResultCache(false, ($arParams["CACHE_GROUPS"]==="N"? false: $USER->GetGroups())))
{

	if($arParams["ACTIVE_DATE"])
		$arFilter["ACTIVE_DATE"] = "Y";


	$arFilter = array("IBLOCK_ID" => $arParams["IBLOCK_ID"]);
	if(!empty($arParams["ADD_FILTER"])){
		$arFilter = array_merge($arFilter,$arParams["ADD_FILTER"]);
	}

	$arFilter["=ID"] = intval($arParams["ID"]);
	$arResult["USERS"] = array();
	
	$arSelect = array_merge($arParams["FIELD_CODE"], array(
		"ID",
		"NAME",
		"IBLOCK_ID",
		"IBLOCK_SECTION_ID",
		"DETAIL_TEXT",
		"DETAIL_TEXT_TYPE",
		"PREVIEW_TEXT",
		"PREVIEW_TEXT_TYPE",
		"DETAIL_PICTURE",
		"TIMESTAMP_X",
		"ACTIVE_FROM",
		"LIST_PAGE_URL",
		"DETAIL_PAGE_URL",
		"CREATED_USER_NAME",
		"TAGS"
	));
	$bGetProperty = count($arParams["PROPERTY_CODE"]) > 0
			|| $arParams["BROWSER_TITLE"] != "-"
			|| $arParams["META_KEYWORDS"] != "-"
			|| $arParams["META_DESCRIPTION"] != "-";
	if($bGetProperty)
		$arSelect[]="PROPERTY_*";
	if ($arParams['SET_CANONICAL_URL'] === 'Y')
		$arSelect[] = 'CANONICAL_PAGE_URL';
	
	


	$rsElement = CIBlockElement::GetList($arSelect, $arFilter, false, false, $arSelect);
	$rsElement->SetUrlTemplates($arParams["DETAIL_URL"], "", $arParams["IBLOCK_URL"]);
	
	if($obElement = $rsElement->GetNextElement()){
		$arResult = $obElement->GetFields();

		$arResult["NAV_RESULT"] = new CDBResult;
		if(($arResult["DETAIL_TEXT_TYPE"]=="html") && (strstr($arResult["DETAIL_TEXT"], "<BREAK />")!==false))
			$arPages=explode("<BREAK />", $arResult["DETAIL_TEXT"]);
		elseif(($arResult["DETAIL_TEXT_TYPE"]!="html") && (strstr($arResult["DETAIL_TEXT"], "&lt;BREAK /&gt;")!==false))
			$arPages=explode("&lt;BREAK /&gt;", $arResult["DETAIL_TEXT"]);
		else
			$arPages=array();
		$arResult["NAV_RESULT"]->InitFromArray($arPages);
		$arResult["NAV_RESULT"]->NavStart($arNavParams);
		if(count($arPages)==0)
		{
			$arResult["NAV_RESULT"] = false;
		}
		else
		{
			$navComponentParameters = array();
			if ($arParams["PAGER_BASE_LINK_ENABLE"] === "Y")
			{
				$pagerBaseLink = trim($arParams["PAGER_BASE_LINK"]);
				if ($pagerBaseLink === "")
					$pagerBaseLink = $arResult["DETAIL_PAGE_URL"];

				if ($pagerParameters && isset($pagerParameters["BASE_LINK"]))
				{
					$pagerBaseLink = $pagerParameters["BASE_LINK"];
					unset($pagerParameters["BASE_LINK"]);
				}

				$navComponentParameters["BASE_LINK"] = CHTTP::urlAddParams($pagerBaseLink, $pagerParameters, array("encode"=>true));
			}

			$arResult["NAV_STRING"] = $arResult["NAV_RESULT"]->GetPageNavStringEx(
				$navComponentObject,
				$arParams["PAGER_TITLE"],
				$arParams["PAGER_TEMPLATE"],
				$arParams["PAGER_SHOW_ALWAYS"],
				$this,
				$navComponentParameters
			);
			/** @var CBitrixComponent $navComponentObject */
			$arResult["NAV_CACHED_DATA"] = $navComponentObject->getTemplateCachedData();

			$arResult["NAV_TEXT"] = "";
			while($ar = $arResult["NAV_RESULT"]->Fetch())
				$arResult["NAV_TEXT"].=$ar;
		}

		if(strlen($arResult["ACTIVE_FROM"])>0)
			$arResult["DISPLAY_ACTIVE_FROM"] = CIBlockFormatProperties::DateFormat($arParams["ACTIVE_DATE_FORMAT"], MakeTimeStamp($arResult["ACTIVE_FROM"], CSite::GetDateFormat()));
		else
			$arResult["DISPLAY_ACTIVE_FROM"] = "";

		$ipropValues = new Iblock\InheritedProperty\ElementValues($arResult["IBLOCK_ID"], $arResult["ID"]);
		$arResult["IPROPERTY_VALUES"] = $ipropValues->getValues();

		Iblock\Component\Tools::getFieldImageData(
			$arResult,
			array('PREVIEW_PICTURE', 'DETAIL_PICTURE'),
			Iblock\Component\Tools::IPROPERTY_ENTITY_ELEMENT,
			'IPROPERTY_VALUES'
		);

		$arResult["FIELDS"] = array();
		foreach($arParams["FIELD_CODE"] as $code)
			if(array_key_exists($code, $arResult))
				$arResult["FIELDS"][$code] = $arResult[$code];

		if($bGetProperty)
			$arResult["PROPERTIES"] = $obElement->GetProperties();
		$arResult["DISPLAY_PROPERTIES"]=array();
		foreach($arParams["PROPERTY_CODE"] as $pid)
		{
			$prop = &$arResult["PROPERTIES"][$pid];
			if(
				(is_array($prop["VALUE"]) && count($prop["VALUE"])>0)
				|| (!is_array($prop["VALUE"]) && strlen($prop["VALUE"])>0)
			)
			{
				$arResult["DISPLAY_PROPERTIES"][$pid] = CIBlockFormatProperties::GetDisplayValue($arResult, $prop, "news_out");
			}
		}

		$arResult["IBLOCK"] = GetIBlock($arResult["IBLOCK_ID"], $arResult["IBLOCK_TYPE"]);

		$arResult["SECTION"] = array("PATH" => array());
		$arResult["SECTION_URL"] = "";
		if($arParams["ADD_SECTIONS_CHAIN"] && $arResult["IBLOCK_SECTION_ID"] > 0)
		{
			$rsPath = CIBlockSection::GetNavChain($arResult["IBLOCK_ID"], $arResult["IBLOCK_SECTION_ID"]);
			$rsPath->SetUrlTemplates("", $arParams["SECTION_URL"]);
			while($arPath = $rsPath->GetNext())
			{
				$ipropValues = new Iblock\InheritedProperty\SectionValues($arParams["IBLOCK_ID"], $arPath["ID"]);
				$arPath["IPROPERTY_VALUES"] = $ipropValues->getValues();
				$arResult["SECTION"]["PATH"][] = $arPath;
				$arResult["SECTION_URL"] = $arPath["~SECTION_PAGE_URL"];
			}
		}

		
	}else{
		$this->abortResultCache();
		Iblock\Component\Tools::process404(
			trim($arParams["MESSAGE_404"]) ?: GetMessage("T_NEWS_DETAIL_NF")
			,true
			,$arParams["SET_STATUS_404"] === "Y"
			,$arParams["SHOW_404"] === "Y"
			,$arParams["FILE_404"]
		);
		
		ec('bad');
	}
	
	
	// get the values for the Next and Previous links
	if(isset($arResult["ID"]))
	{
		//SELECT
		$arSelect = array(
			"ID",
			"IBLOCK_ID",
			"IBLOCK_SECTION_ID",
			"DETAIL_PAGE_URL",
			"LIST_PAGE_URL",
			"NAME",
			"PREVIEW_PICTURE",
			"CREATED_USER_NAME",
			"TAGS"
		);
		//WHERE
		$arFilter = array(
			"IBLOCK_ID" => $arResult["IBLOCK_ID"],
			//"SECTION_ID" => $arResult["IBLOCK_SECTION_ID"],
			"ACTIVE_DATE" => "Y",
			"ACTIVE" => "Y",
			"CHECK_PERMISSIONS" => "Y",
		);
		
		//ORDER BY
		$arSort = array(
			$arParams["ELEMENT_SORT_FIELD"] => $arParams["ELEMENT_SORT_ORDER"],
			"ID" => "ASC",
		);
		//EXECUTE
		$arResult["NEXT"] = array();
		$arResult["PREV"] = array();
		$rsElement = CIBlockElement::GetList($arSort, $arFilter, false, array("nElementID" => $arResult["ID"], "nPageSize" => 2), $arSelect);
		$rsElement->SetUrlTemplates($arParams["DETAIL_URL"], $arParams["SECTION_URL"]);
		$rsElement->SetSectionContext($arResult["SECTION"]);
		$end = false;

		while($arElement = $rsElement->GetNext())
		{
			if($arElement["ID"]==$arResult["ID"])
			{
				$end = true;
				$arResult["CURRENT"]["NO"] = $arElement["RANK"];
			}
			elseif($end)
			{
				$arResult["NEXT"][] = $arElement;
			}
			else
			{
				array_unshift($arResult["PREV"], $arElement);
			}
		}
		
		$this->setResultCacheKeys(array(
			"ID",
			"IBLOCK_ID",
			"NAV_CACHED_DATA",
			"NAME",
			"IBLOCK_SECTION_ID",
			"IBLOCK",
			"LIST_PAGE_URL", "~LIST_PAGE_URL",
			"SECTION_URL",
			"CANONICAL_PAGE_URL",
			"SECTION",
			"PROPERTIES",
			"IPROPERTY_VALUES",
			"TIMESTAMP_X",
			"TAGS"
		));
		
		$this->IncludeComponentTemplate();
	}
	else
	{
		$this->AbortResultCache();
		\Bitrix\Iblock\Component\Tools::process404(
			trim($arParams["MESSAGE_404"]) ?: GetMessage("PHOTO_ELEMENT_NOT_FOUND")
			,true
			,$arParams["SET_STATUS_404"] === "Y"
			,$arParams["SHOW_404"] === "Y"
			,$arParams["FILE_404"]
		);
	}

}



if(isset($arResult["ID"]))
{
	$arTitleOptions = null;
	if(CModule::IncludeModule("iblock"))
	{
		CIBlockElement::CounterInc($arResult["ID"]);

		if($USER->IsAuthorized())
		{
			if($APPLICATION->GetShowIncludeAreas()
				|| $arParams["SET_TITLE"]
				|| isset($arResult[$arParams["BROWSER_TITLE"]])
			)
			{
				$arReturnUrl = array(
					"add_element" => CIBlock::GetArrayByID($arResult["IBLOCK_ID"], "DETAIL_PAGE_URL"),
					"delete_element" => (
						isset($arResult["SECTION"])?
						$arResult["SECTION"]["SECTION_PAGE_URL"]:
						$arResult["LIST_PAGE_URL"]
					),
				);
				$arButtons = CIBlock::GetPanelButtons(
					$arResult["IBLOCK_ID"],
					$arResult["ID"],
					$arResult["IBLOCK_SECTION_ID"],
					Array("RETURN_URL" =>  $arReturnUrl)
				);

				if($APPLICATION->GetShowIncludeAreas())
					$this->AddIncludeAreaIcons(CIBlock::GetComponentMenu($APPLICATION->GetPublicShowMode(), $arButtons));

				if($arParams["SET_TITLE"] || isset($arResult[$arParams["BROWSER_TITLE"]]))
				{
					$arTitleOptions = array(
						'ADMIN_EDIT_LINK' => $arButtons["submenu"]["edit_element"]["ACTION"],
						'PUBLIC_EDIT_LINK' => $arButtons["edit"]["edit_element"]["ACTION"],
						'COMPONENT_NAME' => $this->GetName(),
					);
				}
			}
		}
	}

	if($arParams["SET_TITLE"])
	{
		if ($arResult["IPROPERTY_VALUES"]["ELEMENT_PAGE_TITLE"] != "")
			$APPLICATION->SetTitle($arResult["IPROPERTY_VALUES"]["ELEMENT_PAGE_TITLE"], $arTitleOptions);
		else
			$APPLICATION->SetTitle($arResult["NAME"], $arTitleOptions);
	}

	$browserTitle = \Bitrix\Main\Type\Collection::firstNotEmpty(
		$arResult["PROPERTIES"], array($arParams["BROWSER_TITLE"], "VALUE")
		,$arResult, $arParams["BROWSER_TITLE"]
		,$arResult["IPROPERTY_VALUES"], "ELEMENT_META_TITLE"
	);
	if (is_array($browserTitle))
		$APPLICATION->SetPageProperty("title", implode(" ", $browserTitle), $arTitleOptions);
	elseif ($browserTitle != "")
		$APPLICATION->SetPageProperty("title", $browserTitle, $arTitleOptions);

	$metaKeywords = \Bitrix\Main\Type\Collection::firstNotEmpty(
		$arResult["PROPERTIES"], array($arParams["META_KEYWORDS"], "VALUE")
		,$arResult["IPROPERTY_VALUES"], "ELEMENT_META_KEYWORDS"
	);
	if (is_array($metaKeywords))
		$APPLICATION->SetPageProperty("keywords", implode(" ", $metaKeywords), $arTitleOptions);
	elseif ($metaKeywords != "")
		$APPLICATION->SetPageProperty("keywords", $metaKeywords, $arTitleOptions);

	$metaDescription = \Bitrix\Main\Type\Collection::firstNotEmpty(
		$arResult["PROPERTIES"], array($arParams["META_DESCRIPTION"], "VALUE")
		,$arResult["IPROPERTY_VALUES"], "ELEMENT_META_DESCRIPTION"
	);
	if (is_array($metaDescription))
		$APPLICATION->SetPageProperty("description", implode(" ", $metaDescription), $arTitleOptions);
	elseif ($metaDescription != "")
		$APPLICATION->SetPageProperty("description", $metaDescription, $arTitleOptions);

	
	if ($arParams["SET_LAST_MODIFIED"] && $arResult["TIMESTAMP_X"])
	{
		Context::getCurrent()->getResponse()->setLastModified(DateTime::createFromUserTime($arResult["TIMESTAMP_X"]));
	}

	return $arResult["ID"];
}



?>