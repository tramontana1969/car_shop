<?php
/**
 * Custom header implementation
 */

function automobile_shop_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'automobile_shop_custom_header_args', array(
		'default-text-color' => 'fff',
		'header-text' 	     =>	false,
		'width'              => 1200,
		'height'             => 85,
		'flex-width'         => true,
		'flex-height'        => true,
		'wp-head-callback'   => 'automobile_shop_header_style',
	) ) );
}

add_action( 'after_setup_theme', 'automobile_shop_custom_header_setup' );

if ( ! function_exists( 'automobile_shop_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @see automobile_shop_custom_header_setup().
 */
add_action( 'wp_enqueue_scripts', 'automobile_shop_header_style' );
function automobile_shop_header_style() {
	//Check if user has defined any header image.
	if ( get_header_image() ) :
	$custom_css = "
        #header {
			background-image:url('".esc_url(get_header_image())."');
			background-size: 100% 100%;
		}";
	   	wp_add_inline_style( 'automobile-shop-basic-style', $custom_css );
	endif;
}
endif; // automobile_shop_header_style