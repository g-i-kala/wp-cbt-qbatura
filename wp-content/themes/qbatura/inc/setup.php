<?php
/**
 * Ustawienia motywu: wsparcie funkcji, kategoria wzorców, tłumaczenia, favicon.
 *
 * @package qbatura
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Konfiguracja motywu.
 */
function qbatura_setup() {
	load_theme_textdomain( 'qbatura', QBATURA_DIR . '/languages' );

	add_theme_support( 'editor-styles' );
	add_editor_style(
		array(
			'assets/css/base.css',
			'assets/css/layout.css',
			'assets/css/editor.css',
		)
	);

	// Bez domyślnych wzorców core — w inserterze tylko wzorce projektu.
	remove_theme_support( 'core-block-patterns' );
}
add_action( 'after_setup_theme', 'qbatura_setup' );

/**
 * Kategoria wzorców „Qbatura”.
 */
function qbatura_register_pattern_categories() {
	register_block_pattern_category(
		'qbatura',
		array(
			'label'       => __( 'Qbatura', 'qbatura' ),
			'description' => __( 'Sekcje strony Qbatura.', 'qbatura' ),
		)
	);
}
add_action( 'init', 'qbatura_register_pattern_categories' );

/**
 * Bez wzorców z katalogu WordPress.org (zdalnych).
 */
add_filter( 'should_load_remote_block_patterns', '__return_false' );

/**
 * Favicon „Q” z motywu (W6), dopóki w Ustawieniach nie ustawiono ikony witryny.
 */
function qbatura_favicon() {
	if ( has_site_icon() ) {
		return;
	}
	printf(
		'<link rel="icon" href="%s" type="image/svg+xml">' . "\n",
		esc_url( QBATURA_URI . '/assets/images/favicon.svg' )
	);
}
add_action( 'wp_head', 'qbatura_favicon' );
add_action( 'admin_head', 'qbatura_favicon' );
