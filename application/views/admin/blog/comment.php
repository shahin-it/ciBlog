<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="card skui-data-table" data-url="blogAdmin/comment">
	<div class="card-header clearfix">
		<div class="card-title float-left">Blog Comment List </div>
		<div class="card-option float-right">
			<button type="button" data-url="blogAdmin/editComment" class="btn btn-sm btn-primary add-new">+ ADD</button>
		</div>
	</div>
	<div class="card-body skui-table">
		<table class="table table-bordred table-striped">
			<thead>
			<th>ID</th>
			<th width="20%">Post</th>
			<th>Created By</th>
			<th width="25%">Comment</th>
			<th>Created</th>
			<th>Updated</th>
			<th>Published</th>
			<th width="10%">Actions</th>
			</thead>
			<tbody>
			<?php foreach ($items as $item) { ?>
				<tr class="<?php echo ($item["is_active"] == "Y" ? "":"mark-inactive")?>">
					<td data-label="ID"><?php echo $item["id"];?></td>
					<td data-label="Post"><span class="trim-text"><?php echo htmlentities($item["_post"]); ?></span></td>
					<td data-label="Created By"><?php echo $item["_created_by"]; ?></td>
					<td data-label="Comment"><span class="trim-text"><?php echo htmlentities($item["description"]); ?></span></td>
					<td data-label="Created"><?php echo $item["created"]; ?></td>
					<td data-label="Updated"><?php echo $item["updated"]; ?></td>
					<td data-label="Published"><?php echo $item["is_active"]; ?></td>
					<td data-label="Actions" class="action-navigator" data-id="<?php echo $item["id"];?>" data-name="<?php echo $item["_post"];?>" data-_model="blogComment">
						<button class="btn btn-primary btn-sm" data-action="edit" data-url="blogAdmin/editComment" title="Edit"><i class="fas fa-edit"></i></button>
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
