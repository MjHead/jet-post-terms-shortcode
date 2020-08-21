<?php
/**
 * Plugin Name: Jet Post Terms Shortcode
 * Plugin URI:  #
 * Description: Register new shortcode which allows to combine post terms from different taxonomies into single string.
 * Version:     1.0.0
 * Author:      Crocoblock
 * Author URI:  https://crocoblock.com/
 * License:     GPL-3.0+
 * License URI: http://www.gnu.org/licenses/gpl-3.0.txt
 * Domain Path: /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die();
}

add_shortcode( 'jet_post_terms', function( $atts = array() ) {

	$atts = shortcode_atts( array(
		'tax' => '',
		'tax_2' => '',
		'tax_3' => '',
	), $atts, 'jet_post_terms' );

	$post_id = get_the_ID();

	if ( empty( $atts['tax'] ) ) {
		return;
	}

	$result = array();

	$terms = wp_get_post_terms( $post_id, $atts['tax'], array( 'orderby' => 'parent' ) );

	if ( ! empty( $terms ) ) {
		foreach ( $terms as $term ) {
			$result[] = $term->name;
		}
	}

	if ( ! empty( $atts['tax_2'] ) ) {

		$terms = wp_get_post_terms( $post_id, $atts['tax_2'], array( 'orderby' => 'parent' ) );

		if ( ! empty( $terms ) ) {
			foreach ( $terms as $term ) {
				$result[] = $term->name;
			}
		}

	}

	if ( ! empty( $atts['tax_3'] ) ) {

		$terms = wp_get_post_terms( $post_id, $atts['tax_3'], array( 'orderby' => 'parent' ) );

		if ( ! empty( $terms ) ) {
			foreach ( $terms as $term ) {
				$result[] = $term->name;
			}
		}

	}

	return implode( ' ', $result );

} );
