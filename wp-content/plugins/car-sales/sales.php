<?php
/*
 * Plugin name: Sales
 * Description: Custom plugin for adding an opportunity to crate sales
 * Version: 1
 * Author: Maks
 * Author URI: https://github.com/tramontana1969
 */



add_action( 'admin_head', 'true_colored_admin_bar_72aee6' );

function true_colored_admin_bar_72aee6(){
    echo '<style>#wpadminbar{background-color: #72aee6;}</style>'; // выводим стили
}

