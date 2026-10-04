<?php
/**
 * Title: Filtry kategorii realizacji
 * Slug: qbatura/project-filters
 * Categories: qbatura
 * Inserter: no
 * Description: „Wszystkie” + kategorie realizacji jako linki do archiwów (P2). Używany w szablonach.
 *
 * @package qbatura
 */

$qbatura_terms = get_terms(
	array(
		'taxonomy'   => 'qbatura_project_type',
		'hide_empty' => false,
		// Kolejność dodania — terminy startowe w kolejności z makiety (P1).
		'orderby'    => 'term_id',
	)
);

if ( is_wp_error( $qbatura_terms ) ) {
	$qbatura_terms = array();
}

$qbatura_current = is_tax( 'qbatura_project_type' ) ? get_queried_object_id() : 0;
?>
<!-- wp:html -->
<nav class="qbatura-filters" aria-label="<?php esc_attr_e( 'Kategorie realizacji', 'qbatura' ); ?>">
	<a href="<?php echo esc_url( qbatura_projects_page_url() ); ?>"<?php echo $qbatura_current ? '' : ' aria-current="page"'; ?>><?php esc_html_e( 'Wszystkie', 'qbatura' ); ?></a>
	<?php foreach ( $qbatura_terms as $qbatura_term ) : ?>
		<?php $qbatura_is_current = ( $qbatura_term->term_id === $qbatura_current ); ?>
		<a href="<?php echo esc_url( $qbatura_is_current ? qbatura_projects_page_url() : get_term_link( $qbatura_term ) ); ?>"<?php echo $qbatura_is_current ? ' aria-current="page"' : ''; ?>><?php echo esc_html( $qbatura_term->name ); ?></a>
	<?php endforeach; ?>
</nav>
<!-- /wp:html -->
