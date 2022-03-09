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
    $sale_status_array = array_values(get_post_meta($id,'sales'));

    for ($i = 0; $i < count($sale_status_array); $i++) {
        $sale_status = $sale_status_array[$i];
    }

    if ($column_name == 'sale') {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && $sale_status == 'off' && $_POST['sale'] == $id ) {
            update_post_meta($id, 'sales', 'on');
        }
        else if ($_SERVER['REQUEST_METHOD'] == 'POST' && $sale_status == 'on' && $_POST['sale'] == $id) {
            update_post_meta($id, 'sales', 'off');
        }
        echo "<form method='post'>";
//        print_r(get_post($id));
        $post_IDS = array();

        while ( have_posts() ) : the_post();
            $post_ID = get_the_ID();
            array_push($post_IDS, $post_ID);
        endwhile;
        print_r(get_post_meta($id,'sales'));
        echo "<input id='sale_checkbox_$id' onclick='change_sale_status_js($id)' type='checkbox' name='_sales[$id]' value='$id'/>";
        if ( $sale_status == 'on') {
            echo "on Sale";
        }
        else {
            echo 'add to Sales';
        }
        echo "</form>";
    }
};

add_filter('admin_enqueue_scripts', 'add_js');
function add_js() {
    wp_enqueue_script( "change_sale_status_js", plugins_url('/car-sales/js/sales.js'));
}

add_filter( 'wp_enqueue_scripts', 'css_to_wp_head');
function css_to_wp_head() {
    $post_IDS = array();
    while ( have_posts() ) : the_post();
        $post_ID = get_the_ID();
        array_push($post_IDS, $post_ID);
    endwhile;

    foreach ($post_IDS as $post_ID) {
        if (get_post_meta($post_ID,'sales')[0] == 'on') {
            echo "
            <style>
                #title_$post_ID {
                    color: red;
                }
            </style>
            ";
        }
    }
}