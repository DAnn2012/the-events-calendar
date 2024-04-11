<?php
/**
 * Event Nav Elementor Widget.
 *
 * @since   TBD
 *
 * @package TEC\Events\Integrations\Plugins\Elementor\Widgets
 */

namespace TEC\Events\Integrations\Plugins\Elementor\Widgets;

use Elementor\Controls_Manager;
use TEC\Events\Integrations\Plugins\Elementor\Widgets\Contracts\Abstract_Widget;

/**
 * Class Widget_Event_Navigation
 *
 * @since   TBD
 *
 * @package TEC\Events\Integrations\Plugins\Elementor\Widgets
 */
class Event_Navigation extends Abstract_Widget {
	use Traits\With_Shared_Controls;
	use Traits\Has_Preview_Data;
	use Traits\Event_Query;

	/**
	 * Widget slug.
	 *
	 * @since TBD
	 *
	 * @var string
	 */
	protected static string $slug = 'event_navigation';

	/**
	 * Whether the widget has styles to register/enqueue.
	 *
	 * @since TBD
	 *
	 * @var bool
	 */
	protected static bool $has_styles = true;

	/**
	 * Create the widget title.
	 *
	 * @since TBD
	 *
	 * @return string
	 */
	protected function title(): string {
		return esc_html__( 'Event Navigation', 'the-events-calendar' );
	}

	/**
	 * Get the template args for the event nav widget.
	 *
	 * @since TBD
	 */
	protected function template_args(): array {
		$adjacent_events = tribe( 'tec.adjacent-events' );
		$adjacent_events->set_current_event_id( $this->get_event_id() );
		$next_event = $adjacent_events->get_closest_event( 'next' );
		$prev_event = $adjacent_events->get_closest_event( 'previous' );

		return [
			'show_nav_header' => tribe_is_truthy( $this->get_settings_for_display( 'show_nav_header' ) ?? false ),
			'header_tag'      => $this->get_event_navigation_header_tag(),
			'header_text'     => $this->get_header_text(),
			'prev_event'      => $prev_event,
			'prev_link'       => tribe_get_event_link( $prev_event ),
			'next_event'      => $next_event,
			'next_link'       => tribe_get_event_link( $next_event ),
		];
	}

	/**
	 * Get the template args for the widget preview.
	 *
	 * @since TBD
	 *
	 * @return array The template args for the preview.
	 */
	protected function preview_args(): array {
		$prev_event             = new \stdClass();
		$next_event             = new \stdClass();
		$prev_event->post_title = 'Previous Event';
		$next_event->post_title = 'Next Event';

		return [
			'show_nav_header' => tribe_is_truthy( $this->get_settings_for_display( 'show_nav_header' ) ?? false ),
			'header_tag'      => $this->get_event_navigation_header_tag(),
			'header_text'     => $this->get_header_text(),
			'prev_event'      => $prev_event,
			'prev_link'       => '#',
			'next_event'      => $next_event,
			'next_link'       => '#',
		];
	}

	/**
	 * Determine the HTML tag to use for the event nav based on settings.
	 *
	 * @since TBD
	 *
	 * @return string The HTML tag to use for the event nav.
	 */
	protected function get_event_navigation_header_tag() {
		$settings = $this->get_settings_for_display();

		return $settings['header_tag'] ?? 'h3';
	}

	/**
	 * Get the header text for the event nav.
	 *
	 * @since TBD
	 *
	 * @return string The header text for the event nav.
	 */
	protected function get_header_text(): string {
		$title = tribe_get_event_label_plural();

		/**
		 * Filters the header text for the event nav.
		 *
		 * @since TBD
		 *
		 * @param string $title The header text for the event nav.
		 */
		return (string) apply_filters( 'tribe_events_elementor_widget_event_navigation_header_text', $title );
	}

	/**
	 * Get classes for the header element.
	 *
	 * @since TBD
	 *
	 * @return string The class for the header element.
	 */
	public function get_header_class(): string {
		return $this->get_widget_class() . '--header';
	}

	/**
	 * Get the class for the next link.
	 *
	 * @since TBD
	 *
	 * @return string The class for the element.
	 */
	public function get_next_class(): string {
		return $this->get_widget_class() . '--next';
	}

	/**
	 * Get the class for the pervious link.
	 *
	 * @since TBD
	 *
	 * @return string The class for the element.
	 */
	public function get_prev_class(): string {
		return $this->get_widget_class() . '--previous';
	}

	/**
	 * Get the class for the link list.
	 *
	 * @since TBD
	 *
	 * @return string The class for the element.
	 */
	public function get_list_class(): string {
		return $this->get_widget_class() . '--subnav';
	}

	/**
	 * Register controls for the widget.
	 *
	 * @since TBD
	 */
	protected function register_controls() {
		// Content tab.
		$this->content_panel();
		// Style tab.
		$this->style_panel();
	}

	/**
	 * Add content controls for the widget.
	 *
	 * @since TBD
	 */
	protected function content_panel() {
		$this->content_options();
		$this->add_event_query_section();
	}

	/**
	 * Add styling controls for the widget.
	 *
	 * @since TBD
	 */
	protected function style_panel() {
		$this->header_styling_options();
		$this->content_styling_options();
		$this->content_hover_styling_options();
	}

	/**
	 * Add controls for text content of the event nav.
	 *
	 * @since TBD
	 */
	protected function content_options() {
		$this->start_controls_section(
			'section_title',
			[
				'label' => $this->get_title(),
			]
		);

		$this->add_shared_control(
			'show',
			[
				'id'      => 'show_nav_header',
				'label'   => esc_html__( 'Show header', 'the-events-calendar' ),
				'default' => 'no',
			]
		);

		$this->add_shared_control(
			'tag',
			[
				'id'          => 'header_tag',
				'label'       => esc_html__( 'Header HTML Tag', 'the-events-calendar' ),
				'description' => esc_html__( 'Choose the HTML tag to use for the navigation label read by screen readers.', 'the-events-calendar' ),
				'condition'   => [
					'show_nav_header' => 'yes',
				],
			]
		);

		$this->end_controls_section();
	}
	/**
	 * Add controls for text styling of the event nav header.
	 *
	 * @since TBD
	 */
	protected function header_styling_options() {
		$this->start_controls_section(
			'header_styling_section',
			[
				'label'     => esc_html__( 'Header Styling', 'the-events-calendar' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_nav_header' => 'yes',
				],
			]
		);

		$this->add_shared_control(
			'typography',
			[
				'prefix'   => 'header',
				'selector' => '{{WRAPPER}} .' . $this->get_header_class(),
			]
		);

		$this->add_shared_control(
			'alignment',
			[
				'id'        => 'header_align',
				'selectors' => [ '{{WRAPPER}} .' . $this->get_header_class() ],
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Add controls for text styling of the event nav content.
	 *
	 * @since TBD
	 */
	protected function content_styling_options() {
		$this->start_controls_section(
			'content_styling_section',
			[
				'label' => esc_html__( 'Link Styling', 'the-events-calendar' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_shared_control(
			'typography',
			[
				'prefix'   => 'content',
				'selector' => '{{WRAPPER}} .' . $this->get_list_class() . ' a',
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Add controls for text styling of the event nav content.
	 *
	 * @since TBD
	 */
	protected function content_hover_styling_options() {
		$this->start_controls_section(
			'content_hover_styling_section',
			[
				'label' => esc_html__( 'Link Hover Styling', 'the-events-calendar' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_shared_control(
			'typography',
			[
				'prefix'   => 'content_hover',
				'selector' => '{{WRAPPER}} .' . $this->get_list_class() . ' a:hover',
			]
		);

		$this->end_controls_section();
	}
}
