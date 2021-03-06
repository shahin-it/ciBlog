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
			<div class="list-item my-5">
				<div class="post-title p-4">
					<a class="link" href="<?php echo base_url("post/".$post["id"]); ?>"><h2><?php echo $post["name"]?></h2></a>
					<div class="post-meta text-muted">
						<i class="fas fa-calendar-alt text-warning"></i><span> <?php echo "By <b>".$post["_user"]."</b> at ".$post["created"] ?></span>
					</div>
                    <div class="post-info font-weight-bold">
                        <span class="category fas fa-tags"></span>
                        <a class="random-color" href="<?php echo base_url("category/".$post["category"])?>"> <?php echo $post["_category"]?></a>
                    </div>
				</div>
				<div class="post-card clearfix p-4 border-top">
					<div class="overflow-hide mr-2 my-2 float-left" style="max-width: 200px; max-height: 200px">
						<a href="<?php echo base_url("post/".$post["id"]); ?>">
							<img class="img-fluid" alt="<?php echo $post["name"]?>" src="<?php echo(base_url($post["thumb"] ? $post["thumb"]: Constant::NO_IMAGE_THUMB))?>">
						</a>
					</div>
					<div class="post-summary d-inline">
						<?php echo $post["summary"]?>
					</div>
					<div><a href="<?php echo base_url("post/".$post["id"]); ?>"><i class="fas fa-link pr-1"></i> Visit</a></div>
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
