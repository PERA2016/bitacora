<?php
namespace WP_Stream;

// Load Carbon to Handle dates much easier
if ( ! class_exists( 'Carbon\Carbon' ) ) {
	require_once wp_stream_get_instance()->locations['inc_dir'] . 'lib/Carbon.php';
}

use Carbon\Carbon;

class Date_Interval {
	/**
	 * Contains an array of all available intervals
	 *
	 * @var array $intervals
	 */
	public $intervals;

	/**
	 * Class constructor
	 */
	public function __construct() {
		// Get all default intervals
		$this->intervals = $this->get_predefined_intervals();
	}

	/**
	 * @return mixed|void
	 */
	public function get_predefined_intervals() {
		$timezone = get_option( 'timezone_string' );

		if ( empty( $timezone ) ) {
			$gmt_offset = (int) get_option( 'gmt_offset' );
			$timezone   = timezone_name_from_abbr( null, $gmt_offset * 3600, true );
			if ( false === $timezone ) {
				$timezone = timezone_name_from_abbr( null, $gmt_offset * 3600, false );
			}
			if ( false === $timezone ) {
				$timezone = null;
			}
		}

		return apply_filters(
			'wp_stream_predefined_date_intervals',
			array(),
			$timezone
		);
	}
}
