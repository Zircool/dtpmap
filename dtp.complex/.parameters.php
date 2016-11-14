<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if(!CModule::IncludeModule("iblock"))
	return;

//Iblocks
$dbIblock = CIBlock::GetList(Array("id"=>"asc"), Array('ACTIVE'=>'Y','TYPE'=>"freelance"), false);
while($arIblock = $dbIblock->Fetch())
{
	$arIBlocks[$arIblock["ID"]] = "[".$arIblock["ID"]."]".$arIblock["NAME"];
}

//Fields
$arSort = $arFields = array (
	"ID"=> "ID",
	"NAME"=>"Название",
	"PREVIEW_TEXT"=>"Описание для анонса",
    "PREVIEW_PICTURE"=>"Картинка для анонса",
    "DETAIL_TEXT"=>"Детальное описание",
    "DETAIL_PICTURE"=>"Детальная картинка",
    "IBLOCK_SECTION_ID"=>"ID раздела",
	"DETAIL_PAGE_URL" =>"Детальная страница элемента",
	"SECTION_PAGE_URL"=>"Страница раздела",
	"LIST_PAGE_URL"=>"Страница списка",
	"ACTIVE_FROM"=>"Дата активности"
);
//Props
$rsProp = CIBlockProperty::GetList(Array("sort"=>"asc", "name"=>"asc"), Array("ACTIVE"=>"Y", "IBLOCK_ID"=>(isset($arCurrentValues["IBLOCK_ID"])?$arCurrentValues["IBLOCK_ID"]:$arCurrentValues["ID"])));
while ($arr=$rsProp->Fetch())
{
	$arSort["PROPERTY_".$arr["CODE"]] = $arr["NAME"];
	$arProperty["PROPERTY_".$arr["CODE"]] = "[".$arr["CODE"]."] ".$arr["NAME"];
}

$arComponentParameters = array(
	"GROUPS" => array(
	),
	"PARAMETERS" => array(

		"IBLOCK_ID" => Array(
			"PARENT" => "BASE",
			"NAME" => "Инфоблок",
			"TYPE" => "LIST",
			"VALUES" => $arIBlocks,
			"REFRESH" => "Y",
		),
		"FIELD_CODE" => array(
			"PARENT" => "BASE",
			"NAME" => "Поля",
			"TYPE" => "LIST",
			"MULTIPLE" => "Y",
			"VALUES" => $arFields,
		),
		"PROPERTY_CODE" => array(
			"PARENT" => "BASE",
			"NAME" => "Свойства",
			"TYPE" => "LIST",
			"MULTIPLE" => "Y",
			"VALUES" => $arProperty,
		),
		"LIMIT" => Array(
			"PARENT" => "BASE",
			"NAME" => "Ограничение вывода",
			"TYPE" => "STRING",
		),
		"LIMIT_PER_PAGE" => Array(
			"PARENT" => "BASE",
			"NAME" => "Количество элементов на странице",
			"TYPE" => "STRING",
		),
		"ACTIVE_DATE" => Array(
			"PARENT" => "BASE",
			"NAME" => "Проверять активность элемента",
			"TYPE" => "CHECKBOX",
		),
		"SORT_BY" => Array(
			"PARENT" => "BASE",
			"NAME" => "Сортировать по",
			"TYPE" => "LIST",
			"VALUES" => $arSort,
		),
		"SORT_ORDER" => Array(
			"PARENT" => "BASE",
			"NAME" => "Направление сортировки",
			"TYPE" => "LIST",
			"VALUES" => array("ASC"=>"По возрастанию", "DESC"=>"По убыванию")
		),
		"PAGER_TEMPLATE" => array(
			"PARENT" => "NAVI",
			"NAME" => "Название постраничной навигации",
			"TYPE" => "STRING",
			"DEFAULT" => "",
		),
		"AJAX_MODE" => array(),
		"VARIABLE_ALIASES" => Array(
			"detail_id" => Array("NAME" => "ID вакансии"),
			"add" => Array("NAME" => "Добавить вакансию"),
		),
		"SEF_MODE" => Array(
			"vacancy" => array(
				"NAME" => "Список вакансий",
				"DEFAULT" => "vacancy/",
				"VARIABLES" => array(),
			),
			"vacancy_id" => array(
				"NAME" => "Просмотр вакансии",
				"DEFAULT" => "vacancy/#ID#/",
				"VARIABLES" => array(),
			),
			"vacancy_add" => array(
				"NAME" => "Добавить вакансию",
				"DEFAULT" => "vacancy/add/",
				"VARIABLES" => array(),
			),

			"company" => array(
				"NAME" => "Список компаний",
				"DEFAULT" => "company/",
				"VARIABLES" => array(),
			),

			"company_id" => array(
				"NAME" => "Просмотр компнаии",
				"DEFAULT" => "company/#ID#/",
				"VARIABLES" => array(),
			),

			"company_add" => array(
				"NAME" => "Добавить компанию",
				"DEFAULT" => "company/add/",
				"VARIABLES" => array(),
			),

		),
		"CACHE_TIME"=> array(
			"PARENT" => "BASE",
			"NAME" => "Время кеширования",
			"TYPE" => "STRING",
			"DEFAULT" => "",
		),

	),
);
?>