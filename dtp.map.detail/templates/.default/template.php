<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>

	    <div class="article">
                <h1 class="text-center"><?=$arResult['NAME']?></h1>
                <ul class="article-details">
		    <li><span class="search-results-date"><?=$arResult['PROPERTIES']['DATE']['VALUE']?></span></li>
		    <li><a href="#" class="article-author"><?=$arResult['CREATED_USER_NAME']?></a></li>
<!--		    <li><a href="#" class="article-comments">1 комментарий (ев)</a></li>-->
                </ul>
		<?php if(!empty($arResult['IMG'])):?>
			<div class="article-full-width">
				<div class="article-gallery" itemscope itemtype="http://schema.org/ImageObject">
					<?php foreach($arResult['IMG'] as $fid=>$arItem):?>
						<div class="item"><img itemprop="contentUrl" alt="<?=$arResult['NAME']?>" src="<?=$arItem['SRC']?>"></div>
					<?php endforeach;?>
				</div>
			</div>
		<?php endif;?>
		<div class="article-location" >
			<?php if(!empty($arResult['PROPERTIES']['ADRESS']['VALUE'])):?>
				<span class="well"><?=$arResult['PROPERTIES']['ADRESS']['VALUE']?></span>
			<?endif?>
			<?php if(!empty($arResult['PROPERTIES']['MAP']['VALUE'])):?>
			<a href="#article-location-map" class="article-location-btn btn-scroll-toggle" onclick="ShowMap();" title="Смотреть на карте">Смотреть на карте</a>
			<?endif;?>
		</div>
		<?php if(!empty($arResult['DETAIL_TEXT'])):?>
			<p><?=$arResult['~DETAIL_TEXT']?></p>
		<?php endif;?>
		<?php if(!empty($arResult['PROPERTIES']['MAP']['VALUE'])):?>
		<!--Тут же вставляем JS код-->
		<script>
			ymaps.ready(init);
			function init(){

				var 	myMap = new ymaps.Map('article-location-map', {
							center: [<?=$arResult['PROPERTIES']['MAP']['VALUE']?>],
							zoom: 14
						}, {
							searchControlProvider: 'yandex#search'
						});

					var myPlacemark = new ymaps.Placemark(
					// Координаты метки
					[<?=$arResult['PROPERTIES']['MAP']['VALUE']?>]
					);
 
				// Добавление метки на карту
				myMap.geoObjects.add(myPlacemark);
			}


		</script>
		<div class="form-section-map" id="article-location-map"></div>
		<?endif;?>
		<div class="article-social">
			<div class="article-social-title">Поделиться в соцсетях:</div>
			<ul class="clearfix">
			<script src="//yastatic.net/es5-shims/0.0.2/es5-shims.min.js"></script>
			<script src="//yastatic.net/share2/share.js"></script>
			<div class="ya-share2" data-services="vkontakte,facebook,odnoklassniki,moimir,twitter,viber,whatsapp,telegram"></div>
			</ul>
		</div>
		<ul class="pager article-pager">
			<?php if(!empty($arResult['PREV'])):?>
				<li><a href="<?=$arResult['PREV'][0]['DETAIL_PAGE_URL']?>" title="Предыдущее ДТП"><span aria-hidden="true"></span>Предыдущее ДТП</a></li>
			<?else:?>
				<li><a href="/" title="Предыдущее ДТП"><span aria-hidden="true"></span>Предыдущее ДТП</a></li>
			<?endif;?>
			
			<?php if(!empty($arResult['NEXT'])):?>
				<li><a href="<?=$arResult['NEXT'][0]['DETAIL_PAGE_URL']?>" title="Следующее ДТП">Следующее ДТП<span aria-hidden="true"></span></a></li>
			<?else:?>
				<li><a href="/" title="Следующее ДТП">Следующее ДТП<span aria-hidden="true"></span></a></li>
			<?endif;?>
		</ul>
		</div>
	<?php $this->SetViewTarget("tags");?>
		<?if(!empty($arResult['TAGS'])):?>
			<div class="aside-section">
				<ul class="aside-tags clearfix">
					<?foreach($arResult['ARRAY_TAGS'] as $tag):?>
						<li><a rel="nofollow" href="/?tag=<?=$tag?>">#<?=$tag?></a></li>
					<?endforeach;?>
				</ul>
			</div>
		<?endif;?>
	<?php $this->EndViewTarget();?>
	