<?php
/**
 * Title: Pasy oferty
 * Slug: qbatura/service-bands
 * Categories: qbatura
 * Post Types: page
 * Keywords: oferta, usługi, pasy
 * Description: Kolorowe pasy usług (numer, nazwa, opis). Cały pas prowadzi pod link ustawiony na nazwie usługi — domyślnie do kategorii realizacji (O1/E10, robocze). Kolor pasa: Styl → Kolor → Tło.
 *
 * @package qbatura
 */

// Nazwy z makiety (do potwierdzenia), opisy — placeholdery do uzupełnienia przez klientkę.
$qbatura_bands = array(
	array( '01', __( 'Domy', 'qbatura' ), 'jednorodzinne', 'green-main' ),
	array( '02', __( 'Przemysłowe', 'qbatura' ), 'przemyslowe', 'terracotta' ),
	array( '03', __( 'Użyteczność publiczna', 'qbatura' ), 'uzytecznosc-publiczna', 'earth' ),
	array( '04', __( 'Wnętrza', 'qbatura' ), 'wnetrza', 'green-soft' ),
);
?>
<!-- wp:group {"align":"full","className":"qbatura-bands qbatura-reveal","layout":{"type":"default"}} -->
<div class="wp-block-group alignfull qbatura-bands qbatura-reveal">
<?php
foreach ( $qbatura_bands as $qbatura_band ) :
	list( $qbatura_num, $qbatura_title, $qbatura_term_slug, $qbatura_color ) = $qbatura_band;

	$qbatura_link = get_term_link( $qbatura_term_slug, 'qbatura_project_type' );
	if ( is_wp_error( $qbatura_link ) ) {
		$qbatura_link = qbatura_projects_page_url();
	}
	?>
<!-- wp:group {"className":"is-style-qbatura-band","backgroundColor":"<?php echo esc_attr( $qbatura_color ); ?>","layout":{"type":"default"}} -->
<div class="wp-block-group is-style-qbatura-band has-<?php echo esc_attr( $qbatura_color ); ?>-background-color has-background">
<!-- wp:paragraph -->
<p><?php echo esc_html( $qbatura_num ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2 class="wp-block-heading"><a href="<?php echo esc_url( $qbatura_link ); ?>"><?php echo esc_html( $qbatura_title ); ?></a></h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p><?php esc_html_e( 'Opis usługi — tekst zostanie dostarczony przez klientkę.', 'qbatura' ); ?></p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->
<?php endforeach; ?>
</div>
<!-- /wp:group -->
