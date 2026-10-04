<?php
/**
 * Taksonomia „Kategorie realizacji” (qbatura_project_type).
 *
 * @package qbatura-core
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Rejestracja taksonomii. Hierarchiczna — w edytorze checkboxy zamiast pola tagów.
 */
function qbatura_core_register_taxonomies() {
	$labels = array(
		'name'          => _x( 'Kategorie realizacji', 'taxonomy general name', 'qbatura-core' ),
		'singular_name' => _x( 'Kategoria realizacji', 'taxonomy singular name', 'qbatura-core' ),
		'menu_name'     => __( 'Kategorie', 'qbatura-core' ),
		'all_items'     => __( 'Wszystkie kategorie', 'qbatura-core' ),
		'edit_item'     => __( 'Edytuj kategorię', 'qbatura-core' ),
		'view_item'     => __( 'Zobacz kategorię', 'qbatura-core' ),
		'update_item'   => __( 'Zaktualizuj kategorię', 'qbatura-core' ),
		'add_new_item'  => __( 'Dodaj kategorię', 'qbatura-core' ),
		'new_item_name' => __( 'Nazwa nowej kategorii', 'qbatura-core' ),
		'search_items'  => __( 'Szukaj kategorii', 'qbatura-core' ),
		'not_found'     => __( 'Nie znaleziono kategorii.', 'qbatura-core' ),
		'back_to_items' => __( '← Wróć do kategorii', 'qbatura-core' ),
	);

	register_taxonomy(
		'qbatura_project_type',
		array( 'qbatura_project' ),
		array(
			'labels'            => $labels,
			'public'            => true,
			'hierarchical'      => true,
			'show_in_rest'      => true,
			'show_admin_column' => true,
			// Osobna baza adresu — „realizacje/kategoria/…” kolidowałoby z regułami pojedynczej realizacji.
			'rewrite'           => array(
				'slug'       => 'kategoria-realizacji',
				'with_front' => false,
			),
		)
	);
}
add_action( 'init', 'qbatura_core_register_taxonomies' );

/**
 * Terminy startowe z makiety (P1). Dodawane tylko, jeśli jeszcze nie istnieją.
 */
function qbatura_core_insert_default_terms() {
	$terms = array(
		'przemyslowe'           => __( 'Przemysłowe', 'qbatura-core' ),
		'uzytecznosc-publiczna' => __( 'Użyteczność publiczna', 'qbatura-core' ),
		'wielorodzinne'         => __( 'Wielorodzinne', 'qbatura-core' ),
		'jednorodzinne'         => __( 'Jednorodzinne', 'qbatura-core' ),
		'wnetrza'               => __( 'Wnętrza', 'qbatura-core' ),
	);

	foreach ( $terms as $slug => $name ) {
		if ( ! term_exists( $slug, 'qbatura_project_type' ) ) {
			wp_insert_term( $name, 'qbatura_project_type', array( 'slug' => $slug ) );
		}
	}
}
