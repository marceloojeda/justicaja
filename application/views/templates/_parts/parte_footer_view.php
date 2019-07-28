<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<!-- FIM DO CONTAINER #wrap -->
</div>

<footer class="pt-4 my-md-5 pt-md-5 border-top">
  <div class="container">
    <div class="text-center">
      <small>Copyright © Your Website 2018</small>
    </div>
  </div>
</footer>


<?php echo $before_body;?>

<?php 
//echo $InformacaoTela;
?>

<script type="text/javascript">
	$(document).ready(function() {
		toastr.options = {
		  "closeButton": false,
		  "debug": false,
		  "newestOnTop": false,
		  "progressBar": true,
		  "positionClass": "toast-top-right",
		  "preventDuplicates": true,
		  "onclick": null,
		  "showDuration": "300",
		  "hideDuration": "1000",
		  "timeOut": "5000",
		  "extendedTimeOut": "1000",
		  "showEasing": "swing",
		  "hideEasing": "linear",
		  "showMethod": "fadeIn",
		  "hideMethod": "fadeOut"
		}
	})
</script>

</body>
</html>