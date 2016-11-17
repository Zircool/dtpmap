<?php
if (!defined("STOP_STATISTICS"))
	define("STOP_STATISTICS", true);
if (!defined("NO_AGENT_STATISTIC"))
	define("NO_AGENT_STATISTIC","Y");
if (!defined("NO_AGENT_CHECK"))
	define("NO_AGENT_CHECK", true);
if (!defined("NO_KEEP_STATISTIC"))
	define("NO_KEEP_STATISTIC", true);

require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
//hack! 
header('Content-Type: text/html; charset='.LANG_CHARSET);
Header("Pragma: no-cache");
$APPLICATION->RestartBuffer();
$arResult = array(); 

if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
	if(!empty($_FILES)){
		$fileName = CUtil::ConvertToLangCharset($_FILES["file"]["name"]);
			$arFile = array(
				"name" => $fileName,
				"size" => $_FILES["file"]["size"],
				"tmp_name" => $_FILES["file"]["tmp_name"],
				"type" => $_FILES["file"]["type"],
				"MODULE_ID" => "mail"
			);
			
			$fileID = CFile::SaveFile($arFile, 'main');
			$arResult['FID'] = $fileID;
			echo json_encode($arResult);
	}
}



?>