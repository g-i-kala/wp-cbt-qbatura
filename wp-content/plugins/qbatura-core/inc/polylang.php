<?php
/**
 * Integracja z Polylang (PL/EN).
 *
 * Na razie: realizacje i ich kategorie są tłumaczalne, a pola liczbowe kopiowane
 * do nowego tłumaczenia. Podmiana menu i template parts per język — po aktywacji
 * Polylang i weryfikacji na wersji 3.8.x (decyzja 2026-10-04).
 *
 * @package qbatura-core
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * CPT realizacji jako tłumaczalny.
 *
 * @param array $post_types Typy treści.
 * @param bool  $is_settings Czy wywołane na ekranie ustawień.
 * @return array
 */
function qbatura_core_pll_post_types( $post_types, $is_settings ) {
	if ( ! $is_settings ) {
		$post_types['qbatura_project'] = 'qbatura_project';
	}
	return $post_types;
}
add_filter( 'pll_get_post_types', 'qbatura_core_pll_post_types', 10, 2 );

/**
 * Taksonomia kategorii realizacji jako tłumaczalna.
 *
 * @param array $taxonomies Taksonomie.
 * @param bool  $is_settings Czy wywołane na ekranie ustawień.
 * @return array
 */
function qbatura_core_pll_taxonomies( $taxonomies, $is_settings ) {
	if ( ! $is_settings ) {
		$taxonomies['qbatura_project_type'] = 'qbatura_project_type';
	}
	return $taxonomies;
}
add_filter( 'pll_get_taxonomies', 'qbatura_core_pll_taxonomies', 10, 2 );

/**
 * Przy tworzeniu tłumaczenia kopiujemy pola niezależne od języka (liczby, status).
 * Teksty (miasto, typ, zakres…) tłumaczy się osobno.
 *
 * @param array $metas Klucze meta kopiowane / synchronizowane.
 * @return array
 */
function qbatura_core_pll_copy_metas( $metas ) {
	return array_merge(
		$metas,
		array( 'qbatura_year', 'qbatura_usable_area', 'qbatura_plot_area', 'qbatura_status' )
	);
}
add_filter( 'pll_copy_post_metas', 'qbatura_core_pll_copy_metas' );
