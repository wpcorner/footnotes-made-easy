<?php
/**
 * [footnotes] shortcode.
 *
 * Processes footnote markup in the enclosed content and appends the footnote
 * list — for use in places where WordPress's the_content filter does NOT run,
 * such as Pods or ACF custom fields, page-builder text/dynamic modules, or
 * widgets.
 *
 * Usage:
 *   [footnotes]Body text with a footnote(( like this )).[/footnotes]
 *
 * Nested shortcodes are expanded first, so this also works to wrap field
 * output, e.g. a Pods field:
 *   [footnotes][pods field="my_field"][/footnotes]
 *
 * NOTE: Do not use this inside the normal post editor content — footnotes there
 * are already processed automatically by the the_content filter, and wrapping
 * them would process them twice.
 *
 * @package footnotes-made-easy
 * @since   3.2.2
 */

defined( 'ABSPATH' ) || exit;

/**
 * Render the [footnotes] shortcode.
 *
 * @param array       $atts    Shortcode attributes (unused).
 * @param string|null $content Enclosed content.
 * @return string Processed content with the footnote list appended.
 */
function fme_footnotes_shortcode( $atts, $content = null ) {
	if ( null === $content || '' === trim( $content ) ) {
		return '';
	}

	// Expand any nested shortcodes (e.g. [pods field="x"]) before processing,
	// so their output is what gets scanned for footnotes.
	$content = do_shortcode( $content );

	global $swas_wp_footnotes;

	if ( isset( $swas_wp_footnotes ) && is_object( $swas_wp_footnotes ) && method_exists( $swas_wp_footnotes, 'process' ) ) {
		return $swas_wp_footnotes->process( $content );
	}

	return $content;
}
add_shortcode( 'footnotes', 'fme_footnotes_shortcode' );
