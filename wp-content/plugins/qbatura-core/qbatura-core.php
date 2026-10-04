<?php
/**
 * Plugin Name:       Qbatura Core
 * Description:       Funkcje strony Qbatura niezależne od wyglądu: typ treści „Realizacje”, kategorie realizacji, pola „Dane realizacji” i blok parametrów projektu.
 * Version:           0.1.0
 * Requires at least: 6.7
 * Requires PHP:      8.1
 * Author:            Karo Creative Designs
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       qbatura-core
 * Domain Path:       /languages
 *
 * @package qbatura-core
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'QBATURA_CORE_VERSION', '0.1.0' );
define( 'QBATURA_CORE_DIR', plugin_dir_path( __FILE__ ) );
define( 'QBATURA_CORE_FILE', __FILE__ );

require_once QBATURA_CORE_DIR . 'inc/post-types.php';
require_once QBATURA_CORE_DIR . 'inc/taxonomies.php';
require_once QBATURA_CORE_DIR . 'inc/project-fields.php';
require_once QBATURA_CORE_DIR . 'inc/blocks.php';
require_once QBATURA_CORE_DIR . 'inc/settings.php';
require_once QBATURA_CORE_DIR . 'inc/contact-form.php';
require_once QBATURA_CORE_DIR . 'inc/polylang.php';

/**
 * Tłumaczenia wtyczki.
 */
function qbatura_core_load_textdomain() {
	load_plugin_textdomain( 'qbatura-core', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
}
add_action( 'init', 'qbatura_core_load_textdomain', 0 );

/**
 * Aktywacja: rejestracja typów treści, terminy startowe i odświeżenie reguł adresów.
 */
function qbatura_core_activate() {
	qbatura_core_register_post_types();
	qbatura_core_register_taxonomies();
	qbatura_core_insert_default_terms();
	flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'qbatura_core_activate' );

/**
 * Dezaktywacja: usunięcie reguł adresów CPT.
 */
function qbatura_core_deactivate() {
	flush_rewrite_rules();
}
register_deactivation_hook( __FILE__, 'qbatura_core_deactivate' );
