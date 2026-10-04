/**
 * Edytor bloku qbatura/project-meta — bez kroku budowania (globalne wp.*).
 * Podgląd renderuje serwer; w Query Loop przekazywany jest ID bieżącej realizacji.
 */
( function ( wp ) {
	var el = wp.element.createElement;
	var __ = wp.i18n.__;
	var InspectorControls = wp.blockEditor.InspectorControls;
	var useBlockProps = wp.blockEditor.useBlockProps;
	var PanelBody = wp.components.PanelBody;
	var SelectControl = wp.components.SelectControl;
	var ServerSideRender = wp.serverSideRender;

	function Placeholder() {
		return el(
			'p',
			{ className: 'wp-block-qbatura-project-meta__placeholder' },
			__( 'Dane realizacji — uzupełnij pola pod treścią wpisu.', 'qbatura-core' )
		);
	}

	wp.blocks.registerBlockType( 'qbatura/project-meta', {
		edit: function ( props ) {
			var postId = props.context && props.context.postId;
			var blockProps = useBlockProps();

			return el(
				'div',
				blockProps,
				el(
					InspectorControls,
					null,
					el(
						PanelBody,
						{ title: __( 'Ustawienia', 'qbatura-core' ) },
						el( SelectControl, {
							label: __( 'Wariant', 'qbatura-core' ),
							value: props.attributes.variant,
							options: [
								{ label: __( 'Lista parametrów (strona realizacji)', 'qbatura-core' ), value: 'list' },
								{ label: __( 'Karta (lista realizacji)', 'qbatura-core' ), value: 'card' },
							],
							onChange: function ( value ) {
								props.setAttributes( { variant: value } );
							},
						} )
					)
				),
				el( ServerSideRender, {
					block: 'qbatura/project-meta',
					attributes: props.attributes,
					urlQueryArgs: postId ? { post_id: postId } : {},
					EmptyResponsePlaceholder: Placeholder,
				} )
			);
		},
		save: function () {
			return null;
		},
	} );
} )( window.wp );
