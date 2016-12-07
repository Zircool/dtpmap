$(document).ready(function() {	
	Dropzone.options.myAwesomeDropzone = {
		maxFilesize: 10,
		addRemoveLinks: true,
		dictResponseError: 'Server not Configured',
		acceptedFiles: ".jpg,.bmp,.jpeg,.jpe,.gif,.png,.mp4",
		dictDefaultMessage:"Перетащите сюда файлы или нажмите, что бы загрузить.",
		dictCancelUpload:"Отменить загрузку",
		dictCancelUploadConfirmation:"Вы действительно хотите прервать загрузку?",
		dictInvalidFileType:"Запрещена загрузка файла данного типа.",
		init: function () {
			var self = this;
			// config
			self.options.addRemoveLinks = true;
			self.options.dictRemoveFile = "Удалить";
			//New file added
			self.on("addedfile", function (file) {
				//console.log('new file added ', file);
			});
			// Send file starts
			self.on("sending", function (file) {
				//console.log('upload started', file);
				$('.meter').show();
			});

			// File upload Progress
			self.on("totaluploadprogress", function (progress) {
				//console.log("progress ", progress);
				$('.roller').width(progress + '%');
			});

			self.on("queuecomplete", function (progress) {
				$('.meter').delay(999).slideUp(999);
			});

			// On removing file
			self.on("removedfile", function (file) {
				//console.log(file);
				// Получаем атрибут и удаляем файл 
				var fid = file._removeLink.getAttribute('fid');
				BX.remove(BX('file-'+fid));
				debugger;
			});
			
			// complete 
			self.on("success", function (file,res) {
				console.log(file);
				if(file.status == "success"){
					if(file.xhr.status == 200){
						var result = JSON.parse(res);
						file._removeLink.setAttribute('fid',result.FID);
						var hidden = BX.create('INPUT', {
							props: {
								'id': 'file-'+result.FID,
								'type': 'hidden',
								'className':'drop-file',
								'name': 'DROPZONE[]',
								'value': result.FID
							}
						});
						
						BX('my-awesome-dropzone').appendChild(hidden); 
						debugger;
					}
				}
				debugger;
			});
			self.on("complete", function (file) {
				//console.log(file);
			});
		}
	};
})