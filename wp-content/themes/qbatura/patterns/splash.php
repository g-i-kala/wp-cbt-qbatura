<?php
/**
 * Title: Splash strony głównej
 * Slug: qbatura/splash
 * Categories: qbatura
 * Inserter: no
 * Description: Ekran 1 (zieleń, „Wejście”, wielki wordmark) i ekran 2 (wielkie menu na terakocie). Używany w szablonie front-page.
 *
 * Splash tylko przy pierwszej wizycie (S1) — flaga w localStorage, obsługa w assets/js/splash.js.
 * Podgląd splasha ponownie: adres strony głównej z ?splash.
 *
 * @package qbatura
 */

$qbatura_has_lang = function_exists( 'pll_the_languages' );
?>
<!-- wp:group {"tagName":"section","anchor":"screen-1","className":"qbatura-splash qbatura-splash--intro","backgroundColor":"green-main","layout":{"type":"default"}} -->
<section id="screen-1" class="wp-block-group qbatura-splash qbatura-splash--intro has-green-main-background-color has-background">
	<!-- wp:group {"className":"qbatura-splash__top","layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"space-between","verticalAlignment":"top"}} -->
	<div class="wp-block-group qbatura-splash__top">
		<?php if ( $qbatura_has_lang ) : ?>
		<!-- wp:html -->
		<?php echo qbatura_lang_switch_markup(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escapowane w funkcji. ?>
		<!-- /wp:html -->
		<?php endif; ?>

		<!-- wp:paragraph {"className":"qbatura-splash__description"} -->
		<p class="qbatura-splash__description"><?php esc_html_e( 'Pracownia projektowa Qbatura', 'qbatura' ); ?></p>
		<!-- /wp:paragraph -->
	</div>
	<!-- /wp:group -->

	<!-- wp:group {"className":"qbatura-splash__center","layout":{"type":"default"}} -->
	<div class="wp-block-group qbatura-splash__center">
		<!-- wp:html -->
		<a class="qbatura-splash__enter js-splash-enter" href="#screen-2"><?php esc_html_e( 'Wejście', 'qbatura' ); ?></a>
		<!-- /wp:html -->
	</div>
	<!-- /wp:group -->

	<!-- wp:site-title {"level":1,"isLink":false,"className":"qbatura-splash__brand"} /-->
</section>
<!-- /wp:group -->

<!-- wp:group {"tagName":"section","anchor":"screen-2","className":"qbatura-splash qbatura-splash--menu","backgroundColor":"terracotta","layout":{"type":"default"}} -->
<section id="screen-2" class="wp-block-group qbatura-splash qbatura-splash--menu has-terracotta-background-color has-background">
	<!-- wp:group {"className":"qbatura-splash__bar","layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"space-between"}} -->
	<div class="wp-block-group qbatura-splash__bar">
		<!-- wp:paragraph {"className":"qbatura-splash__logo qbatura-aria-hidden"} -->
		<p class="qbatura-splash__logo qbatura-aria-hidden">Qbatura</p>
		<!-- /wp:paragraph -->

		<?php if ( $qbatura_has_lang ) : ?>
		<!-- wp:html -->
		<?php echo qbatura_lang_switch_markup(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escapowane w funkcji. ?>
		<!-- /wp:html -->
		<?php endif; ?>
	</div>
	<!-- /wp:group -->

	<!-- wp:navigation {"overlayMenu":"never","className":"qbatura-giant-nav","layout":{"type":"flex","orientation":"vertical"}} /-->
</section>
<!-- /wp:group -->
