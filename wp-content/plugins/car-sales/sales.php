<?php
/*
 * Plugin name: Sales
 * Description: Custom plugin for adding an opportunity to crate sales
 * Version: 1
 * Author: Maks
 * Author URI: https://github.com/tramontana1969
 */


add_action('save_post_cars', 'set_default_sale_status');
function set_default_sale_status() {
    $id = get_the_ID();
    update_post_meta($id, 'sales', 'off');
}

add_filter( 'manage_cars_posts_columns', function ( $columns ) {
    $my_columns = [
        'sale' => 'Sale',
    ];
    return $columns +  $my_columns;
} );

add_action( 'manage_cars_posts_custom_column', function ( $column_name ) {
    $id = get_the_ID();
    $sale_status_array = array_values(get_post_meta($id,'sales'));

    for ($i = 0; $i < count($sale_status_array); $i++) {
        $sale_status = $sale_status_array[$i];
    }

    if ( $column_name === 'sale' && $sale_status == 'off') {
        ?><form method="post">
            <input type="checkbox" name="sales" />
            <input type="submit" value="Add to Sales"/>
        </form><?php
    }
    elseif ($column_name === 'sale' && $sale_status == 'on') {
//        update_post_meta($id, 'sales', 'on');
        ?><form method="post">
            <input type="checkbox" name="sales" checked/>
            <input type="submit" value="Remove form Sales"/>
        </form><?php
    }
} );
