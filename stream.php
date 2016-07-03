<?php
/**
 *Plugin Name: BICOCI-Bitacora
 *Plugin URI: http://bicoci.site88.net
 *Description: módulo de bitacora de bicoci
 *Version: 1.0
 *Author: Alumno PERA
 *Author URI: http://bicoci.site88.net
 * License: GPLv2+
 * Text Domain: stream
 * Domain Path: /languages
 */

if ( ! version_compare( PHP_VERSION, '5.3', '>=' ) ) {
	load_plugin_textdomain( 'stream', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
	add_action( 'shutdown', 'wp_stream_fail_php_version' );
} else {
	require __DIR__ . '/classes/class-plugin.php';
	$plugin_class_name = 'WP_Stream\Plugin';
	if ( class_exists( $plugin_class_name ) ) {
		$GLOBALS['wp_stream'] = new $plugin_class_name();
	}
}

/**
 * Invoked when the PHP version check fails
 * Load up the translations and add the error message to the admin notices.
 */
function wp_stream_fail_php_version() {
	load_plugin_textdomain( 'stream', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );

	$message      = esc_html__( 'Stream requires PHP version 5.3+, plugin is currently NOT ACTIVE.', 'stream' );
	$html_message = sprintf( '<div class="error">%s</div>', wpautop( $message ) );

	echo wp_kses_post( $html_message );
}

/**
 * Helper for external plugins which wish to use Stream
 *
 * @return WP_Stream\Plugin
 */
function wp_stream_get_instance() {
	return $GLOBALS['wp_stream'];
}
/*Variable para el directorio del plugin Bitácora*/
define('BICOCI_BITACORA_DIR', plugin_dir_path(__FILE__));