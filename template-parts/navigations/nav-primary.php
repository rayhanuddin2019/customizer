<nav class="navbar navbar-light xs-navbar navbar-expand-lg">

	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#primary-nav" aria-controls="primary-nav" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"><i class="icon icon-menu"></i></span>
	</button>

	<?php
	wp_nav_menu([
		'menu'            => 'primary',
		'theme_location'  => 'primary',
		'container'       => 'div',
		'container_id'    => 'primary-nav',
		'container_class' => 'collapse navbar-collapse justify-content-end',
		'menu_id'         => 'main-menu',
		'menu_class'      => 'navbar-nav  main-menu',
		'depth'           => 3,
		'walker'          => new ts_navwalker(),
		'fallback_cb'     => 'ts_navwalker::fallback',
	]);
	?>
</nav>

