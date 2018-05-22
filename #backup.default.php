<?php 
	if ( wp_is_mobile() ) { ?>
	<?php
	if ( in_category( 'news' ) || in_category( 'nouvelles' )) { ?>
		<div class="entry-content col-xs-12 newsitem">
			<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
			<?php $bigimg = get_field('news_img_big'); ?>
			<?php $smallimg = get_field('news_img_small'); ?>
			<?php if( $bigimg ): ?>
	    		<img src="<?php echo $bigimg['url']; ?>" alt="<?php echo $bigimg['alt']; ?>" class="bigimg" />
	    	<?php endif; ?>
			<?php if( $smallimg ): ?>
	    		<img src="<?php echo $smallimg['url']; ?>" alt="<?php echo $smallimg['alt']; ?>" class="smallimg" />
	    	<?php endif; ?>
	    	<?php the_content(); ?>
		</div> 
		<?php 
	}
	else { ?>	
		<div class="entry-content col-xs-6 col-lg-4 alm-repeater-template page-<?php echo $alm_page; ?>">
			<?php if ( has_post_thumbnail() ) : ?>
				<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
			    	<?php the_post_thumbnail(); ?>
				</a>
			<?php
			endif;
			?>
			
			<div class="entry-titles">
				<?php the_title( sprintf( '<a href="%s" rel="bookmark" class="entry-title">', esc_url( 		get_permalink() ) ), '</a>' ); ?>
			</div>
		</div>
	<?php }
	}
	
	else {
	//if desktop

	if ( in_category( 'news' ) || in_category( 'nouvelles' )) { ?>
		<div class="entry-content col-xs-12 newsitem">
			<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
			<?php $bigimg = get_field('news_img_big'); ?>
			<?php $smallimg = get_field('news_img_small'); ?>
			<?php if( $bigimg ): ?>
	    		<img src="<?php echo $bigimg['url']; ?>" alt="<?php echo $bigimg['alt']; ?>" class="bigimg" />
	    	<?php endif; ?>
			<?php if( $smallimg ): ?>
	    		<img src="<?php echo $smallimg['url']; ?>" alt="<?php echo $smallimg['alt']; ?>" class="smallimg" />
	    	<?php endif; ?>
	    	<?php the_content(); ?>
		</div> 
		<?php 
	}
	else { ?>
	<div class="entry-content col-xs-6 col-sm-4 col-lg-4 alm-repeater-template page-<?php echo $alm_page; ?>">
		<?php if ( has_post_thumbnail() ) : ?>
			<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
		    	<?php the_post_thumbnail(); ?>
			</a>
		<?php
		endif;
		?>
		<?php 
		
		$images = get_field('cpost_gallery');
		$oembed = get_field('oembed');
		
		if( $images ): ?>
			<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
				<span class="post-slides hidden">
		    		<span class="post-slides-inner" data-kffader='{"name":"anim", "time": 0.2, "fade": 0.01}'>
		        		<?php foreach( $images as $image ): ?>
		                     <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
		        		<?php endforeach; ?>
			    	</span>
				</span>
			</a>
		<?php endif; ?>
		<?php
		if( $oembed ): ?>
			<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
				<span class="post-slides">
			    	<span class="post-slides-inner">
			    		<div class="blackframe hidden"></div>
						<div class="embed-container">
							<?php
							
							$oembed = get_field('oembed');
							
							
							// use preg_match to find iframe src
							preg_match('/src="(.+?)"/', $oembed, $matches);
							$src = $matches[1];
							
							
							// add extra params to iframe src
							$params = array(
							    'controls'    => 0,
							    'hd'        => 1,
							    'autohide'    => 1,
							    'api'		=> 1,
							    'background' => 1
							);
							
							$new_src = add_query_arg($params, $src);
							
							$oembed = str_replace($src, $new_src, $oembed);
							
							
							// add extra attributes to iframe html
							$attributes = 'class="myvid"';
							
							$oembed = str_replace('></iframe>', ' ' . $attributes . '></iframe>', $oembed);
							
							
							// echo $oembed
							echo $oembed;
							
							?>
						</div>
			    	</span>
				</span>
			</a>
		<?php endif; ?>
		
		
		<div class="entry-titles">
			<?php the_title( sprintf( '<a href="%s" rel="bookmark" class="entry-title">', esc_url( 		get_permalink() ) ), '</a>' ); ?>
		    <p class="entry-second"><?php the_field('second_title'); ?></p>
		</div>
	</div>
	<?php }
 } ?>