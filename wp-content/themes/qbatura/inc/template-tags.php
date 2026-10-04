<?php
/**
 * Funkcje pomocnicze dla wzorców renderowanych w szablonach.
 *
 * @package qbatura
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * ID strony „Realizacje” — pierwszej opublikowanej strony z szablonem „Realizacje — lista z filtrami”.
 * Z Polylang zapytanie zwraca stronę w bieżącym języku.
 *
 * @return int 0, gdy brak.
 */
function qbatura_projects_page_id() {
	static $id = null;

	if ( null !== $id ) {
		return $id;
	}

	$pages = get_posts(
		array(
			'post_type'      => 'page',
			'post_status'    => 'publish',
			'posts_per_page' => 1,
			'fields'         => 'ids',
			'meta_key'       => '_wp_page_template', // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_key -- jedno zapytanie na stronę.
			'meta_value'     => 'page-projects', // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_value
		)
	);

	$id = $pages ? (int) $pages[0] : 0;

	return $id;
}

/**
 * Adres strony „Realizacje”.
 *
 * @return string
 */
function qbatura_projects_page_url() {
	$id = qbatura_projects_page_id();

	return $id ? get_permalink( $id ) : home_url( '/realizacje/' );
}

/**
 * Tytuł strony „Realizacje” (nagłówek listy i archiwów kategorii).
 *
 * @return string
 */
function qbatura_projects_page_title() {
	$id = qbatura_projects_page_id();

	return $id ? get_the_title( $id ) : __( 'Realizacje', 'qbatura' );
}

/**
 * Markup Query Loop z kartami realizacji (wspólny dla strony „Realizacje” i archiwum kategorii).
 *
 * Kolejność: najnowsze pierwsze — do zmiany po decyzji klientki (P5).
 *
 * @param bool $inherit Czy dziedziczyć zapytanie z szablonu (archiwum kategorii).
 * @return string
 */
function qbatura_projects_query_markup( $inherit ) {
	$query = array(
		'queryId' => $inherit ? 2 : 1,
		'query'   => array(
			'perPage'  => 24,
			'pages'    => 0,
			'offset'   => 0,
			'postType' => 'qbatura_project',
			'order'    => 'desc',
			'orderBy'  => 'date',
			'inherit'  => $inherit,
		),
		'align'   => 'full',
		'layout'  => array( 'type' => 'default' ),
	);

	ob_start();
	?>
<!-- wp:query <?php echo wp_json_encode( $query ); ?> -->
<div class="wp-block-query alignfull">
	<!-- wp:post-template {"className":"qbatura-cards","layout":{"type":"default"}} -->
		<!-- wp:group {"className":"qbatura-card","layout":{"type":"default"}} -->
		<div class="wp-block-group qbatura-card">
			<!-- wp:post-featured-image {"aspectRatio":"4/3","sizeSlug":"medium_large","className":"qbatura-card__thumb"} /-->
			<!-- wp:post-title {"level":2,"isLink":true,"className":"qbatura-card__title"} /-->
			<!-- wp:qbatura/project-meta {"variant":"card"} /-->
			<!-- wp:post-terms {"term":"qbatura_project_type","className":"qbatura-card__tag"} /-->
		</div>
		<!-- /wp:group -->
	<!-- /wp:post-template -->

	<!-- wp:query-no-results -->
		<!-- wp:paragraph {"className":"qbatura-cards-empty"} -->
		<p class="qbatura-cards-empty"><?php esc_html_e( 'Brak realizacji w tej kategorii.', 'qbatura' ); ?></p>
		<!-- /wp:paragraph -->
	<!-- /wp:query-no-results -->
</div>
<!-- /wp:query -->
	<?php
	return (string) ob_get_clean();
}

/**
 * Przełącznik języka Polylang w formie „[PL] [EN]” (nawiasy przez CSS, W5).
 * Bez aktywnego Polylang nic nie wyświetla.
 *
 * @return string
 */
function qbatura_lang_switch_markup() {
	if ( ! function_exists( 'pll_the_languages' ) ) {
		return '';
	}

	$languages = pll_the_languages(
		array(
			'raw'           => 1,
			'hide_if_empty' => 0,
		)
	);

	if ( empty( $languages ) || ! is_array( $languages ) ) {
		return '';
	}

	$links = '';
	foreach ( $languages as $language ) {
		$links .= sprintf(
			'<a href="%1$s" hreflang="%2$s" lang="%2$s" aria-label="%3$s"%4$s>%5$s</a>',
			esc_url( $language['url'] ),
			esc_attr( $language['slug'] ),
			esc_attr( $language['name'] ),
			$language['current_lang'] ? ' aria-current="true"' : '',
			esc_html( strtoupper( $language['slug'] ) )
		);
	}

	return sprintf(
		'<nav class="qbatura-lang" aria-label="%1$s">%2$s</nav>',
		esc_attr__( 'Wybór języka', 'qbatura' ),
		$links
	);
}
