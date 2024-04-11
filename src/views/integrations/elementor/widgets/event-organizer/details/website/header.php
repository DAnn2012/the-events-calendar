<?php
/**
 * View: Elementor Event Organizer widget website section header.
 *
 * You can override this template in your own theme by creating a file at
 * [your-theme]/tribe/events/integrations/elementor/widgets/event-organizer/details/website/header.php
 *
 * @since TBD
 *
 * @var bool   $show        Whether to show the organizer website header.
 * @var string $header_tag  The HTML tag to use for the header.
 * @var string $header_text The header text.
 * @var array  $organizer   The organizer ID.
 * @var Tribe\Events\Integrations\Elementor\Widgets\Event_Organizer $widget The widget instance.
 */

if ( ! $show_organizer_website_header ) {
	return;
}
?>

<<?php echo tag_escape( $organizer_website_header_tag ); ?> <?php tribe_classes( $widget->get_website_header_class() ); ?>>
	<?php echo wp_kses_post( $organizer_website_header_text ); ?>
</<?php echo tag_escape( $organizer_website_header_tag ); ?>>
