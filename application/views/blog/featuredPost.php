<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$count = count($items);
$slideItems = array_splice($items, 0, 3);

if($slideItems) {
?>
<div id="carouselExampleIndicators" class="carousel pb-3 skui-carousel slide carousel-fade" data-ride="carousel">
	<div class="carousel-inner" style="height: 400px;">
		<?php foreach ($slideItems as $i=>$post) {?>
			<div class="carousel-item <?php echo ($i == 0 ? "active":"")?> jumbotron p-3 p-md-5 text-white rounded bg-dark h-100">
				<h1 class="font-italic h-25"><?php echo $post["name"]?></h1>
				<p class="lead my-3 overflow-hide h-50"><?php echo $post["summary"]?></p>
				<p class="lead mb-0 float-right h-25"><a href="<?php echo base_url('post/'.$post['id'])?>" class="text-white font-weight-bold">Continue reading...</a></p>
			</div>
		<?php }?>
	</div>
	<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
		<span class="carousel-control-prev-icon" aria-hidden="true"></span>
		<span class="sr-only">Previous</span>
	</a>
	<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
		<span class="carousel-control-next-icon" aria-hidden="true"></span>
		<span class="sr-only">Next</span>
	</a>
</div>

<div class="flex-body d-lg-flex flex-lg-wrap justify-content-between">
<?php
foreach($items as $i=>$post) {
?>
	<div class="col-lg-6">
		<div class="card flex-md-row mb-4 shadow-sm h-md-200">
			<div class="card-body d-flex flex-column align-items-start">
				<strong class="d-inline-block mb-2 text-primary"><a class="random-color" href="<?php echo base_url("category/".$post["category"])?>"><?php echo $post["_category"]?></a></strong>
				<h4 class="mb-0">
					<a class="text-dark" href="<?php echo base_url("post/".$post["id"])?>"><?php echo $post["name"]?></a>
				</h4>
				<div class="mb-1 text-muted"><?php echo $post["updated"]?></div>
				<p class="card-text overflow-hide mb-auto"><?php echo $post["summary"]?></p>
				<a href="<?php echo base_url("post/".$post["id"])?>">Continue reading...</a>
			</div>
			<div class="card-img-right flex-auto d-none d-lg-block overflow-hide" style="max-height: 200px; max-width: 200px;">
				<img class="img-fluid" src="<?php echo(base_url($post["thumb"] ? $post["thumb"]: Constant::NO_IMAGE_THUMB))?>">
			</div>
		</div>
	</div>
<?php } ?>
</div>
<?php } else {
	echo '<p>No post found!</p>';
}
?>
