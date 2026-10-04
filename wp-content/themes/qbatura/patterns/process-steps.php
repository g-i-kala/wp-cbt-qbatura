<?php
/**
 * Title: Jak pracujemy (kroki)
 * Slug: qbatura/process-steps
 * Categories: qbatura
 * Post Types: page
 * Keywords: proces, etapy, kroki, oferta
 * Description: Sekcja z etykietą [ ] i krokami współpracy: numer, nazwa, opis. Układ 4 → 2 → 1 kolumna. Kolor numeru: Styl → Kolor → Tekst.
 *
 * @package qbatura
 */

// Nazwy z makiety (do potwierdzenia), opisy — placeholdery do uzupełnienia przez klientkę.
$qbatura_steps = array(
	array( '01', __( 'Spotkanie', 'qbatura' ), 'green-main' ),
	array( '02', __( 'Koncepcja', 'qbatura' ), 'terracotta' ),
	array( '03', __( 'Projekt', 'qbatura' ), 'earth' ),
	array( '04', __( 'Realizacja', 'qbatura' ), 'olive-dark' ),
);
?>
<!-- wp:group {"tagName":"section","align":"full","className":"is-style-qbatura-section qbatura-reveal","backgroundColor":"white","layout":{"type":"default"}} -->
<section class="wp-block-group alignfull is-style-qbatura-section qbatura-reveal has-white-background-color has-background">
<!-- wp:heading {"className":"is-style-qbatura-eyebrow"} -->
<h2 class="wp-block-heading is-style-qbatura-eyebrow"><?php esc_html_e( 'Jak pracujemy', 'qbatura' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:group {"className":"qbatura-steps","layout":{"type":"default"}} -->
<div class="wp-block-group qbatura-steps">
<?php
foreach ( $qbatura_steps as $qbatura_step ) :
	list( $qbatura_num, $qbatura_title, $qbatura_color ) = $qbatura_step;
	?>
<!-- wp:group {"layout":{"type":"default"}} -->
<div class="wp-block-group">
<!-- wp:paragraph {"textColor":"<?php echo esc_attr( $qbatura_color ); ?>"} -->
<p class="has-<?php echo esc_attr( $qbatura_color ); ?>-color has-text-color"><?php echo esc_html( $qbatura_num ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading"><?php echo esc_html( $qbatura_title ); ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p><?php esc_html_e( 'Opis etapu — tekst zostanie dostarczony przez klientkę.', 'qbatura' ); ?></p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->
<?php endforeach; ?>
</div>
<!-- /wp:group -->
</section>
<!-- /wp:group -->
