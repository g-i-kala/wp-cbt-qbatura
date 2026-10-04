<?php
/**
 * Typ treści „Realizacje” (qbatura_project).
 *
 * @package qbatura-core
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Rejestracja CPT qbatura_project.
 *
 * Lista realizacji jest na stronie „Realizacje” (Query Loop), dlatego bez archiwum CPT.
 */
function qbatura_core_register_post_types() {
	$labels = array(
		'name'                  => _x( 'Realizacje', 'post type general name', 'qbatura-core' ),
		'singular_name'         => _x( 'Realizacja', 'post type singular name', 'qbatura-core' ),
		'menu_name'             => _x( 'Realizacje', 'admin menu', 'qbatura-core' ),
		'add_new'               => __( 'Dodaj realizację', 'qbatura-core' ),
		'add_new_item'          => __( 'Dodaj realizację', 'qbatura-core' ),
		'edit_item'             => __( 'Edytuj realizację', 'qbatura-core' ),
		'new_item'              => __( 'Nowa realizacja', 'qbatura-core' ),
		'view_item'             => __( 'Zobacz realizację', 'qbatura-core' ),
		'view_items'            => __( 'Zobacz realizacje', 'qbatura-core' ),
		'search_items'          => __( 'Szukaj realizacji', 'qbatura-core' ),
		'not_found'             => __( 'Nie znaleziono realizacji.', 'qbatura-core' ),
		'not_found_in_trash'    => __( 'Brak realizacji w koszu.', 'qbatura-core' ),
		'all_items'             => __( 'Wszystkie realizacje', 'qbatura-core' ),
		'featured_image'        => __( 'Zdjęcie główne', 'qbatura-core' ),
		'set_featured_image'    => __( 'Ustaw zdjęcie główne', 'qbatura-core' ),
		'remove_featured_image' => __( 'Usuń zdjęcie główne', 'qbatura-core' ),
		'use_featured_image'    => __( 'Użyj jako zdjęcia głównego', 'qbatura-core' ),
		'item_published'        => __( 'Realizacja opublikowana.', 'qbatura-core' ),
		'item_updated'          => __( 'Realizacja zaktualizowana.', 'qbatura-core' ),
	);

	register_post_type(
		'qbatura_project',
		array(
			'labels'        => $labels,
			'public'        => true,
			'has_archive'   => false,
			'show_in_rest'  => true,
			'menu_position' => 21,
			'menu_icon'     => 'dashicons-building',
			'supports'      => array( 'title', 'editor', 'thumbnail', 'page-attributes', 'revisions', 'custom-fields' ),
			'rewrite'       => array(
				'slug'       => 'realizacje',
				'with_front' => false,
			),
			// Nowa realizacja otwiera się z gotowym układem: opis + galeria (bez nagłówka „Szczegóły projektu”, P8).
			'template'      => array(
				array(
					'core/paragraph',
					array( 'placeholder' => __( 'Opis realizacji — pierwszy akapit…', 'qbatura-core' ) ),
				),
				array(
					'core/paragraph',
					array( 'placeholder' => __( 'Kolejny akapit opisu…', 'qbatura-core' ) ),
				),
				array(
					'core/gallery',
					array(
						'className' => 'is-style-qbatura-grid',
						'linkTo'    => 'media',
						'sizeSlug'  => 'large',
					),
				),
			),
		)
	);
}
add_action( 'init', 'qbatura_core_register_post_types' );

/**
 * Kolumny listy realizacji w panelu: miniatura i rok.
 *
 * @param array $columns Kolumny.
 * @return array
 */
function qbatura_core_project_columns( $columns ) {
	$new = array();
	foreach ( $columns as $key => $label ) {
		if ( 'title' === $key ) {
			$new['qbatura_thumb'] = __( 'Zdjęcie', 'qbatura-core' );
		}
		$new[ $key ] = $label;
		if ( 'title' === $key ) {
			$new['qbatura_year'] = __( 'Rok', 'qbatura-core' );
		}
	}
	return $new;
}
add_filter( 'manage_qbatura_project_posts_columns', 'qbatura_core_project_columns' );

/**
 * Zawartość kolumn listy realizacji.
 *
 * @param string $column  Nazwa kolumny.
 * @param int    $post_id ID realizacji.
 */
function qbatura_core_project_column_content( $column, $post_id ) {
	if ( 'qbatura_thumb' === $column ) {
		echo get_the_post_thumbnail( $post_id, array( 60, 45 ) );
	}
	if ( 'qbatura_year' === $column ) {
		echo esc_html( (string) get_post_meta( $post_id, 'qbatura_year', true ) );
	}
}
add_action( 'manage_qbatura_project_posts_custom_column', 'qbatura_core_project_column_content', 10, 2 );
