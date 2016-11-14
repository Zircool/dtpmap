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


//Props
$rsProp = CIBlockProperty::GetList(Array("sort"=>"asc", "name"=>"asc"), Array("ACTIVE"=>"Y", "IBLOCK_ID"=>(isset($arCurrentValues["IBLOCK_ID"])?$arCurrentValues["IBLOCK_ID"]:$arCurrentValues["ID"])));
while ($arr=$rsProp->Fetch())
{
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

		"ID" => Array(
			"PARENT" => "BASE",
			"NAME" => "ID вакансии",
			"TYPE" => "STRING",
			"ADDITIONAL_VALUES" => "N",
			"VALUES" => "",
			"DEFAULT" => ""
		),
		"FIELD_CODE" => CIBlockParameters::GetFieldCode("Поля", "DATA_SOURCE"),
		"PROPERTY_CODE" => array(
			"PARENT" => "BASE",
			"NAME" => "Свойства",
			"TYPE" => "LIST",
			"MULTIPLE" => "Y",
			"VALUES" => $arProperty,
		),

		"PAGER_TEMPLATE" => array(
			"PARENT" => "NAVI",
			"NAME" => "Название постраничной навигации",
			"TYPE" => "STRING",
			"DEFAULT" => "",
		),


	),
);
?>