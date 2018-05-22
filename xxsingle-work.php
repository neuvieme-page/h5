<?php get_header(); ?>
	<div class="primary">
		<main class="site-main" role="main">
			<div class="container" id="content">
			    <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
                <?php 
                $images = get_field('cpost_gallery');
                
                if( $images ): ?>
                    <div class="slider">
                        <?php foreach( $images as $image ): ?>
                            <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
                <div class="post-content">
                    <div class="row">
                        <div class="col-sm-12 col-lg-5">
                            <div class="col-lg-4">
                                <p class="heavy">Client</p>
                                <p class="heavy">Type of work</p>
                            </div>
                            <div class="col-lg-8">
                                <p><?php echo the_field('client'); ?></p>
                                <p><?php echo the_field('typeofwork'); ?></p>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-7">
                    	    <div class="entry-content">
                                <?php echo $post->post_content; ?>
                    		</div>
                		</div>
            		</div>
        		</div>
    		</div>
            next:<?php next_posts_link('&laquo; Older Entries', $post->max_num_pages) ?>
		</main>
	</div>
<?php get_footer(); ?>