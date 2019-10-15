<?php
/**
 * Handles a collection of View Messages.
 *
 * @since   TBD
 *
 * @package Tribe\Events\Views\V2
 */

namespace Tribe\Events\Views\V2;

use Tribe__Utils__Array as Arr;

/**
 * Class Messages
 *
 * @since   TBD
 *
 * @package Tribe\Events\Views\V2
 */
class Messages {
	/**
	 * A notice type of message.
	 *
	 * @since TBD
	 */
	const TYPE_NOTICE = 'notice';

	/**
	 * The strategy that will print a single message, the last, per priority collection, per type.
	 *
	 * @since TBD
	 */
	const RENDER_STRATEGY_PRIORITY_LAST = 'priority_last';

	/**
	 * The strategy that will print a single message, the first, per priority collection, per type.
	 *
	 * @since TBD
	 */
	const RENDER_STRATEGY_PRIORITY_FIRST =  'priority_first';

	/**
	 * An array of the messages handled by the object.
	 *
	 * @since TBD
	 *
	 * @var array
	 */
	protected $messages = [];

	/**
	 * The render strategy the collection will use to "render" the messages in the `to_array` method.
	 *
	 * @since TBD
	 *
	 * @var string
	 */
	protected $render_strategy;

	/**
	 * Messages constructor.
	 *
	 * @param null|string $render_strategy The render strategy that should be used to render the messages in the
	 *                                     `to_array` method.
	 * @param array $messages A list of messages to hydrate the collection with.
	 */
	public function __construct( $render_strategy = null, array $messages = [] ) {
		$this->render_strategy = $render_strategy ?: static::RENDER_STRATEGY_PRIORITY_LAST;
		$this->messages        = $messages;
	}

	/**
	 * Returns the human-readable message for a key.
	 *
	 * @since TBD
	 *
	 * @param string $key The message identification key or slug.
	 * @param mixed $values A variadic number of arguments that should be used to fill in the message placeholders, if
	 *                      the message contains `sprintf` compatible placeholders at all.
	 *
	 * @return string The human readable message for the specified key, if found, or the key itself.
	 */
	public static function for_key( string $key, ...$values ) {
		$map = [
			'no_results_found' => __( 'There were no results found.', 'the-events-calendar' ),
			'month_no_results_found_w_keyword' => __(
				'There were no results found for <strong>"%1$s"</strong> this month. Try searching next month.',
				'the-events-calendar'
			)
		];

		/**
		 * Filters the map of user-facing messages that will be used in the Views.
		 *
		 * @since TBD
		 *
		 * @param array $map An map of message keys to localized, user-facing, messages.
		 */
		$map = apply_filters( 'tribe_events_views_v2_messages_map', $map );

		// If not found return the key itself.
		$match = Arr::get( $map, $key, $key );

		return count( $values ) ? sprintf( $match, ...$values ) : $match;
	}

	/**
	 * Applies the current message render policy to the messages and returns an array of messages.
	 *
	 * @since TBD
	 *
	 * @return array An array of messages in the shape `[ <message_type> => [ ...<messages> ] ]`.
	 */
	public function to_array() {
		return $this->apply_render_strategy( $this->messages );
	}

	/**
	 * Applies the render strategy to the collection of messages.
	 *
	 * @since TBD
	 *
	 * @param array $messages The collection of messages to apply the render strategy to.
	 *
	 * @return array An array of messages after the current strategy application.
	 *               No matter the render strategy, the array always has shape
	 *              `[ <message_type> => [ ...<messages> ] ]`.
	 */
	protected function apply_render_strategy( array $messages = [] ) {
		if ( empty( $messages ) ) {
			return [];
		}

		$updated_messages = $this->messages;

		switch ($this->render_strategy) {
			case static::RENDER_STRATEGY_PRIORITY_LAST:
				array_walk( $updated_messages, static function ( array &$value, $message_type ) {
					ksort($value);
					// Keep only the last message.
					$highest = reset( $value );
					$value   = [ end( $highest ) ];
				} );
				break;
			case static::RENDER_STRATEGY_PRIORITY_FIRST:
				array_walk( $updated_messages, static function ( array &$value, $message_type ) {
					ksort($value);
					// Keep only the last message.
					$highest = reset( $value );
					$value   = [ reset( $highest ) ];
				} );
				break;
			default:
				break;
		}

		// Remove empty entries.
		return array_filter( $updated_messages );
	}

	/**
	 * Sets the render strategy that the collection should use to render the messages in the `to_array` method.
	 *
	 * @since TBD
	 *
	 * @param string $render_strategy One of the `RENDER_STRATEGY_` constants.
	 */
	public function set_render_strategy( $render_strategy ) {
		$this->render_strategy = $render_strategy;
	}

	/**
	 * Inserts a message in the collection, at a specific priority.
	 *
	 * @since TBD
	 *
	 * @param string $message_type    The type of message to insert, while there is no check on the type, the suggestion
	 *                                is to use one of the `TYPE_` constants.
	 * @param string $message         The message to insert.
	 * @param int    $priority        the priority of the message among the types; defaults to `10`. Similarly to the
	 *                                priority concept of WordPress filters, an higher number has a lower priority.
	 */
	public function insert( $message_type, $message, $priority = 10 ) {
		if ( empty( $this->messages[ $message_type ][ $priority ] ) ) {
			$this->messages[ $message_type ][ $priority ] = [ $message ];

			return;
		}
		$this->messages[ $message_type ][ $priority ][] = $message;
	}
}