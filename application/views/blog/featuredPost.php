<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$count = count($items);
foreach($items as $i=>$post) {
	if($i == 0) {
?>
		<div class="jumbotron p-3 p-md-5 text-white rounded bg-dark">
			<div class="col-md-6 px-0">
				<h1 class="display-4 font-italic"><?php echo $post["name"]?></h1>
				<p class="lead my-3"><?php echo $post["summary"]?></p>
				<p class="lead mb-0"><a href="<?php echo base_url("post/".$post["id"])?>" class="text-white font-weight-bold">Continue reading...</a></p>
			</div>
		</div>
	<?php } else { if($i == 1) {echo "<div class='flex-body d-lg-flex flex-lg-wrap justify-content-between'>";} ?>
		<div class="col-lg-6">
			<div class="card flex-md-row mb-4 shadow-sm h-md-250">
				<div class="card-body d-flex flex-column align-items-start">
					<strong class="d-inline-block mb-2 text-primary"><a href="<?php echo base_url("category/".$post["category"])?>"><?php echo $post["_category"]?></a></strong>
					<h4 class="mb-0">
						<a class="text-dark" href="<?php echo base_url("post/".$post["id"])?>"><?php echo $post["name"]?></a>
					</h4>
					<div class="mb-1 text-muted"><?php echo $post["updated"]?></div>
					<p class="card-text overflow-hide mb-auto"><?php echo $post["summary"]?></p>
					<a href="<?php echo base_url("post/".$post["id"])?>">Continue reading...</a>
				</div>
				<img class="card-img-right flex-auto d-none d-lg-block" data-src="holder.js/200x250?theme=thumb" alt="Thumbnail [200x250]" src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22200%22%20height%3D%22250%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20200%20250%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_1657a83a2f0%20text%20%7B%20fill%3A%23eceeef%3Bfont-weight%3Abold%3Bfont-family%3AArial%2C%20Helvetica%2C%20Open%20Sans%2C%20sans-serif%2C%20monospace%3Bfont-size%3A13pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_1657a83a2f0%22%3E%3Crect%20width%3D%22200%22%20height%3D%22250%22%20fill%3D%22%2355595c%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%2256.203125%22%20y%3D%22131%22%3EThumbnail%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" data-holder-rendered="true" style="width: 200px; height: 250px;">
			</div>
		</div>
<?php if($i == $count - 1) {echo "</div>";} }
} ?>
