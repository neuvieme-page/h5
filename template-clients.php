<?php
/*
Template Name: Clients page
*/
?>
<?php get_header(); ?>
	<div class="primary">
		<main class="site-main" role="main">
		    <div class="container">
                <h2>the posts</h2>	
					<?php
						$args = array(
							'post_type' => 'post',
							'posts_per_page' => 999
						);
						// The Query
						$the_query = new WP_Query( $args );

						// The Loop
						if ( $the_query->have_posts() ) {
							echo '<ul>';
							while ( $the_query->have_posts() ) {
								$the_query->the_post();
								echo '<li>' . get_the_title() . '</li>';
							}
							echo '</ul>';
							/* Restore original Post Data */
							wp_reset_postdata();
						} else {
							// no posts found
						}
					?>      
		    </div>
		</main>
	</div>
<?php get_footer(); ?>