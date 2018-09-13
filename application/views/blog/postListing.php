<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if($items) {
	$uri = $uri ?: "category/latest"
?>
<div class="post-listing skui-paginated-page" data-url="<?php echo $uri ?>">
	<div class="list-header">
		<h3 class="pb-3 mb-4 font-italic border-bottom"><?php echo(@$title ? $title : "From the ".$items[0]["_category"])?></h3>
	</div>
	<div class="list-items">
		<?php foreach ($items as $post) {?>
			<div class="list-item post-summary">
				<div class="post-title">
					<div class="post-info">
						<span class="category font-weight-bold"><a href="<?php echo base_url("category/".$post["category"])?>"><?php echo $post["_category"]?></a></span>
					</div>
					<h2 class=""><?php echo $post["name"]?></h2>
					<div class="post-meta text-muted">
						<i class="fas fa-calendar-alt"></i><span> <?php echo "By ".$post["_user"]." at ".$post["created"] ?></span>
					</div>
				</div>
				<div class="post-details">
					<div class="post-summary"><?php echo $post["summary"]?></div>
					<div><a class="btn btn-sm btn-secondary" href="<?php echo base_url("post/".$post["id"]); ?>" role="button">View details »</a></div>
				</div>
			</div>
		<?php }?>
	</div>
	<div class="list-footer clearfix">
		<ul class="pagination pagination-sm float-right" data-count="<?php echo $count;?>" data-offset="<?php echo $params['offset']; ?>"></ul>
	</div>
</div>
<?php } else {
	?>
	<p>No post found!</p>
<?php }?>
