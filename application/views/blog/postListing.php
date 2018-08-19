<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if($items) {
?>
<div class="category-details">
	<div class="card-header">
		<div class="card-title">Post from </div>
	</div>
	<?php foreach ($items as $item) {?>
	<div class="card">
		<div class="card-header">
			<div class="card-title"><a href="<?php echo base_url("post/".$item["id"]); ?>"><?php echo $item["name"]; ?></a></div>
			<div class="card-text">Published at <?php echo AppUtil::localTime($item["created"])?></div>
		</div>
		<div class="card-body">
			<div class="trim-text-10"><?php echo $item["description"]?></div>
			<div><a class="btn btn-sm btn-secondary" href="<?php echo base_url("post/".$item["id"]); ?>" role="button">View details »</a></div>
		</div>
	</div>
	<?php }?>
	<div class="card-footer text-center">
		<a class="btn btn-success btn-sm fas fa-chevron-circle-down" href="#"></a>
	</div>
</div>
<?php } else {
	?>
	<p>No post found!</p>
<?php }?>
