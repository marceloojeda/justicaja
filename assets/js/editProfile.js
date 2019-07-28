$(document).ready(function() {
	Initpage();
	Eventos();

	setStage();
});

function Initpage(){
	//$("#foto-perfil").fileinput({'showUpload':false, 'previewFileType':'any'});
	
	$('#divMenu').addClass('hide');

	$('.cpfOuCnpj').mask('000.000.000-000', options);
	cepFocused();
}

function Eventos(){
	$('#showAndress').on('click', function(){
		$('#personal-info').addClass('hide');
		$('#login-info').addClass('hide');

		$('#andress-info').removeClass('hide');
	});
	$('#showLogin').on('click', function(){
		$('#personal-info').addClass('hide');
		$('#andress-info').addClass('hide');

		$('#login-info').removeClass('hide');
	});
	$('#showPersonal').on('click', function(){
		$('#andress-info').addClass('hide');
		$('#login-info').addClass('hide');

		$('#personal-info').removeClass('hide');
	});

	$("#foto-perfil").on('click', function(){
		var formData = new FormData(this);

		$.ajax ({
			url: '../uploadFoto',
			type: 'post',
			data: formData,
			dataType: 'json'
		}).done(function(result) {
			if(result){
				$('foto-perfil').attr('src', result);
			}
			else{
				console.log("Não foi possivel registrar o voto.");
			}
		}).fail(function(data){
			console.log(data.responseText);
		});
	})
}

function setStage(){
	var stage = $('[name=Stage]').val();
	if(stage == "personalInfo")
		$('#showPersonal').click();
	if(stage == "andressInfo")
		$('#showAndress').click();
	if(stage == "loginInfo")
		$('#showLogin').click();
}