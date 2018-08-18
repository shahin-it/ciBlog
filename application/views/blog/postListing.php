<?php
defined('BASEPATH') OR exit('No direct script access allowed');
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
			<span class="trim-text-5"><?php echo $item["description"]?></span>
			<p><a class="btn btn-md btn-secondary" href="<?php echo base_url("post/".$item["id"]); ?>" role="button">View details »</a></p>
		</div>
	</div>
	<?php }?>
	<div class="card-footer text-center">
		<a class="btn btn-success btn-sm fas fa-chevron-circle-down" href="#"></a>
	</div>
</div>
