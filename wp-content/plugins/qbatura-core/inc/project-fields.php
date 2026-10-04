<?php
/**
 * Pola „Dane realizacji” — definicja w kodzie (ACF Free) i wspólna lista parametrów.
 *
 * Dane są zwykłymi post meta (klucze z prefiksem qbatura_), więc blok project-meta
 * czyta je przez get_post_meta() i działa także bez aktywnego ACF.
 *
 * @package qbatura-core
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Parametry realizacji w kolejności wyświetlania na stronie projektu.
 *
 * @return array<string, array{label: string, type: string, suffix?: string}>
 */
function qbatura_core_project_fields() {
	return array(
		'qbatura_location'    => array(
			'label' => __( 'Lokalizacja', 'qbatura-core' ),
			'type'  => 'text',
		),
		'qbatura_country'     => array(
			'label' => __( 'Kraj', 'qbatura-core' ),
			'type'  => 'text',
		),
		'qbatura_year'        => array(
			'label' => __( 'Rok', 'qbatura-core' ),
			'type'  => 'number',
		),
		'qbatura_object_type' => array(
			'label' => __( 'Typ', 'qbatura-core' ),
			'type'  => 'text',
		),
		'qbatura_scope'       => array(
			'label' => __( 'Zakres', 'qbatura-core' ),
			'type'  => 'text',
		),
		'qbatura_usable_area' => array(
			'label'  => __( 'Powierzchnia użytkowa', 'qbatura-core' ),
			'type'   => 'number',
			'suffix' => 'm²',
		),
		'qbatura_plot_area'   => array(
			'label'  => __( 'Powierzchnia działki', 'qbatura-core' ),
			'type'   => 'number',
			'suffix' => 'm²',
		),
		'qbatura_storeys'     => array(
			'label' => __( 'Liczba kondygnacji', 'qbatura-core' ),
			'type'  => 'text',
		),
		'qbatura_function'    => array(
			'label' => __( 'Funkcja', 'qbatura-core' ),
			'type'  => 'text',
		),
		'qbatura_investor'    => array(
			'label' => __( 'Inwestor', 'qbatura-core' ),
			'type'  => 'text',
		),
		'qbatura_status'      => array(
			'label' => __( 'Status', 'qbatura-core' ),
			'type'  => 'select',
		),
		'qbatura_duration'    => array(
			'label' => __( 'Czas realizacji', 'qbatura-core' ),
			'type'  => 'text',
		),
	);
}

/**
 * Wartości pola „Status” — lista do potwierdzenia przez klientkę (P7).
 *
 * @return array<string, string>
 */
function qbatura_core_project_statuses() {
	return array(
		'completed'   => __( 'Zrealizowany', 'qbatura-core' ),
		'in_progress' => __( 'W realizacji', 'qbatura-core' ),
		'concept'     => __( 'Koncepcja', 'qbatura-core' ),
	);
}

/**
 * Rejestracja meta w REST (dostęp dla edytora i ewentualnych block bindings).
 */
function qbatura_core_register_project_meta() {
	foreach ( qbatura_core_project_fields() as $key => $field ) {
		register_post_meta(
			'qbatura_project',
			$key,
			array(
				'type'          => 'string',
				'single'        => true,
				'show_in_rest'  => true,
				'auth_callback' => static function () {
					return current_user_can( 'edit_posts' );
				},
			)
		);
	}
}
add_action( 'init', 'qbatura_core_register_project_meta' );

/**
 * Grupa pól ACF „Dane realizacji”. Definicja tylko w kodzie — nie edytujemy jej w panelu ACF.
 */
function qbatura_core_register_acf_fields() {
	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}

	$instructions = array(
		'qbatura_location'    => __( 'Miasto, np. Szczecin.', 'qbatura-core' ),
		'qbatura_object_type' => __( 'Np. Dom jednorodzinny — pojawia się też na karcie realizacji.', 'qbatura-core' ),
		'qbatura_usable_area' => __( 'Sama liczba, bez „m²”.', 'qbatura-core' ),
		'qbatura_plot_area'   => __( 'Sama liczba, bez „m²”.', 'qbatura-core' ),
		'qbatura_storeys'     => __( 'Np. 1 + poddasze.', 'qbatura-core' ),
	);

	$fields = array();
	foreach ( qbatura_core_project_fields() as $key => $field ) {
		$acf_field = array(
			'key'          => 'field_' . $key,
			'name'         => $key,
			'label'        => $field['label'],
			'type'         => $field['type'],
			'instructions' => $instructions[ $key ] ?? '',
			'wrapper'      => array( 'width' => '50' ),
		);

		if ( 'number' === $field['type'] ) {
			$acf_field['min'] = 0;
		}

		if ( 'select' === $field['type'] ) {
			$acf_field['choices']       = qbatura_core_project_statuses();
			$acf_field['allow_null']    = 1;
			$acf_field['return_format'] = 'value';
		}

		$fields[] = $acf_field;
	}

	acf_add_local_field_group(
		array(
			'key'                   => 'group_qbatura_project_data',
			'title'                 => __( 'Dane realizacji', 'qbatura-core' ),
			'fields'                => $fields,
			'location'              => array(
				array(
					array(
						'param'    => 'post_type',
						'operator' => '==',
						'value'    => 'qbatura_project',
					),
				),
			),
			'position'              => 'normal',
			'style'                 => 'default',
			'label_placement'       => 'top',
			'instruction_placement' => 'label',
			'description'           => __( 'Puste pola nie są wyświetlane na stronie.', 'qbatura-core' ),
			'show_in_rest'          => 0,
		)
	);
}
add_action( 'acf/include_fields', 'qbatura_core_register_acf_fields' );

/**
 * Sformatowana wartość parametru (metraż z separatorem tysięcy, status jako etykieta).
 *
 * @param int    $post_id ID realizacji.
 * @param string $key     Klucz meta.
 * @return string Tekst do wyświetlenia (nieescapowany) albo pusty ciąg.
 */
function qbatura_core_project_value( $post_id, $key ) {
	$fields = qbatura_core_project_fields();
	$value  = trim( (string) get_post_meta( $post_id, $key, true ) );

	if ( '' === $value || ! isset( $fields[ $key ] ) ) {
		return '';
	}

	$field = $fields[ $key ];

	if ( 'select' === $field['type'] ) {
		$statuses = qbatura_core_project_statuses();
		return $statuses[ $value ] ?? '';
	}

	if ( ! empty( $field['suffix'] ) && is_numeric( $value ) ) {
		$decimals = ( floor( (float) $value ) === (float) $value ) ? 0 : 1;
		// „1 200 m²” — twarda spacja jako separator tysięcy, jak w makiecie.
		return number_format_i18n( (float) $value, $decimals ) . "\u{00A0}" . $field['suffix'];
	}

	return $value;
}
