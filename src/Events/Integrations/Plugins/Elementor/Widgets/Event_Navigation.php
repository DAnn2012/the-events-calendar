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
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Text_Stroke;
use Elementor\Group_Control_Typography;
use TEC\Events\Integrations\Plugins\Elementor\Widgets\Contracts\Abstract_Widget;

/**
 * Class Widget_Event_Navigation
 *
 * @since   TBD
 *
 * @package TEC\Events\Integrations\Plugins\Elementor\Widgets
 */
class Event_Navigation extends Abstract_Widget {
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
			'header_tag' => $this->get_event_navigation_header_tag(),
			'prev_event' => $prev_event,
			'prev_link'  => tribe_get_event_link( $prev_event ),
			'next_event' => $next_event,
			'next_link'  => tribe_get_event_link( $next_event ),
			'label'      => $this->get_title(),
			'event_id'   => $this->get_event_id(),
		];
	}

	/**
	 * Get classes for the header element.
	 *
	 * @since TBD
	 *
	 * @return array
	 */
	public function get_header_classes(): array {
		$settings = $this->get_settings_for_display();
		$classes  = [
			$this->get_widget_class() . '--header',
		];

		$show_header = tribe_is_truthy( $settings['show_header'] ?? false );

		if ( ! $show_header ) {
			$classes[] = 'tribe-common-a11y-visual-hide';
		}

		return $classes;
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
	}

	/**
	 * Add styling controls for the widget.
	 *
	 * @since TBD
	 */
	protected function style_panel() {
		// Styling options.
		$this->styling_options();
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

		$this->add_control(
			'header_tag',
			[
				'label'       => esc_html__( 'HTML Tag', 'the-events-calendar' ),
				'type'        => Controls_Manager::SELECT,
				'description' => esc_html__( 'Choose the HTML tag to use for the navigation label read by screen readers.', 'the-events-calendar' ),
				'options'     => [
					'h1'   => 'H1',
					'h2'   => 'H2',
					'h3'   => 'H3',
					'h4'   => 'H4',
					'h5'   => 'H5',
					'h6'   => 'H6',
					'div'  => 'div',
					'span' => 'span',
					'p'    => 'p',
				],
				'default'     => 'h3',
			]
		);



		$this->add_control(
			'show_header',
			[
				'label'       => esc_html__( 'Show header', 'the-events-calendar' ),
				'type'        => Controls_Manager::SWITCHER,
				'description' => esc_html__( 'Choose to show the navigation label. When hidden it will still be visible to screen readers.', 'the-events-calendar' ),
				'label_on'    => esc_html__( 'Show', 'the-events-calendar' ),
				'label_off'   => esc_html__( 'Hide', 'the-events-calendar' ),
				'default'     => 'no',
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Add controls for text styling of the event nav.
	 *
	 * @since TBD
	 */
	protected function styling_options() {
		$this->start_controls_section(
			'styling_section_title',
			[
				'label' => $this->get_title(),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'color',
			[
				'label'     => esc_html__( 'Text Color', 'the-events-calendar' ),
				'type'      => Controls_Manager::COLOR,
				'global'    => [
					'default' => Global_Colors::COLOR_TEXT,
				],
				'selectors' => [
					'{{WRAPPER}} .' . $this->get_prev_class() . ' a' => 'color: {{VALUE}};',
					'{{WRAPPER}} .' . $this->get_next_class() . ' a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'hover-color',
			[
				'label'     => esc_html__( 'Text Hover Color', 'the-events-calendar' ),
				'type'      => Controls_Manager::COLOR,
				'global'    => [
					'default' => Global_Colors::COLOR_ACCENT,
				],
				'selectors' => [
					'{{WRAPPER}} .' . $this->get_prev_class() . ' a:hover'  => 'color: {{VALUE}};',
					'{{WRAPPER}} .' . $this->get_prev_class() . ' a:active' => 'color: {{VALUE}};',
					'{{WRAPPER}} .' . $this->get_prev_class() . ' a:focus'  => 'color: {{VALUE}};',
					'{{WRAPPER}} .' . $this->get_next_class() . ' a:hover'  => 'color: {{VALUE}};',
					'{{WRAPPER}} .' . $this->get_next_class() . ' a:active' => 'color: {{VALUE}};',
					'{{WRAPPER}} .' . $this->get_next_class() . ' a:focus'  => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'typography',
				'global'    => [
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				],
				'selectors' => [
					'{{WRAPPER}} .' . $this->get_list_class(),
				],
			]
		);

		$this->add_group_control(
			Group_Control_Text_Stroke::get_type(),
			[
				'name'     => 'text_stroke',
				'selector' => '{{WRAPPER}} .' . $this->get_list_class(),
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name'     => 'text_shadow',
				'selector' => '{{WRAPPER}} .' . $this->get_list_class(),
			]
		);

		$this->add_control(
			'blend_mode',
			[
				'label'     => esc_html__( 'Blend Mode', 'the-events-calendar' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => [
					''            => esc_html__( 'Normal', 'the-events-calendar' ),
					'multiply'    => esc_html__( 'Multiply', 'the-events-calendar' ),
					'screen'      => esc_html__( 'Screen', 'the-events-calendar' ),
					'overlay'     => esc_html__( 'Overlay', 'the-events-calendar' ),
					'darken'      => esc_html__( 'Darken', 'the-events-calendar' ),
					'lighten'     => esc_html__( 'Lighten', 'the-events-calendar' ),
					'color-dodge' => esc_html__( 'Color Dodge', 'the-events-calendar' ),
					'saturation'  => esc_html__( 'Saturation', 'the-events-calendar' ),
					'color'       => esc_html__( 'Color', 'the-events-calendar' ),
					'difference'  => esc_html__( 'Difference', 'the-events-calendar' ),
					'exclusion'   => esc_html__( 'Exclusion', 'the-events-calendar' ),
					'hue'         => esc_html__( 'Hue', 'the-events-calendar' ),
					'luminosity'  => esc_html__( 'Luminosity', 'the-events-calendar' ),
				],
				'selectors' => [
					'{{WRAPPER}} .' . $this->get_list_class() => 'mix-blend-mode: {{VALUE}}',
				],
				'separator' => 'none',
			]
		);

		$this->end_controls_section();
	}
}
