<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	$postByMonth = $this->blogPost->getPostByMonth();
?>
<h4 class="font-italic">Archives</h4>
<ol class="list-unstyled mb-0">
	<?php foreach ($postByMonth as $dateTime) {?>
		<li><a href="<?php echo base_url("archive/".$dateTime["year"]."/".$dateTime["month"])?>"><?php echo (date("F",
						strtotime($dateTime["year"]."-".$dateTime["month"]))." ".$dateTime["year"]." [".$dateTime["count"]."]")?></a></li>
	<?php }?>
</ol>
