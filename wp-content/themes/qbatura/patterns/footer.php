<?php
/**
 * Title: Stopka
 * Slug: qbatura/footer
 * Categories: footer
 * Block Types: core/template-part/footer
 * Inserter: no
 * Description: Menu, rok, dane pracowni, linki do polityk i mały wordmark (W3).
 *
 * Dane pracowni to placeholdery „jak w przykładzie” — do podmiany na dane klientki.
 *
 * @package qbatura
 */

$qbatura_privacy_url = get_privacy_policy_url();
if ( ! $qbatura_privacy_url ) {
	$qbatura_privacy_url = home_url( '/polityka-prywatnosci/' );
}
$qbatura_cookies_url = home_url( '/polityka-cookies/' );
?>
<!-- wp:group {"tagName":"footer","className":"qbatura-footer","backgroundColor":"dark","textColor":"white","layout":{"type":"default"}} -->
<footer class="wp-block-group qbatura-footer has-white-color has-dark-background-color has-text-color has-background">
	<!-- wp:group {"className":"qbatura-footer__top","layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"space-between","verticalAlignment":"top"}} -->
	<div class="wp-block-group qbatura-footer__top">
		<!-- wp:navigation {"overlayMenu":"never","className":"qbatura-footer-nav","layout":{"type":"flex","flexWrap":"wrap"}} /-->

		<!-- wp:paragraph {"className":"qbatura-footer__year"} -->
		<p class="qbatura-footer__year"><?php echo esc_html( wp_date( 'Y' ) ); ?></p>
		<!-- /wp:paragraph -->
	</div>
	<!-- /wp:group -->

	<!-- wp:group {"className":"qbatura-footer__bottom","layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"space-between"}} -->
	<div class="wp-block-group qbatura-footer__bottom">
		<!-- wp:paragraph {"className":"qbatura-footer__address"} -->
		<p class="qbatura-footer__address"><?php esc_html_e( 'Qbatura — pracownia architektoniczna', 'qbatura' ); ?><br>ul. Architektów 12/3, 00-001 Warszawa<br><a href="mailto:biuro@qbatura.pl">biuro@qbatura.pl</a> · <a href="tel:+48123123123">+48 123 123 123</a></p>
		<!-- /wp:paragraph -->

		<!-- wp:paragraph {"className":"qbatura-footer__policy"} -->
		<p class="qbatura-footer__policy"><a href="<?php echo esc_url( $qbatura_privacy_url ); ?>"><?php esc_html_e( 'Polityka prywatności', 'qbatura' ); ?></a> – <a href="<?php echo esc_url( $qbatura_cookies_url ); ?>"><?php esc_html_e( 'Polityka ciasteczek', 'qbatura' ); ?></a></p>
		<!-- /wp:paragraph -->
	</div>
	<!-- /wp:group -->

	<!-- wp:paragraph {"className":"qbatura-wordmark"} -->
	<p class="qbatura-wordmark">Qbatura</p>
	<!-- /wp:paragraph -->
</footer>
<!-- /wp:group -->
