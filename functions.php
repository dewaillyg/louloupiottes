<?php

/**
 * This file contains global configuration functions related to the parent theme.
 */

/***********************************************
 *   CONSTANTS	
 ************************************************/

defined('ABSPATH') || exit;



/***********************************************
 *   HOOKS	
 ************************************************/

add_action( 'init', 'minimog_child_remove_wp_global_styles' );

if (!function_exists('minimog_child_enqueue_scripts'))
	add_action('wp_enqueue_scripts', 'minimog_child_enqueue_scripts', 15);

add_action('wp_enqueue_scripts', 'minimog_child_disable_gutenberg_wp_enqueue_scripts', 100);



/***********************************************
 *   FUNCTIONS	
 ************************************************/

/**
 * This function loads the child theme styles.
 *
 * @return void
 */
function minimog_child_enqueue_scripts(): void
{
	wp_enqueue_style('minimog-child-style', get_stylesheet_directory_uri() . '/style.css');
	return;
}


/**
 * Disable the global WordPress style.
 *
 * @return void
 */
function minimog_child_remove_wp_global_styles(): void {
	remove_action( 'wp_enqueue_scripts', 'wp_enqueue_global_styles' );
	remove_action( 'wp_body_open', 'wp_global_styles_render_svg_filters' );

	return;
}


/**
 * Disable Gutenberg resources.
 *
 * @return void
 */
function minimog_child_disable_gutenberg_wp_enqueue_scripts(): void
{
	if (!is_singular('post')) {
		wp_dequeue_style('wp-block-library');
		wp_dequeue_style('wp-block-library-theme');
		wp_dequeue_style('wc-blocks-style');
	}
	return;
}
