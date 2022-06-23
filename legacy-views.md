# Changelog legacy views removal

## Files Removed

* `src/functions/template-tags/widgets.php`
* `src/functions/template-tags/options.php`
* `src/admin-views/widget-admin-list.php`
* `src/views/modules/bar.php`
* `src/views/widgets/list-widget.php`
* `src/views/widgets/calendar-widget.php`
* `src/views/day.php`
* `src/views/day/content.php`
* `src/views/day/loop.php`
* `src/views/day/nav.php`
* `src/views/day/single-event.php`
* `src/views/day/title-bar.php`
* `src/views/list.php`
* `src/views/list/content.php`
* `src/views/list/loop.php`
* `src/views/list/nav.php`
* `src/views/list/single-event.php`
* `src/views/list/single-featured.php`
* `src/views/list/title-bar.php`
* `src/views/month.php`
* `src/views/month/content.php`
* `src/views/month/loop-grid.php`
* `src/views/month/mobile.php`
* `src/views/month/nav.php`
* `src/views/month/single-day.php`
* `src/views/month/single-event.php`
* `src/views/month/title-bar.php`
* `src/views/month/tooltip.php`
* `src/resources/js/tribe-events-ajax-list.js`
* `src/resources/js/tribe-events-ajax-day.js`
* `src/resources/js/tribe-events-ajax-calendar.js`
* `src/resources/js/tribe-events-bar.js`
* `src/resources/js/tribe-events-calendar-script.js`
  * Filterbar usage of `tribe-events-calendar-script`
* `src/resources/postcss/tribe-events-pro-full.pcss`
* `src/resources/postcss/tribe-events-pro-full-mobile.pcss`
* `src/resources/postcss/tribe-events-pro-skeleton.pcss`
* `src/resources/postcss/tribe-events-pro-theme.pcss`
* `src/resources/postcss/tribe-events-pro-theme-mobile.pcss`

## Classes moved to `src/deprecated`

* `Tribe__Events__List_Widget` - modified to extend the new List Widget and deprecate publicly accessible methods.

## Classes Removed

* `TribeEventsListWidget`
* `Tribe__Events__Asset__Abstract_Asset`
* `Tribe__Events__Asset__Abstract_Events_Css`
* `Tribe__Events__Asset__Admin`
* `Tribe__Events__Asset__Admin_Menu`
* `Tribe__Events__Asset__Admin_Ui`
* `Tribe__Events__Asset__Ajax_Calendar`
* `Tribe__Events__Asset__Ajax_Dayview`
* `Tribe__Events__Asset__Ajax_List`
* `Tribe__Events__Asset__Bootstrap_Datepicker`
* `Tribe__Events__Asset__Calendar_Script`
* `Tribe__Events__Asset__Chosen`
* `Tribe__Events__Asset__Datepicker`
* `Tribe__Events__Asset__Dialog`
* `Tribe__Events__Asset__Dynamic`
* `Tribe__Events__Asset__Ecp_Plugins`
* `Tribe__Events__Asset__Events_Css`
* `Tribe__Events__Asset__Events_Css_Default`
* `Tribe__Events__Asset__Events_Css_Full`
* `Tribe__Events__Asset__Events_Css_Skeleton`
* `Tribe__Events__Asset__Factory`
* `Tribe__Events__Asset__Jquery_Placeholder`
* `Tribe__Events__Asset__Jquery_Resize`
* `Tribe__Events__Asset__PHP_Date_Formatter`
* `Tribe__Events__Asset__Settings`
* `Tribe__Events__Asset__Smoothness`
* `Tribe__Events__Asset__Tribe_Events_Bar`
* `Tribe__Events__Asset__Tribe_Select2`
* `Tribe__Events__Template__Day`
* `Tribe_Events_Day_Template`
* `Tribe__Events__Template__List`
* `Tribe_Events_List_Template`
* `Tribe__Events__Template__Month`
  * [x] There are usages of this in Filter Bar
* `Tribe_Events_Month_Template`
* `Tribe__Template_Factory`
  * [ ] There are usages of this in Event Tickets
* `Tribe_Template_Factory`
* `TribeEventsQuery`
* `TribeEventsTemplates`
* `TribeRecurringEventCleanup`
* `Tribe__Events__Recurring_Event_Cleanup`
* `TribeEventsBar`
* `Tribe__Events__Bar`
  * [ ] `tec.bar` in Events Pro
* `Tribe__Events__Backcompat`
* `Tribe\Events\Views\V2\V1_Compat`
* `Tribe__Events__Admin__Front_Page_View`
* `Tribe__Events__Admin__Notices__Base_Notice`
* `Tribe__Events__Admin__Notices__Notice_Interface`
* `Tribe__Events__Admin__Organizer_Chooser_Meta_Box`
* `Tribe__Events__Advanced_Functions__Register_Meta`
* `Tribe__Events__Aggregator__Record__Facebook`
* `Tribe__Events__Customizer__Front_Page_View`
* `Tribe__Events__Customizer__Text`
* `Tribe__Events__Google_Data_Markup`
* `Tribe__Events__Google_Data_Markup__Event`
* `Tribe__Events__Importer__Admin_Page`
* `Tribe__Events__Importer__Options`
* `Tribe__Events__Importer__Plugin`
* `Tribe__Events__Meta_Factory`
* `Tribe__Events__PUE__Checker`
* `Tribe__Events__PUE__Plugin_Info`
* `Tribe__Events__PUE__Utility`
* `Tribe_Amalgamator`
* `Tribe_Events_Single_Event_Template`
* `Tribe_Meta_Factory`
* `Tribe_PU_PluginInfo`
* `Tribe_Register_Meta`
* `TribeAppShop`
* `TribeDateUtils`
* `TribeEvents`
* `TribeEvents_EmbeddedMaps`
* `TribeEventsAdminList`
* `TribeEventsAPI`
* `TribeEventsCache`
* `TribeEventsCacheListener`
* `TribeEventsImporter_AdminPage`
* `TribeEventsImporter_ColumnMapper`
* `TribeEventsImporter_FileImporter`
* `TribeEventsImporter_FileImporter_Events`
* `TribeEventsImporter_FileImporter_Organizers`
* `TribeEventsImporter_FileImporter_Venues`
* `TribeEventsImporter_FileReader`
* `TribeEventsImporter_FileUploader`
* `TribeEventsImporter_Plugin`
* `TribeEventsOptionsException`
* `TribeEventsPostException`
* `TribeEventsSupport`
* `TribeEventsUpdate`
* `TribeEventsViewHelpers`
* `TribeField`
* `TribeiCal`
* `TribePluginUpdateEngineChecker`
* `TribePluginUpdateUtility`
* `TribeSettings`
* `TribeSettingsTab`
* `TribeValidate`

## Methods marked as deprecated

* `Tribe__Events__Main::add_new_organizer`
* `Tribe__Events__Main::default_view`
  * [ ] Pro makes use of this method
* `Tribe__Events__Main::fullAddress`
* `Tribe__Events__Main::fullAddressString`
* `Tribe__Events__Main::getDateStringShortened`
* `Tribe__Events__Main::getPostTypes`
  * [ ] Community Events makes use, replace with `Tribe__Main::get_post_types()`
* `Tribe__Events__Main::googleCalendarLink`
* `Tribe__Events__Main::googleMapLink`
* `Tribe__Events__Main::monthNames`
* `Tribe__Events__Main::nextMonth`
  * [ ] Pro makes use of this method
* `Tribe__Events__Main::previousMonth`
  * [ ] Pro makes use of this method
* `Tribe__Events__Main::setDisplay`
  * [ ] Investigate `Tribe__Events__Main->displaying`

## Functions moved to `src/functions/template-tags/deprecated`

* `tribe_events_the_header_attributes` - logic stripped out.
* `tribe_get_next_day_date`
* `tribe_get_previous_day_date`

## Functions/methods refactored

* `tribe_events_is_view_enabled` - refactored to use Views\V2\Manager.
  * [ ] Pro make use of this
* `tribe_is_ajax_view_request` - switched to use tribe_context() and the Manager.
* `tribe_meta_event_category_name` - refactored to use tribe_context().

## Functions/Methods Removed

* `tribe_get_list_widget_events`
* `Tribe__Events__Main::register_list_widget`
* `Tribe__Events__Main::init_day_view` - [BTRIA-620]
* `Tribe__Events__Main::eventQueryVars`
* `Tribe__Events__Main::ecpActive`
* `Tribe__Events__Main::dateHelper`
* `Tribe__Events__Main::dateToTimeStamp`
* `Tribe__Events__Main::defaultValueReplaceEnabled`
* `Tribe__Events__Main::addHelpAdminMenuItem`
* `Tribe__Events__Main::getNotices`
* `Tribe__Events__Main::removeNotice`
* `Tribe__Events__Main::isNotice`
* `Tribe__Events__Main::setNotice`
* `Tribe__Events__Main::renderDebug`
* `Tribe__Events__Main::debug`
* `Tribe__Events__Main::truncate`
* `Tribe__Events__Main::saveAllTabsHidden`
* `Tribe__Events__Main::doNetworkSettingTab`
* `Tribe__Events__Main::addNetworkOptionsPage`
* `Tribe__Events__Main::setNetworkOptions`
* `Tribe__Events__Main::getNetworkOption`
* `Tribe__Events__Main::getNetworkOptions`
* `Tribe__Events__Main::setOption`
* `Tribe__Events__Main::setOptions`
* `Tribe__Events__Main::getOption`
* `Tribe__Events__Main::getOptions`
* `Tribe__Events__Main::getTagRewriteSlug`
* `Tribe__Events__Main::getTaxRewriteSlug`
* `Tribe__Events__Main::doHelpTab`
* `Tribe__Events__Main::doSettingTabs`
* `Tribe__Events__Main::array_insert_before_key`
* `Tribe__Events__Main::array_insert_after_key`
* `Tribe__Events__Main::add_post_type_to_edit_term_link`
* `Tribe__Events__Main::prepare_to_fix_tagcloud_links`
* `Tribe__Events__Main::saved_organizers_dropdown`
* `Tribe__Events__Main::saved_venues_dropdown`
* `Tribe__Events__Main::set_meta_factory_global`
* `Tribe__Events__Main::initOptions`
* `Tribe__Events__Main::loadTextDomain`
* `Tribe__Events__Main::common`
* `Tribe__Events__Main::issue_noindex`
* `Tribe__Events__Main::displayEventOrganizerDropdown`
* `Tribe__Events__Main::displayEventVenueDropdown`
* `Tribe__Events__Main::checkAddOnCompatibility`
* `Tribe__Events__Main::maybe_delay_activation_if_outdated_common`
* `Tribe__Events__Main::is_delayed_activation`
* `Tribe__Events__Main::get_event_link`
* `Tribe__Events__Main::get_closest_event`
* `Tribe__Events__Main::setPostExceptionThrown`
* `Tribe__Events__Main::getPostExceptionThrown`
* `Tribe__Events__Main::manage_preview_metapost`
* `Tribe__Events__Main::setDashicon`
* `Tribe__Events__Main::printLocalizedAdmin`
* `Tribe__Events__Main::localizeAdmin`
* `Tribe__Events__Main::asset_fixes`
* `Tribe__Events__Main::add_admin_assets`
* `Tribe__Events__Main::loadStyle`
* `Tribe__Events__Main::enqueue_wp_admin_menu_style`
* `Tribe__Events__Main::get_closest_event_where`
* `Tribe__Events__Main::setup_listview_in_bar`
* `Tribe__Events__Main::setup_gridview_in_bar`
* `Tribe__Events__Main::setup_dayview_in_bar`
* `Tribe__Events__Main::setup_date_search_in_bar`
* `Tribe__Events__Main::remove_hidden_views`
* `Tribe__Events__Main::setup_keyword_search_in_bar`
* `Tribe__Events__Main::OrganizerMetaBox`
* `Tribe__Events__Main::VenueMetaBox`
* `Tribe__Events__Main::EventsChooserBox`
* `Tribe__Events__Main::normalize_organizer_submission`
* `Tribe__Events__Main::get_i18n_strings_for_domains`
* `Tribe__Events__Main::get_i18n_strings`
* `Tribe__Events__Main::redirect_past_upcoming_view_urls`
* `Tribe__Events__Main::getOrganizerPostTypeArgs`
* `Tribe__Events__Main::getVenuePostTypeArgs`
  * [ ] Pro makes use of this method, replace with `Tribe__Events__Venue::instance()->post_type_args`
* `Tribe__Events__Main::disable_pro`
* `Tribe__Events__Main::template_redirect`
* `Tribe__Events__Main::handle_submit_bar_redirect`
* `Tribe__Events__Main::print_noindex_meta`
  * [ ] Confirm why we might have removed this from our Views.
* `Tribe__Events__Query::init`
* `Tribe__Events__Query::parse_query`
  * [ ] `WP_Query->tribe_is_event`
    * [ ] There are usages of this in Filter Bar
  * [ ] `WP_Query->tribe_is_multi_posttype`
  * [ ] `WP_Query->eventDisplay`
    * [ ] There are usages of this in Filter Bar
  * [ ] `WP_Query->tribe_is_event_category`
    * [ ] There are usages of this in Filter Bar
  * [ ] `WP_Query->tribe_is_event_venue`
  * [ ] `WP_Query->tribe_is_event_organizer`
  * [ ] `WP_Query->tribe_is_event_query`
  * [ ] `WP_Query->tribe_is_past`
* `Tribe__Events__Query::pre_get_posts`
  * [ ] `WP_Query->tribe_suppress_query_filters`
* `Tribe__Events__Query::default_page_on_front`
* `Tribe__Events__Query::multi_type_posts_fields`
* `Tribe__Events__Query::posts_join`
* `Tribe__Events__Query::posts_fields`
* `Tribe__Events__Query::posts_results`
* `Tribe__Events__Query::posts_where`
* `Tribe__Events__Query::posts_orderby_venue_organizer`
* `Tribe__Events__Query::posts_join_venue_organizer`
* `Tribe__Events__Query::posts_distinct`
* `Tribe__Events__Query::posts_orderby`
* `Tribe__Events__Query::set_orderby`
* `Tribe__Events__Query::set_order`
* `Tribe__Events__Query::getHideFromUpcomingEvents`
* `Tribe__Events__Query::getEventCounts`
* `Tribe__Events__Query::last_found_events`
* `Tribe__Events__Query::postmeta_table`
* `Tribe__Events__Query::can_inject_date_field`
* `Tribe__Events__Query::should_remove_date_filters`
* `Tribe\Events\Views\V2\Widgets\Service_Provider::unregister_list_widget`
* `tribe_include_view_list`
* `tribe_events_month_has_events_filtered`
* `tribe_events_the_month_single_event_classes`
* `tribe_events_the_month_day_classes`
* `tribe_events_get_current_month_day`
* `tribe_events_get_current_week`
* `tribe_events_the_month_day`
* `tribe_events_have_month_days`
* `tribe_show_month`
* `tribe_get_dropdown_link_prefix`
* `tribe_events_get_filters`
  * [ ] Pro make use of this
* `tribe_events_get_views`
  * [ ] Pro make use of this
* `Tribe__Events__Template__Single_Event::setup_meta`
* `Tribe__Events__Template_Factory::asset_package`
* `Tribe__Events__Template_Factory::get_asset_factory_instance`
* `Tribe__Events__Template_Factory::handle_asset_package_request`
* `Tribe__Events__Template_Factory::setup_meta`
* `tribe_initialize_view`
* `Tribe__Events__Templates::init`
* `Tribe__Events__Templates::instantiate_template_class`
* `Tribe__Events__Templates::load_ecp_comments_page_template`
* `Tribe__Events__Templates::load_ecp_into_page_template`
* `Tribe__Events__Templates::maybe_modify_global_post_title`
* `Tribe__Events__Templates::maybeSpoofQuery`
* `Tribe__Events__Templates::modify_global_post_title`
* `Tribe__Events__Templates::restore_global_post_title`
* `Tribe__Events__Templates::setup_ecp_template`
* `Tribe__Events__Templates::showInLoops`
* `Tribe__Events__Templates::spoof_the_post`
* `Tribe__Events__Templates::templateChooser`
* `Tribe__Events__Templates::theme_body_class`
  * [ ] Community Events uses this method
* `Tribe__Events__Templates::add_singular_body_class`
* `Tribe__Events__Templates::get_current_page_template`
* `Tribe__Events__Templates::needs_compatibility_fix`
* `Tribe__Events__Templates::remove_singular_body_class`
* `Tribe__Events__Templates::restoreQuery`
* `Tribe__Events__Templates::spoof_the_post`
* `Tribe__Events__Templates::template_body_class`
* `Tribe__Events__Templates::wpHeadFinished`
* `event_grid_view`
* `get_event_google_map_link`
* `event_google_map_link`
* `tec_get_event_address`
* `tec_event_address`
* `tec_address_exists`
* `get_event_google_map_embed`
* `event_google_map_embed`
* `get_jump_to_date_calendar`
* `the_event_start_date`
* `the_event_end_date`
* `the_event_cost`
* `the_event_venue`
* `the_event_country`
* `the_event_address`
* `the_event_city`
* `the_event_state`
* `the_event_province`
* `the_event_zip`
* `the_event_phone`
* `the_event_region`
* `the_event_all_day`
* `is_new_event_day`
* `get_events`
* `tribe_event_link`
* `events_displaying_past`
* `events_displaying_upcoming`
* `events_displaying_month`
* `events_get_past_link`
* `events_get_upcoming_link`
* `events_get_next_month_link`
* `events_get_previous_month_link`
* `events_get_events_link`
* `events_get_gridview_link`
* `events_get_listview_link`
* `events_get_listview_past_link`
* `events_get_previous_month_text`
* `events_get_current_month_text`
* `events_get_next_month_text`
* `events_get_displayed_month`
* `events_get_this_month_link`
* `sp_get_option`
* `sp_calendar_grid`
* `sp_calendar_mini_grid`
* `sp_sort_by_month`
* `sp_is_event`
* `sp_get_map_link`
* `sp_the_map_link`
* `sp_get_full_address`
* `sp_the_full_address`
* `sp_address_exists`
* `sp_get_embedded_map`
* `sp_the_embedded_map`
* `sp_month_year_dropdowns`
* `sp_get_start_date`
* `sp_get_end_date`
* `sp_get_cost`
* `sp_has_organizer`
* `sp_get_organizer`
* `sp_get_organizer_email`
* `sp_get_organizer_website`
* `sp_get_organizer_link`
* `sp_get_organizer_phone`
* `sp_has_venue`
* `sp_get_venue`
* `sp_get_country`
* `sp_get_address`
* `sp_get_city`
* `sp_get_stateprovince`
* `sp_get_state`
* `sp_get_province`
* `sp_get_zip`
* `sp_get_phone`
* `sp_previous_event_link`
* `sp_next_event_link`
* `sp_post_id_helper`
* `sp_is_new_event_day`
* `sp_get_events`
* `sp_is_past`
* `sp_is_upcoming`
* `sp_is_month`
* `sp_get_past_link`
* `sp_get_upcoming_link`
* `sp_get_next_month_link`
* `sp_get_previous_month_link`
* `sp_get_month_view_date`
* `sp_get_single_ical_link`
* `sp_get_events_link`
* `sp_get_gridview_link`
* `sp_get_listview_link`
* `sp_get_listview_past_link`
* `sp_get_dropdown_link_prefix`
* `sp_get_ical_link`
* `sp_get_previous_month_text`
* `sp_get_current_month_text`
* `sp_get_next_month_text`
* `sp_get_displayed_month`
* `sp_get_this_month_link`
* `sp_get_region`
* `sp_get_all_day`
* `sp_is_multiday`
* `sp_events_title`
* `sp_meta_event_cats`
* `sp_meta_event_category_name`
* `sp_get_add_to_gcal_link`
* `eventsGetOptionValue`
* `events_by_month`
* `is_event`
* `getEventMeta`
* `tribe_events_event_recurring_info_tooltip`
* `tribe_the_map_link`
* `tribe_the_embedded_map`
* `tribe_the_full_address`
* `tribe_get_organizer_website`
* `tribe_get_venue_permalink`
* `tribe_previous_event_link`
* `tribe_next_event_link`
* `display_day_title`
* `display_day`
* `tribe_meta_event_cats`
* `tribe_get_all_day`
* `tribe_is_multiday`
* `tribe_calendar_grid`
* `tribe_calendar_mini_grid`
* `tribe_sort_by_month`
* `tribe_month_year_dropdowns`
* `tribe_get_this_month_link`
* `tribe_get_displayed_month`
* `tribe_get_display_day_title`
* `tribe_the_display_day`
* `tribe_get_display_day`
* `tribe_get_object_property_from_array`
* `tribe_mini_display_day`
* `tribe_event_format_date`
* `tribe_event_beginning_of_day`
* `tribe_event_end_of_day`
* `tribe_events_the_notices`
* `tribe_get_the_day_link_date`
* `tribe_get_the_day_link_label`
* `tribe_the_day_link`
* `tribe_get_linked_day`
* `tribe_events_get_views`
  * [ ] Pro make use of this
* `tribe_events_disabled_views`
* `tribe_events_enabled_views`
* `tribe_events_template_data`
* `tribe_get_ticket_form`
* `tribe_map_cost_array_callback`
* `tribe_events_get_days_of_week`
  * [ ] Pro make use of this
* `tribe_is_community_edit_event_page`
  * [ ] Community Events and community tickets uses this method
* `tribe_is_community_my_events_page`
  * [ ] Community Events uses this method
* `tribe_display_current_events_slug`
* `tribe_display_current_single_event_slug`
* `tribe_display_current_ical_link`
* `tribe_is_new_event_day`

## Hooks Removed

* `tribe-events-bar-views`
  * This is kind important, because previously that was the way to check which views were active. We should now use `tribe( \Tribe\Events\Views\V2\Manager::class )->get_publicly_visible_views()`
* `tribe_events_list_widget_before_the_event_image`
* `tribe_events_list_widget_thumbnail_size`
* `tribe_events_list_widget_featured_image_link`
* `tribe_events_list_widget_after_the_event_image`
* `tribe_events_list_widget_before_the_event_title`
* `tribe_events_list_widget_after_the_event_title`
* `tribe_events_list_widget_before_the_meta`
* `tribe_events_list_widget_after_the_meta`