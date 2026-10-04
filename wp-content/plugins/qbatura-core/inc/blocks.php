<?php
/**
 * Rejestracja bloków wtyczki.
 *
 * @package qbatura-core
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Blok dynamiczny qbatura/project-meta (parametry realizacji: karta / lista).
 */
function qbatura_core_register_blocks() {
	register_block_type( QBATURA_CORE_DIR . 'blocks/project-meta' );
}
add_action( 'init', 'qbatura_core_register_blocks' );
