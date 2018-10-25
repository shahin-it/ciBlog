<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<form class="create-edit-form" action="<?php echo base_url() ?>blogAdmin/save" method="post">
    <input type="hidden" name="id" value="<?php echo @$item["id"];?>">
    <input type="hidden" name="_model" value="page">
    <span class="form-title">Create/Edit Page</span>
	<div class="form-row">
		<div class="form-group col-sm-6">
			<label for="">Title</label>
			<input type="text" class="form-control" name="title" value="<?php echo @$item["title"]?>" required minlength="2" maxlength="150">
		</div>
		<div class="form-group col-sm-6">
			<label for="">Heading</label>
			<input type="text" class="form-control" name="heading" value="<?php echo @$item["heading"]?>" minlength="2" maxlength="250">
		</div>
	</div>
	<div class="form-group">
		<label for="">URI (eg.. page/career)</label>
		<input type="text" class="form-control" name="uri" value="<?php echo @$item["uri"]?>" required minlength="2" maxlength="500">
	</div>
    <div class="form-row">
		<div class="form-group col-sm-6">
			<label for="">Blog Post</label>
			<?php echo form_dropdown('post', ([""=>"---Select Post---"] + $blogPost), @$item["post"], 'class="form-control" data-toggle-target="page-content"'); ?>
		</div>
		<div class="form-group col-sm-6">
			<label for="">Published</label>
			<?php echo form_dropdown('is_active', Constant::$YES_NO, @$item["is_active"], 'class="form-control"'); ?>
		</div>
    </div>
    <div class="form-group page-content-">
        <label for="">Content (TEXT/HTML)</label>
        <textarea name="content" class="skui-text-editor" required><?php echo @$item["content"];?></textarea>
    </div>
    <button class="btn btn-md btn-primary form-submit">Submit</button>
</form>
