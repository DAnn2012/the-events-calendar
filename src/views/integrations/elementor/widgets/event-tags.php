<?php
/**
 * View: Elementor Event Tags widget.
 *
 * You can override this template in your own theme by creating a file at
 * [your-theme]/tribe/events/integrations/elementor/widgets/event-tags.php
 *
 * @since TBD
 *
 * @var bool       $show_tags_header Whether to show the header.
 * @var string     $header_tag       The HTML tag for the header.
 * @var string     $label_text       The label text.
 * @var array      $tags             The event tags.
 * @var Event_Tags $widget           The widget instance.
 */

use TEC\Events\Integrations\Plugins\Elementor\Widgets\Event_Tags;

// No tags, no render.
if ( empty( $tags ) ) {
	return;
}
?>
<div <?php tribe_classes( $widget->get_element_classes() ); ?>>
	<?php
	$this->template( 'views/integrations/elementor/widgets/event-tags/header' );
	?>
	<div <?php tribe_classes( $widget->get_links_class() ); ?>>
		<?php
		$tag_count = count( $tags );
		$count     = 0;
		foreach ( $tags as $tag_name => $tag_link ) {
			++$count;
			$this->template(
				'views/integrations/elementor/widgets/event-tags/content',
				[
					'tag_name' => $tag_name,
					'tag_link' => $tag_link,
					'last'     => $count === $tag_count,
				]
			);
		}
		?>
	</div>
</div>
