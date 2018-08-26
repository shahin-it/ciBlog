<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if($post) {
?>
<div class="post-single">
	<div class="post-thumbnail"><img src="" class="img-fluid"></div>
	<div class="post-title">
		<div class="post-info">
			<div class="category"><a href="<?php echo base_url("category/".$post["category"])?>"><?php echo $post["_category"]?></a></div>
		</div>
		<h1 class=""><?php echo $post["name"]?></h1>
		<div class="post-meta text-danger">
			<i class="fas fa-calendar-alt"></i><span> <?php echo "By ".$post["_user"]." at ".AppUtil::localTime($post["created"]) ?></span>
		</div>
	</div>
	<div class="post-details"><?php echo $post["description"]?></div>
	<div class="post-footer">
		<span class="info-text text-danger font-weight-bold"><?php echo "Last modified ".$post["updated"] ?></span>
	</div>
</div>
<?php } else {
?>
	<p>No post found!</p>
<?php }?>
