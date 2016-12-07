<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
$APPLICATION->AddHeadScript("//api-maps.yandex.ru/2.1/?load=package.full&lang=ru-RU", true);
?>
<?php if(!empty($arResult['ITEMS'])):?>
	<div  class="locations-map" id="map">
		<!--Наша карта-->
	</div>
<script type="text/javascript">
	ymaps.ready(function () {
    var myMap = new ymaps.Map('map', {
            center: [55.751574, 37.573856],
            zoom: 9,
            behaviors: ['default', 'scrollZoom']
        }, {
            searchControlProvider: 'yandex#search'
        }),
        /**
         * Создадим кластеризатор, вызвав функцию-конструктор.
         * Список всех опций доступен в документации.
         * @see https://api.yandex.ru/maps/doc/jsapi/2.1/ref/reference/Clusterer.xml#constructor-summary
         */
            clusterer = new ymaps.Clusterer({
            /**
             * Через кластеризатор можно указать только стили кластеров,
             * стили для меток нужно назначать каждой метке отдельно.
             * @see https://api.yandex.ru/maps/doc/jsapi/2.1/ref/reference/option.presetStorage.xml
             */
            preset: 'islands#invertedVioletClusterIcons',
            /**
             * Ставим true, если хотим кластеризовать только точки с одинаковыми координатами.
             */
            groupByCoordinates: false,
            /**
             * Опции кластеров указываем в кластеризаторе с префиксом "cluster".
             * @see https://api.yandex.ru/maps/doc/jsapi/2.1/ref/reference/ClusterPlacemark.xml
             */
            clusterDisableClickZoom: true,
            clusterHideIconOnBalloonOpen: false,
            geoObjectHideIconOnBalloonOpen: false
        }),
	getPointOptions = function () {
            return {
                preset: 'islands#violetIcon'
            };
        },
        geoObjects = [];
    /**
     * Данные передаются вторым параметром в конструктор метки, опции - третьим.
     * @see https://api.yandex.ru/maps/doc/jsapi/2.1/ref/reference/Placemark.xml#constructor-summary
     */
    <?php foreach($arResult['ITEMS'] as$k=> $arItem):?>
	<?if(!empty($arItem['PROPERTY_26'])):?>
		geoObjects[<?=$k?>] = new ymaps.Placemark([<?=$arItem['PROPERTY_26']?>], {
		balloonContentBody: '<?=$arItem['BODY_YANDEX']?>',
		clusterCaption: '<?=$arItem['NAME']?>'
		}, getPointOptions());
	<?endif;?>
    <?php endforeach;?>
    /**
     * Можно менять опции кластеризатора после создания.
     */
    clusterer.options.set({
        gridSize: 80,
        clusterDisableClickZoom: true
    });

    /**
     * В кластеризатор можно добавить javascript-массив меток (не геоколлекцию) или одну метку.
     * @see https://api.yandex.ru/maps/doc/jsapi/2.1/ref/reference/Clusterer.xml#add
     */
    clusterer.add(geoObjects);
    myMap.geoObjects.add(clusterer);

    /**
     * Спозиционируем карту так, чтобы на ней были видны все объекты.
     */

    myMap.setBounds(clusterer.getBounds(), {
        checkZoomRange: true
    });
});
 
</script>
<?php else:?>
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<div class="search-results-item text-center">
				<br>
				<h1>ПО ВАШЕМУ ЗАПРОСУ НИЧЕГО НЕ НАЙДЕНО</h1>
				<p>Введите другой запрос или воспользуйтесь фильтрами.</p>
			</div>
		</div>
	</div>
<?endif;?>


