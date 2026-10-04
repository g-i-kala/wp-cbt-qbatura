<?php
/**
 * Style bloków (warianty wybierane w panelu „Style” bloku).
 *
 * CSS stylów jest w assets/css/blocks/{blok}.css, ładowanym tylko z danym blokiem.
 * Kolejne style (pasy oferty, statystyki, drzewo) dochodzą razem z wzorcami sekcji.
 *
 * @package qbatura
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Rejestracja stylów bloków.
 */
function qbatura_register_block_styles() {
	$styles = array(
		'core/separator' => array(
			'qbatura-thick' => __( 'Gruba linia', 'qbatura' ),
		),
		'core/paragraph' => array(
			'qbatura-eyebrow' => __( 'Etykieta [ ]', 'qbatura' ),
		),
		'core/heading'   => array(
			'qbatura-eyebrow' => __( 'Etykieta [ ]', 'qbatura' ),
		),
		'core/gallery'   => array(
			'qbatura-grid' => __( 'Siatka Qbatura', 'qbatura' ),
		),
	);

	foreach ( $styles as $block => $block_styles ) {
		foreach ( $block_styles as $name => $label ) {
			register_block_style(
				$block,
				array(
					'name'  => $name,
					'label' => $label,
				)
			);
		}
	}
}
add_action( 'init', 'qbatura_register_block_styles' );
