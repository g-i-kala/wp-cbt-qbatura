<?php
/**
 * Title: Historia (tekst, zdjęcie, liczby)
 * Slug: qbatura/about-history
 * Categories: qbatura
 * Post Types: page
 * Keywords: o mnie, historia, liczby, zdjęcie
 * Description: Sekcja z etykietą [ ], tekstem po lewej i zdjęciem z liczbami po prawej. Zdjęcie jest opcjonalne (E9) — podmień przez „Zamień” albo usuń blok. Kolor kreski przy liczbie: Styl → Obramowanie.
 *
 * @package qbatura
 */

// Liczby do zredagowania przez klientkę (D3) — we wzorcu neutralne placeholdery.
$qbatura_stats = array( 'green-main', 'terracotta', 'earth' );
?>
<!-- wp:group {"tagName":"section","align":"full","className":"is-style-qbatura-section qbatura-reveal","backgroundColor":"green-light","layout":{"type":"default"}} -->
<section class="wp-block-group alignfull is-style-qbatura-section qbatura-reveal has-green-light-background-color has-background">
<!-- wp:heading {"className":"is-style-qbatura-eyebrow"} -->
<h2 class="wp-block-heading is-style-qbatura-eyebrow"><?php esc_html_e( 'Historia pracowni', 'qbatura' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:group {"className":"qbatura-about","layout":{"type":"default"}} -->
<div class="wp-block-group qbatura-about">
<!-- wp:group {"className":"qbatura-about__text","layout":{"type":"default"}} -->
<div class="wp-block-group qbatura-about__text">
<!-- wp:paragraph -->
<p><?php esc_html_e( 'Historia pracowni — tekst zostanie dostarczony przez klientkę.', 'qbatura' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p><?php esc_html_e( 'Drugi akapit — do uzupełnienia.', 'qbatura' ); ?></p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->

<!-- wp:group {"className":"qbatura-about__aside","layout":{"type":"default"}} -->
<div class="wp-block-group qbatura-about__aside">
<!-- wp:image {"aspectRatio":"4/5","scale":"cover","sizeSlug":"full","linkDestination":"none","className":"qbatura-about__photo"} -->
<figure class="wp-block-image size-full qbatura-about__photo"><img src="<?php echo esc_url( QBATURA_URI . '/assets/images/photo-placeholder.svg' ); ?>" alt="" style="aspect-ratio:4/5;object-fit:cover"/></figure>
<!-- /wp:image -->

<!-- wp:group {"className":"qbatura-stats","layout":{"type":"default"}} -->
<div class="wp-block-group qbatura-stats">
<?php foreach ( $qbatura_stats as $qbatura_color ) : ?>
<!-- wp:group {"style":{"border":{"left":{"color":"var:preset|color|<?php echo esc_attr( $qbatura_color ); ?>"}}},"layout":{"type":"default"}} -->
<div class="wp-block-group" style="border-left-color:var(--wp--preset--color--<?php echo esc_attr( $qbatura_color ); ?>)">
<!-- wp:paragraph -->
<p>00</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p><?php esc_html_e( 'Opis liczby', 'qbatura' ); ?></p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->
<?php endforeach; ?>
</div>
<!-- /wp:group -->
</div>
<!-- /wp:group -->
</div>
<!-- /wp:group -->
</section>
<!-- /wp:group -->
