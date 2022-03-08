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

add_action( 'manage_edit-cars_columns', function ( $columns ) {
    $my_columns = [
        'sale' => 'Sale',
    ];
    return $columns + $my_columns ;
} );

add_filter( 'manage_cars_posts_custom_column', 'view_all_checkboxes');

function view_all_checkboxes($column_name) {
    $id = get_the_ID();
    $post = acf_get_posts();
    $sale_status_array = array_values(get_post_meta($id,'sales'));

    for ($i = 0; $i < count($sale_status_array); $i++) {
        $sale_status = $sale_status_array[$i];
    }
    if ($column_name == 'sale') {
        if($post[0] == get_post()) {
            echo "<form method='post'>";
            if ( $sale_status == 'off') {
                echo "<input type='hidden'/>";
            }
            elseif ($sale_status == 'on') {
                echo "<input type='hidden'>";
            }
            echo "</form>";
        }
        echo "<form method='post'>";
        the_meta();
        if ( $sale_status == 'off') {
            echo "<input id='empty_checkbox_$id' type='checkbox' name='_sales[$id]' value='$id'/>";
        }
        elseif ($sale_status == 'on') {
            echo "<input id='checkbox_$id' type='checkbox' name='_sales[$id]' value='$id' checked/>";
        }
        echo "<input onclick='change_status()' type='submit' value='Change status' />";
        echo "</form>";
    }
};

add_action('manage_cars_posts_custom_column', 'change_cars_sale_status', 10, 5);
function change_cars_sale_status($column_name, $id) {

    $sale_status_array = array_values(get_post_meta($id,'sales'));

    for ($i = 0; $i < count($sale_status_array); $i++) {
        $sale_status = $sale_status_array[$i];
    }

    if ($column_name == 'sale') {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && $sale_status == 'off' && $_POST['_sales'][$id] == $id) {
            update_post_meta($id, 'sales', 'on');
            wp_get_update_https_url();
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && $sale_status == 'on' && $_POST['_sales'][$id] == $id) {
            update_post_meta($id, 'sales', 'off');
            wp_get_update_https_url();
        }
    }
}