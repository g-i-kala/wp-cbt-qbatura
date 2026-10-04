<?php
/**
 * Title: Tytuł archiwum kategorii realizacji
 * Slug: qbatura/projects-title
 * Categories: qbatura
 * Inserter: no
 * Description: Nagłówek „Realizacje” (tytuł strony z listą) także po wybraniu filtra. Nazwa kategorii tylko dla czytników ekranu — wizualnie kategorię pokazuje aktywny filtr.
 *
 * @package qbatura
 */

$qbatura_term = is_tax( 'qbatura_project_type' ) ? get_queried_object() : null;
?>
<!-- wp:heading {"level":1,"className":"qbatura-hero__title"} -->
<h1 class="wp-block-heading qbatura-hero__title"><?php echo esc_html( qbatura_projects_page_title() ); ?><?php if ( $qbatura_term ) : ?><span class="screen-reader-text">: <?php echo esc_html( $qbatura_term->name ); ?></span><?php endif; ?></h1>
<!-- /wp:heading -->
