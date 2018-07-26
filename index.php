<?php get_header(); ?>
	<div class="primary">
		<main class="site-main" role="main">
		    <div class="container">
                <?php
                if ( have_posts() ) {
                    while ( have_posts() ) {
                        the_post();
                        the_title( '<h3>', '</h3>' );
                        the_content();
                    }
                } ?>
            </div>
		</main>
	</div>
<?php get_footer(); ?>