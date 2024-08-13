<?php

/**
 * Adds ShareOpenly block
 *
 * This is the code that adds the sharing links to the ShareOpenly block for use with Block Themes.
 *
 * @package shareopenly
 */

// Exit if accessed directly.

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Registers the block using the metadata loaded from the `block.json` file.
 *
 * @see https://developer.wordpress.org/reference/functions/register_block_type/
 */
function shareopenly_share_openly_block_init() {
	register_block_type( __DIR__ . '/../build' );
}
add_action( 'init', 'shareopenly_share_openly_block_init' );

