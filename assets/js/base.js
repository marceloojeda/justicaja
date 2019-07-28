$(document).ready(function(){
  $('.dropdown-toggle').on("click", function(e){
    $(this).next('ul').toggle();
    e.stopPropagation();
    e.preventDefault();
  });
});

function getBaseUrl() {
	var re = new RegExp(/^.*\//);
	return re.exec(window.location.href);
}

function confirmaOperacao(){
  if (confirm("Confirma essa operação?")){
    return true;
  }else{
    return false;
  }
}