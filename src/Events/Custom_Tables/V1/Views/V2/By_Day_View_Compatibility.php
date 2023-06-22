<?php
/**
 * Handles the plugin integration and compatibility with the `By_Day_View` class, the common ancestor of Month and
 * Week View.
 *
 * @since   6.0.0
 *
 * @package TEC\Events\Custom_Tables\V1\Views\V2
 */

namespace TEC\Events\Custom_Tables\V1\Views\V2;

use stdClass;
use TEC\Events\Custom_Tables\V1\Models\Occurrence;
use Tribe\Events\Models\Post_Types\Event;
use Tribe__Timezones as Timezones;

/**
 * Class By_Day_View_Compatibility
 *
 * @since   6.0.0
 *
 * @package TEC\Events\Custom_Tables\V1\Views\V2
 */
class By_Day_View_Compatibility {

	/**
	 * Returns the day results, prepared as the `By_Day_View` expects them.
	 *
	 * @since 6.0.0
	 * @since TBD Separating UTC date fields.
	 *
	 * @param array<int> $ids A list of the Event post IDs to prepare the day results
	 *                        for.
	 *
	 * @return array<int,stdClass> The prepared day results.
	 */
	public function prepare_day_results( array $ids = [] ) {
		if ( empty( $ids ) ) {
			return [];
		}

		$prepared = [];

		/** @var Occurrence $occurrence */
		foreach (
			Occurrence::find_all( $ids, 'post_id' ) as $occurrence
		) {
			$prepared[ $occurrence->post_id ] = (object) [
				'ID'             => $occurrence->post_id,
				'start_date'     => $occurrence->start_date,
				'end_date'       => $occurrence->end_date,
				'timezone'       => get_post_meta( $occurrence->post_id, '_EventTimezone', true ),
			];
		}

		return $prepared;
	}
}
