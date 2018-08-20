<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if($items) {
?>
<div class="category-details skui-paginated-page" data-url="category/<?php echo $id ?>">
	<div class="card-header">
		<div class="card-title">Post from </div>
	</div>
	<?php foreach ($items as $item) {?>
	<div class="card post-summary">
		<div class="card-header">
			<div class="card-title"><a href="<?php echo base_url("post/".$item["id"]); ?>"><?php echo $item["name"]; ?></a></div>
			<div class="card-text"><i class="fas fa-calendar-alt"></i> Published at <?php echo AppUtil::localTime($item["created"])?></div>
		</div>
		<div class="card-body">
			<div class="trim-text-10"><?php echo $item["description"]?></div>
			<div><a class="btn btn-sm btn-secondary" href="<?php echo base_url("post/".$item["id"]); ?>" role="button">View details »</a></div>
		</div>
	</div>
	<?php }?>
	<div class="card-footer clearfix">
		<ul class="pagination pagination-sm float-right" data-count="<?php echo $count;?>" data-offset="<?php echo $params['offset']; ?>"></ul>
	</div>
</div>
<?php } else {
	?>
	<p>No post found!</p>
<?php }?>
