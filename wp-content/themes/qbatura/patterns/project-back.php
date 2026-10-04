<?php
/**
 * Title: Link powrotny do realizacji
 * Slug: qbatura/project-back
 * Categories: qbatura
 * Inserter: no
 * Description: „← Realizacje” na stronie pojedynczej realizacji.
 *
 * @package qbatura
 */

?>
<!-- wp:paragraph {"className":"qbatura-back"} -->
<p class="qbatura-back"><a href="<?php echo esc_url( qbatura_projects_page_url() ); ?>">← <?php esc_html_e( 'Realizacje', 'qbatura' ); ?></a></p>
<!-- /wp:paragraph -->
