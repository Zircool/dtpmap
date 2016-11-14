$(document).ready(function() {	
	$('#datepicker').datepicker();
})




BX.ready(function(){

});

/*
 * Сохраняем ДТП
 */
function AddDtp(){
	BX.showWait();
	var errors = [];
	var imgs = [];
	var error = "";
	var fields =  BX.findChild(BX("file-selectdialog-"+BX("uid-input").value), {
				'tag': 'input',
				'type': 'hidden'
			},
			true,
			true
	);
	
	fields.forEach(function(element){
		if(element.value != ""){
			imgs.push(element.value)
		}
	});
	
	
	postData = {
		'sessid': BX.bitrix_sessid(),
		'date': BX('search-date-start').value,
		'lat':BX('lat').value,
		'lng':BX('lng').value,
		'type':BX('crash-type').value,
		'adress':BX('adress').value,
		'name':BX('name').value,
		'detail':BX('detail').value,
		'video_link':BX('video_link').value,
		'tags':$('#tags').val(),
		'link':BX('link').value,
		'imgs':imgs,
	};
	
	if(postData.type == 0){
		errors.push('Выберите тип происшествия.');
	}
	
	if(postData.adress == ""){
		errors.push('Заполните адрес.');
	}
	
	if(postData.name == ""){
		errors.push('Укажите заголовок.');
	}
	
	
	if(errors.length != 0){
		
		errors.forEach(function(er){
			error = error + er+"</br>"; 
		});
		yaCounter40888589.reachGoal('ADD_DTP_ERROR');
		debugger;
		$('#err-field').html(error);
		$('#formErrorModal').modal();
		return;
	}
	
	
	BX.ajax({
		url: '/ajax/add.php',
		method: 'POST',
		data: postData,
		dataType: 'json',
		timeout: 30,
		onsuccess: function(result){
			BX.closeWait();
			if(result.ERROR){
				yaCounter40888589.reachGoal('ADD_DTP_ERROR');
				result.ERRORS.forEach(function(er){
					error = error + er+"</br>"; 
				});
				$('#err-field').html(error);
				$('#formErrorModal').modal();
				return;
			}else{
				yaCounter40888589.reachGoal('ADD_DTP_COMPLETE');
				$('#formErrorModalLabel').text('Успешно');
				$('#modal-body-err').html('<p>Информация о ДТП успешно добавлена.</p>');
				$('#err-but').text('Перейти к записи');
				$('#formErrorModal').modal();
			}
		},
		onfailure:function(er){
			BX.closeWait();
			yaCounter40888589.reachGoal('ADD_DTP_ERROR');
			$('#formErrorModalLabel').text('Ошибка');
			$('#modal-body-err').html('<p>На сервере произошла ошибка. Пожалуйста повторите попытку позже.</p>');
			$('#err-but').text('Закрыть');
			$('#formErrorModal').modal();
			
		},
	});
}





ymaps.ready(init);
function init(){
	var myPlacemark;
	var geolocation = ymaps.geolocation,
			myMap = new ymaps.Map('YMapsID', {
				center: [55.74954, 37.621587],
				zoom: 10
			}, {
				searchControlProvider: 'yandex#search'
			});

	// Сравним положение, вычисленное по ip пользователя и
	// положение, вычисленное средствами браузера.
	geolocation.get({
		provider: 'auto',
		mapStateAutoApply: true
	}).then(function (result) {
		// Красным цветом пометим положение, вычисленное через ip.
//		result.geoObjects.options.set('preset', 'islands#redCircleIcon');
//		result.geoObjects.get(0).properties.set({
//			balloonContentBody: 'Мое местоположение'
//		});
//		myMap.geoObjects.add(result.geoObjects);

	myPlacemark = createPlacemark(result.geoObjects.position);
		myMap.geoObjects.add(myPlacemark);
		myMap.setCenter(result.geoObjects.position);
		myMap.setZoom(18);
		getAddress(result.geoObjects.position);
		
		$("#lat").val(result.geoObjects.position[0]);
		$("#lng").val(result.geoObjects.position[1]);
	});


	// Слушаем клик на карте

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
			if($('#name').val() == ""){
				$('#name').val("ДТП "+firstGeoObject.properties.get('name'));
			}
			$("#adress").val(firstGeoObject.properties.get('text'));
			myPlacemark.properties
					.set({
						iconContent: firstGeoObject.properties.get('name'),
						balloonContent: firstGeoObject.properties.get('text')
					});
		});
	}
	
	
}
