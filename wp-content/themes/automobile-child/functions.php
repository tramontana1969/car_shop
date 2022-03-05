<?php
function webpro_add_books_to_query( $query ) {
if ( is_home() && $query->is_main_query() )
$query->set( 'post_type', array( 'cars' ) );
return $query;
}
add_action( 'pre_get_posts', 'webpro_add_books_to_query' );

function true_custom_fields() {
    add_post_type_support( 'cars', 'custom-fields'); // в качестве первого параметра укажите название типа поста
}

add_action('init', 'true_custom_fields');