<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$arComponentVariables = array('vacancy','vacancy_id', 'add','resume');
$arDefaultUrlTemplates404 = array(	'vacancy'=>'vacancy/',
									'vacancy_id' => 'vacancy/#ID#/',
									'vacancy_edit' => 'vacancy/edit/#ID#/',
									'vacancy_add' => 'vacancy/add/',
									'vacancy_search' => 'vacancy/search/',
									'vacancy_my' =>'vacancy/my/',
									'resume'=>'resume/',
									'resume_id'=>'resume/#ID#/',
									'resume_add'=>'resume/add/',
									'resume_edit'=>'resume/edit/#ID#/',
									'resume_search' => 'resume/search/',
									'company'=>'company/',
									'company_my'=>'company/my/',
									'company_id'=>'company/#ID#/',
									'company_add'=>'company/add/',
									'company_edit'=>'company/edit/#ID#/',
									'company_search'=>'company/search/',
									'search' =>'search/');

if ($arParams['SEF_MODE'] == 'Y')
{
	$arVariables = array();
	$arUrlTemplates = CComponentEngine::MakeComponentUrlTemplates($arDefaultUrlTemplates404, $arParams['SEF_URL_TEMPLATES']);
	$componentPage = CComponentEngine::ParseComponentPath($arParams['SEF_FOLDER'], $arUrlTemplates, $arVariables);

	$arResult = array('VARIABLES' => $arVariables, 'ALIASES' => $arVariableAliases);
	$arResult['PATH_TO_LIST'] = $arParams['SEF_FOLDER'];
	$arResult['PATH_TO_DETAIL'] = $arParams['SEF_FOLDER'].$arParams['SEF_URL_TEMPLATES']['vacancy_id'];
	$arResult['PATH_TO_VACANCY_LIST'] = $arParams['SEF_FOLDER'].$arParams['SEF_URL_TEMPLATES']['vacancy'];
	$arResult['PATH_TO_VACANCY_EDIT'] = $arParams['SEF_FOLDER'].$arParams['SEF_URL_TEMPLATES']['vacancy_edit'];
	$arResult['PATH_TO_ADD_VACANCY'] = $arParams['SEF_FOLDER'].$arParams['SEF_URL_TEMPLATES']['vacancy_add'];
	$arResult['PATH_TO_RESUME_LIST'] = $arParams['SEF_FOLDER'].$arParams['SEF_URL_TEMPLATES']['resume'];
	$arResult['PATH_TO_RESUME_ADD'] = $arParams['SEF_FOLDER'].$arParams['SEF_URL_TEMPLATES']['resume_add'];
	$arResult['PATH_TO_RESUME_EDIT'] = $arParams['SEF_FOLDER'].$arParams['SEF_URL_TEMPLATES']['resume_edit'];
	$arResult['PATH_TO_ADD_COMPANY'] = $arParams['SEF_FOLDER'].$arParams['SEF_URL_TEMPLATES']['company_add'];
	$arResult['PATH_TO_EDIT_COMPANY'] = $arParams['SEF_FOLDER'].$arParams['SEF_URL_TEMPLATES']['company_edit'];
	$arResult['PATH_TO_MY_COMPANY'] = $arParams['SEF_FOLDER'].$arParams['SEF_URL_TEMPLATES']['company_my'];


}else{
	$arVariableAliases = CComponentEngine::MakeComponentVariableAliases(array(), $arParams['VARIABLE_ALIASES']);
	CComponentEngine::InitComponentVariables(false, $arComponentVariables, $arVariableAliases, $arVariables);

	if ($arVariables['vacancy_id'] > 0)
		$componentPage = 'vacancy_id';
	elseif (isset($arVariables['add']))
		$componentPage = 'add';
	elseif (isset($arVariables['company']))
		$componentPage = 'company';
	else
		$componentPage = 'template';

	$arResult = array('VARIABLES' => $arVariables, 'ALIASES' => $arVariableAliases);
	$arVarAliaces = $arParams['VARIABLE_ALIASES'];
	$arForDel = array($arVarAliaces['vacancy_id'], $arVarAliaces['add']);

	$arResult['PATH_TO_LIST'] = $APPLICATION->GetCurPageParam('', $arForDel);
	$arResult['PATH_TO_DETAIL'] = $APPLICATION->GetCurPageParam($arParams['VARIABLE_ALIASES']['vacancy_id'].'=#ID#', $arForDel);
	/*$arResult['PATH_TO_DETAIL'] = $APPLICATION->GetCurPageParam($arParams['VARIABLE_ALIASES']['company_id'].'=#ID#', $arForDel);*/
}

$this->IncludeComponentTemplate($componentPage);

?>