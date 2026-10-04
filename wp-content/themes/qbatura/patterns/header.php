<?php
/**
 * Title: Nagłówek
 * Slug: qbatura/header
 * Categories: header
 * Block Types: core/template-part/header
 * Inserter: no
 * Description: Pasek z logo, przyciskiem „Menu” i przełącznikiem języka oraz nakładka menu (pełny ekran, terakota).
 *
 * Nakładka to własny overlay (decyzja 2026-10-04, opcja B) — pozycje menu pochodzą z bloku Nawigacja,
 * więc menu edytuje się w Wygląd → Edytor → Nawigacja. Obsługa klawiatury: assets/js/navigation.js.
 *
 * @package qbatura
 */

?>
<!-- wp:group {"tagName":"header","className":"qbatura-header","layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"space-between"}} -->
<header class="wp-block-group qbatura-header">
	<!-- wp:site-title {"level":0,"className":"qbatura-logo"} /-->

	<!-- wp:group {"className":"qbatura-header__right","layout":{"type":"flex","flexWrap":"nowrap"}} -->
	<div class="wp-block-group qbatura-header__right">
		<!-- wp:html -->
		<button type="button" class="qbatura-menu-toggle js-menu-open" aria-controls="qbatura-menu" aria-expanded="false"><?php esc_html_e( 'Menu', 'qbatura' ); ?></button>
		<!-- /wp:html -->

		<?php if ( function_exists( 'pll_the_languages' ) ) : ?>
		<!-- wp:html -->
		<?php echo qbatura_lang_switch_markup(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escapowane w funkcji. ?>
		<!-- /wp:html -->
		<?php endif; ?>
	</div>
	<!-- /wp:group -->
</header>
<!-- /wp:group -->

<!-- wp:group {"anchor":"qbatura-menu","className":"qbatura-menu","backgroundColor":"terracotta","layout":{"type":"default"}} -->
<div id="qbatura-menu" class="wp-block-group qbatura-menu has-terracotta-background-color has-background">
	<!-- wp:group {"className":"qbatura-menu__top","layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"space-between"}} -->
	<div class="wp-block-group qbatura-menu__top">
		<!-- wp:site-title {"level":0,"className":"qbatura-logo"} /-->

		<!-- wp:html -->
		<button type="button" class="qbatura-menu-close js-menu-close"><?php esc_html_e( 'Zamknij', 'qbatura' ); ?></button>
		<!-- /wp:html -->
	</div>
	<!-- /wp:group -->

	<!-- wp:navigation {"overlayMenu":"never","className":"qbatura-giant-nav","layout":{"type":"flex","orientation":"vertical"}} /-->
</div>
<!-- /wp:group -->
