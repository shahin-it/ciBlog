<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<form class="create-edit-form" action="<?php echo base_url() ?>postAdmin/save" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo @$item["id"];?>">
    <span class="form-title">Create/Edit Blog Post</span>
	<div class="form-row">
		<div class="form-group col-sm">
			<label for="">Name/Title</label>
			<input type="text" class="form-control" name="name" required maxlength="250" value="<?php echo @$item["name"];?>">
		</div>
		<div class="form-group col-sm">
			<label for="">Publish</label>
			<?php echo form_dropdown('is_active', ["Y"=>"YES", "N"=>"NO"], @$item["is_active"], 'class="form-control"'); ?>
		</div>
	</div>
    <div class="form-row">
		<div class="form-group col-sm-6">
			<label for="">Parent</label>
			<?php echo form_dropdown('category', $category, @$item["category"], 'class="form-control"'); ?>
		</div>
        <div class="form-group col-sm-3">
            <label for="">Sort Index</label>
            <input type="number" class="form-control" name="sort_index" max="999" required value="<?php echo @$item["sort_index"] ?: 0; ?>">
        </div>
		<div class="form-group col-sm-3">
			<label for="">Is Featured</label>
			<?php echo form_dropdown('is_featured', ["N"=>"NO", "Y"=>"YES"], @$item["is_featured"], 'class="form-control"'); ?>
		</div>
    </div>
	<div class="form-row">
		<div class="form-group skui-image-chooser col-sm-6">
			<label for="">Image</label>
			<div class="form-control">
				<input type="file" name="image" value="<?php echo $item["image"];?>">
				<img src="<?php echo base_url(@$item["image"])?>" alt="" class="skui-image-preview">
			</div>
		</div>
		<div class="form-group col-sm-6">
			<label for="">Summary (TEXT/HTML)</label>
			<textarea name="summary" class="form-control" required maxlength="500"><?php echo @$item["summary"];?></textarea>
		</div>
	</div>
    <div class="form-group">
        <label for="">Description (TEXT/HTML)</label>
        <textarea name="description" class="skui-text-editor" required><?php echo @$item["description"];?></textarea>
    </div>
    <button class="btn btn-md btn-primary form-submit">Submit</button>
</form>
