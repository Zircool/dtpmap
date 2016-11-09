$(document).ready(function() {	
	$('#datepicker').datepicker();
	Dropzone.options.myAwesomeDropzone = {
		maxFilesize: 5,
		addRemoveLinks: true,
		dictResponseError: 'Server not Configured',
		acceptedFiles: ".png,.jpg,.gif,.bmp,.jpeg",
		dictDefaultMessage:"Фото и видео материалы",
		init: function () {
			var self = this;
			// config
			self.options.addRemoveLinks = true;
			self.options.dictRemoveFile = "Удалить";
			//New file added
			self.on("addedfile", function (file) {
				console.log('new file added ', file);
			});
			// Send file starts
			self.on("sending", function (file) {
				console.log('upload started', file);
				$('.meter').show();
			});

			// File upload Progress
			self.on("totaluploadprogress", function (progress) {
				console.log("progress ", progress);
				$('.roller').width(progress + '%');
			});

			self.on("queuecomplete", function (progress) {
				$('.meter').delay(999).slideUp(999);
			});

			// On removing file
			self.on("removedfile", function (file) {
				console.log(file);
			});
		}
	};
})



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
		provider: 'yandex',
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
			$("#adress").val(firstGeoObject.properties.get('text'));
			myPlacemark.properties
					.set({
						iconContent: firstGeoObject.properties.get('name'),
						balloonContent: firstGeoObject.properties.get('text')
					});
		});
	}
	
	
}
