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


add_filter( 'manage_cars_posts_custom_column', 'checkboxes_methods');
function checkboxes_methods($column_name) {
    $id = get_the_ID();
    $post = acf_get_posts();
    $sale_status_array = array_values(get_post_meta($id,'sales'));

    for ($i = 0; $i < count($sale_status_array); $i++) {
        $sale_status = $sale_status_array[$i];
    }
    if ($column_name == 'sale') {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && $sale_status == 'off' && $_POST['_sales'][$id] == $id) {
            update_post_meta($id, 'sales', 'on');
            echo "<p>Added to sales</p>";
        }
        else if ($_SERVER['REQUEST_METHOD'] == 'POST' && $sale_status == 'on' && $_POST['_sales'][$id] == $id) {
            update_post_meta($id, 'sales', 'off');
            echo "<p>Removed from sales</p>";
        }
        else {
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
            if ( $sale_status == 'off') {
                echo "<input id='empty_checkbox_$id' type='checkbox' name='_sales[$id]' value='$id'/>";
            }
            elseif ($sale_status == 'on') {
                echo "<input id='checked_checkbox_$id' type='checkbox' name='_sales[$id]' value='$id' checked/>";
            }
            echo "<input type='submit' value='Change status' />";
            echo "</form>";
        }
    }
};