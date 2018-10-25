<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="card mx-auto skui-h-center">
	<div class="card-header">
		<h3>User Login</h3>
	</div>
	<form class="create-edit-form card-body ajax-submit" action="<?php echo base_url("user/doLogin"); ?>" method="post">
		<div class="form-group has-feedback">
			<input type="email" class="form-control" name="email" placeholder="Email" maxlength="150" required value>
		</div>
		<div class="form-group">
			<input type="password" class="form-control" name="pass" placeholder="Password" maxlength="150" required>
		</div>
		<div class="form-group">
			<button type="submit" name="loginSubmit" class="btn btn-primary">Submit</button>
		</div>
	</form>
	<div class="card-footer">
		<span class="hints">Don't have an account? <a href="<?php echo base_url(); ?>user/registration">Register here</a></span>
	</div>
</div>
