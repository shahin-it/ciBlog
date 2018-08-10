<?php

defined('BASEPATH') OR exit('No direct script access allowed');
?>
<form class="create-edit-form" action="<?php echo base_url()?>blogAdmin/saveCategory" method="post">
	<input type="hidden" name="id" value="">
	<span class="form-title">Create/Edit Category</span>
	<div class="form-row">
		<div class="form-group col-sm-6">
			<label for="">Name</label>
			<input type="text" class="form-control" name="name" required maxlength="150">
		</div>
		<div class="form-group col-sm-6">
			<label for="">Sort Index</label>
			<input type="number" class="form-control" name="sort_order" max="999" required>
		</div>
	</div>
	<div class="form-group">
		<label for="">Parent</label>
		<select name="parent" class="form-control"></select>
	</div>
	<div class="form-group">
		<label for="">Description</label>
		<textarea name="description" class="form-control"></textarea>
	</div>
	<button class="btn btn-md btn-primary form-submit">Submit</button>
</form>

