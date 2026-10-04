<?php
/**
 * Render bloku qbatura/project-meta.
 *
 * Wariant „list” — pełna lista parametrów na stronie realizacji (makieta: .projekt-meta-list).
 * Wariant „card” — dwie linie na karcie: „Typ, metraż” / „Miasto, rok” (makieta: .project-card-info).
 *
 * @package qbatura-core
 *
 * @var array    $attributes Atrybuty bloku.
 * @var WP_Block $block      Instancja bloku (kontekst postId z Query Loop lub szablonu).
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$qbatura_post_id = isset( $block->context['postId'] ) ? (int) $block->context['postId'] : get_the_ID();

if ( ! $qbatura_post_id || 'qbatura_project' !== get_post_type( $qbatura_post_id ) ) {
	return;
}

$qbatura_variant = ( isset( $attributes['variant'] ) && 'card' === $attributes['variant'] ) ? 'card' : 'list';

if ( 'card' === $qbatura_variant ) {
	$qbatura_lines = array(
		array_filter(
			array(
				qbatura_core_project_value( $qbatura_post_id, 'qbatura_object_type' ),
				qbatura_core_project_value( $qbatura_post_id, 'qbatura_usable_area' ),
			)
		),
		array_filter(
			array(
				qbatura_core_project_value( $qbatura_post_id, 'qbatura_location' ),
				qbatura_core_project_value( $qbatura_post_id, 'qbatura_year' ),
			)
		),
	);

	$qbatura_lines = array_filter(
		array_map(
			static function ( $parts ) {
				return esc_html( implode( ', ', $parts ) );
			},
			$qbatura_lines
		)
	);

	if ( ! $qbatura_lines ) {
		return;
	}

	printf(
		'<p %1$s>%2$s</p>',
		get_block_wrapper_attributes( array( 'class' => 'is-variant-card' ) ), // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escapowane przez WP.
		implode( '<br>', $qbatura_lines ) // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escapowane wyżej.
	);
	return;
}

// Lokalizacja w liście łączy miasto i kraj („Szczecin, Polska”), tak jak w makiecie.
$qbatura_items = array();
foreach ( qbatura_core_project_fields() as $qbatura_key => $qbatura_field ) {
	if ( 'qbatura_country' === $qbatura_key ) {
		continue;
	}

	$qbatura_value = qbatura_core_project_value( $qbatura_post_id, $qbatura_key );

	if ( 'qbatura_location' === $qbatura_key ) {
		$qbatura_value = implode(
			', ',
			array_filter( array( $qbatura_value, qbatura_core_project_value( $qbatura_post_id, 'qbatura_country' ) ) )
		);
	}

	if ( '' === $qbatura_value ) {
		continue;
	}

	$qbatura_items[] = sprintf(
		'<div class="wp-block-qbatura-project-meta__item"><dt>%1$s</dt><dd>%2$s</dd></div>',
		esc_html( $qbatura_field['label'] ),
		esc_html( $qbatura_value )
	);
}

if ( ! $qbatura_items ) {
	return;
}

printf(
	'<dl %1$s>%2$s</dl>',
	get_block_wrapper_attributes( array( 'class' => 'is-variant-list' ) ), // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escapowane przez WP.
	implode( '', $qbatura_items ) // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escapowane wyżej.
);
