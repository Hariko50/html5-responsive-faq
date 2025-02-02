<?php
/*
Plugin Name: HTML5 Responsive FAQ
Author: Aman Verma
Author URI: http://www.indatos.com/?ref=faq
Plugin URI: http://www.indatos.com/?ref=faq
Description: HTML5 Responsive FAQ Plugin – Erstelle responsive FAQs für deine Seite.
Version: 2.4
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

// Sicherheitsabfrage:
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Direktzugriff verhindern.
}

// Custom Post Type für FAQs registrieren.
function hrf_register_faq_post_type() {
    $labels = array(
        'name'               => 'FAQs',
        'singular_name'      => 'FAQ',
        'menu_name'          => 'FAQs',
        'add_new'            => 'Add FAQ',
        'add_new_item'       => 'Add New FAQ',
        'edit'               => 'Edit',
        'edit_item'          => 'Edit FAQ',
        'new_item'           => 'New FAQ',
        'view'               => 'View FAQ',
        'view_item'          => 'View FAQ',
        'search_items'       => 'Search FAQs',
        'not_found'          => 'No FAQs Found',
        'not_found_in_trash' => 'No FAQs Found in Trash',
        'parent_item_colon'  => 'Parent FAQ:',
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'capability_type'    => 'post',
        'hierarchical'       => false,
        'rewrite'            => array( 'slug' => 'hrf_faq', 'with_front' => true ),
        'query_var'          => true,
        'exclude_from_search'=> true,
        'menu_position'      => 5,
        'supports'           => array( 'title', 'editor', 'page-attributes' ),
        'taxonomies'         => array( 'category' ),
    );

    register_post_type( 'hrf_faq', $args );
}
add_action( 'init', 'hrf_register_faq_post_type' );

// Zusätzliche Dateien einbinden.
require plugin_dir_path( __FILE__ ) . 'include/hrf-options.php';
require plugin_dir_path( __FILE__ ) . 'include/hrf-faq.php';
require plugin_dir_path( __FILE__ ) . 'include/hrf-style.php';

// Frontend-JavaScript einbinden.
function hrf_enqueue_scripts() {
    wp_enqueue_script( 'hrf-script', plugins_url( 'js/hrf-script.js', __FILE__ ), array('jquery'), '2.4', true );
}
add_action( 'wp_enqueue_scripts', 'hrf_enqueue_scripts' );

// Admin-Skripte (Color Picker) einbinden.
function hrf_admin_enqueue_scripts( $hook ) {
    wp_enqueue_style( 'wp-color-picker' );
    wp_enqueue_script( 'hrf-options', plugins_url( 'js/hrf-options.js', __FILE__ ), array( 'wp-color-picker', 'jquery' ), '2.4', true );
}
add_action( 'admin_enqueue_scripts', 'hrf_admin_enqueue_scripts' );
