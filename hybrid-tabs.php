<?php
/**
 * Plugin Name: Hybrid Tabs
 * Plugin URI: http://themehybrid.com/plugins/hybrid-tabs
 * Description: Creates a tabbed widget for the Hybrid WordPress theme.
 * Version: 0.2.1
 * Author: Justin Tadlock
 * Author URI: http://justintadlock.com
 *
 * Hybrid Tabs is a tabbed widget that accompanies the Hybrid
 * WordPress theme framework.  Individual child themes that 
 * support the tabs widget should have a tabs.css file in the theme
 * download packaged.
 *
 * Hybrid Tabs will auto-insert several plugins if the plugin is activated:
 * @link http://wordpress.org/extend/plugins/configurable-tag-cloud-widget
 * @link http://wordpress.org/extend/plugins/events-calendar
 * @link http://wordpress.org/extend/plugins/flickr-rss
 * @link http://wordpress.org/extend/plugins/get-recent-comments
 * @link http://wordpress.org/extend/plugins/hot-friends
 * @link http://wordpress.org/extend/plugins/quote-this
 * @link http://wordpress.org/extend/plugins/sidebar-login
 * @link http://wordpress.org/extend/plugins/wp-cumulus
 * @link http://wordpress.org/extend/plugins/wp-postratings
 * @link http://wordpress.org/extend/plugins/wp-postviews
 * @link http://wordpress.org/extend/plugins/wp-stats
 * @link http://wordpress.org/extend/plugins/wp-wall
 *
 * @copyright 2008 - 2013
 * @version 0.2.1
 * @author Justin Tadlock
 * @link http://themehybrid.com/themes/hybrid/tabs
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * @package HybridTabs
 */

/**
 * Yes, we're localizing the plugin.  This partly makes sure non-English
 * users can use it too.  To translate into your language use the
 * en_EN.po file as as guide.  Poedit is a good tool to for translating.
 * @link http://poedit.net
 *
 * @since 0.1
 */
load_plugin_textdomain( 'hybrid_tabs', false, '/hybrid-tabs' );

/**
 * Make sure we get the correct directory.
 * @since 0.1
 */
if ( !defined('WP_CONTENT_URL' ) )
	define( 'WP_CONTENT_URL', get_option( 'siteurl' ) . '/wp-content' );
if ( !defined( 'WP_CONTENT_DIR' ) )
	define( 'WP_CONTENT_DIR', ABSPATH . 'wp-content' );
if ( !defined( 'WP_PLUGIN_URL' ) )
	define( 'WP_PLUGIN_URL', WP_CONTENT_URL. '/plugins' );
if ( !defined( 'WP_PLUGIN_DIR' ) )
	define( 'WP_PLUGIN_DIR', WP_CONTENT_DIR . '/plugins' );

/**
 * Define constant paths to the plugin folder.
 * @since 0.1
 */
define( HYBRID_TABS, WP_PLUGIN_DIR . '/hybrid-tabs' );
define( HYBRID_TABS_URL, WP_PLUGIN_URL . '/hybrid-tabs' );

/**
 * Global $hybrid_tabs variable, which is where are the tabs are kept.
 * @since 0.2
 */
$hybrid_tabs = array();

/**
 * Load files at the appropriate time.
 * @since 0.1
 */
add_action( 'init', 'create_initial_hybrid_tabs' );
add_action( 'plugins_loaded', 'hybrid_tabs_load_tab_functions' );
add_action( 'wp_print_scripts', 'hybrid_tabs_load_js' );
add_action( 'widgets_init', 'hybrid_tabs_register_widgets' );

/**
 * Create the default tabs for use with the widget.
 * @uses register_hybrid_tab() Registers individual tabs.
 *
 * @since 0.2
 */
function create_initial_hybrid_tabs() {
	global $wp_taxonomies;

	/* Authors list. */
	register_hybrid_tab( 'authors', array( 'label' => __('Authors', 'hybrid_tabs'), 'callback' => 'hybrid_tabs_authors' ) );

	/* Stats plugin (authors' stats). @link http://wordpress.org/extend/plugins/wp-stats */
	if ( function_exists( 'get_authorsstats' ) )
		register_hybrid_tab( 'get_authorsstats', array( 'label' => __('Authors\' Stats', 'hybrid_tabs'), 'callback' => 'hybrid_tabs_get_authorsstats' ) );

	/* Calendar. */
	register_hybrid_tab( 'calendar', array( 'label' => __('Calendar', 'hybrid_tabs'), 'callback' => 'hybrid_tabs_calendar' ) );

	/* Categories list. */
	register_hybrid_tab( 'categories', array( 'label' => __('Categories', 'hybrid_tabs'), 'callback' => 'hybrid_tabs_categories' ) );

	/* Stats plugin (comments' members stats). @link http://wordpress.org/extend/plugins/wp-stats */
	if ( function_exists( 'get_commentmembersstats' ) )
		register_hybrid_tab( 'get_commentmembersstats', array( 'label' => __('Comments\' Members Stats', 'hybrid_tabs'), 'callback' => 'hybrid_tabs_get_commentmembersstats' ) );

	/* Configurable tag cloud. @link http://wordpress.org/extend/plugins/configurable-tag-cloud-widget */
	if ( function_exists( 'ctc' ) )
		register_hybrid_tab( 'ctc', array( 'label' => __('Configurable Tag Cloud', 'hybrid_tabs'), 'callback' => 'hybrid_tabs_ctc' ) );

	/* Daily archives list. */
	register_hybrid_tab( 'daily', array( 'label' => __('Daily Archives', 'hybrid_tabs'), 'callback' => 'hybrid_tabs_daily_archives' ) );

	/* Events calendar plugin. @link http://wordpress.org/extend/plugins/events-calendar */
	if ( function_exists( 'sidebarEventsCalendar' ) )
		register_hybrid_tab( 'sidebarEventsCalendar', array( 'label' => __('Events Calendar', 'hybrid_tabs'), 'callback' => 'hybrid_tabs_sidebarEventsCalendar' ) );

	/* Flickr RSS plugin. @link http://wordpress.org/extend/plugins/flickr-rss */
	if ( function_exists( 'get_flickrRSS' ) )
		register_hybrid_tab( 'get_flickrRSS', array( 'label' => __('flickrRSS', 'hybrid_tabs'), 'callback' => 'hybrid_tabs_get_flickrRSS' ) );

	/* Highest rated. @link http://wordpress.org/extend/plugins/wp-postratings */
	if ( function_exists( 'get_highest_rated' ) )
		register_hybrid_tab( 'get_highest_rated', array( 'label' => __('Highest Rated', 'hybrid_tabs'), 'callback' => 'hybrid_tabs_get_highest_rated' ) );

	/* Hot friends plugin. @link http://wordpress.org/extend/plugins/hot-friends */
	if ( function_exists( 'hot_friends' ) )
		register_hybrid_tab ( 'hot_friends', array( 'label' => __('Hot Friends', 'hybrid_tabs'), 'callback' => 'hybrid_tabs_hot_friends' ) );

	/* Least viewed. @link http://wordpress.org/extend/plugins/wp-postviews */
	if ( function_exists( 'get_least_viewed' ) )
		register_hybrid_tab( 'get_least_viewed', array( 'label' => __('Least Viewed', 'hybrid_tabs'), 'callback' => 'hybrid_tabs_get_least_viewed' ) );

	/* Stats plugin (link categories). @link http://wordpress.org/extend/plugins/wp-stats */
	if ( function_exists( 'get_linkcats' ) )
		register_hybrid_tab( 'get_linkcats', array( 'label' => __('Link Category Stats', 'hybrid_tabs'), 'callback' => 'hybrid_tabs_get_linkcats' ) );

	/* Lowest rated. @link http://wordpress.org/extend/plugins/wp-postratings */
	if ( function_exists( 'get_lowest_rated' ) )
		register_hybrid_tab( 'get_lowest_rated', array( 'label' => __('Lowest Rated', 'hybrid_tabs'), 'callback' => 'hybrid_tabs_get_lowest_rated' ) );

	/* Meta. */
	register_hybrid_tab( 'meta', array( 'label' => __('Meta', 'hybrid_tabs'), 'callback' => 'hybrid_tabs_meta' ) );

	/* Monthly archives list. */
	register_hybrid_tab( 'monthly', array( 'label' => __('Monthly Archives', 'hybrid_tabs'), 'callback' => 'hybrid_tabs_monthly_archives' ) );

	/* Stats plugin (most commented). @link http://wordpress.org/extend/plugins/wp-stats */
	if ( function_exists( 'get_mostcommented' ) )
		register_hybrid_tab( 'get_mostcommented', array( 'label' => __('Most Commented', 'hybrid_tabs'), 'callback' => 'hybrid_tabs_get_mostcommented' ) );

	/* Most rated. @link http://wordpress.org/extend/plugins/wp-postratings */
	if ( function_exists( 'get_most_rated' ) )
		register_hybrid_tab( 'get_most_rated', array( 'label' => __('Most Rated', 'hybrid_tabs'), 'callback' => 'hybrid_tabs_get_most_rated' ) );

	/* Most viewed. @link http://wordpress.org/extend/plugins/wp-postviews */
	if ( function_exists( 'get_most_viewed' ) )
		register_hybrid_tab( 'get_most_viewed', array( 'label' => __('Most Viewed', 'hybrid_tabs'), 'callback' => 'hybrid_tabs_get_most_viewed' ) );

	/* Pages list. */
	register_hybrid_tab( 'pages', array( 'label' => __('Pages', 'hybrid_tabs'), 'callback' => 'hybrid_tabs_pages' ) );

	/* Quote This plugin. @link http://justintadlock.com/archives/2009/03/26/quote-this-wordpress-plugin */
	if ( function_exists( 'quote_this' ) ) :
		register_hybrid_tab( 'all_quote_this', array( 'label' => __('Quote This: All', 'hybrid_tabs'), 'callback' => 'hybrid_tabs_quote_this' ) );
		register_hybrid_tab( 'art_quote_this', array( 'label' => __('Quote This: Art', 'hybrid_tabs'), 'callback' => 'hybrid_tabs_quote_this' ) );
		register_hybrid_tab( 'film_quote_this', array( 'label' => __('Quote This: Film', 'hybrid_tabs'), 'callback' => 'hybrid_tabs_quote_this' ) );
		register_hybrid_tab( 'friendship_quote_this', array( 'label' => __('Quote This: Friendship', 'hybrid_tabs'), 'callback' => 'hybrid_tabs_quote_this' ) );
		register_hybrid_tab( 'individual_quote_this', array( 'label' => __('Quote This: Individual', 'hybrid_tabs'), 'callback' => 'hybrid_tabs_quote_this' ) );
		register_hybrid_tab( 'life_quote_this', array( 'label' => __('Quote This: Life', 'hybrid_tabs'), 'callback' => 'hybrid_tabs_quote_this' ) );
		register_hybrid_tab( 'literature_quote_this', array( 'label' => __('Quote This: Literature', 'hybrid_tabs'), 'callback' => 'hybrid_tabs_quote_this' ) );
	endif;

	/* Stats plugin (post categories). @link http://wordpress.org/extend/plugins/wp-stats */
	if ( function_exists( 'get_postcats' ) )
		register_hybrid_tab( 'get_postcats', array( 'label' => __('Post Category Stats', 'hybrid_tabs'), 'callback' => 'hybrid_tabs_get_postcats' ) );

	/* Stats plugin (post tags stats). @link http://wordpress.org/extend/plugins/wp-stats */
	if ( function_exists( 'get_tags_list' ) )
		register_hybrid_tab( 'get_tags_list', array( 'label' => __('Post Tag Stats', 'hybrid_tabs'), 'callback' => 'hybrid_tabs_get_tags_list' ) );

	/* Random posts list. */
	register_hybrid_tab( 'random', array( 'label' => __('Random', 'hybrid_tabs'), 'callback' => 'hybrid_tabs_random' ) );

	/* Recent comments. @link http://wordpress.org/extend/plugins/get-recent-comments */
	if ( function_exists( 'get_recent_comments' ) )
		register_hybrid_tab( 'get_recent_comments', array( 'label' => __('Recent Comments', 'hybrid_tabs'), 'callback' => 'hybrid_tabs_recent_comments' ) );

	/* Stats plugin (recent comments). @link http://wordpress.org/extend/plugins/wp-stats */
	if ( function_exists( 'get_recentcomments' ) )
		register_hybrid_tab( 'get_recentcomments', array( 'label' => __('Recent Comments', 'hybrid_tabs'), 'callback' => 'hybrid_tabs_get_recentcomments' ) );

	/* Post by post (alphabetical) list. */
	register_hybrid_tab( 'postbyalpha', array( 'label' => __('Recent Posts (Alphabetical)', 'hybrid_tabs'), 'callback' => 'hybrid_tabs_alpha_archives' ) );

	/* Post by post (chronological) list. */
	register_hybrid_tab( 'postbypost', array( 'label' => __('Recent Posts (Chronological)', 'hybrid_tabs'), 'callback' => 'hybrid_tabs_postbypost_archives' ) );

	/* Recent trackbacks. @link http://wordpress.org/extend/plugins/get-recent-comments */
	if ( function_exists( 'get_recent_trackbacks' ) )
		register_hybrid_tab( 'get_recent_trackbacks', array( 'label' => __('Recent Trackbacks', 'hybrid_tabs'), 'callback' => 'hybrid_tabs_recent_trackbacks' ) );

	/* Sidebar login plugin. @link http://wordpress.org/extend/plugins/sidebar-login */
	if ( function_exists( 'sidebarlogin' ) )
		register_hybrid_tab( 'sidebarlogin', array( 'label' => __('Sidebar Login', 'hybrid_tabs'), 'callback' => 'hybrid_tabs_sidebarlogin' ) );

	/* Weekly archives list. */
	register_hybrid_tab( 'weekly', array( 'label' => __('Weekly Archives', 'hybrid_tabs'), 'callback' => 'hybrid_tabs_weekly_archives' ) );

	/* WP Cumulus plugin. @link http://wordpress.org/extend/plugins/wp-cumulus */
	if ( function_exists( 'wp_cumulus_insert' ) )
		register_hybrid_tab( 'wp_cumulus_insert', array( 'label' => __('WP Cumulus', 'hybrid_tabs'), 'callback' => 'hybrid_tabs_wp_cumulus_insert' ) );

	/* WP Wall plugin. @link http://wordpress.org/extend/plugins/wp-wall */
	if ( function_exists( 'WPWall_Widget' ) )
		register_hybrid_tab( 'WPWall_Widget', array( 'label' => __('WP Wall', 'hybrid_tabs'), 'callback' => 'hybrid_tabs_WPWall_Widget' ) );

	/* Yearly archives list. */
	register_hybrid_tab( 'yearly', array( 'label' => __('Yearly Archives', 'hybrid_tabs'), 'callback' => 'hybrid_tabs_yearly_archives' ) );

	/* Makes each taxonomy a tab (term/tag cloud). */
	if ( is_array( $wp_taxonomies ) ) :
		foreach( $wp_taxonomies as $tax ) :
			register_hybrid_tab( $tax->name . '_cloud', array( 'label' => sprintf( __('%1$s Cloud', 'hybrid_tabs'), $tax->name ), 'callback' => 'hybrid_tabs_term_cloud' ) );
		endforeach;
	endif;

	/* Makes each individual bookmark (link) category a separate tab. */
	$bookmark_cats = get_categories( array( 'type' => 'link' ) );
	if ( is_array( $bookmark_cats ) ) :
		foreach( $bookmark_cats as $cat ) :
			register_hybrid_tab( $cat->slug . '_bookmarks', array( 'label' => $cat->name, 'callback' =>'hybrid_tabs_bookmarks' ) );
		endforeach;
	endif;

	/* Custom tab 1. @deprecated 0.2 */
	if ( has_filter( 'hybrid_tabs_custom_1' ) )
		register_hybrid_tab( 'hybrid_tabs_custom_1', array( 'label' => __('Custom 1', 'hybrid_tabs'), 'callback' => 'hybrid_tabs_custom_1' ) );

	/* Custom tab 2. @deprecated 0.2 */
	if ( has_filter( 'hybrid_tabs_custom_2' ) )
		register_hybrid_tab( 'hybrid_tabs_custom_2', array( 'label' => __('Custom 2', 'hybrid_tabs'), 'callback' => 'hybrid_tabs_custom_2' ) );

	/* Custom tab 3. @deprecated 0.2 */
	if ( has_filter( 'hybrid_tabs_custom_3' ) )
		register_hybrid_tab( 'hybrid_tabs_custom_3', array( 'label' => __('Custom 3', 'hybrid_tabs'), 'callback' => 'hybrid_tabs_custom_3' ) );

	/* Custom tab 4. @deprecated 0.2 */
	if ( has_filter( 'hybrid_tabs_custom_4' ) )
		register_hybrid_tab( 'hybrid_tabs_custom_4', array( 'label' => __('Custom 4', 'hybrid_tabs'), 'callback' => 'hybrid_tabs_custom_4' ) );

	/* Custom tab 5. @deprecated 0.2 */
	if ( has_filter( 'hybrid_tabs_custom_5' ) )
		register_hybrid_tab( 'hybrid_tabs_custom_5', array( 'label' => __('Custom 5', 'hybrid_tabs'), 'callback' => 'hybrid_tabs_custom_5' ) );

	/* Custom tab 6. @deprecated 0.2 */
	if ( has_filter( 'hybrid_tabs_custom_6' ) )
		register_hybrid_tab( 'hybrid_tabs_custom_6', array( 'label' => __('Custom 6', 'hybrid_tabs'), 'callback' => 'hybrid_tabs_custom_6' ) );
}

/**
 * Register a tab with the plugin.
 * $name should be a unique identifier for the tab.
 * $label is the title of the tab.
 * $callback is the function to call for displaying the tab content.
 *
 * @since 0.2
 * @param string $name Required. Name of the tab.
 * @param array $args Arguments for tab.
 */
function register_hybrid_tab( $name, $args = array() ) {
	global $hybrid_tabs;

	if ( !is_array( $hybrid_tabs ) )
		$hybrid_tabs = array();

	$defaults = array( 'label' => '', 'callback' => '' );
	$args = wp_parse_args( $args, $defaults );
	extract ( $args );

	$args['name'] = $name;
	$args['label'] = $label;
	$args['callback'] = $callback;
	$hybrid_tabs[$name] = (object) $args;
}

/**
 * Get a tab object by the name of the tab.
 * $tab_name is the unique identifier for the tab.
 *
 * @param string $tab_name Name of tab.
 * @return object $hybrid_tabs[$tab_name] Tab.
 */
function get_hybrid_tab( $tab_name ) {
	global $hybrid_tabs;

	return $hybrid_tabs[$tab_name];
}

/**
 * Call the function associated with the tab.
 * The $tab object is passed to the callback function, which
 * users can use to customize tabbed content.
 *
 * @since 0.1
 * @param string $tab Name of tab.
 */
function hybrid_tabs_get_selected( $tab_name = '' ) {
	if ( $tab_name == '' )
		return false;

	$tab = get_hybrid_tab( $tab_name );

	call_user_func( $tab->callback, $tab );
}

/**
 * Registers the Hybrid Tabs widget.
 * @since 0.2
 */
function hybrid_tabs_register_widgets() {
	require_once( HYBRID_TABS . '/tabs-widget.php' );
	register_widget( 'Hybrid_Tabs_Widget' );
}

/**
 * Loads all the tabbed content functions for display.
 * @since 0.2
 */
function hybrid_tabs_load_tab_functions() {
	if ( !is_admin() && is_active_widget( 'Hybrid_Tabs_Widget', false, 'hybrid-tabs', true ) )
		require_once( HYBRID_TABS . '/functions.php' );
}

/**
 * Load JavaScript only if widget is active and not in the admin.
 * @since 0.2
 */
function hybrid_tabs_load_js() {
	if ( !is_admin() && is_active_widget( 'Hybrid_Tabs_Widget', false, 'hybrid-tabs', true ) )
		wp_enqueue_script( 'hybrid-tabs-js', HYBRID_TABS_URL . '/js/tabs.js', array('jquery'), '0.1' );
}

?>