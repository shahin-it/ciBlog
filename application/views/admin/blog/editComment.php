<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<form class="create-edit-form" action="<?php echo base_url() ?>blogAdmin/save" method="post">
    <input type="hidden" name="id" value="<?php echo @$item["id"];?>">
    <input type="hidden" name="_model" value="blogComment">
    <span class="form-title">Create/Edit Blog Comment</span>
    <div class="form-row">
		<div class="form-group col-sm-6">
			<label for="">User</label>
			<div class="form-control"><?php echo "Current User"?></div>
		</div>
		<div class="form-group col-sm-6">
			<label for="">Blog Post</label>
			<?php echo form_dropdown('post', $blogPost, @$item["post"], 'class="form-control" required'); ?>
		</div>
    </div>
    <div class="form-group">
        <label for="">Comment</label>
        <textarea name="description" class="form-control" maxlength="5000" required><?php echo @$item["description"];?></textarea>
    </div>
    <button class="btn btn-md btn-primary form-submit">Submit</button>
</form>