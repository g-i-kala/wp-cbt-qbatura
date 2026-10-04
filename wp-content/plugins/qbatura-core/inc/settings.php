<?php
/**
 * Ustawienie „E-mail do formularza kontaktowego” (K3).
 *
 * Wartość z panelu (Ustawienia → Ogólne) można nadpisać stałą QBATURA_FORM_RECIPIENT
 * w wp-config.php danego środowiska (np. na stagingu, żeby wiadomości testowe nie trafiały do klientki).
 * Podpięcie pod akcję e-mail w WS Form: inc/contact-form.php.
 *
 * @package qbatura-core
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Adres odbiorcy wiadomości z formularza.
 *
 * @return string
 */
function qbatura_core_form_recipient() {
	if ( defined( 'QBATURA_FORM_RECIPIENT' ) && is_email( QBATURA_FORM_RECIPIENT ) ) {
		return QBATURA_FORM_RECIPIENT;
	}

	$email = get_option( 'qbatura_form_recipient', '' );

	return is_email( $email ) ? $email : get_option( 'admin_email' );
}

/**
 * Pole w Ustawienia → Ogólne.
 */
function qbatura_core_register_settings() {
	register_setting(
		'general',
		'qbatura_form_recipient',
		array(
			'type'              => 'string',
			'sanitize_callback' => 'sanitize_email',
			'default'           => '',
		)
	);

	add_settings_field(
		'qbatura_form_recipient',
		__( 'E-mail do formularza kontaktowego', 'qbatura-core' ),
		'qbatura_core_render_recipient_field',
		'general',
		'default',
		array( 'label_for' => 'qbatura_form_recipient' )
	);
}
add_action( 'admin_init', 'qbatura_core_register_settings' );

/**
 * Pole formularza ustawień.
 */
function qbatura_core_render_recipient_field() {
	$locked = defined( 'QBATURA_FORM_RECIPIENT' );

	printf(
		'<input type="email" class="regular-text" id="qbatura_form_recipient" name="qbatura_form_recipient" value="%1$s" %2$s>',
		esc_attr( get_option( 'qbatura_form_recipient', '' ) ),
		disabled( $locked, true, false )
	);

	echo '<p class="description">';
	if ( $locked ) {
		/* translators: %s: adres e-mail ze stałej */
		printf( esc_html__( 'Ustawione w wp-config.php (QBATURA_FORM_RECIPIENT): %s', 'qbatura-core' ), esc_html( qbatura_core_form_recipient() ) );
	} else {
		esc_html_e( 'Na ten adres trafiają wiadomości z formularza. Puste — adres administratora witryny.', 'qbatura-core' );
	}
	echo '</p>';
}
