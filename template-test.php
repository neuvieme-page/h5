<?php
/*
Template Name: Test page
*/
?>
<?php get_header(); ?>
	<div class="primary">
		<main class="site-main" role="main">
		    <div class="container">
                <div class="sliderwrapper">
                    <div class="slider">

                        <?php

                        // check if the flexible content field has rows of data
                        if( have_rows('test_carousel_gallery') ):

                             // loop through the rows of data
                            while ( have_rows('test_carousel_gallery') ) : the_row();

                                if( get_row_layout() == 'test_image_gallery' ):

                                    $carouselimage = get_sub_field('test_image'); ?>

                                    <img src="<?php echo $carouselimage['url']; ?>" alt="<?php echo $carouselimage['alt']; ?>">

                                    <?php

                                elseif( get_row_layout() == 'test_video_gallery' ): 

                                    $carouselvid = get_sub_field('test_video');
                                    ?>
                                    
                                    <?php if ( !wp_is_mobile() ) : ?>
                                        <div class="single-video-wrapper">
                                            <img class="ratio" src="<?php bloginfo('template_directory'); ?>/assets/images/16x9.png"/>
                                            <?php
                                                                                    
                                            // use preg_match to find iframe src
                                            preg_match('/src="(.+?)"/', $carouselvid, $matches);
                                            $src = $matches[1];
                                            
                                            // add extra params to iframe src
                                            $params = array(
                                                'controls'    => 0,
                                                'hd'        => 1,
                                                'autohide'    => 1,
                                                'api'       => 1,
                                                'background' => 1,
                                                'fullscreen'  => true,
                                                'player_id' => 'player1'
                                            );
                                            
                                            $new_src = add_query_arg($params, $src);
                                            
                                            $carouselvid = str_replace($src, $new_src, $carouselvid);
                                            
                                            
                                            // add extra attributes to iframe html
                                            $attributes = 'id="player1"';
                                            
                                            $carouselvid = str_replace('></iframe>', ' ' . $attributes . '></iframe>', $carouselvid);
                                            
                                            
                                            // echo $carouselvideos
                                            echo $carouselvid;
                                            
                                            ?>
                                        </div>
                                    <?php else: ?>
                                        <div class="single-video-wrapper">
                                            <img class="ratio" src="<?php bloginfo('template_directory'); ?>/assets/images/16x9.png"/>
                                            <?php
                                                                                        
                                            // use preg_match to find iframe src
                                            preg_match('/src="(.+?)"/', $carouselvid, $matches);
                                            $src = $matches[1];
                                            
                                            // add extra params to iframe src
                                            $params = array(
                                                    'controls'    => 1,
                                                    'hd'        => 1,
                                                    'autohide'    => 1,
                                                    'api'       => 1,
                                                    'background' => 0,
                                                    'fullscreen'  => true,
                                                    'player_id' => 'player1'
                                            );
                                            
                                            $new_src = add_query_arg($params, $src);
                                            
                                            $carouselvid = str_replace($src, $new_src, $carouselvid);
                                            
                                            
                                            // add extra attributes to iframe html
                                            $attributes = 'id="player1"';
                                            
                                            $carouselvid = str_replace('></iframe>', ' ' . $attributes . '></iframe>', $carouselvid);
                                            
                                            
                                            // echo $carouselvideos
                                            echo $carouselvid;
                                            
                                            ?>
                                        </div>
                                    <?php endif; ?>

                                    <?php
                                endif;

                            endwhile;

                        else :

                            // no layouts found

                        endif;

                        ?>
              
                    </div>

                    <div class="cursors">
                        <span class="cursor cursorleft"></span>
                        <span class="cursor cursorright"></span>
                    </div>                          
                </div>
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