<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
<div class="article-section">
    <div class="row article-section-nav">
	<div class="col-xs-12 col-sm-6">
	    <a href="/" class="asn-btn-back" title="Вернуться к карте ДТП"><span>Вернуться к карте ДТП</span></a>
	</div>
	<div class="col-xs-12 col-sm-6">
	    <a href="#add-comment" class="asn-btn-comment" title="Оставить комментарий"><span>Оставить комментарий</span></a>
	</div>
    </div>
    <div class="row">
	<div class="col-xs-12 col-md-9 article-section-content">
	<?php $APPLICATION->IncludeComponent(
	"zircool:dtp.map.detail", 
	".default", 
	Array(
		"DISPLAY_DATE" => $arParams["DISPLAY_DATE"],
		"DISPLAY_NAME" => $arParams["DISPLAY_NAME"],
		"DISPLAY_PICTURE" => $arParams["DISPLAY_PICTURE"],
		"DISPLAY_PREVIEW_TEXT" => $arParams["DISPLAY_PREVIEW_TEXT"],
		"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
		"FIELD_CODE" => $arParams["DETAIL_FIELD_CODE"],
		"PROPERTY_CODE" => $arParams["DETAIL_PROPERTY_CODE"],
		"DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["detail"],
		"SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
		"META_KEYWORDS" => $arParams["META_KEYWORDS"],
		"META_DESCRIPTION" => $arParams["META_DESCRIPTION"],
		"BROWSER_TITLE" => $arParams["BROWSER_TITLE"],
		"SET_CANONICAL_URL" => $arParams["DETAIL_SET_CANONICAL_URL"],
		"DISPLAY_PANEL" => $arParams["DISPLAY_PANEL"],
		"SET_LAST_MODIFIED" => $arParams["SET_LAST_MODIFIED"],
		"SET_TITLE" => $arParams["SET_TITLE"],
		"MESSAGE_404" => $arParams["MESSAGE_404"],
		"SET_STATUS_404" => $arParams["SET_STATUS_404"],
		"SHOW_404" => $arParams["SHOW_404"],
		"FILE_404" => $arParams["FILE_404"],
		"INCLUDE_IBLOCK_INTO_CHAIN" => $arParams["INCLUDE_IBLOCK_INTO_CHAIN"],
		"ADD_SECTIONS_CHAIN" => $arParams["ADD_SECTIONS_CHAIN"],
		"ACTIVE_DATE_FORMAT" => $arParams["DETAIL_ACTIVE_DATE_FORMAT"],
		"CACHE_TYPE" => $arParams["CACHE_TYPE"],
		"CACHE_TIME" => $arParams["CACHE_TIME"],
		"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
		"USE_PERMISSIONS" => $arParams["USE_PERMISSIONS"],
		"GROUP_PERMISSIONS" => $arParams["GROUP_PERMISSIONS"],
		"DISPLAY_TOP_PAGER" => $arParams["DETAIL_DISPLAY_TOP_PAGER"],
		"DISPLAY_BOTTOM_PAGER" => $arParams["DETAIL_DISPLAY_BOTTOM_PAGER"],
		"PAGER_TITLE" => $arParams["DETAIL_PAGER_TITLE"],
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => $arParams["DETAIL_PAGER_TEMPLATE"],
		"PAGER_SHOW_ALL" => $arParams["DETAIL_PAGER_SHOW_ALL"],
		"CHECK_DATES" => $arParams["CHECK_DATES"],
		"ID" => $arResult["VARIABLES"]["ELEMENT_ID"],
		"ELEMENT_CODE" => $arResult["VARIABLES"]["ELEMENT_CODE"],
		"IBLOCK_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["news"],
		"USE_SHARE" => $arParams["USE_SHARE"],
		"SHARE_HIDE" => $arParams["SHARE_HIDE"],
		"SHARE_TEMPLATE" => $arParams["SHARE_TEMPLATE"],
		"SHARE_HANDLERS" => $arParams["SHARE_HANDLERS"],
		"SHARE_SHORTEN_URL_LOGIN" => $arParams["SHARE_SHORTEN_URL_LOGIN"],
		"SHARE_SHORTEN_URL_KEY" => $arParams["SHARE_SHORTEN_URL_KEY"],
		"ADD_ELEMENT_CHAIN" => (isset($arParams["ADD_ELEMENT_CHAIN"]) ? $arParams["ADD_ELEMENT_CHAIN"] : '')
	),
	$component
);?>
<!-- Comments section -->
<div class="comments-section">
<div class="comments-title" id="add-comment">
	<strong>Комментарии</strong>
<!--			<a href="#comments-form" class="leave-comment-btn btn-scroll-toggle">Оставить комментарий</a>-->
</div>
<?php $APPLICATION->IncludeComponent(
	"realcommenter:tape.show.tree", 
	".default", 
	array(
		"ACTIVE_FOR_NEW" => "Y",
		"COLLAPSE_BRANCH" => "2",
		"COMPLAINT_EMAIL" => "",
		"COMPLAINT_ONLY_FOR_REGISTERED" => "N",
		"DATE_FORMAT" => "1 december 2012",
		"DONT_TELL_MODERATORS" => "N",
		"EMAIL_REQUIRED" => "N",
		"EXPANDED_FRESH" => "1",
		"HIDE_EMAIL" => "N",
		"HIDE_EMAIL_FOR_AUTHORIZED" => "Y",
		"HIDE_FAXIMILLE" => "N",
		"HIDE_PHOTO_UPLOADER" => "N",
		"HIDE_SIGNATURE_FOR_AUTHORIZED" => "Y",
		"IBLOCK_ID" => "17",
		"IBLOCK_TYPE" => "iopen_tapes",
		"LANGUAGE_SPECIAL" => "",
		"LEVELS_ANCHORS" => "Y",
		"LIMIT_EVERY_NEXT" => "",
		"LIMIT_START" => "",
		"MAX_DEPTH_FOR_USERS" => "",
		"MORE_BAD_KEYS" => array(
		),
		"REVERSE_ORDER" => "N",
		"SHOW_ANONYM_PICTORGAMM" => "Y",
		"SHOW_DATE" => "Y",
		"SHOW_EMAIL_IN_TREE_FOR_ADMIN" => "Y",
		"SHOW_MODERATOR_STATUS" => "Y",
		"SHOW_TIME" => "Y",
		"SHOW_USER_LINK" => "N",
		"SIGNATURE_REQUIRED" => "N",
		"STATIC_URL" => "",
		"STYLES_MAP" => "",
		"USE_AUTHORIZATION" => "Y",
		"USE_COMPLAINT" => "Y",
		"USE_FLYOUT" => "N",
		"USE_PAGE_NAV" => "N",
		"USE_TIME_INTERVAL" => "Y",
		"USE_VOTES" => "Y",
		"USE_VOTES_FOR_ALL" => "Y",
		"WHO_MAY_COMMENT" => array(
		),
		"lang_add_comment" => "",
		"lang_anser_a" => "",
		"lang_answer_comment" => "",
		"lang_close_form" => "",
		"lang_commenter_avatar" => "",
		"lang_copy_comment_link" => "",
		"lang_left_faximille" => "",
		"lang_scroll_to_comment" => "",
		"lang_send_comment" => "",
		"lang_u_may_left_picture" => "",
		"lang_write_comment_to_send" => "",
		"lang_your_comment_on_moderation" => "",
		"COMPONENT_TEMPLATE" => ".default"
	),
	false
);?>

	    </div>
	    <!-- //comments section -->
	</div>
<div class="col-xs-12 col-md-3 article-section-aside">
<?php $APPLICATION->ShowViewContent("tags")?>
	<div class="aside-section" id="aside-news-section">
		<?$APPLICATION->IncludeComponent(
	"zircool:dtp.map.list",
	"list_sidebar",
	Array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"ADD_SECTIONS_CHAIN" => "Y",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"FIELD_CODE" => array("NAME",""),
		"FILTER_NAME" => "",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "11",
		"IBLOCK_TYPE" => "dtp_map",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
		"INCLUDE_SUBSECTIONS" => "Y",
		"MESSAGE_404" => "",
		"NEWS_COUNT" => "5",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Новости",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"PREVIEW_TRUNCATE_LEN" => "",
		"PROPERTY_CODE" => array("ADRESS","DATE",""),
		"SET_BROWSER_TITLE" => "Y",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "Y",
		"SET_META_KEYWORDS" => "Y",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "Y",
		"SHOW_404" => "N",
		"SORT_BY1" => "PROPERTY_DATE",
		"SORT_BY2" => "SORT",
		"SORT_ORDER1" => "DESC",
		"SORT_ORDER2" => "ASC"
	)
);?>
	</div>
	</div>
    </div>
</div>        

