<?php
/**
 * Title: Obszary działalności (drzewo)
 * Slug: qbatura/specializations-tree
 * Categories: qbatura
 * Post Types: page
 * Keywords: o mnie, specjalizacje, obszary, drzewo
 * Description: Sekcja z etykietą [ ] i drzewem specjalizacji: podpis nad drzewem i węzły (nazwa + krótki opis), po dwa w rzędzie.
 *
 * @package qbatura
 */

// Nazwy z makiety (do potwierdzenia), opisy — placeholdery do uzupełnienia przez klientkę.
$qbatura_nodes = array(
	__( 'Domy jednorodzinne', 'qbatura' ),
	__( 'Obiekty przemysłowe', 'qbatura' ),
	__( 'Użyteczność publiczna', 'qbatura' ),
	__( 'Wnętrza', 'qbatura' ),
);
?>
<!-- wp:group {"tagName":"section","align":"full","className":"is-style-qbatura-section qbatura-reveal","backgroundColor":"green-soft","layout":{"type":"default"}} -->
<section class="wp-block-group alignfull is-style-qbatura-section qbatura-reveal has-green-soft-background-color has-background">
<!-- wp:heading {"className":"is-style-qbatura-eyebrow"} -->
<h2 class="wp-block-heading is-style-qbatura-eyebrow"><?php esc_html_e( 'Obszary działalności', 'qbatura' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"qbatura-tree__root"} -->
<p class="qbatura-tree__root"><?php esc_html_e( 'Qbatura / Specjalizacje', 'qbatura' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:group {"className":"qbatura-tree","layout":{"type":"default"}} -->
<div class="wp-block-group qbatura-tree">
<?php foreach ( $qbatura_nodes as $qbatura_node ) : ?>
<!-- wp:group {"layout":{"type":"default"}} -->
<div class="wp-block-group">
<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading"><?php echo esc_html( $qbatura_node ); ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p><?php esc_html_e( 'Krótki opis — do uzupełnienia.', 'qbatura' ); ?></p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->
<?php endforeach; ?>
</div>
<!-- /wp:group -->
</section>
<!-- /wp:group -->
