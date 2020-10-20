<?php
/**
 * List Widget
 *
 * @since   TBD
 *
 * @package Tribe\Events\Views\V2\Widgets
 */

namespace Tribe\Events\Views\V2\Widgets;

/**
 * Class for the List Widget.
 *
 * @since   TBD
 *
 * @package Tribe\Events\Views\V2\Widgets
 */
class Widget_List extends Widget_Abstract {
	/**
	 * {@inheritDoc}
	 *
	 * @var string
	 */
	protected $slug = 'tribe_events_list_widget';

	/**
	 * {@inheritDoc}
	 *
	 * @var string
	 */
	protected $view_slug = 'widget-list';

	/**
	 * {@inheritDoc}
	 *
	 * @var string
	 */
	protected $view_admin_slug = 'widgets/list';

	/**
	 * {@inheritDoc}
	 *
	 * @var array<string,mixed>
	 */
	protected $default_arguments = [
		// View options.
		'view'                 => null,
		'should_manage_url'    => false,

		// Event widget options.
		'id'                   => null,
		'alias-slugs'          => null,
		'title'                => '',
		'limit'                => 5,
		'no_upcoming_events'   => false,
		'featured_events_only' => false,
		'jsonld_enable'        => true,

		// WP_Widget properties.
		'id_base'              => 'tribe-events-list-widget',
		'name'                 => null,
		'widget_options'       => [
			'classname'   => 'tribe-events-list-widget',
			'description' => null,
		],
		'control_options'      => [
			'id_base' => 'tribe-events-list-widget',
		],
	];

	protected function setup_default_arguments() {
		$default_arguments = parent::setup_default_arguments();

		$default_arguments['description'] = esc_html_x( 'A widget that displays upcoming events.',
			'The description of the List Widget.', 'the-events-calendar' );
		// @todo update name once this widget is ready to replace the existing list widget.
		$default_arguments['name']                          = esc_html_x( 'Events List V2', 'The name of the widget.',
			'the-events-calendar' );
		$default_arguments['widget_options']['description'] = esc_html_x( 'A widget that displays upcoming events.',
			'The description of the List Widget.', 'the-events-calendar' );

		// Setup default title.
		$default_arguments['title'] = _x( 'Upcoming Events', 'The default title of the List Widget.',
			'the-events-calendar' );

		return $default_arguments;
	}

	/**
	 * {@inheritDoc}
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags (if needed) and update the widget settings. */
		$instance['title']                = wp_strip_all_tags( $new_instance['title'] );
		$instance['limit']                = $new_instance['limit'];
		$instance['no_upcoming_events']   = ! empty( $new_instance['no_upcoming_events'] );
		$instance['featured_events_only'] = ! empty( $new_instance['featured_events_only'] );
		$instance['jsonld_enable']        = (int) ( ! empty( $new_instance['jsonld_enable'] ) );

		return $this->filter_updated_instance( $instance );
	}

	/**
	 * {@inheritDoc}
	 */
	public function get_admin_fields() {

		return [
			'title'                => [
				'label' => _x( 'Title:', 'The label for the field of the title of the List Widget.','the-events-calendar' ),
				'type'  => 'text',
			],
			'limit'                => [
				'label'   => _x( 'Show:', 'The label for the amount of events to show in the List Widget.', 'the-events-calendar' ),
				'type'    => 'dropdown',
				'options' => $this->get_limit_options(),
			],
			'no_upcoming_events'   => [
				'label' => _x( 'Show widget only if there are upcoming events', 'The label for the option to hide the List Widget if no upcoming events.', 'the-events-calendar' ),
				'type'  => 'checkbox',
			],
			'featured_events_only' => [
				'label' => _x( 'Limit to featured events only', 'The label for the option to only show featured events in the List Widget.', 'events list widget setting', 'the-events-calendar' ),
				'type'  => 'checkbox',
			],
			'jsonld_enable'        => [
				'label' => _x( 'Generate JSON-LD data', 'The label for the option to enable JSONLD on the List Widget.', 'the-events-calendar' ),
				'type'  => 'checkbox',
			],

		];
	}

	/**
	 * Get the options to use in a the limit dropdown.
	 *
	 * @since TBD
	 *
	 * @return array<string,mixed> An array of options with the text and value included.
	 */
	public function get_limit_options() {
		/**
		 * Filter the max limit of events to display in the List Widget.
		 *
		 * @since TBD
		 *
		 * @param int The max limit of events to display in the List Widget, default 10.
		 */
		$events_limit = apply_filters( 'tribe_events_widget_list_events_max_limit', 10 );

		$options = [];

		foreach ( range( 1, $events_limit ) as $i ) {
			$options[] = [
				'text'  => $i,
				'value' => $i,
			];
		}

		return $options;
	}

	protected function args_to_context( array $arguments, Context $context ) {
		$alterations =  parent::args_to_context( $arguments, $context );

		// featured
		if ( tribe_is_truthy( $arguments['feature_events_only'] ) ) {
			$alterations['featured'] = true;
		}

		// posts_per_page
		if ( ! isset( $arguments['limit'] ) ) {
			$alterations['events_per_page'] = 5;
		} else {
			// Ignore any 0 and negative values.
			$alterations['events_per_page'] = (int) $arguments['limit'] > 0 ? (int) $arguments['limit'] : 5;
		}

		// This might require emptying some Context locations to remove stuff that does not apply in a widget View.

		return $alterations;
	}
}
