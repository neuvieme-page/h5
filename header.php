<!DOCTYPE html>
<html>
<head>
	<script>;(function(global) { global.pageStartTime = Date.now(); }(this));</script>
	<?php wp_head();?>
	<meta charset="<?php bloginfo('charset');?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no" />
	<link rel="icon" href="<?php bloginfo('template_directory');?>/favicon.ico?v=2" />
</head>
<body <?php body_class();?>>

	<div class="menuHeader">	
		<form action="" class="menuHeader-searchbar">
			<img class="menuHeader-logo" src="<?php bloginfo('template_directory');?>/assets/images/search-icon.svg" alt="Search Icon">
			<input class="menuHeader-input" type="text">
			<input class="menuHeader-pathInput" type="hidden" value="<?php bloginfo('url');?>/search.php">
			<img class="menuHeader-clearInput" src="<?php bloginfo('template_directory');?>/assets/images/cross-icon.svg" alt="Cross Icon">
		</form>
		<ul class="menuHeader-list">
			<li class="menuHeader-item">
				<a class="menuHeader-link" href="">
					<div class="menuHeader-flex">
						<img class="menuHeader-item-img" src="<?php bloginfo('template_directory');?>/assets/images/content.jpg" alt="">
						<div class="menuHeader-item-texts">
							<p>Lacoste (2018)</p>
							<p>Xmas</p>
						</div>
					</div>
					<p class="menuHeader-item-category">FILM</p>
				</a>
			</li>
		</ul>
	</div>

	<script src="<?php bloginfo('template_directory');?>/assets/js/menuHeader.js"></script>

	<script src="<?php bloginfo('template_directory');?>/assets/js/early.js"></script>
	<header class="site-header hideOnHome nav-down cf">
		<?php
if (wp_is_mobile()) {?>
		<div class="mobile-top cf">
			<div class="header-logo"><a href="http://h5.fr">H5</a></div>
			<div class="header-lang">
				<ul class="hidden"><?php pll_the_languages();?></ul>
			</div>
		</div>
			<?php
$cleanermenu = wp_nav_menu(array(
    'theme_location' => 'primary',
    'container' => false,
    'items_wrap' => '<nav class="flex-item"><div class="flex-container">%3$s</div></nav>',
    'echo' => false,
));

    $find = array('><a', 'li');
    $replace = array('', 'a');
    echo str_replace($find, $replace, $cleanermenu);
    ?>
		<?php } else if (is_front_page()) {?>
		<div class="topz cf">
			<div class="header-logo"><a href="<?php echo esc_url(home_url('/')); ?>">H5</a></div>
			<div class="header-lang">
				<ul class="hidden"><?php pll_the_languages();?></ul>
			</div>
		</div>
		<?php
wp_nav_menu(array(
    'container_class' => 'mainNav hideOnHome',
    'theme_location' => 'primary',
    'customaction' => 'foo',
));
} else {?>
			<div class="header-logo"><a href="<?php echo esc_url(home_url('/')); ?>">H5</a></div>
				<div class="header-lang">
				<ul class="hidden"><?php pll_the_languages();?></ul>
			</div>
			<?php
wp_nav_menu(array(
    'container_class' => 'mainNav hideOnHome',
    'theme_location' => 'primary',
    'customaction' => 'foo',
));

}
?>




		<?php
if (is_front_page() && !wp_is_mobile()): ?>

			<div class="hover-square">
				<div class="imageWrapper hidden">
					<?php
$posts = get_posts(array(
    'posts_per_page' => -1,
    'post_type' => 'hover_slides',
));

if ($posts):

    foreach ($posts as $post):

        setup_postdata($post);

        $post_title = get_the_title();

        if ($post_title == 'Work' || $post_title == 'Work fr') {
            $imgz = get_field('hover_slides');?>
										<div class="sliding work hidden" data-kffader='{"name":"anim1", "time": 0.2, "fade": 1e-6}'>
											<?php if ($imgz): ?>
												<?php foreach ($imgz as $image): ?>
										             <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
												<?php endforeach;?>
										<?php endif;?>
								</div>
							<?php } else if ($post_title == 'Art' || $post_title == 'Art fr') {?>
								<div class="sliding art hidden" data-kffader='{"name":"anim2", "time": 0.2, "fade": 1e-6}'>
									<?php
$imgz = get_field('hover_slides');
    if ($imgz): ?>
										<?php foreach ($imgz as $image): ?>
								             <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
										<?php endforeach;?>
									<?php endif;?>
								</div>
							<?php } else if ($post_title == 'Studio' || $post_title == 'Studio Fr') {?>
								<div class="sliding studio hidden" data-kffader='{"name":"anim3", "time": 0.2, "fade": 1e-6}'>
									<?php
$imgz = get_field('hover_slides');
    if ($imgz): ?>
										<?php foreach ($imgz as $image): ?>
								             <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
										<?php endforeach;?>
									<?php endif;?>
								</div>
							<?php } else if ($post_title == 'Contact' || $post_title == 'Contact Fr') {?>
								<div class="sliding contact hidden" data-kffader='{"name":"anim4", "time": 0.2, "fade": 1e-6}'>
									<?php
$imgz = get_field('hover_slides');
    if ($imgz): ?>
										<?php foreach ($imgz as $image): ?>
								             <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
										<?php endforeach;?>
									<?php endif;?>
								</div>
							<?php } else if ($post_title == 'News' || $post_title == 'News fr') {?>
								<div class="sliding news hidden" data-kffader='{"name":"anim5", "time": 0.2, "fade": 1e-6}'>
									<?php
$imgz = get_field('hover_slides');
    if ($imgz): ?>
										<?php foreach ($imgz as $image): ?>
								             <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
										<?php endforeach;?>
									<?php endif;?>
								</div>
							<?php }

endforeach;?>

						<script>
							$('[data-kffader] img').on('load', loadHandler);

							function loadHandler(event) {
								var target = $(event.target),
									fader = target.closest('[data-kffader]');
								fader.kffader();
							}
						</script>

						<?php wp_reset_postdata();?>

					<?php endif;?>
				</div>
			</div>
		<?php endif;?>

	</header>