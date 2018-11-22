<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	$navigations = $this->navigation->getNavigationTree(null, ["is_active"=>"Y"]);
?>
<nav class="nav-widget navbar navbar-expand-md navbar-light bg-light skui-hover-menu">
	<a class="navbar-brand" href="<?php echo base_url()?>"><img class="logo" height="28" width="28" src="<?php echo base_url("asset/image/default/logo.png")?>"/> Batayon</a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>
	<div class="collapse navbar-collapse" id="navbarNavDropdown">
		<ul class="navbar-nav">
			<?php
			foreach ($navigations as $nav) {
				if (!$nav["child"]) {
					echo '<li class="nav-item $home">' .
						'<a class="nav-link" target="'.$nav["target"].'" href="'.base_url($nav["uri"]).'">'.$nav["name"].'</a>' .
						'</li>';
				} else {
					echo '<li class="nav-item dropdown">'.
						'<a class="nav-link dropdown-toggle link" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">'.$nav["name"].'</a>'.
						'<ul class="dropdown-menu">';
					foreach ($nav["child"] as $_nav) {
						if(!$_nav["child"]) {
							echo '<li><a class="dropdown-item" target="'.$_nav["target"].'" href="'.base_url($_nav["uri"]).'">'.$_nav["name"].'</a></li>';
						} else {
							echo '<li>' .
								'<a class="dropdown-item dropdown-toggle" target="'.$_nav["target"].'" href="#">'.$_nav["name"].'</a>' .
								'<ul class="dropdown-menu">';
							foreach ($_nav["child"] as $__nav) {
								echo '<li><a class="dropdown-item" target="'.$__nav["target"].'" href="'.base_url($__nav["uri"]).'">'.$__nav["name"].'</a></li>';
							}
							echo '</ul>' .
								'</li>';
						}
					}
					echo '</ul>'.
						'</li>';
				}
			}
			?>
		</ul>
	</div>

	<!--<div class="collapse navbar-collapse" id="navbarNavDropdown">
			<ul class="navbar-nav">
				<li class="nav-item <?php /*echo @$home*/?>">
					<a class="nav-link" href="<?php /*echo base_url()*/?>">Home <span class="sr-only">(current)</span></a>
				</li>
				<li class="nav-item <?php /*echo @$featured*/?>">
					<a class="nav-link" href="<?php /*echo base_url("category/featured")*/?>">Featured</a>
				</li>
				<li class="nav-item <?php /*echo @$latest*/?>">
					<a class="nav-link" href="<?php /*echo base_url("category/latest")*/?>">Latest</a>
				</li>
				<li class="nav-item <?php /*echo @$popular*/?>">
					<a class="nav-link" href="<?php /*echo base_url("category/popular")*/?>">Most Popular</a>
				</li>
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Others
					</a>
					<ul class="dropdown-menu">
						<li><a class="dropdown-item" href="#">Action</a></li>
						<li><a class="dropdown-item" href="#">Another action</a></li>
						<li>
							<a class="dropdown-item dropdown-toggle" href="#">Submenu</a>
							<ul class="dropdown-menu">
								<li><a class="dropdown-item" href="#">Submenu action</a></li>
								<li><a class="dropdown-item" href="#">Another submenu action</a></li>
								<li><a class="dropdown-item dropdown-toggle" href="#">Subsubmenu</a>
									<ul class="dropdown-menu">
										<li><a class="dropdown-item" href="#">Subsubmenu action aa</a></li>
										<li><a class="dropdown-item" href="#">Another subsubmenu action</a></li>
									</ul>
								</li>
								<li><a class="dropdown-item dropdown-toggle" href="#">Second subsubmenu</a>
									<ul class="dropdown-menu">
										<li><a class="dropdown-item" href="#">Subsubmenu action bb</a></li>
										<li><a class="dropdown-item" href="#">Another subsubmenu action</a></li>
									</ul>
								</li>
							</ul>
						</li>
						<li><a class="dropdown-item dropdown-toggle" href="#">Submenu 2</a>
							<ul class="dropdown-menu">
								<li><a class="dropdown-item" href="#">Submenu action 2</a></li>
								<li><a class="dropdown-item" href="#">Another submenu action 2</a></li>
								<li>
									<a class="dropdown-item dropdown-toggle" href="#">Subsubmenu</a>
									<ul class="dropdown-menu">
										<li><a class="dropdown-item" href="#">Subsubmenu action 1 3</a></li>
										<li><a class="dropdown-item" href="#">Another subsubmenu action 2 3</a></li>
									</ul>
								</li>
								<li>
									<a class="dropdown-item dropdown-toggle" href="#">Second subsubmenu 3</a>
									<ul class="dropdown-menu">
										<li><a class="dropdown-item" href="#">Subsubmenu action 3 </a></li>
										<li><a class="dropdown-item" href="#">Another subsubmenu action 3</a></li>
									</ul>
								</li>
							</ul>
						</li>
					</ul>
				</li>
			</ul>
		</div>-->
</nav>
