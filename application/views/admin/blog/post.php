<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="card skui-data-table" data-url="blogAdmin/post">
    <div class="card-header clearfix">
        <div class="card-title float-left">Blog Post List</div>
        <div class="card-option float-right">
            <button type="button" data-url="blogAdmin/editPost" class="btn btn-sm btn-primary add-new">+ ADD</button>
        </div>
    </div>
    <div class="card-body skui-table">
        <table class="table table-bordred table-striped">
            <thead>
            <th>ID</th>
            <th>Name/Title</th>
            <th>Category</th>
            <th>Description</th>
            <th>Created</th>
            <th>Updated</th>
            <th>Sort Index</th>
            <th>Actions</th>
            </thead>
            <tbody>
                <?php foreach ($items as $item) { ?>
                <tr>
                    <td data-label="ID"><?php echo $item["id"];?></td>
                    <td data-label="Name/Title"><?php echo htmlentities($item["name"]); ?></td>
                    <td data-label="Parent"><?php echo "[".$item["category"]."] ".$item["_category"]; ?></td>
                    <td data-label="Description"><?php echo htmlentities($item["description"]); ?></td>
                    <td data-label="Created"><?php echo $item["created"]; ?></td>
                    <td data-label="Updated"><?php echo $item["updated"]; ?></td>
                    <td data-label="Sort Index"><?php echo $item["sort_index"]; ?></td>
                    <td data-label="Actions" class="action-navigator" data-id="<?php echo $item["id"];?>" data-name="<?php echo $item["name"];?>" data-_model="blogPost">
                        <button class="btn btn-primary btn-sm" data-action="edit" data-url="blogAdmin/editPost" title="Edit"><i class="fas fa-edit"></i></button>
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
