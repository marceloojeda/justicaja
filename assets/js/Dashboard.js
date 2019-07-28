$(document).ready(function() {
    Initpage();
    Eventos();
});

function Initpage(){
	$('.dropdown-toggle').dropdown();
}

function Eventos(){
	$('.countdown').each(function(){
		var prazo = $(this).find('input');
		var clock = $(this).find('span');
		startCronometro(clock, prazo.val());
	})
}

function startCronometro(elemento, prazo){
	$(elemento).countdown(prazo, function(event) {
	  $(elemento).html(event.strftime('%D dias %H horas %M minutos'));
	});
}