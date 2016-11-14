<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if(!CModule::IncludeModule("iblock"))
	return;

$arTypesEx = CIBlockParameters::GetIBlockTypes(Array("-"=>" "));

$arIBlocks=Array();
$db_iblock = CIBlock::GetList(Array("SORT"=>"ASC"), Array("SITE_ID"=>$_REQUEST["site"], "TYPE" => ($arCurrentValues["IBLOCK_TYPE"]!="-"?$arCurrentValues["IBLOCK_TYPE"]:"")));
while($arRes = $db_iblock->Fetch())
	$arIBlocks[$arRes["ID"]] = $arRes["NAME"];

/*���������� */
$arSortFields = Array(
		"ID"=>"ID",
		"NAME"=>"��������",
		"ACTIVE_FROM"=>"���� ������ ����������",
		"SORT"=>"����������",
		"TIMESTAMP_X"=>"���� ���������� ���������"
	);

$arProperty_LNS = array();
$rsProp = CIBlockProperty::GetList(Array("sort"=>"asc", "name"=>"asc"), Array("ACTIVE"=>"Y", "IBLOCK_ID"=>(isset($arCurrentValues["IBLOCK_ID"])?$arCurrentValues["IBLOCK_ID"]:$arCurrentValues["ID"])));
while ($arr=$rsProp->Fetch())
{	$arProperty[$arr["CODE"]] = "[".$arr["CODE"]."] ".$arr["NAME"];
	if (in_array($arr["PROPERTY_TYPE"], array("L", "N", "S","G","E")))
	{
		$arProperty_LNS[$arr["CODE"]] = "[".$arr["CODE"]."] ".$arr["NAME"];
	}
}


$arComponentParameters = array(
	"GROUPS" => array(
	),
	"PARAMETERS" => array(
		"IBLOCK_TYPE" => Array(
			"PARENT" => "BASE",
			"NAME" => "��� ���. �����",
			"TYPE" => "LIST",
			"VALUES" => $arTypesEx,
			"DEFAULT" => "freelance",
			"REFRESH" => "Y",
		),
		"IBLOCK_ID" => Array(
			"PARENT" => "BASE",
			"NAME" => "���. ����",
			"TYPE" => "LIST",
			"VALUES" => $arIBlocks,
			"DEFAULT" => '={$_REQUEST["ID"]}',
			"ADDITIONAL_VALUES" => "N",
			"REFRESH" => "Y",
		),

		"COUNT" => Array(
			"PARENT" => "BASE",
			"NAME" => "���������� �� ��������",
			"TYPE" => "STRING",
			"DEFAULT" => "20",
		),
		"SORT_BY1" => Array(
			"PARENT" => "DATA_SOURCE",
			"NAME" => "����������",
			"TYPE" => "LIST",
			"DEFAULT" => "ACTIVE_FROM",
			"VALUES" => $arSortFields,
			"ADDITIONAL_VALUES" => "Y",
		),
		"FILTER_NAME" => Array(
			"PARENT" => "DATA_SOURCE",
			"NAME" => "������",
			"TYPE" => "STRING",
			"DEFAULT" => "",
		),

		"FIELD_CODE" => CIBlockParameters::GetFieldCode("����", "DATA_SOURCE"),
		"PROPERTY_CODE" => array(
			"PARENT" => "DATA_SOURCE",
			"NAME" => "��������� ����",
			"TYPE" => "LIST",
			"MULTIPLE" => "Y",
			"VALUES" => $arProperty_LNS,
			"ADDITIONAL_VALUES" => "N",
		),

		"DETAIL_URL" => CIBlockParameters::GetPathTemplateParam(
			"DETAIL",
			"DETAIL_URL",
			"URL �������� ���������� ��������� (�� ��������� - �� �������� ���������)",
			"",
			"URL_TEMPLATES"
		),
		"QUERY" => Array(
			"PARENT" => "BASE",
			"NAME" => "��������� ������",
			"TYPE" => "STRING",
			"VALUES" => '={$_REQUEST["q"]}',
			"DEFAULT" => '={$_REQUEST["q"]}',
			"ADDITIONAL_VALUES" => "N",
		),


		"SET_TITLE" => Array(),

		"CACHE_TIME"  =>  Array("DEFAULT"=>3600),
		"CACHE_FILTER" => array(
			"PARENT" => "CACHE_SETTINGS",
			"NAME" => "���������� ��� ������������� �������",
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "N",
		),
	),
);
?>