<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="post-single">
    <div class="post-title">
        <h1 class=""><?php echo $page["heading"]?></h1>
        <div class="post-meta text-muted">
            <i class="fas fa-calendar-alt text-warning"></i><span> <?php echo "Posted at ".$page["created"] ?></span>
        </div>
    </div>
    <div class="post-body">
        <div class="post-details img-fluid">
            <?php echo $page["content"]?>
        </div>
    </div>
    <div class="post-footer float-left">
    <span class="info-text text-muted"><i class="fas fa-calendar-alt text-warning"></i><span> <?php echo "Last Updated at ".$page["updated"] ?></span>
    </div>
</div>