<?php
/**
 * The Events Calendar Template Tags
 *
 * Display functions for use in WordPress templates.
 */

// Don't load directly
if ( !defined('ABSPATH') ) { die('-1'); }

if( class_exists( 'TribeEvents' ) ) {

	/**
	 * Get Options
	 *
	 * Retrieve specific key from options array, optionally provide a default return value
	 *
	 * @param string $optionName Name of the option to retrieve.
	 * @param string $default Value to return if no such option is found.
	 * @return mixed Value of the option if found.
	 * @todo Abstract this function out of template tags or otherwise secure it from other namespace conflicts.
	 * @since 2.0
	 */
	function tribe_get_option($optionName, $default = '')  {
		$tribe_ecp = TribeEvents::instance();
		return $tribe_ecp->getOption($optionName, $default);
	}

	/**
	 * Event Type Test
	 *
	 * Checks type of $postId to determine if it is an Event
	 *
	 * @param int $postId (optional)
	 * @return bool true if this post is an Event post type
	 * @since 2.0
	 */
	function tribe_is_event( $postId = null )  {
		return TribeEvents::instance()->isEvent($postId);
	}
	
	/**
	 * Get Event
	 *
	 * Queries the events using WordPress get_posts() by setting the post type and sorting by event date.
	 *
	 * @param array $args query vars with added defaults including post_type of events, sorted (orderby) by event date (order) ascending
	 * @return array List of posts.
	 * @link http://codex.wordpress.org/Template_Tags/get_posts
	 * @link http://codex.wordpress.org/Function_Reference/get_post
	 * @uses get_posts()
	 * @see get_posts()
	 * @since 2.0
	 */
	function tribe_get_events( $args = '' )  {
		$tribe_ecp = TribeEvents::instance();
		return $tribe_ecp->getEvents( $args );
	}

	/**
	 * All Day Event Test
	 *
	 * Returns true if the event is an all day event
	 *
	 * @param int $postId (optional)
	 * @return bool
	 * @since 2.0
	 */
	function tribe_get_all_day( $postId = null )  {
		$postId = TribeEvents::postIdHelper( $postId );
		return !! tribe_get_event_meta( $postId, '_EventAllDay', true );
	}
	
	/**
	 * Multi-day Event Test
	 *
	 * Returns true if the event spans multiple days
	 *
	 * @param int $postId (optional)
	 * @return bool true if event spans multiple days
	 * @since 2.0
	 */
	function tribe_is_multiday( $postId = null)  {
		$postId = TribeEvents::postIdHelper( $postId );
		$start = (array)tribe_get_event_meta( $postId, '_EventStartDate', false );
		sort($start);
		$start = strtotime($start[0]);
		$end = strtotime(tribe_get_event_meta( $postId, '_EventEndDate', true ));
		return date('d-m-Y', $start) != date('d-m-Y', $end);
	}

	/**
	 * Event Categories (Display)
	 *
	 * Display the event categories
	 *
	 * @param string $label
	 * @param string $separator
	 * @uses the_terms()
	 * @since 2.0
	 */	
	function tribe_meta_event_cats( $label=null, $separator=', ')  {
		if( !$label ) { $label = __('Category:', 'tribe-events-calendar'); }

		$tribe_ecp = TribeEvents::instance();
		the_terms( get_the_ID(), $tribe_ecp->get_event_taxonomy(), '<dt>'.$label.'</dt><dd>', $separator, '</dd>' );
	}

	/**
	 * Event Post Meta
	 *
	 * Get event post meta.
	 *
	 * @param int $postId (optional)
	 * @param string $meta name of the meta_key
	 * @param bool $single determines if the results should be a single item or an array of items.
	 * @return mixed meta value(s)
	 * @since 2.0
	 */
	function tribe_get_event_meta( $postId = null, $meta = false, $single = true ){
		$postId = TribeEvents::postIdHelper( $postId );
		$tribe_ecp = TribeEvents::instance();
		return $tribe_ecp->getEventMeta( $postId, $meta, $single );
	}
	
	/**
	 * Event Category Name
	 *
	 * Return the current event category name based the url.
	 *
	 * @return string Name of the Event Category
	 * @since 2.0
	 */ 
	function tribe_meta_event_category_name() {
		$tribe_ecp = TribeEvents::instance();
		$current_cat = get_query_var('tribe_events_cat');
		if($current_cat){
			$term_info = get_term_by('slug',$current_cat,$tribe_ecp->get_event_taxonomy());
			return $term_info->name;
		}
	}
		
	/**
	 * Current Template
	 *
	 * Get the current page template that we are on
	 *
	 * @todo Update the function name to ensure there are no namespace conflicts.
	 * @return string Page template
	 * @since 2.0
	 */
	function tribe_get_current_template() {
		return TribeEventsTemplates::get_current_page_template();
	}

	/**
	 * Venue Type Test
	 *
	 * Checks type of $postId to determine if it is a Venue
	 *
	 * @param int $postId (optional)
	 * @return bool True if post type id Venue
	 * @since 2.0
	 */
	function tribe_is_venue( $postId = null )  {
		$tribe_ecp = TribeEvents::instance();
		return $tribe_ecp->isVenue($postId);
	}

	/**
	 * HTML Before Event (Display)
	 *
	 * Display HTML to output before the event template
	 *
	 * @since 2.0
	 */
	function tribe_events_before_html() {
		echo stripslashes(tribe_get_option('spEventsBeforeHTML'));
	}

	/**
	 * HTML After Event (Display)
	 *
	 * Display HTML to output after the event template
	 *
	 * @since 2.0
	 */
	function tribe_events_after_html() {
		echo stripslashes(tribe_get_option('spEventsAfterHTML'));
	}
	
	/**
	 * Event Cost
	 *
	 * If EventBrite plugin is active
	 * - If the event is registered in eventbrite, and has one ticket. Return the cost of that ticket.
	 * - If the event is registered in eventbrite, and there are many tickets, return "Varies"
	 *   - If the event is not registered in eventbrite, and there is meta, return that.
	 *   - If the event is not registered in eventbrite, and there is no meta, return ""
	 *
	 * @param int $postId (optional)
	 * @return string Cost of the event.
	 */
	function tribe_get_cost( $postId = null)  {
		$tribe_ecp = TribeEvents::instance();
		$postId = TribeEvents::postIdHelper( $postId );
		if( class_exists( 'Eventbrite_for_TribeEvents' ) ) {
			global $spEventBrite;
			$returned = $spEventBrite->tribe_get_cost($postId);
			if($returned) {
				return esc_html($returned);
			}
		}

		$cost = tribe_get_event_meta( $postId, '_EventCost', true );

		if($cost === ''){
			$cost = '';
		}elseif($cost == '0'){
			$cost = __( "Free", 'tribe-events-calendar' );
		}else{
			$cost = esc_html($cost);
		}

		return apply_filters( 'tribe_get_cost', $cost );
	}

}
?>