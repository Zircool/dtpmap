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
	"NAME"=>"��������",
	"PREVIEW_TEXT"=>"�������� ��� ������",
    "PREVIEW_PICTURE"=>"�������� ��� ������",
    "DETAIL_TEXT"=>"��������� ��������",
    "DETAIL_PICTURE"=>"��������� ��������",
    "IBLOCK_SECTION_ID"=>"ID �������",
	"DETAIL_PAGE_URL" =>"��������� �������� ��������",
	"SECTION_PAGE_URL"=>"�������� �������",
	"LIST_PAGE_URL"=>"�������� ������",
	"ACTIVE_FROM"=>"���� ����������"
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
			"NAME" => "��������",
			"TYPE" => "LIST",
			"VALUES" => $arIBlocks,
			"REFRESH" => "Y",
		),
		"FIELD_CODE" => array(
			"PARENT" => "BASE",
			"NAME" => "����",
			"TYPE" => "LIST",
			"MULTIPLE" => "Y",
			"VALUES" => $arFields,
		),
		"PROPERTY_CODE" => array(
			"PARENT" => "BASE",
			"NAME" => "��������",
			"TYPE" => "LIST",
			"MULTIPLE" => "Y",
			"VALUES" => $arProperty,
		),
		"LIMIT" => Array(
			"PARENT" => "BASE",
			"NAME" => "����������� ������",
			"TYPE" => "STRING",
		),
		"LIMIT_PER_PAGE" => Array(
			"PARENT" => "BASE",
			"NAME" => "���������� ��������� �� ��������",
			"TYPE" => "STRING",
		),
		"ACTIVE_DATE" => Array(
			"PARENT" => "BASE",
			"NAME" => "��������� ���������� ��������",
			"TYPE" => "CHECKBOX",
		),
		"SORT_BY" => Array(
			"PARENT" => "BASE",
			"NAME" => "����������� ��",
			"TYPE" => "LIST",
			"VALUES" => $arSort,
		),
		"SORT_ORDER" => Array(
			"PARENT" => "BASE",
			"NAME" => "����������� ����������",
			"TYPE" => "LIST",
			"VALUES" => array("ASC"=>"�� �����������", "DESC"=>"�� ��������")
		),
		"PAGER_TEMPLATE" => array(
			"PARENT" => "NAVI",
			"NAME" => "�������� ������������ ���������",
			"TYPE" => "STRING",
			"DEFAULT" => "",
		),
		"AJAX_MODE" => array(),
		"VARIABLE_ALIASES" => Array(
			"detail_id" => Array("NAME" => "ID ��������"),
			"add" => Array("NAME" => "�������� ��������"),
		),
		"SEF_MODE" => Array(
			"vacancy" => array(
				"NAME" => "������ ��������",
				"DEFAULT" => "vacancy/",
				"VARIABLES" => array(),
			),
			"vacancy_id" => array(
				"NAME" => "�������� ��������",
				"DEFAULT" => "vacancy/#ID#/",
				"VARIABLES" => array(),
			),
			"vacancy_add" => array(
				"NAME" => "�������� ��������",
				"DEFAULT" => "vacancy/add/",
				"VARIABLES" => array(),
			),

			"company" => array(
				"NAME" => "������ ��������",
				"DEFAULT" => "company/",
				"VARIABLES" => array(),
			),

			"company_id" => array(
				"NAME" => "�������� ��������",
				"DEFAULT" => "company/#ID#/",
				"VARIABLES" => array(),
			),

			"company_add" => array(
				"NAME" => "�������� ��������",
				"DEFAULT" => "company/add/",
				"VARIABLES" => array(),
			),

		),
		"CACHE_TIME"=> array(
			"PARENT" => "BASE",
			"NAME" => "����� �����������",
			"TYPE" => "STRING",
			"DEFAULT" => "",
		),

	),
);
?>