<?php get_header();?>

    <div class="primary">
        <main class="site-main" role="main">
            <div class="container" id="content">
                <div id="post-<?php the_ID();?>" <?php post_class();?>>

                <div class="sliderwrapper">
                    <div class="slider">

                        <?php

// check if the flexible content field has rows of data
if (have_rows('carousel_gallery')):

    // loop through the rows of data
    while (have_rows('carousel_gallery')): the_row();

        if (get_row_layout() == 'image_container'):

            $carouselimage = get_sub_field('gallery_image');?>

																																																																																	<img src="<?php echo $carouselimage['url']; ?>" alt="<?php echo $carouselimage['alt']; ?>">

																																																																																										                                    <?php

        elseif (get_row_layout() == 'video_container'):

            $carouselvid = get_sub_field('gallery_video');
            ?>

																																																																																										                                    <?php if (!wp_is_mobile()): ?>
																																																																																										                                        <div class="single-video-wrapper">
																																																																																										                                            <img class="ratio" src="<?php bloginfo('template_directory');?>/assets/images/16x9.png"/>
																																																																																										                                            <?php

            // use preg_match to find iframe src
            preg_match('/src="(.+?)"/', $carouselvid, $matches);
            $src = $matches[1];

            // add extra params to iframe src
            $params = array(
                'controls' => 1,
                'hd' => 1,
                'fullscreen' => true,
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
																																																												                                            <img class="ratio" src="<?php bloginfo('template_directory');?>/assets/images/16x9.png"/>
																																																												                                            <?php

        // use preg_match to find iframe src
        preg_match('/src="(.+?)"/', $carouselvid, $matches);
        $src = $matches[1];

        // add extra params to iframe src
        $params = array(
            'controls' => 1,
            'hd' => 1,
            'autohide' => 1,
            'api' => 1,
            'background' => 0,
            'fullscreen' => true,
            'player_id' => 'player1',
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
																																																												                                    <?php endif;?>

																														                                    <?php
endif;

endwhile;

else:

    // no layouts found

endif;

?>

                    </div>

                    <div class="cursors">
                        <span class="cursor cursorleft"></span>
                        <span class="cursor cursorright"></span>
                    </div>
                </div>


                <?php $classes = get_body_class();?>
                <div class="post-content">
                    <div class="row">
                        <div class="col-sm-6 col-lg-6 seperate">
                            <div class="clientbox entry-content">
                                <div class="row">
                                    <div class="col-xs-12 col-lg-12">
                                        <?php the_title('<h1 class="entry-title">', '</h1>');?>
                                    </div>
                                    <div class="col-sm-5 col-lg-5">
                                        <?php
    $client = get_field('client');
    if ($client): ?>
                                            <p class="entry-texts"><?php echo $client; ?></p>
                                        <?php else: ?>
                                            <p class="entry-texts">Client name goes here</p>
                                        <?php endif;?>
                                    </div>
                                    <div class="col-sm-3 col-lg-3">
                                        <?php
    $yearofwork = get_field('yearofwork');
    if ($yearofwork): ?>
                                            <p class="entry-texts "><?php echo $yearofwork; ?></p>
                                        <?php else: ?>
                                            <p class="entry-texts">Year goes here</p>
                                        <?php endif;?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-6">
                            <div class="type-of-work">
                                <?php
$typeofwork = get_field('typeofwork');
if ($typeofwork): ?>
                                    <p class="entry-desc"><?php echo $typeofwork; ?></p>
                                <?php else: ?>
                                    <p class="entry-desc">Works go here (i.e Art direction)</p>
                                <?php endif;?>
                            </div>
                            <div class="entry-content">
                                <?php if ($post->post_content != ""): ?>
                                    <?php echo apply_filters('the_content', $post->post_content); ?>
                                    <?php else: ?>

                                <?php endif;?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-lg-12">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/content.jpg" alt="">
                            </div>
                            <div class="col-sm-12 col-lg-12">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/content.jpg" alt="">
                            </div>
                            <div class="col-sm-12 col-lg-12">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/content.jpg" alt="">
                            </div>
                            <div class="col-sm-12 col-lg-12">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/content.jpg" alt="">
                            </div>
                        </div>
                    </div>
                </div>

                </div>
                <?php
ini_set("display_errors", 1);
$post_id = get_the_ID();

$cat_id = get_the_category($post_id);
$term_id = $cat_id[0]->term_id;
$good = array(29, 15);
if (in_array($term_id, $good)):

    $original_query = $wp_query;
    $wp_query = null;
    $args = array('posts_per_page' => 6);
    $wp_query = new WP_Query($args);

    ?>
	            <div class="more-works">

                    <p class="more-works-title col-xs-12 col-lg-12">Voir aussi :</p>

                    <?php foreach ($wp_query->posts as $post): ?>

                    <div class="entry-content col-sm-12 col-lg-4">
                        <a href="<?=get_the_permalink();?>" rel="bookmark"></a>
                        <?php if (has_post_thumbnail($post->ID)): ?>
                        <?php $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'single-post-thumbnail');?>
                        <img src="<?php echo $image[0]; ?>" alt="">
                        <?php endif;?>
                        <div class="entry-titles">
                            <h3 class="entry-title">Dior</h3>
                            <h3><?=$post->post_title;?></h3>
                        </div>
                    </div>

                  <?php endforeach;

?>

                </div>
                <?php endif;?>
            </div>
        </main>
    </div>
<?php get_footer();?>