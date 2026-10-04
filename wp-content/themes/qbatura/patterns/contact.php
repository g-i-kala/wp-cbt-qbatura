<?php
/**
 * Title: Kontakt (dane i formularz)
 * Slug: qbatura/contact
 * Categories: qbatura
 * Post Types: page
 * Keywords: kontakt, adres, telefon, e-mail, formularz
 * Description: Dwie kolumny: dane kontaktowe (etykieta + wartość; telefon i e-mail jako linki) i formularz WS Form z klasą „qbatura-contact-form” (shortcode z wtyczki Qbatura Core). Pozycję danych można zduplikować albo usunąć.
 *
 * @package qbatura
 */

// Dane kontaktowe dostarczy klientka (K1) — we wzorcu neutralne placeholdery.
?>
<!-- wp:group {"tagName":"section","align":"full","className":"qbatura-contact qbatura-reveal","layout":{"type":"default"}} -->
<section class="wp-block-group alignfull qbatura-contact qbatura-reveal">
<!-- wp:group {"className":"qbatura-contact__col","layout":{"type":"default"}} -->
<div class="wp-block-group qbatura-contact__col">
<!-- wp:heading {"className":"is-style-qbatura-eyebrow"} -->
<h2 class="wp-block-heading is-style-qbatura-eyebrow"><?php esc_html_e( 'Dane kontaktowe', 'qbatura' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:group {"className":"qbatura-contact-list","layout":{"type":"default"}} -->
<div class="wp-block-group qbatura-contact-list">
<!-- wp:group {"layout":{"type":"default"}} -->
<div class="wp-block-group">
<!-- wp:paragraph -->
<p><?php esc_html_e( 'Adres', 'qbatura' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p><?php esc_html_e( 'Ulica i numer', 'qbatura' ); ?><br><?php esc_html_e( 'Kod pocztowy i miasto', 'qbatura' ); ?></p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->

<!-- wp:group {"layout":{"type":"default"}} -->
<div class="wp-block-group">
<!-- wp:paragraph -->
<p><?php esc_html_e( 'Telefon', 'qbatura' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p><a href="tel:+48000000000">+48 000 000 000</a></p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->

<!-- wp:group {"layout":{"type":"default"}} -->
<div class="wp-block-group">
<!-- wp:paragraph -->
<p><?php esc_html_e( 'E-mail', 'qbatura' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p><a href="mailto:adres@example.com">adres@example.com</a></p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->
</div>
<!-- /wp:group -->
</div>
<!-- /wp:group -->

<!-- wp:group {"className":"qbatura-contact__col","backgroundColor":"green-soft","layout":{"type":"default"}} -->
<div class="wp-block-group qbatura-contact__col has-green-soft-background-color has-background">
<!-- wp:heading {"className":"is-style-qbatura-eyebrow"} -->
<h2 class="wp-block-heading is-style-qbatura-eyebrow"><?php esc_html_e( 'Formularz kontaktowy', 'qbatura' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:shortcode -->
[qbatura_contact_form]
<!-- /wp:shortcode -->
</div>
<!-- /wp:group -->
</section>
<!-- /wp:group -->
