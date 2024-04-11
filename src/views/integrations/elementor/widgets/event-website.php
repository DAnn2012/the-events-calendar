<?php
/**
 * View: Elementor Event Website widget.
 *
 * You can override this template in your own theme by creating a file at
 * [your-theme]/tribe/events/integrations/elementor/widgets/event-website.php
 *
 * @since TBD
 *
 * @var string        $align                The text alignment.
 * @var string        $show_website_header  Whether to show the header.
 * @var string        $header_tag           The HTML tag for the header.
 * @var string        $header_class         The class for the link header.
 * @var string        $link_class           The class for the link.
 * @var string        $website              The event website link.
 * @var Event_Website $widget               The widget instance.
 */

use TEC\Events\Integrations\Plugins\Elementor\Widgets\Event_Website;

if ( ! $this->has_event() ) {
	return;
}

$website = tribe_get_event_website_url( $this->get_event() );

if ( empty( $website ) ) {
	return;
}

?>
<div <?php tribe_classes( $widget->get_element_classes() ); ?>>
	<?php $this->template( 'views/integrations/elementor/widgets/event-website/header' ); ?>
	<?php $this->template( 'views/integrations/elementor/widgets/event-website/link' ); ?>
</div>
