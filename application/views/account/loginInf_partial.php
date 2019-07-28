<div class="col-md-9 personal-info">
	
	<?php $this->load->view('account/validation_message');?>
	
	<h3>Andress Info</h3>

	<form class="form-horizontal" role="form" action="SaveLoginInfo" method="post">
		<?php echo form_hidden('Id', $dataPost['result']['Id']); ?>
		<div class="form-group">
			<label class="col-md-3 control-label">Username:</label>
			<div class="col-md-8">
				<input class="form-control" type="text" value="<?php echo $dataPost['result']['Email']; ?>" name="UserName" readonly>
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-3 control-label">Password:</label>
			<div class="col-md-8">
				<input class="form-control" type="password" name="Password">
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-3 control-label">Confirm password:</label>
			<div class="col-md-8">
				<input class="form-control" type="password" name="ConfirmPassword">
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-3 control-label"></label>
			<div class="col-md-8">
				<button type="submit" class="btn btn-primary">Save Changes</button>
				<span></span>
			</div>
		</div>
	</form>
</div>