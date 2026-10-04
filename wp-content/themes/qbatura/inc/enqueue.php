<?php
/**
 * Style i skrypty frontu.
 *
 * @package qbatura
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Wersja assetu z daty modyfikacji pliku (cache busting bez ręcznego podbijania wersji).
 *
 * @param string $path Ścieżka względem katalogu motywu.
 * @return string
 */
function qbatura_asset_version( $path ) {
	$file = QBATURA_DIR . '/' . ltrim( $path, '/' );
	return file_exists( $file ) ? (string) filemtime( $file ) : QBATURA_VERSION;
}

/**
 * Style globalne i skrypty.
 */
function qbatura_enqueue_assets() {
	wp_enqueue_style( 'qbatura-base', QBATURA_URI . '/assets/css/base.css', array(), qbatura_asset_version( 'assets/css/base.css' ) );
	wp_enqueue_style( 'qbatura-layout', QBATURA_URI . '/assets/css/layout.css', array( 'qbatura-base' ), qbatura_asset_version( 'assets/css/layout.css' ) );

	// Nakładka menu w nagłówku (Esc, focus trap, powrót fokusu).
	wp_enqueue_script(
		'qbatura-navigation',
		QBATURA_URI . '/assets/js/navigation.js',
		array(),
		qbatura_asset_version( 'assets/js/navigation.js' ),
		array(
			'in_footer' => true,
			'strategy'  => 'defer',
		)
	);

	// Animacja wejścia sekcji .qbatura-reveal (z poszanowaniem prefers-reduced-motion).
	wp_enqueue_script(
		'qbatura-reveal',
		QBATURA_URI . '/assets/js/reveal.js',
		array(),
		qbatura_asset_version( 'assets/js/reveal.js' ),
		array(
			'in_footer' => true,
			'strategy'  => 'defer',
		)
	);

	// Splash — tylko strona główna.
	if ( is_front_page() ) {
		wp_enqueue_style( 'qbatura-splash', QBATURA_URI . '/assets/css/splash.css', array( 'qbatura-layout' ), qbatura_asset_version( 'assets/css/splash.css' ) );
		wp_enqueue_script(
			'qbatura-splash',
			QBATURA_URI . '/assets/js/splash.js',
			array(),
			qbatura_asset_version( 'assets/js/splash.js' ),
			array(
				'in_footer' => true,
				'strategy'  => 'defer',
			)
		);
	}
}
add_action( 'wp_enqueue_scripts', 'qbatura_enqueue_assets' );

/**
 * Style per blok — ładowane tylko, gdy blok jest na stronie.
 * Plik assets/css/blocks/{namespace}-{blok}.css, np. core-separator.css → core/separator.
 */
function qbatura_enqueue_block_styles() {
	$files = glob( QBATURA_DIR . '/assets/css/blocks/*.css' );

	foreach ( (array) $files as $file ) {
		$name       = basename( $file, '.css' );
		$parts      = explode( '-', $name, 2 );
		$block_name = $parts[0] . '/' . $parts[1];

		wp_enqueue_block_style(
			$block_name,
			array(
				'handle' => 'qbatura-block-' . $name,
				'src'    => QBATURA_URI . '/assets/css/blocks/' . $name . '.css',
				'path'   => $file,
				'ver'    => (string) filemtime( $file ),
			)
		);
	}
}
add_action( 'init', 'qbatura_enqueue_block_styles' );

/**
 * Klasa .js na <html> przed pierwszym renderem — style ukrywające sekcje do animacji
 * działają tylko z JS, więc bez JS treść jest widoczna. Skrypt musi być inline w <head>,
 * inaczej sekcje mignęłyby przed ukryciem.
 */
function qbatura_js_class() {
	wp_print_inline_script_tag( "document.documentElement.classList.add('js');" );

	// Splash tylko przy pierwszej wizycie (S1): przy kolejnej od razu ekran menu, bez mignięcia ekranu 1.
	// Podgląd splasha ponownie: ?splash w adresie.
	if ( is_front_page() ) {
		wp_print_inline_script_tag(
			"try{if(localStorage.getItem('qbatura-entered')&&!/[?&]splash\\b/.test(location.search)){document.documentElement.classList.add('is-entered');}}catch(e){}"
		);
	}
}
add_action( 'wp_head', 'qbatura_js_class', 1 );
