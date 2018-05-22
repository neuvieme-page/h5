<?php
/*
Template Name: Studio page
*/
?>
<?php get_header(); ?>
	<div class="primary">
		<main class="site-main" role="main">
		    <div class="container">
                <?php
                if ( have_posts() ):
                    while ( have_posts() ) {
                        the_post();
                        the_content();
                    }
                else: ?>
                    <script id="findme">window.early.done();</script>
                <?php endif; ?>
            </div>
		</main>
	</div>
<?php get_footer(); ?>