<?php get_header(); ?>
	<div class="primary">
		<main class="site-main" role="main">
			<div class="landing-pages"
				data-customaction="
				toggleClass(hidden) of .letter-container on animationend/webkitAnimationEnd/oAnimationEnd/MSAnimationEnd,
				toggleClass(menulove) of .mainNav ul li on animationend/webkitAnimationEnd/oAnimationEnd/MSAnimationEnd,
				toggleClass(hideOnHome) of .mainNav on animationend/webkitAnimationEnd/oAnimationEnd/MSAnimationEnd,
				toggleClass(hideOnHome) of .site-header on animationend/webkitAnimationEnd/oAnimationEnd/MSAnimationEnd,
				toggleClass(hidden) of .primary on animationend/webkitAnimationEnd/oAnimationEnd/MSAnimationEnd">
				<?php
						$files = array('front-parts/front-letters.php', 'front-parts/front-clients.php', 'front-parts/front-philosophy.php', 'front-parts/front-crafts.php');
						
						// randomly include a file
						include $files[array_rand($files)];
				?>
			</div>
		</main>
	</div>
<?php get_footer(); ?>