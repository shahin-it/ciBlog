<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<form class="create-edit-form" action="<?php echo base_url() ?>blogAdmin/save" method="post">
    <input type="hidden" name="id" value="<?php echo @$item["id"];?>">
    <input type="hidden" name="_model" value="navigation">
    <span class="form-title">Create/Edit Main Navigation</span>
    <div class="form-row">
        <div class="form-group col-sm-6">
            <label for="">Name</label>
            <input type="text" class="form-control" name="name" required maxlength="200" value="<?php echo @$item["name"];?>">
        </div>
        <div class="form-group col-sm-6">
            <label for="">Sort Index</label>
            <input type="number" class="form-control" name="sort_index" max="999" required value="<?php echo @$item["sort_index"] ?: 0; ?>">
        </div>
    </div>
	<div class="form-row">
		<div class="form-group col-sm-4">
			<label for="">Parent</label>
			<?php echo form_dropdown('parent', @$item["parents"], @$item["parent"], 'class="form-control"'); ?>
		</div>
		<div class="form-group col-sm-4">
			<label for="">Target</label>
			<?php echo form_dropdown('target', Constant::$ANCHOR_TARGET, @$item["target"], 'class="form-control"'); ?>
		</div>
		<div class="form-group col-sm-4">
			<label for="">Active</label>
			<?php echo form_dropdown('is_active', Constant::$YES_NO, @$item["is_active"], 'class="form-control"'); ?>
		</div>
	</div>
	<div class="form-row">
		<div class="form-group col-sm-6">
			<label for="">Type</label>
			<?php echo form_dropdown('type', Constant::$NAV_TYPE, @$item["type"], 'class="form-control" data-toggle-target="navigation-type"'); ?>
		</div>
		<div class="form-group col-sm-6 navigation-type-">
			<label for="">URI</label>
			<input type="text" class="form-control" name="uri" maxlength="500" value="<?php echo @$item["uri"] ?>">
		</div>
		<div class="form-group col-sm-6 navigation-type-PAGE">
			<label for="">Page</label>
			<?php echo form_dropdown('uri', ([""=>"---Select Page---"] + @$item["_page"]), @$item["uri"], 'class="form-control" required'); ?>
		</div>
		<div class="form-group col-sm-6 navigation-type-POST">
			<label for="">Post</label>
			<?php echo form_dropdown('uri', ([""=>"---Select Post---"] + @$item["_post"]), @$item["uri"], 'class="form-control" required'); ?>
		</div>
	</div>
    <button class="btn btn-md btn-primary form-submit">Submit</button>
</form>

