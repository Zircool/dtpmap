<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
<div class="locations-map-wrapper">
	<div class="locations-map-bar">
		<div class="locations-map-tabs">
			<ul class="nav nav-tabs" role="tablist">
				<li role="presentation" class="active"><a href="#tabFilters" aria-controls="tabFilters" role="tab" data-toggle="tab"><span>Фильтр</span></a></li>
				<li role="presentation"><a href="#tabLastEvents" aria-controls="tabLastEvents" role="tab" data-toggle="tab"><span>Последние ДТП</span></a></li>
				<li role="presentation"><a href="#tabLiveStream" aria-controls="tabLiveStream" role="tab" data-toggle="tab"><span>Прямой эфир</span></a></li>
			</ul>
		</div>
	<div class="tab-content">
	<!-- Tab "Фильтры" -->
		<div role="tabpanel" class="tab-pane active" id="tabFilters">
		<form>
			<div class="form-group">
				<label for="search-date-start">Период:</label>
				<div class="row">
					<div class="col-xs-12 col-sm-6">
						<div class="search-date">
							<input type="text" id="search-date-start" class="form-control search-date-start" placeholder="Начало">
							<button class="seach-date-toggle"><span></span><span></span><span></span></button>
						</div>
					</div>
					<div class="col-xs-12 col-sm-6">
						<div class="search-date">
							<input type="text" id="search-date-end" class="form-control search-date-end" placeholder="Конец">
							<button class="seach-date-toggle"><span></span><span></span><span></span></button>
						</div>
					</div>
				</div>
			</div>
		    <div class="row">
			<div class="col-xs-12">
			    <div class="form-group">
				<label for="search-filter-type">Тип ДТП:</label>
				<select name="search-filter-type" id="search-filter-type" class="form-control" data-jcf='{"wrapNative": false, "wrapNativeOnMobile": false, "fakeDropInBody": false, "useCustomScroll": false}'>
				    <option value="0">Все типы ДТП</option>
				    <option value="1">Опция выбора 1</option>
				    <option value="2">Опция выбора 2</option>
				    <option value="3">Опция выбора 3</option>
				    <option value="4">Опция выбора 4</option>
				</select>
			    </div>
			</div>
			<div class="col-xs-12">
			    <div class="form-group">
				<label for="search-filter-city">Город:</label>
				<select name="search-filter-city" id="search-filter-city" class="form-control" data-jcf='{"wrapNative": false, "wrapNativeOnMobile": false, "fakeDropInBody": false, "useCustomScroll": false}'>
				    <option value="0">Все города</option>
				    <option value="1">Москва</option>
				    <option value="2">Тула</option>
				    <option value="3">Владивосток</option>
				    <option value="4">Пермь</option>
				</select>
			    </div>
			</div>
		    </div>
		    <div class="form-group">
			<input class="btn-md-pink" type="submit" value="Подобрать">
		    </div>
		</form>
	    </div>
	    <!-- //tab "Фильтры" -->
	    <!-- Tab "Последние ДТП" -->
	    <div role="tabpanel" class="tab-pane" id="tabLastEvents">
		<div class="jcf-scrollable">
		    <ul class="latest-events">
			<li class="event">
			    <div class="event-heading clearfix">
				<span class="event-photo"><a href="#" title="Пять человек пострадали в ДТП с большегрузом на трассе М-1 Беларусь"><img src="img/search-results-img-1.jpg" alt="Пять человек пострадали в ДТП с большегрузом на трассе М-1 Беларусь"></a></span>
				<span class="event-location"><span class="event-town">г. Москва</span> <a href="#">Западное Бирюлёво, ул Подольских Курсантов</a></span>
			    </div>
			    <a href="#">Пять человек пострадали в ДТП с большегрузом на трассе М-1 Беларусь</a>
			    <span class="search-results-date">Сегодня 12:25</span>
			</li>
			<li class="event">
			    <div class="event-heading clearfix">
				<span class="event-photo"><a href="#" title="Пять человек пострадали в ДТП с большегрузом на трассе М-1 Беларусь"><img src="img/search-results-img-1.jpg" alt="Пять человек пострадали в ДТП с большегрузом на трассе М-1 Беларусь"></a></span>
				<span class="event-location"><span class="event-town">г. Москва</span> <a href="#">Западное Бирюлёво</a></span>
			    </div>
			    <a href="#">Пять человек пострадали в ДТП с большегрузом на трассе М-1 Беларусь</a>
			    <span class="search-results-date">Сегодня 12:25</span>
			</li>
			<li class="event">
			    <div class="event-heading clearfix">
				<span class="event-photo"><a href="#" title="Пять человек пострадали в ДТП с большегрузом на трассе М-1 Беларусь"><img src="img/search-results-img-1.jpg" alt="Пять человек пострадали в ДТП с большегрузом на трассе М-1 Беларусь"></a></span>
				<span class="event-location"><span class="event-town">г. Москва</span> <a href="#">Западное Бирюлёво, ул Подольских Курсантов</a></span>
			    </div>
			    <a href="#">Пять человек пострадали в ДТП с большегрузом на трассе М-1 Беларусь</a>
			    <span class="search-results-date">Сегодня 12:25</span>
			</li>
			<li class="event">
			    <div class="event-heading clearfix">
				<span class="event-photo"><a href="#" title="Пять человек пострадали в ДТП с большегрузом на трассе М-1 Беларусь"><img src="img/search-results-img-1.jpg" alt="Пять человек пострадали в ДТП с большегрузом на трассе М-1 Беларусь"></a></span>
				<span class="event-location"><span class="event-town">г. Москва</span> <a href="#">Западное Бирюлёво</a></span>
			    </div>
			    <a href="#">Пять человек пострадали в ДТП с большегрузом на трассе М-1 Беларусь</a>
			    <span class="search-results-date">Сегодня 12:25</span>
			</li>
			<li class="event">
			    <div class="event-heading clearfix">
				<span class="event-photo"><a href="#" title="Пять человек пострадали в ДТП с большегрузом на трассе М-1 Беларусь"><img src="img/search-results-img-1.jpg" alt="Пять человек пострадали в ДТП с большегрузом на трассе М-1 Беларусь"></a></span>
				<span class="event-location"><span class="event-town">г. Москва</span> <a href="#">Западное Бирюлёво, ул Подольских Курсантов</a></span>
			    </div>
			    <a href="#">Пять человек пострадали в ДТП с большегрузом на трассе М-1 Беларусь</a>
			    <span class="search-results-date">Сегодня 12:25</span>
			</li>
			<li class="event">
			    <div class="event-heading clearfix">
				<span class="event-photo"><a href="#" title="Пять человек пострадали в ДТП с большегрузом на трассе М-1 Беларусь"><img src="img/search-results-img-1.jpg" alt="Пять человек пострадали в ДТП с большегрузом на трассе М-1 Беларусь"></a></span>
				<span class="event-location"><span class="event-town">г. Москва</span> <a href="#">Западное Бирюлёво</a></span>
			    </div>
			    <a href="#">Пять человек пострадали в ДТП с большегрузом на трассе М-1 Беларусь</a>
			    <span class="search-results-date">Сегодня 12:25</span>
			</li>
		    </ul>
		</div>
	    </div>
	    <!-- //tab "Последние ДТП" -->
	    <!-- Tab "Прямой эфир" -->
	    <div role="tabpanel" class="tab-pane" id="tabLiveStream">
		<div class="jcf-scrollable">
		    <ul class="online-events-list">
			<li class="event">
			    <div class="event-title">
				<span class="event-author">Татьяна Миннибаева</span> <span class="event-date">16.08.2016</span>
			    </div>
			    <p>
				<a href="#" class="event-link">Да, жаль, что сегодня так много беспредела на дорогах. Хочется надеяться, что все наладится и власти что нибудь придумают</a>
			    </p>
			    <p><a href="#" class="btn-xs-grey">Подробнее о ДТП</a></p>
			</li>
			<li class="event">
			    <div class="event-title">
				<span class="event-author">Татьяна Миннибаева</span> <span class="event-date">16.08.2016</span>
			    </div>
			    <p>
				<a href="#" class="event-link">Да, жаль, что сегодня так много беспредела на дорогах. Хочется надеяться, что все наладится и власти что нибудь придумают</a>
			    </p>
			    <p><a href="#" class="btn-xs-grey">Подробнее о ДТП</a></p>
			</li>
			<li class="event">
			    <div class="event-title">
				<span class="event-author">Татьяна Миннибаева</span> <span class="event-date">16.08.2016</span>
			    </div>
			    <p>
				<a href="#" class="event-link">Да, жаль, что сегодня так много беспредела на дорогах. Хочется надеяться, что все наладится и власти что нибудь придумают</a>
			    </p>
			    <p><a href="#" class="btn-xs-grey">Подробнее о ДТП</a></p>
			</li>
			<li class="event">
			    <div class="event-title">
				<span class="event-author">Татьяна Миннибаева</span> <span class="event-date">16.08.2016</span>
			    </div>
			    <p>
				<a href="#" class="event-link">Да, жаль, что сегодня так много беспредела на дорогах. Хочется надеяться, что все наладится и власти что нибудь придумают</a>
			    </p>
			    <p><a href="#" class="btn-xs-grey">Подробнее о ДТП</a></p>
			</li>
			<li class="event">
			    <div class="event-title">
				<span class="event-author">Татьяна Миннибаева</span> <span class="event-date">16.08.2016</span>
			    </div>
			    <p>
				<a href="#" class="event-link">Да, жаль, что сегодня так много беспредела на дорогах. Хочется надеяться, что все наладится и власти что нибудь придумают</a>
			    </p>
			    <p><a href="#" class="btn-xs-grey">Подробнее о ДТП</a></p>
			</li>
			<li class="event">
			    <div class="event-title">
				<span class="event-author">Татьяна Миннибаева</span> <span class="event-date">16.08.2016</span>
			    </div>
			    <p>
				<a href="#" class="event-link">Да, жаль, что сегодня так много беспредела на дорогах. Хочется надеяться, что все наладится и власти что нибудь придумают</a>
			    </p>
			    <p><a href="#" class="btn-xs-grey">Подробнее о ДТП</a></p>
			</li>
		    </ul>
		</div>
	    </div>
	    <!-- //tab "Прямой эфир" -->
	</div>
    </div>
	<?php $APPLICATION->IncludeComponent("zircool:dtp.map.list", ".default_map", array(
			"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
			"IBLOCK_ID" => $arParams["IBLOCK_ID"],
			"NEWS_COUNT" => $arParams["NEWS_COUNT"],
			"SORT_BY1" => $arParams["SORT_BY1"],
			"SORT_ORDER1" => $arParams["SORT_ORDER1"],
			"SORT_BY2" => $arParams["SORT_BY2"],
			"SORT_ORDER2" => $arParams["SORT_ORDER2"],
			"FIELD_CODE" => $arParams["LIST_FIELD_CODE"],
			"PROPERTY_CODE" => $arParams["LIST_PROPERTY_CODE"],
			"DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["detail"],
			"SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
			"IBLOCK_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["dtp"],
			"DISPLAY_PANEL" => $arParams["DISPLAY_PANEL"],
			"SET_TITLE" => $arParams["SET_TITLE"],
			"SET_LAST_MODIFIED" => $arParams["SET_LAST_MODIFIED"],
			"MESSAGE_404" => $arParams["MESSAGE_404"],
			"SET_STATUS_404" => $arParams["SET_STATUS_404"],
			"SHOW_404" => $arParams["SHOW_404"],
			"FILE_404" => $arParams["FILE_404"],
			"INCLUDE_IBLOCK_INTO_CHAIN" => $arParams["INCLUDE_IBLOCK_INTO_CHAIN"],
			"CACHE_TYPE" => $arParams["CACHE_TYPE"],
			"CACHE_TIME" => $arParams["CACHE_TIME"],
			"CACHE_FILTER" => $arParams["CACHE_FILTER"],
			"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
			"DISPLAY_TOP_PAGER" => $arParams["DISPLAY_TOP_PAGER"],
			"DISPLAY_BOTTOM_PAGER" => $arParams["DISPLAY_BOTTOM_PAGER"],
			"PAGER_TITLE" => $arParams["PAGER_TITLE"],
			"PAGER_TEMPLATE" => $arParams["PAGER_TEMPLATE"],
			"PAGER_SHOW_ALWAYS" => $arParams["PAGER_SHOW_ALWAYS"],
			"PAGER_DESC_NUMBERING" => $arParams["PAGER_DESC_NUMBERING"],
			"PAGER_DESC_NUMBERING_CACHE_TIME" => $arParams["PAGER_DESC_NUMBERING_CACHE_TIME"],
			"PAGER_SHOW_ALL" => $arParams["PAGER_SHOW_ALL"],
			"PAGER_BASE_LINK_ENABLE" => $arParams["PAGER_BASE_LINK_ENABLE"],
			"PAGER_BASE_LINK" => $arParams["PAGER_BASE_LINK"],
			"PAGER_PARAMS_NAME" => $arParams["PAGER_PARAMS_NAME"],
			"DISPLAY_DATE" => $arParams["DISPLAY_DATE"],
			"DISPLAY_NAME" => "Y",
			"DISPLAY_PICTURE" => $arParams["DISPLAY_PICTURE"],
			"DISPLAY_PREVIEW_TEXT" => $arParams["DISPLAY_PREVIEW_TEXT"],
			"PREVIEW_TRUNCATE_LEN" => $arParams["PREVIEW_TRUNCATE_LEN"],
			"ACTIVE_DATE_FORMAT" => $arParams["LIST_ACTIVE_DATE_FORMAT"],
			"USE_PERMISSIONS" => $arParams["USE_PERMISSIONS"],
			"GROUP_PERMISSIONS" => $arParams["GROUP_PERMISSIONS"],
			"FILTER_NAME" => $arParams["FILTER_NAME"],
			"HIDE_LINK_WHEN_NO_DETAIL" => $arParams["HIDE_LINK_WHEN_NO_DETAIL"],
			"CHECK_DATES" => $arParams["CHECK_DATES"],
		),
		$component
	);?>

</div>
