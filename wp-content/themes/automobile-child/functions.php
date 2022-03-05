<?php
function webpro_add_books_to_query( $query ) {
if ( is_home() && $query->is_main_query() )
$query->set( 'post_type', array( 'post', 'cars' ) );
return $query;
}
add_action( 'pre_get_posts', 'webpro_add_books_to_query' );