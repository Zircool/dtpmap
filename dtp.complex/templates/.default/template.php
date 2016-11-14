<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
<div class="top-block-wrap">
	<?$APPLICATION->IncludeComponent("job:job.list", "top_list", array(
	"IBLOCK_TYPE" => "freelance",
	"IBLOCK_ID" => "122",
	"COUNT" => "60",
	"SORT_BY1" => "TIMESTAMP_X",
	"FILTER_NAME" => "",
	"FIELD_CODE" => array(
		0 => "NAME",
		1 => "PREVIEW_PICTURE",
		2 => "",
	),
	"PROPERTY_CODE" => array(
	),
	"DETAIL_URL" => "/project/#ID#/",
	"CACHE_TYPE" => "N",
	"CACHE_TIME" => "3600",
	"CACHE_FILTER" => "N",
	"SET_TITLE" => "Y"
	),
	false
);?>
</div>