<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<form class="create-edit-form" action="<?php echo base_url() ?>blogAdmin/save" method="post">
    <input type="hidden" name="id" value="<?php echo @$item["id"];?>">
    <input type="hidden" name="_model" value="blogCategory">
    <span class="form-title">Create/Edit Blog Category</span>
    <div class="form-row">
        <div class="form-group col-sm-6">
            <label for="">Name</label>
            <input type="text" class="form-control" name="name" required maxlength="200" value="<?php echo @$item["name"];?>">
        </div>
        <div class="form-group col-sm-6">
            <label for="">Sort Index</label>
            <input type="number" class="form-control" name="sort_index" max="999" required value="<?php echo @$item["sort_index"]; ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="">Parent</label>
        <?php echo form_dropdown('parent', @$item["parents"], @$item["parent"], 'class="form-control"'); ?>
    </div>
    <div class="form-group">
        <label for="">Description</label>
        <textarea name="description" class="form-control" maxlength="500"><?php echo @$item["description"];?></textarea>
    </div>
    <button class="btn btn-md btn-primary form-submit">Submit</button>
</form>

