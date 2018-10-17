<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if($post) {
?>
<div class="post-single">
	<div class="post-title">
		<div class="post-info">
			<div class="category font-weight-bold"><a class="random-color" href="<?php echo base_url("category/".$post["category"])?>"><?php echo $post["_category"]?></a></div>
		</div>
		<h1 class=""><?php echo $post["name"]?></h1>
		<div class="post-meta text-muted">
			<i class="fas fa-calendar-alt text-warning"></i><span> <?php echo "By <b>".$post["_user"]."</b> at ".$post["created"] ?></span>
		</div>
	</div>
	<div class="post-body">
		<?php if($post["image"]) {?>
			<div class="post-image float-left"><img src="<?php echo(base_url($post["image"]))?>" class="img-fluid"></div>
		<?php }?>
		<div class="post-details">
			<?php echo $post["description"]?>
		</div>
	</div>
	<div class="post-footer float-left">
		<span class="info-text text-muted"><i class="fas fa-calendar-alt text-warning"></i><span> <?php echo "Last Updated at ".$post["updated"] ?></span>
	</div>
</div>
<?php } else {
?>
	<p>No post found!</p>
<?php }?>
