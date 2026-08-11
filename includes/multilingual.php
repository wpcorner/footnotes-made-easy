<?php
/**
 * Multilingual support for the footnote header/footer text.
 *
 * Registers the "pre" (header) and "post" (footer) footnotes text with Polylang
 * and WPML so multilingual sites can translate them per language, then provides
 * a translate helper used when the footnote list is rendered.
 *
 * Everything here is guarded by soft dependency checks: on sites without Polylang
 * or WPML nothing is registered and the original text is returned unchanged.
 *
 * @package footnotes-made-easy
 * @since   3.2.2
 */

defined( 'ABSPATH' ) || exit;

/**
 * The translation group / context these strings appear under in the
 * Polylang and WPML string-translation screens.
 */
if ( ! defined( 'FME_STRINGS_GROUP' ) ) {
	define( 'FME_STRINGS_GROUP', 'Footnotes Made Easy' );
}

/**
 * Register the header/footer footnote text with the active translation plugin.
 *
 * Runs on init so the multilingual plugin's registration API is available.
 * Only non-empty values are registered.
 */
function fme_register_translatable_strings() { // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedFunctionFound -- Uses the plugin's established fme_ prefix.
	$options = get_option( 'swas_footnote_options', array() );

	$strings = array(
		'pre_footnotes'  => __( 'Footnotes header text', 'footnotes-made-easy' ),
		'post_footnotes' => __( 'Footnotes footer text', 'footnotes-made-easy' ),
	);

	foreach ( $strings as $key => $label ) {
		$value = isset( $options[ $key ] ) ? $options[ $key ] : '';

		if ( '' === trim( (string) $value ) ) {
			continue;
		}

		// Polylang.
		if ( function_exists( 'pll_register_string' ) ) {
			pll_register_string( 'fme_' . $key, $value, FME_STRINGS_GROUP, true );
		}

		// WPML.
		if ( has_action( 'wpml_register_single_string' ) ) {
			do_action( 'wpml_register_single_string', FME_STRINGS_GROUP, $label, $value ); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound -- WPML's own hook name; must be used verbatim to integrate.
		}
	}
}
add_action( 'init', 'fme_register_translatable_strings' );

/**
 * Return the translated value of a footnote header/footer string for the
 * current language, falling back to the original when no translation plugin
 * is active or no translation exists.
 *
 * @param string $key   Option key: 'pre_footnotes' or 'post_footnotes'.
 * @param string $value The original (untranslated) string value.
 * @return string
 */
function fme_translate_string( $key, $value ) { // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedFunctionFound -- Uses the plugin's established fme_ prefix.
	if ( '' === trim( (string) $value ) ) {
		return $value;
	}

	// Polylang.
	if ( function_exists( 'pll__' ) ) {
		return pll__( $value );
	}

	// WPML.
	if ( has_filter( 'wpml_translate_single_string' ) ) {
		$labels = array(
			'pre_footnotes'  => __( 'Footnotes header text', 'footnotes-made-easy' ),
			'post_footnotes' => __( 'Footnotes footer text', 'footnotes-made-easy' ),
		);
		$label = isset( $labels[ $key ] ) ? $labels[ $key ] : $key;

		return apply_filters( 'wpml_translate_single_string', $value, FME_STRINGS_GROUP, $label ); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound -- WPML's own hook name; must be used verbatim to integrate.
	}

	return $value;
}
