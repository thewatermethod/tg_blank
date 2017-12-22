/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {

	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		} );
	} );
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );

	// Header text color.
	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.site-title a, .site-description' ).css( {
					'clip': 'rect(1px, 1px, 1px, 1px)',
					'position': 'absolute'
				} );
			} else {
				$( '.site-title a, .site-description' ).css( {
					'clip': 'auto',
					'position': 'relative'
				} );
				$( '.site-title a, .site-description' ).css( {
					'color': to
				} );
			}
		} );
	} );
} )( jQuery );

( function( $ ) {
	"use strict";

	window.onload = function() {

		var textareas = document.getElementsByClassName( 'customize-editor-control' );

		for ( var i = 0; i < textareas.length; i++ ) {
			var textarea, id, options;

			textarea = textareas[ i ];
			id = textarea.getAttribute( 'id' );
			options = textarea.getAttribute( 'data-editor' ) ? JSON.parse( textarea.getAttribute( 'data-editor' ) ) : {};

			wp.editor.initialize( id, options );
		}

		setInterval( function() {
			for ( var i = 0; i < textareas.length; i++ ) {
				var textarea, id, oldValue, newValue;

				textarea = textareas[ i ];
				id = textarea.getAttribute( 'id' );
				oldValue = textarea.value;
				newValue = wp.editor.getContent( id );

				if ( oldValue == newValue ) {
					continue;
				}

				textarea.value = newValue;
				$( textarea ).trigger( 'change' );
			}
		}, 500 );
	}
})( jQuery );
