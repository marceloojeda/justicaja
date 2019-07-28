$(document).ready(function() {
	Initpage();
	Eventos();
});

function Initpage(){
	SelectOption($("[name=TipoPessoa_Autor]").val(), "tipoPessoa_Autor");
	SelectOption($("[name=TipoDocumento_Autor]").val(), "tipoDoc_Autor");

	SelectOption($("[name=TipoPessoa_Reu]").val(), "tipoPessoa_Reu");
	SelectOption($("[name=TipoDocumento_Reu]").val(), "tipoDoc_Reu");

  // $("#ddlStatus").addClass('select-readonly');
  $('.summernote').summernote({ height: 300 });
}

function Eventos(){
	
}

function SelectOption(valueToSelect, elementId)
{    
    var element = document.getElementById(elementId);
    if(element){
      element.value = valueToSelect;
    }
}

function openCity(evt, cityName) {
  var i, x, tablinks;
  x = document.getElementsByClassName("city");
  for (i = 0; i < x.length; i++) {
      x[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablink");
  for (i = 0; i < x.length; i++) {
      $(tablinks[i]).removeClass('w3-red');
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " w3-red";
}