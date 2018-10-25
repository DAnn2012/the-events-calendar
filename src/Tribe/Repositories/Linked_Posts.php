<?php
/**
 * The main ORM/Repository class for linked posts.
 *
 * @since TBD
 */

/**
 * Class Tribe__Events__Repositories__Linked_Posts
 *
 *
 * @since TBD
 */
class Tribe__Events__Repositories__Linked_Posts extends Tribe__Repository {

	/**
	 * The unique fragment that will be used to identify this repository filters.
	 *
	 * @var string
	 */
	protected $filter_name = 'linked_posts';

	/**
	 * Meta key used to store the Linked Post ID.
	 *
	 * @var string
	 */
	protected $linked_id_meta_key;

	/**
	 * Tribe__Events__Repositories__Linked_Posts constructor.
	 *
	 * Sets up the repository default parameters and schema.
	 *
	 * @since TBD
	 */
	public function __construct() {
		parent::__construct();

		$this->default_args = array(
			'post_type'                    => Tribe__Events__Venue::POSTTYPE,
			// We'll be handling the dates, let's mark the query as a non-filtered one.
			'tribe_suppress_query_filters' => true,
		);

		$this->schema = array_merge( $this->schema, array(
			'event' => array( $this, 'filter_by_event' ),
		) );
	}

	/**
	 * Filters linked post types by a specific event of set of events.
	 *
	 * @since TBD
	 *
	 * @param int|WP_Post|array $event Post ID, Post Object, or an array of Post IDs or Objects.
	 */
	public function filter_by_event( $event ) {
		if ( ! $this->linked_id_meta_key ) {
			return;
		}

		$events = (array) $event;

		$post_ids = array();

		foreach ( $events as $event_id_or_object ) {
			$post_id = Tribe__Events__Main::postIdHelper( $event_id_or_object );

			if ( ! $post_id ) {
				continue;
			}

			$post_ids[] = $post_id;
		}

		$post_ids = array_unique( $post_ids );

		if ( empty( $post_ids ) ) {
			return;
		}

		$in_pattern = array_fill( 0, count( $post_ids ), '%d' );
		$in_pattern = implode( ', ', $in_pattern );

		global $wpdb;

		$this->filter_query->join(
			$wpdb->prepare(
				"
					JOIN {$wpdb->postmeta} linked_posts_event
					ON ( {$wpdb->posts}.ID = linked_posts_event.meta_value AND linked_posts_event.meta_key = %s )
				",
				$this->linked_id_meta_key
			)
		);

		$this->filter_query->where(
			$wpdb->prepare(
				"linked_posts_event.post_id IN ( {$in_pattern} )",
				$post_ids
			)
		);
	}

}
