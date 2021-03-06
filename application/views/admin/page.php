<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="card skui-data-table" data-url="blogAdmin/page">
    <div class="card-header clearfix">
        <div class="card-title float-left"><i class="fas fa-globe-americas"></i> Blog Page List</div>
        <div class="card-option float-right">
            <button type="button" data-url="blogAdmin/editPage" class="btn btn-sm btn-primary add-new">+ ADD</button>
        </div>
    </div>
    <div class="card-body skui-table">
        <table class="table table-bordred table-striped">
            <thead>
            <th>ID</th>
            <th width="20%">Title</th>
			<th>URI</th>
			<th>Created By</th>
			<th>Created</th>
            <th>Post</th>
            <th>Active</th>
            <th width="12%">Actions</th>
            </thead>
            <tbody>
                <?php foreach ($items as $item) { ?>
                <tr class="<?php echo ($item["is_active"] == "Y" ? "":"mark-inactive")?>">
                    <td data-label="ID"><?php echo $item["id"];?></td>
                    <td data-label="Title"><span class="trim-text"><?php echo htmlentities($item["title"]); ?></span></td>
					<td data-label="URI"><?php echo $item["uri"]; ?></td>
					<td data-label="Created By"><?php echo $item["_created_by"]; ?></td>
					<td data-label="Created"><?php echo $item["created"]; ?></td>
                    <td data-label="Post"><?php echo $item["_post"]; ?></td>
                    <td data-label="Active"><?php echo $item["is_active"]; ?></td>
                    <td data-label="Actions" class="action-navigator" data-id="<?php echo $item["id"];?>" data-name="<?php echo $item["title"];?>" data-_model="page">
                        <button class="btn btn-primary btn-sm" data-action="edit" data-url="blogAdmin/editPage" title="Edit"><i class="fas fa-edit"></i></button>
                        <a class="btn btn-success btn-sm" data-action="view" title="View in site" target="_blank" href="<?php echo base_url("page/".$item["uri"])?>"><i class="fas fa-eye"></i></a>
                        <button class="btn btn-danger btn-sm" data-action="delete" data-url="blogAdmin/delete" title="Delete"><i class="fas fa-trash"></i></button>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <div class="card-footer clearfix">
        <ul class="pagination pagination-sm float-right" data-count="<?php echo $count;?>"></ul>
    </div>
</div>
