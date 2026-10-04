<?php
/**
 * Drobne korekty HTML bloków core przy renderowaniu (atrybuty dostępności, podział treści realizacji).
 *
 * @package qbatura
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Czy blok ma daną klasę w atrybucie className.
 *
 * @param array  $block Blok (sparsowany).
 * @param string $class Klasa.
 * @return bool
 */
function qbatura_block_has_class( $block, $class ) {
	$classes = isset( $block['attrs']['className'] ) ? explode( ' ', $block['attrs']['className'] ) : array();
	return in_array( $class, $classes, true );
}

/**
 * Nakładka menu (grupa .qbatura-menu) jako okno dialogowe: role, aria-modal, etykieta.
 * Grupa core nie pozwala ustawić tych atrybutów w edytorze.
 *
 * Sekcje splasha (section) dostają etykiety „Powitanie” / „Menu”.
 *
 * Wordmark w stopce (.qbatura-wordmark) i logo na ekranie menu (.qbatura-aria-hidden) są dekoracyjne —
 * ukryte przed czytnikami ekranu.
 *
 * @param string $content HTML bloku.
 * @param array  $block   Blok.
 * @return string
 */
function qbatura_block_a11y_attributes( $content, $block ) {
	if ( qbatura_block_has_class( $block, 'qbatura-menu' ) ) {
		$tags = new WP_HTML_Tag_Processor( $content );
		if ( $tags->next_tag() ) {
			$tags->set_attribute( 'role', 'dialog' );
			$tags->set_attribute( 'aria-modal', 'true' );
			$tags->set_attribute( 'aria-label', __( 'Menu', 'qbatura' ) );
			$content = $tags->get_updated_html();
		}
	}

	$section_labels = array(
		'qbatura-splash--intro' => __( 'Powitanie', 'qbatura' ),
		'qbatura-splash--menu'  => __( 'Menu', 'qbatura' ),
	);
	foreach ( $section_labels as $class => $label ) {
		if ( qbatura_block_has_class( $block, $class ) ) {
			$tags = new WP_HTML_Tag_Processor( $content );
			if ( $tags->next_tag() ) {
				$tags->set_attribute( 'aria-label', $label );
				$content = $tags->get_updated_html();
			}
		}
	}

	if ( qbatura_block_has_class( $block, 'qbatura-wordmark' ) || qbatura_block_has_class( $block, 'qbatura-aria-hidden' ) ) {
		$tags = new WP_HTML_Tag_Processor( $content );
		if ( $tags->next_tag() ) {
			$tags->set_attribute( 'aria-hidden', 'true' );
			$content = $tags->get_updated_html();
		}
	}

	return $content;
}
add_filter( 'render_block_core/group', 'qbatura_block_a11y_attributes', 10, 2 );
add_filter( 'render_block_core/paragraph', 'qbatura_block_a11y_attributes', 10, 2 );

/**
 * Etykiety bloków Nawigacja w nagłówku i stopce (tłumaczone).
 *
 * Atrybut ariaLabel bloku w WP 6.9 dubluje tekst („Menu główne Menu główne”) i kopiuje etykietę
 * na <ul>, dlatego ustawiamy ją tutaj: tylko na <nav>, z listy usuwamy.
 *
 * @param string $content HTML bloku.
 * @param array  $block   Blok.
 * @return string
 */
function qbatura_navigation_labels( $content, $block ) {
	$labels = array(
		'qbatura-giant-nav'  => __( 'Menu główne', 'qbatura' ),
		'qbatura-footer-nav' => __( 'Menu w stopce', 'qbatura' ),
	);

	foreach ( $labels as $class => $label ) {
		if ( ! qbatura_block_has_class( $block, $class ) ) {
			continue;
		}

		$tags = new WP_HTML_Tag_Processor( $content );
		if ( $tags->next_tag( 'nav' ) ) {
			$tags->set_attribute( 'aria-label', $label );
		}
		while ( $tags->next_tag( 'ul' ) ) {
			$tags->remove_attribute( 'aria-label' );
		}
		return $tags->get_updated_html();
	}

	return $content;
}
add_filter( 'render_block_core/navigation', 'qbatura_navigation_labels', 10, 2 );

/*
 * Strona realizacji: opis stoi w kolumnie obok parametrów, a galeria pod hero na pełną szerokość
 * (jak w makiecie). Klientka edytuje jedną treść wpisu (akapity + blok Galeria), a szablon renderuje
 * ją dwa razy: core/post-content z klasą .qbatura-content-text pomija galerie,
 * z klasą .qbatura-content-gallery pokazuje tylko galerie.
 */

/**
 * Bieżący tryb renderowania treści: '', 'text' albo 'gallery'.
 *
 * @param string|null $mode Nowy tryb (null — tylko odczyt).
 * @return string
 */
function qbatura_content_mode( $mode = null ) {
	static $current = '';
	if ( null !== $mode ) {
		$current = $mode;
	}
	return $current;
}

/**
 * Ustawienie trybu przed renderem core/post-content.
 *
 * @param array $parsed_block Blok.
 * @return array
 */
function qbatura_set_content_mode( $parsed_block ) {
	if ( 'core/post-content' === $parsed_block['blockName'] ) {
		if ( qbatura_block_has_class( $parsed_block, 'qbatura-content-text' ) ) {
			qbatura_content_mode( 'text' );
		} elseif ( qbatura_block_has_class( $parsed_block, 'qbatura-content-gallery' ) ) {
			qbatura_content_mode( 'gallery' );
		}
	}
	return $parsed_block;
}
add_filter( 'render_block_data', 'qbatura_set_content_mode' );

/**
 * Filtrowanie bloków treści wg trybu (przed do_blocks, które działa na priorytecie 9).
 *
 * @param string $content Treść wpisu (markup bloków).
 * @return string
 */
function qbatura_filter_content_blocks( $content ) {
	$mode = qbatura_content_mode();
	if ( '' === $mode || ! has_blocks( $content ) ) {
		return $content;
	}

	$blocks = array_filter(
		parse_blocks( $content ),
		static function ( $block ) use ( $mode ) {
			$is_gallery = 'core/gallery' === $block['blockName'];
			return 'gallery' === $mode ? $is_gallery : ! $is_gallery;
		}
	);

	return serialize_blocks( $blocks );
}
add_filter( 'the_content', 'qbatura_filter_content_blocks', 1 );

/**
 * Reset trybu po renderze; pusty kontener galerii nie jest wyświetlany.
 *
 * @param string $content HTML bloku.
 * @return string
 */
function qbatura_reset_content_mode( $content ) {
	$mode = qbatura_content_mode();
	qbatura_content_mode( '' );

	if ( 'gallery' === $mode && false === strpos( $content, 'wp-block-gallery' ) ) {
		return '';
	}
	return $content;
}
add_filter( 'render_block_core/post-content', 'qbatura_reset_content_mode' );
