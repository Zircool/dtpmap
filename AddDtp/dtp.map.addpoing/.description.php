<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentDescription = array(
	"NAME" => "Карта ДТП",
	"DESCRIPTION" => "Карта ДТП",
	"ICON" => "/images/news_list.gif",
	"SORT" => 20,
	"CACHE_PATH" => "Y",
	"PATH" => array(
		"ID" => "dtpmap",
		"CHILD" => array(
			"ID" => "addpoint",
			"NAME" => "Добавить место ДТП",
			"SORT" => 10,
		),
	),
);

?>