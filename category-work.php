<?php get_header(); ?>
	<div class="primary">
		<main class="site-main" role="main">
			<div class="container" id="content">
                <?php 
                    $cat = get_category( get_query_var( 'cat' ) );
                    $category = $cat->slug;
                    echo do_shortcode('[ajax_load_more category="'.$category.'"]');
                ?>			    
			</div>
		</main>
	</div>
<?php get_footer(); ?>