<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
   die(); 
?>


<div class="search-panel clearfix">
	<h2><?$APPLICATION->ShowTitle()?></h2>
	<ul class="search-panel-nav clearfix">
		<li><a href="/" class="sp-btn-back"><span>Вернуться к карте ДТП</span></a></li>
	</ul>
</div>

<div class="form-section">
	<div class="section-heading text-center">
		<h1><?$APPLICATION->ShowTitle()?></h1>
		<p>Для добавления ДТП заполните, пожалуйста, все поля</p>
	</div>
	<div class="row">
	<div class="col-xs-12 col-md-10 col-md-offset-1 col-lg-8 col-lg-offset-2">
		<input type="hidden" id="lng" value="<?=$arResult['LNG']?>">
		<input type="hidden" id="lat" value="<?=$arResult['LAT']?>">
		<div class="row">
			<div class="col-xs-12 col-sm-6 col-md-3">
				<label>Дата аварии:</label>
				<div class="form-group">
					<div class="search-date">
						<input type="text" id="search-date-start" class="form-control datepicker" placeholder="Начало">
						<button class="seach-date-toggle"><span></span><span></span><span></span></button>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-6 col-md-5">
				<label for="">Тип ДТП:</label>
				<div class="form-group">
					<select name="crash-type" id="crash-type" class="form-control"  data-jcf='{"wrapNative": false, "wrapNativeOnMobile": false, "fakeDropInBody": false, "useCustomScroll": false}'>
						<option value="0">Выберите тип ДТП</option>
							<?foreach($arResult['SECTIONS'] as $sid=>$sname):?>
								<option value="<?=$sid?>"><?=$sname?></option>
							<?endforeach;?>	
					</select>
				</div>
			</div>
			<div class="col-xs-12">
				<label>Место аварии:</label>
				<p>Отметьте на мето ДТП на карте самостоятельно, либо нажмите кнопку автоопределения Вашего нахождения</p>
<!--					<p><button onclick="GetPosition();" class="btn-sm-pink btn-locate" title="Автоопределение вашего текущего положения">Автоопределение</button></p>-->
				<div class="form-section-map" id="YMapsID"></div>
			</div>
			<div class="col-xs-12">
				<label>Адрес происшествия:</label>
				<div class="form-group">
					<input type="text" id="adress" class="form-control" placeholder="Адрес происшествия">
				</div>
			</div>
			<div class="col-xs-12">
				<label>Заголовок:</label>
				<div class="form-group">
					<input type="text" class="form-control" placeholder="Напишите заголовок, отражающий суть ДТП">
				</div>
			</div>
			<div class="col-xs-12">
				<label>Полное описание:</label>
				<div class="form-group">
					<textarea class="form-control" cols="30" rows="10" placeholder="Пожалуйста, опишите подробнее детали ДПТ"></textarea>
				</div>
			</div>
			<div class="col-xs-12">
				<form action="/tmp" method="post" class="dropzone" id="my-awesome-dropzone">
					<div class="fallback">
						<input name="file" type="file" />
					</div>
				</form>
			</div>
		    <div class="col-xs-12">
			<label>Видео:</label>
		    </div>
		    <div class="col-xs-12">
			<label>Теги:</label>
			<div class="form-group">
			    <input type="text" class="form-control" placeholder="Напишите заголовок, отражающий суть ДТП">
			</div>
		    </div>
		    <div class="col-xs-12">
			<label>Добавить видео по ссылке:</label>
			<div class="form-group">
			    <input type="text" class="form-control">
			</div>
		    </div>
		    <div class="col-xs-12">
			<label>Ссылка на источник <small>Пожалуйста, разместите ссылку на источник, если материал взят с другого сайта</small></label>
			<div class="form-group">
			    <input type="text" class="form-control">
			</div>
		    </div>
		    <div class="col-xs-12">
			<p>
			    <button type="submit" class="btn-md-pink">Добавить ДТП</button>
			</p>
		    </div>
		</div>

	</div>
	</div>
</div>

<?php return;?>


<div class="content animate-panel">
	<div class="row">
	    <div class="col-lg-12 animated-panel zoomIn" style="animation-delay: 0.1s;">
		<div class="hpanel">
		    <div class="panel-body">
			<h3>Добавить ДТП на карту</h3>                
		    </div>
		</div>
	    </div>
	</div>
	
	
	<div class="hpanel">

		<div class="panel-body">
			<form method="POST" class="form-horizontal">
			<div class="form-group"><label class="col-sm-2 control-label">Дата аварии</label>
	
				<div class="col-sm-10">		
					<div class="input-group date" id="datepicker">
						<input type="text" required="required" class="form-control"><span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
					</div
				</div>
			</div>
				

				
			<div class="form-group"><label class="col-sm-2 control-label">Место аварии<br>
			<span class="font-light">Просто щёлкните на карте,
остальное мы сделаем за Вас
<p>Для этого надо включить опцию Сообщить местоположение в Вашем браузере.</p></span>
			</label>
	
			    <div class="col-sm-10">
				<div id="map"  style="width:100%;height: 300px;"></div>						
			    </div>
			</div>
			
			<div class="form-group"><label class="col-sm-2 control-label">Координаты</label>
	
			    <div class="col-sm-10">
				<div class="col-md-2"><input id="lat" type="text" placeholder="широта" class="form-control"></div> 
				<div class="col-md-2"><input id="lng" type="text" placeholder="долгота" class="form-control"></div>
			    </div>
			</div>
			
			<div class="hr-line-dashed"></div>
			
			<div class="form-group"><label  class="col-sm-2 control-label">Адрес</label>
	
			    <div class="col-sm-10"><input required="required" id="adress" type="text" class="form-control"></div>
			</div>
			
			<div class="hr-line-dashed"></div>
			
			<div class="form-group"><label  class="col-sm-2 control-label">Заголовок</label>
	
			    <div class="col-sm-10"><input required="required"  id="adress" type="text" class="form-control"></div>
			</div>
			
			
			<div class="hr-line-dashed"></div>
			
			<div class="form-group"><label class="col-sm-2 control-label">Полное описание</label>
				<div class="col-sm-10">
					<textarea rows="5" required="required" class="form-control"> </textarea>
				</div>
			</div>
			
			<div class="hr-line-dashed"></div>
			
			<div class="form-group"><label  class="col-sm-2 control-label">Ссылка на видео</label>
	
			    <div class="col-sm-10"><input required="required"  id="adress" type="text" class="form-control"></div>
			</div>
			

			<div class="form-group">
			    <div class="col-sm-8 col-sm-offset-2">
				<button class="btn btn-default" type="submit">Отмена</button>
				<button class="btn btn-primary" type="submit">Добавить место ДТП</button>
			    </div>
			</div>
			

			</form>
			
	      </div>
        </div>

</div>

<script src="//api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>
	
<script type="text/javascript">
var myMap;

// Дождёмся загрузки API и готовности DOM.
ymaps.ready(init);
function init() 
    var myPlacemark;

	var myMap = new ymaps.Map('map', {
            center: [55.753994, 37.622093],
            zoom: 9
        }, {
            searchControlProvider: 'yandex#search'
        });

 
    // Слушаем клик на карте
    debugger;
    myMap.events.add('click', function (e) {
        var coords = e.get('coords');
	
	//Задаем координаты
	$("#lat").val(coords[0]);
	$("#lng").val(coords[1]);

        // Если метка уже создана – просто передвигаем ее
        if (myPlacemark) {
            myPlacemark.geometry.setCoordinates(coords);
        }
        // Если нет – создаем.
        else {
            myPlacemark = createPlacemark(coords);
            myMap.geoObjects.add(myPlacemark);
            // Слушаем событие окончания перетаскивания на метке.
            myPlacemark.events.add('dragend', function () {
                getAddress(myPlacemark.geometry.getCoordinates());
            });
        }
        getAddress(coords);
    });

    // Создание метки
    function createPlacemark(coords) {
        return new ymaps.Placemark(coords, {
            iconContent: 'Поиск места...'
        }, {
            preset: 'islands#nightStretchyIcon',
            draggable: true
        });
    }

    // Определяем адрес по координатам (обратное геокодирование)
    function getAddress(coords) {
        myPlacemark.properties.set('iconContent', 'Поиск...');
        ymaps.geocode(coords).then(function (res) {
            var firstGeoObject = res.geoObjects.get(0);
	    $("#adress").val(firstGeoObject.properties.get('text')); 
            myPlacemark.properties
                .set({
                    iconContent: firstGeoObject.properties.get('name'),
                    balloonContent: firstGeoObject.properties.get('text')
                });
        });
    }
}
    
</script>
	


