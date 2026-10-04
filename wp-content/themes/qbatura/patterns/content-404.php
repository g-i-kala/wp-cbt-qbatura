<?php
/**
 * Title: Treść strony 404
 * Slug: qbatura/content-404
 * Categories: qbatura
 * Inserter: no
 * Description: Hero „404” i link do strony głównej. Tekst do potwierdzenia.
 *
 * @package qbatura
 */

?>
<!-- wp:group {"align":"full","className":"qbatura-hero","backgroundColor":"green-soft","layout":{"type":"default"}} -->
<div class="wp-block-group alignfull qbatura-hero has-green-soft-background-color has-background">
	<!-- wp:heading {"level":1,"className":"qbatura-hero__title"} -->
	<h1 class="wp-block-heading qbatura-hero__title">404</h1>
	<!-- /wp:heading -->

	<!-- wp:separator {"className":"is-style-qbatura-thick"} -->
	<hr class="wp-block-separator has-alpha-channel-opacity is-style-qbatura-thick"/>
	<!-- /wp:separator -->

	<!-- wp:group {"className":"qbatura-hero__meta","layout":{"type":"default"}} -->
	<div class="wp-block-group qbatura-hero__meta">
		<!-- wp:paragraph {"className":"qbatura-hero__text"} -->
		<p class="qbatura-hero__text"><?php esc_html_e( 'Nie znaleziono strony.', 'qbatura' ); ?> <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Wróć na stronę główną', 'qbatura' ); ?></a>.</p>
		<!-- /wp:paragraph -->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->
