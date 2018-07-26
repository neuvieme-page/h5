<?php get_header();?>

    <div class="primary">
        <main class="site-main" role="main">
            <div class="container" id="content">
                <div id="post-<?php the_ID();?>" <?php post_class();?>>
                <?php $classes = get_body_class();
                    $client = get_field('client');
                    $yearofwork = get_field('yearofwork');
                    $typeofwork = get_field('typeofwork');
                ?>
                <div class="post-content">
                    <div class="row row--intro">
                        <div class="col-sm-6 col-lg-6 seperate">
                            <div class="clientbox entry-content">
                                <div class="row">
                                    <div class="col-xs-12 col-lg-12">
                                        <?php the_title('<h1 class="entry-title">', '</h1>');?>
                                    </div>
                                    <div class="col-xs-12 col-lg-12">
                                    <p class="entry-texts"><?php echo $client; ?>, <?php echo $yearofwork; ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-6">
                            <div class="type-of-work">
                                <?php
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
                        </div>
                        <div class="row">
                        <?php

                            // check if the repeater field has rows of data
                            if( have_rows('image_repeater') ):

                                while ( have_rows('image_repeater') ) : the_row(); ?>

                            <div class="col-sm-12 col-lg-12">
                                <img src="<?php echo get_sub_field('image')['url']; ?>" alt="" />
                            </div>

                                <?php endwhile;

                            else :

                                // no rows found

                            endif;

                            ?>
                        </div>
                    </div>
                </div>
                <?php
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

            </div>
        </main>
    </div>
<?php get_footer();?>