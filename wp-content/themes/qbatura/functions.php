<?php
/**
 * Qbatura — funkcje motywu.
 *
 * Plik tylko dołącza moduły z inc/. Funkcje niezwiązane z wyglądem (realizacje,
 * kategorie, pola) są we wtyczce qbatura-core.
 *
 * @package qbatura
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'QBATURA_VERSION', wp_get_theme( 'qbatura' )->get( 'Version' ) );
define( 'QBATURA_DIR', get_template_directory() );
define( 'QBATURA_URI', get_template_directory_uri() );

require_once QBATURA_DIR . '/inc/setup.php';
require_once QBATURA_DIR . '/inc/enqueue.php';
require_once QBATURA_DIR . '/inc/block-styles.php';
require_once QBATURA_DIR . '/inc/render-filters.php';
require_once QBATURA_DIR . '/inc/template-tags.php';
