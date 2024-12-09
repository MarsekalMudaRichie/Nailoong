<?php
/**
 * Customizer sanitization functions
 *
 * @package Cerebro
 */

/**
 * Sanitize checkbox
 */
function cerebro_sanitize_checkbox( $checkbox ) {
	if ( $checkbox ) {
		$checkbox = 1;
	} else {
		$checkbox = false;
	}
	return $checkbox;
}

// Sanitize text.
function cerebro_sanitize_text( $text ) {
	if ( '' == $text ) {
		$text = '';
	}
	return $text;
}

/**
 * Sanitize selection.
 */
function cerebro_sanitize_select( $selection ) {
	return $selection;
}

/**
 * Sanitize sticky header radio inputs
 */
function cerebro_sanitize_sticky_header( $selection ) {
	if ( !in_array( $selection, array( 'enable', 'disable' ) ) ) {
		$selection = 'enable';
	} else {
		return $selection;
	}
}

/**
 * Sanitize colors
 */
function cerebro_sanitize_color( $hex, $default = '' ) {
	if ( cerebro_of_validate_hex( $hex ) ) {
		return $hex;
	}
	return $default;
}

/**
 * Validate HEX values
 */
function cerebro_of_validate_hex( $hex ) {
	$hex = trim( $hex );
	/* Strip recognized prefixes. */
	if ( 0 === strpos( $hex, '#' ) ) {
		$hex = substr( $hex, 1 );
	}
	elseif ( 0 === strpos( $hex, '%23' ) ) {
		$hex = substr( $hex, 3 );
	}
	/* Regex match. */
	if ( 0 === preg_match( '/^[0-9a-fA-F]{6}$/', $hex ) ) {
		return false;
	}
	else {
		return true;
	}
}
