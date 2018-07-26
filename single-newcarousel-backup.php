<?php get_header(); ?>

    <div class="primary">
        <main class="site-main" role="main">
            <div class="container" id="content">
                <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

                <div class="sliderwrapper">
                    <div class="slider">

                        <?php

                        // check if the flexible content field has rows of data
                        if( have_rows('carousel_gallery') ):

                             // loop through the rows of data
                            while ( have_rows('carousel_gallery') ) : the_row();

                                if( get_row_layout() == 'image_container' ):

                                    $carouselimage = get_sub_field('gallery_image'); ?>

                                    <img src="<?php echo $carouselimage['url']; ?>" alt="<?php echo $carouselimage['alt']; ?>">

                                    <?php

                                elseif( get_row_layout() == 'video_container' ): 

                                    $carouselvid = get_sub_field('gallery_video');
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


                <?php $classes = get_body_class(); ?>     
                <div class="post-content">
                    <div class="row">
                        <div class="col-sm-12 col-lg-4 seperate">
                            <div class="clientbox entry-content">
                                <?php
                                $client = get_field('client');
                                if( $client ): ?>
                                    <h3>Client</h3>
                                    <p><?php echo $client; ?></p>
                                <?php else: ?>
                                    <h3>Client</h3>
                                    <p>Client name goes here</p>
                                <?php endif; ?>
                            </div>
                        <?php
                        $yearofwork = get_field('yearofwork');
                        if( $yearofwork ): ?>
                            <?php if (in_array('en-US', $classes)) : ?>
                                <h3>Year</h3>
                            <?php else: ?>
                                <h3>Année</h3>
                            <?php endif; ?>
                            <p><?php echo $yearofwork; ?></p>
                        <?php else: ?>
                            <?php if (in_array('en-US', $classes)) : ?>
                                <h3>Year</h3>
                            <?php else: ?>
                                <h3>Année</h3>
                            <?php endif; ?>
                            <p>Year goes here</p>
                        <?php endif; ?>                            
                            
                        </div>

                        <div class="col-sm-12 col-lg-8">
                            <div class="type-of-work">
                                <?php
                                $typeofwork = get_field('typeofwork');
                                if( $typeofwork ): ?>
                                    <?php if (in_array('en-US', $classes)) : ?>
                                        <h3>Works</h3>
                                    <?php else: ?>
                                        <h3>Réalisations</h3>
                                    <?php endif; ?>
                                    <p><?php echo $typeofwork; ?></p>
                                <?php else: ?>
                                    <?php if (in_array('en-US', $classes)) : ?>
                                        <h3>Works</h3>
                                    <?php else: ?>
                                        <h3>Réalisations</h3>
                                    <?php endif; ?>
                                    <p>Works go here (i.e Art direction)</p>
                                <?php endif; ?>                            
                            </div>
                            <div class="entry-content">
                                <?php if($post->post_content != "") : ?>
                                    <?php echo apply_filters('the_content', $post->post_content); ?>
                                    <?php else: ?>
                                    
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>

                <?php
                if ( wp_is_mobile() ) { ?>
                    <?php if (in_array('en-US', $classes)) { ?>   
                        <div class="pagination-single cf">
                            <div class="post-link link-left fill-left"><?php next_post_link('%link', '<span class="prev-project"><i class="fa fa-angle-left"></i></span>', TRUE); ?></div>
                            <?php if ( in_category( 'work' )) { ?>
                                <div class="post-link link-center fill-bot"><a href="<?php echo get_page_link(23); ?>"><span class="all-projects">ALL PROJECTS</span><span class="fill"></span></a></div>
                            <?php } else { ?>
                                <div class="post-link link-center fill-bot"><a href="<?php echo get_page_link(25); ?>"><span class="all-projects">ALL PROJECTS</span><span class="fill"></span></a></div>
                            <?php } ?>
                            <div class="post-link link-right fill-right"><?php previous_post_link('%link', '<span class="next-project"><i class="fa fa-angle-right"></i></span>', TRUE); ?></div>               
                        </div>
                    <?php } else { ?>
                        <div class="pagination-single cf">
                            <div class="post-link link-left fill-left"><?php next_post_link('%link', '<span class="prev-project"><i class="fa fa-angle-left"></i></span>', TRUE); ?></div>
                            <?php if ( in_category( 'travail' )) { ?>
                                <div class="post-link link-center fill-bot"><a href="<?php echo get_page_link(41); ?>"><span class="all-projects">Tous les projets</span><span class="fill"></span></a></div>
                            <?php } else { ?>
                                <div class="post-link link-center fill-bot"><a href="<?php echo get_page_link(488); ?>"><span class="all-projects">Tous les projets</span><span class="fill"></span></a></div>
                            <?php } ?>
                            <div class="post-link link-right fill-right"><?php previous_post_link('%link', '<span class="next-project"><i class="fa fa-angle-right"></i></span>', TRUE); ?></div>               
                        </div>
                    <?php } ?>

                    <?php
                    } else { ?>


                  <?php
                  if (in_array('en-US', $classes)) { ?>                    
                        <div class="pagination-single cf">
                            <div class="post-link link-left fill-left"><?php next_post_link('%link', '<span class="prev-project"><i class="fa fa-angle-left"></i> <span class="btnstring">Previous project</span></span>', TRUE); ?></div>
                            <?php if ( in_category( 'work' )) { ?>
                                <div class="post-link link-center fill-bot"><a href="<?php echo get_page_link(23); ?>"><span class="all-projects">ALL PROJECTS</span><span class="fill"></span></a></div>
                            <?php } else { ?>
                                <div class="post-link link-center fill-bot"><a href="<?php echo get_page_link(25); ?>"><span class="all-projects">ALL PROJECTS</span><span class="fill"></span></a></div>
                            <?php } ?>
                            <div class="post-link link-right fill-right"><?php previous_post_link('%link', '<span class="next-project"><span class="btnstring">Next project</span> <i class="fa fa-angle-right"></i></span>', TRUE); ?></div>
                        </div> 
                    <?php } else { ?>
                        <div class="pagination-single cf">
                            <div class="post-link link-left fill-left"><?php next_post_link('%link', '<span class="prev-project"><i class="fa fa-angle-left"></i> <span class="btnstring">Projet précédent</span></span>', TRUE); ?></div>
                            <?php if ( in_category( 'travail' )) { ?>
                                <div class="post-link link-center fill-bot"><a href="<?php echo get_page_link(41); ?>"><span class="all-projects">Tous les projets</span><span class="fill"></span></a></div>
                            <?php } else { ?>
                                <div class="post-link link-center fill-bot"><a href="<?php echo get_page_link(488); ?>"><span class="all-projects">Tous les projets</span><span class="fill"></span></a></div>
                            <?php } ?>
                            <div class="post-link link-right fill-right"><?php previous_post_link('%link', '<span class="next-project"><span class="btnstring">Projet suivant</span> <i class="fa fa-angle-right"></i></span>', TRUE); ?></div>
                        </div>                     
                    <?php } ?>
                    <?php } ?>
                </div>
            </div>
        </main>
    </div>
<?php get_footer(); ?>