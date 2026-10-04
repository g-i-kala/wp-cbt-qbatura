<?php
/**
 * Title: Nagłówek strony (hero)
 * Slug: qbatura/page-hero
 * Categories: qbatura
 * Post Types: page
 * Keywords: hero, nagłówek, tytuł
 * Description: Tytuł strony, gruba linia, etykieta [ ] i krótki opis. Kolor tła zmieniasz w ustawieniach grupy (Styl → Kolor → Tło). Etykietę można usunąć.
 *
 * @package qbatura
 */

?>
<!-- wp:group {"align":"full","className":"qbatura-hero","backgroundColor":"terracotta","layout":{"type":"default"}} -->
<div class="wp-block-group alignfull qbatura-hero has-terracotta-background-color has-background">
<!-- wp:post-title {"level":1,"className":"qbatura-hero__title"} /-->

<!-- wp:separator {"className":"is-style-qbatura-thick"} -->
<hr class="wp-block-separator has-alpha-channel-opacity is-style-qbatura-thick"/>
<!-- /wp:separator -->

<!-- wp:group {"className":"qbatura-hero__meta","layout":{"type":"default"}} -->
<div class="wp-block-group qbatura-hero__meta">
<!-- wp:paragraph {"className":"is-style-qbatura-eyebrow qbatura-hero__label"} -->
<p class="is-style-qbatura-eyebrow qbatura-hero__label"><?php esc_html_e( 'Etykieta do uzupełnienia', 'qbatura' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"qbatura-hero__text"} -->
<p class="qbatura-hero__text"><?php esc_html_e( 'Krótki opis strony — tekst zostanie dostarczony przez klientkę.', 'qbatura' ); ?></p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->
</div>
<!-- /wp:group -->
