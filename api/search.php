<?php

header('Content-Type: application/json');

define('WP_USE_THEMES', false);
require_once '../../../../wp-load.php';

$search_term = isset($_GET['s']) ? $_GET['s'] : 'lacoste';

$query = new WP_Query(array('s' => $search_term, 'cat' => '29,15'));

$formatPosts = array();

foreach ($query->posts as $post) {

    $client = get_field('client', $post->ID);
    $yearofwork = get_field('yearofwork', $post->ID);
    $typeofwork = get_field('typeofwork', $post->ID);
    $secondTitle = get_field('second_title', $post->ID);
    $image = get_field('news_img_small', $post->ID);

    $formatPost = array(
        'title' => $post->post_title,
        'year' => $yearofwork,
        'second_title' => $secondTitle,
        'client' => $client,
        'link' => get_bloginfo('url') . '/' . $post->post_name,
        'image' => get_the_post_thumbnail_url(),
    );

    array_push($formatPosts, $formatPost);
}

die(json_encode($formatPosts));
