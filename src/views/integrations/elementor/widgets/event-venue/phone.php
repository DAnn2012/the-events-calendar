<?php
/**
 * View: Elementor Single Event Venue widget hone.
 *
 * You can override this template in your own theme by creating a file at
 * [your-theme]/tribe/events/integrations/elementor/widgets/venue/event-venue/phone.php
 *
 * @since TBD
 *
 * @var bool   $show         Whether to show the venue phone section.
 * @var bool   $show_header Whether to show the phone header.
 * @var string $header_tag   The HTML tag to use for the phone header.
 * @var string $header_text  The phone header text.
 * @var string $venue_id     The venue ID.
 * @var array  $settings     The widget settings.
 * @var int    $event_id     The event ID.
 * @var Tribe\Events\Pro\Integrations\Elementor\Widgets\Event_Venue $widget The widget instance.
 */

if ( empty( $show ) ) {
	return;
}
?>
<div <?php tribe_classes( $widget->get_phone_base_class() ); ?> >
	<?php
	$this->template(
		'views/integrations/elementor/widgets/event-venue/phone/header',
		[
			'show'        => $show_header,
			'header_tag'  => $header_tag,
			'header_text' => $header_text,
			'venue_id'    => $venue_id,
			'settings'    => $settings,
			'event_id'    => $event_id,
			'widget'      => $widget,
		]
	);

	$this->template(
		'views/integrations/elementor/widgets/event-venue/phone/phone',
		[
			'venue_id' => $venue_id,
			'settings' => $settings,
			'event_id' => $event_id,
			'widget'   => $widget,
		]
	);
	?>
</div>