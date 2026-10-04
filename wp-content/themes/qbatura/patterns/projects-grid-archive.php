<?php
/**
 * Title: Siatka realizacji (archiwum kategorii)
 * Slug: qbatura/projects-grid-archive
 * Categories: qbatura
 * Inserter: no
 * Description: Karty realizacji z zapytaniem dziedziczonym z archiwum kategorii.
 *
 * @package qbatura
 */

echo qbatura_projects_query_markup( true ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- markup bloków.
