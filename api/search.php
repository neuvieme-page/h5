<?php

    $search_term = (String) $_GET['s'];

    $query = new WP_Query( array( 's' => $search_term ) );

    print_r($query);

?>