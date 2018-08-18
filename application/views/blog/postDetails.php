<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if($post) {
?>
<div class="card">
	<div class="card-header">
		<div class="card-title"><?php echo $post["name"]?></div>
		<div class="card-text"><?php echo "Published By ".$post["_user"]." at ".AppUtil::localTime($post["created"]) ?></div>
	</div>
	<div class="card-body"><?php echo $post["description"]?></div>
	<div class="card-footer">
		<span class="card-text"><?php echo "Last modified ".$post["updated"] ?></span>
	</div>
</div>
<?php } else {
?>
	<p>No post found!</p>
<?php }?>
