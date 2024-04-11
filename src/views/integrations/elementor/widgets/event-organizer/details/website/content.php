<?php
/**
 * View: Elementor Event Organizer widget header.
 *
 * You can override this template in your own theme by creating a file at
 * [your-theme]/tribe/events/integrations/elementor/widgets/event-organizer/details/website/content.php
 *
 * @since TBD
 *
 * @var array  $organizer The organizer ID.
 * @var Tribe\Events\Integrations\Elementor\Widgets\Event_Organizer $widget The widget instance.
 */

?>
<p <?php tribe_classes( $widget->get_website_base_class() ); ?>><?php echo wp_kses_post( $organizer['website'] ); ?></p>
