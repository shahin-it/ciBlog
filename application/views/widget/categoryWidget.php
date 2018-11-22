<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	$categories = $this->blogCategory->getCategoryTree();
?>
<div class="widget category-widget">
    <h4 class="widget-title">Categories</h4>
    <ol class="side-bar-nav list-unstyled mb-0 skui-accordion-panel">
        <?php foreach ($categories as $category) {?>
            <li class="nav-item clearfix">
                <a href="<?php echo base_url("category/".$category['id'])?>"><?php echo($category['name']);?></a>
                <?php if($category["child"]) { ?>
                    <span class="skui-accordion-label float-right btn btn-link"><h6 class="fas fa-arrow-circle-down"></h6></span>
                    <ul class="skui-accordion-item">
                        <?php foreach ($category["child"] as $cat) {?>
                            <li class="nav-item"><a href="<?php echo base_url("category/".$cat['id'])?>" class="skui-accordion-label"><?php echo($cat['name']);?></a></li>
                        <?php } ?>
                    </ul>
                <?php } ?>
            </li>
        <?php } ?>
    </ol>
</div>