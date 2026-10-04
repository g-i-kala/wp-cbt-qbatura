<?php
/**
 * Formularz kontaktowy (WS Form): osadzanie i odbiorca wiadomości.
 *
 * Formularz kontaktowy to formularz WS Form z klasą „qbatura-contact-form”
 * (Ustawienia formularza → Styl → Klasy CSS opakowania). Ta sama klasa służy motywowi do stylizacji.
 * - Shortcode [qbatura_contact_form] wyświetla opublikowany formularz z tą klasą — wzorzec
 *   w motywie nie musi znać ID, które jest inne na każdym środowisku.
 * - Akcja e-mail takiego formularza wysyła na adres z qbatura_core_form_recipient() (K3).
 *
 * @package qbatura-core
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Klasa CSS oznaczająca formularz kontaktowy.
 */
const QBATURA_CORE_CONTACT_FORM_CLASS = 'qbatura-contact-form';

/**
 * Czy formularz WS Form jest formularzem kontaktowym (ma klasę qbatura-contact-form).
 *
 * @param object $form Obiekt formularza WS Form (z meta).
 * @return bool
 */
function qbatura_core_is_contact_form( $form ) {
	$classes = isset( $form->meta->class_form_wrapper ) ? (string) $form->meta->class_form_wrapper : '';

	return in_array( QBATURA_CORE_CONTACT_FORM_CLASS, preg_split( '/\s+/', $classes ), true );
}

/**
 * ID opublikowanego formularza kontaktowego (najstarszy z klasą qbatura-contact-form).
 *
 * @return int 0, gdy brak.
 */
function qbatura_core_contact_form_id() {
	global $wpdb;

	static $form_id = null;

	if ( null === $form_id ) {
		// phpcs:ignore WordPress.DB.DirectDatabaseQuery -- tabele WS Form, brak API do wyszukiwania po meta.
		$form_id = (int) $wpdb->get_var(
			$wpdb->prepare(
				"SELECT f.id FROM {$wpdb->prefix}wsf_form f
				INNER JOIN {$wpdb->prefix}wsf_form_meta m ON m.parent_id = f.id
				WHERE f.status = 'publish' AND m.meta_key = 'class_form_wrapper' AND m.meta_value LIKE %s
				ORDER BY f.id ASC LIMIT 1",
				'%' . $wpdb->esc_like( QBATURA_CORE_CONTACT_FORM_CLASS ) . '%'
			)
		);
	}

	/**
	 * ID formularza kontaktowego — np. osobny formularz dla wersji EN (Polylang).
	 *
	 * @param int $form_id ID formularza WS Form.
	 */
	return (int) apply_filters( 'qbatura_contact_form_id', $form_id );
}

/**
 * Shortcode [qbatura_contact_form].
 *
 * @return string
 */
function qbatura_core_contact_form_shortcode() {
	if ( ! defined( 'WS_FORM_VERSION' ) ) {
		return current_user_can( 'activate_plugins' )
			? '<p>' . esc_html__( 'Formularz kontaktowy wymaga aktywnej wtyczki WS Form.', 'qbatura-core' ) . '</p>'
			: '';
	}

	$form_id = qbatura_core_contact_form_id();

	if ( ! $form_id ) {
		return current_user_can( 'edit_pages' )
			? '<p>' . esc_html__( 'Brak opublikowanego formularza WS Form z klasą „qbatura-contact-form”.', 'qbatura-core' ) . '</p>'
			: '';
	}

	return do_shortcode( sprintf( '[ws_form id="%d"]', $form_id ) );
}
add_shortcode( 'qbatura_contact_form', 'qbatura_core_contact_form_shortcode' );

/**
 * Odbiorca akcji e-mail formularza kontaktowego = adres z ustawień (K3).
 *
 * @param array  $email_to Odbiorcy z ustawień akcji WS Form.
 * @param object $form     Formularz WS Form.
 * @return array
 */
function qbatura_core_contact_form_email_to( $email_to, $form ) {
	if ( ! qbatura_core_is_contact_form( $form ) ) {
		return $email_to;
	}

	return array( qbatura_core_form_recipient() );
}
add_filter( 'wsf_action_email_to', 'qbatura_core_contact_form_email_to', 10, 2 );
