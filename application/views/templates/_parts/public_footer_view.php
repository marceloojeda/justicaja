<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<footer class="pt-4 my-md-5 pt-md-5 border-top">
  <div class="container">
    <div class="text-center">
      <small>Copyright © Your Website 2018</small>
    </div>
  </div>
</footer>
<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
  <i class="fa fa-angle-up"></i>
</a>

<!-- Bootstrap Core JavaScript -->
<script src="assets/vendor/jquery/jquery-3.2.1.min.js"></script>

<script src="assets/vendor/jquery/jquery-ui-1.8.24.min.js"></script>

<script src="assets/vendor/bootstrap/js/utils.js"></script>

<script src="assets/vendor/bootstrap/js/bootstrap.min.js"></script>

<script src="assets/vendor/toastr/toastr.min.js"></script>

<script src="assets/js/base.js"></script>

<script src="assets/js/jquery.backstretch.min.js"></script>
<script src="assets/js/scripts.js"></script>

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