<?php
/**
 * Functions for displaying tabbed content within the tabs widget.
 * This only needs to be loaded on the front page of the site.
 *
 * @package HybridTabs
 */

/**
 * Replicates the default meta widget.
 *
 * @since 0.2
 */
function hybrid_tabs_meta() {
	echo '<ul>';
	wp_register();
	echo '<li>'; wp_loginout(); echo '</li>';
	echo '<li><a href="' . get_bloginfo('rss2_url') . '" title="' . esc_attr( __('Syndicate this site using RSS 2.0', 'hybrid_tabs') ) . '">' . __('Entries <abbr title="Really Simple Syndication">RSS</abbr>', 'hybrid_tabs') . '</a></li>';
	echo '<li><a href="' . get_bloginfo('comments_rss2_url') . '" title="' . esc_attr( __('The latest comments to all posts in RSS', 'hybrid_tabs') ) . '">' . __('Comments <abbr title="Really Simple Syndication">RSS</abbr>', 'hybrid_tabs') . '</a></li>';
	echo '<li><a href="http://wordpress.org/" title="' . esc_attr( __('Powered by WordPress, state-of-the-art semantic personal publishing platform.', 'hybrid_tabs') ) . '>">WordPress.org</a></li>';
	wp_meta();
	echo '</ul>';
}

/**
 * Displays the WordPress calendar.
 * @uses get_calendar()
 * @link http://codex.wordpress.org/Template_Tags/get_calendar
 *
 * @since 0.2
 */
function hybrid_tabs_calendar() {
	echo '<div class="calendar-wrap">';
	get_calendar();
	echo '</div>';
}

/**
 * Lists last 10 years of archives.
 * @uses wp_get_archives()
 * @link http://codex.wordpress.org/Template_Tags/wp_get_archives
 *
 * @since 0.1
 */
function hybrid_tabs_yearly_archives() {
	echo '<ul class="xoxo yearly-archives">';
	echo str_replace( array( "\r", "\n", "\t" ), '', wp_get_archives( array( 'type' => 'yearly', 'limit' => 10, 'echo' => false ) ) );
	echo '</ul>';
}

/**
 * Lists last 10 months of archives.
 * @uses wp_get_archives()
 * @link http://codex.wordpress.org/Template_Tags/wp_get_archives
 *
 * @since 0.1
 */
function hybrid_tabs_monthly_archives() {
	echo '<ul class="xoxo monthly-archives">';
	echo str_replace( array( "\r", "\n", "\t" ), '', wp_get_archives( array( 'type' => 'monthly', 'limit' => 10, 'echo' => false ) ) );
	echo '</ul>';
}

/**
 * Lists last 10 weeks of archives.
 * @uses wp_get_archives()
 * @link http://codex.wordpress.org/Template_Tags/wp_get_archives
 *
 * @since 0.1
 */
function hybrid_tabs_weekly_archives() {
	echo '<ul class="xoxo weekly-archives">';
	echo str_replace( array( "\r", "\n", "\t" ), '', wp_get_archives( array( 'type' => 'weekly', 'limit' => 10, 'echo' => false ) ) );
	echo '</ul>';
}

/**
 * Lists last 10 days of archives.
 * @uses wp_get_archives()
 * @link http://codex.wordpress.org/Template_Tags/wp_get_archives
 *
 * @since 0.1
 */
function hybrid_tabs_daily_archives() {
	echo '<ul class="xoxo daily-archives">';
	echo str_replace( array( "\r", "\n", "\t" ), '', wp_get_archives( array( 'type' => 'daily', 'limit' => 10, 'echo' => false ) ) );
	echo '</ul>';
}

/**
 * Lists last 10 posts.
 * @uses wp_get_archives()
 * @link http://codex.wordpress.org/Template_Tags/wp_get_archives
 *
 * @since 0.1
 */
function hybrid_tabs_postbypost_archives() {
	echo '<ul class="xoxo postbypost-archives">';
	echo str_replace( array( "\r", "\n", "\t" ), '', wp_get_archives( array( 'type' => 'postbypost', 'limit' => 10, 'echo' => false ) ) );
	echo '</ul>';
}

/**
 * Lists 10 posts in alphabetical order.
 * @uses wp_get_archives()
 * @link http://codex.wordpress.org/Template_Tags/wp_get_archives
 *
 * @since 0.2
 */
function hybrid_tabs_alpha_archives() {
	echo '<ul class="xoxo alpha-archives">';
	echo str_replace( array( "\r", "\n", "\t" ), '', wp_get_archives( array( 'type' => 'alpha', 'limit' => 10, 'echo' => false ) ) );
	echo '</ul>';
}

/**
 * Lists blog authors.
 * @uses wp_list_authors()
 * @link http://codex.wordpress.org/Template_Tags/wp_list_authors
 *
 * @since 0.1
 */
function hybrid_tabs_authors() {
	echo '<ul class="xoxo authors">';
	echo str_replace( array( "\r", "\n", "\t" ), '', wp_list_authors( array( 'exclude_admin' => false, 'echo' => false ) ) );
	echo '</ul>';
}

/**
 * Lists bookmarks/links from a specific link category.
 * @uses wp_list_bookmarks()
 * @link http://codex.wordpress.org/Template_Tags/wp_list_bookmarks
 *
 * @since 0.1
 * @param object $tab The current tab being displayed.
 */
function hybrid_tabs_bookmarks( $tab ) {

	$args = array(
		'category_name' => $tab->label,
		'categorize' => false,
		'title_li' => false,
		'title_before' => false,
		'title_after' => false,
		'category_before' => false,
		'category_after' => false,
		'link_before' => '<span>',
		'link_after' => '</span>',
		'show_rating' => false,
		'show_updated' => false,
		'show_description' => false,
		'show_images' => false,
		'echo' => false,
	);

	echo '<ul class="xoxo bookmarks">';
	echo str_replace( array( "\r", "\n", "\t" ), '', wp_list_bookmarks( $args ) );
	echo '</ul>';
}

/**
 * Lists the blog's post categories.
 * @uses wp_list_categories()
 * @link http://codex.wordpress.org/Template_Tags/wp_list_categories
 *
 * @since 0.1
 */
function hybrid_tabs_categories() {
	echo '<ul class="xoxo categories">';
	echo str_replace( array( "\r", "\n", "\t" ), '', wp_list_categories( array( 'use_desc_for_title' => false, 'orderby' => 'name', 'title_li' => false, 'echo' => false ) ) );
	echo '</ul>';
}

/**
 * Lists all the blog's pages.
 * @uses wp_list_pages()
 * @link http://codex.wordpress.org/Template_Tags/wp_list_pages
 *
 * @since 0.1
 */
function hybrid_tabs_pages() {
	echo '<ul class="xoxo pages">';
	echo str_replace( array( "\r", "\n", "\t" ), '', wp_list_pages( array( 'echo' => false, 'title_li' => false ) ) );
	echo '</ul>';
}

/**
 * Lists 10 random posts.
 * @uses get_posts()
 * @link http://codex.wordpress.org/Template_Tags/get_posts
 *
 * @since 0.1
 */
function hybrid_tabs_random() {
	echo '<ul class="xoxo random">';
	$random_posts = get_posts( array( 'numberposts' => 10, 'orderby' => 'rand' ) );
	foreach ( $random_posts as $post ) :
		global $post;
		the_title( '<li><a href="' . get_permalink() . '" title="' . the_title_attribute( 'echo=0' ) . '" rel="bookmark">', '</a></li>', true );
	endforeach;
	echo '</ul>';
}

/**
 * Displays a term/tag cloud of the given taxonomy.
 * @uses wp_tag_cloud()
 * @link http://codex.wordpress.org/Template_Tags/wp_tag_cloud
 *
 * @since 0.2
 * @param object $tab The current tab.
 */
function hybrid_tabs_term_cloud( $tab ) {
	$tax = str_replace( '_cloud', '', $tab->name );

	echo '<p class="term-cloud ' . $tax . '-cloud">';
	echo wp_tag_cloud( array( 'taxonomy' => $tax, 'largest' => 15, 'smallest' => 8, 'order' => 'ASC', 'echo' => false ) );
	echo '</p>';
}

/**
 * Displays the WP Wall plugin.
 * @link http://wordpress.org/extend/plugins/wp-wall
 * @since 0.2
 */
function hybrid_tabs_WPWall_Widget() {
	if ( function_exists( 'WPWall_Widget' ) )
		WPWall_Widget();
}

/**
 * Displays the Events Calendar plugin.
 * @link http://wordpress.org/extend/plugins/events-calendar
 * @since 0.2
 */
function hybrid_tabs_sidebarEventsCalendar() {
	if ( function_exists( 'sidebarEventsCalendar' ) )
		sidebarEventsCalendar();
}

/**
 * Displays the Sidebar Login plugin.
 * @link http://wordpress.org/extend/plugins/sidebar-login
 * @since 0.2
 */
function hybrid_tabs_sidebarlogin() {
	if ( function_exists( 'sidebarlogin' ) )
		sidebarlogin();
}

/**
 * Displays the most viewed posts by the WP PostViews plugin.
 * @link http://wordpress.org/extend/plugins/wp-postviews
 * @since 0.2
 */
function hybrid_tabs_get_most_viewed() {
	if ( !function_exists( 'get_most_viewed' ) )
		return false;

	echo '<ul class="xoxo most-viewed">';
	get_most_viewed( '', 10, 0, true );
	echo '</ul>';
}

/**
 * Displays the least viewed posts by the WP PostViews plugin.
 * @link http://wordpress.org/extend/plugins/wp-postviews
 * @since 0.2
 */
function hybrid_tabs_get_least_viewed() {
	if ( !function_exists( 'get_least_viewed' ) )
		return false;

	echo '<ul class="xoxo least-viewed">';
	get_least_viewed( '', 10, 0, true );
	echo '</ul>';
}

/**
 * Displays the recent comments by the WP Stats plugin.
 * @link http://wordpress.org/extend/plugins/wp-stats
 * @since 0.2
 */
function hybrid_tabs_get_recentcomments() {
	if ( !function_exists( 'get_recentcomments' ) )
		return false;

	echo '<ul class="xoxo recent-comments">';
	get_recentcomments( '', 10, true );
	echo '</ul>';
}

/**
 * Displays the most-commented posts by the WP Stats plugin.
 * @link http://wordpress.org/extend/plugins/wp-stats
 * @since 0.2
 */
function hybrid_tabs_get_mostcommented() {
	if ( !function_exists( 'get_mostcommented' ) )
		return false;

	echo '<ul class="xoxo most-commented">';
	get_mostcommented( '', 10, 0, true );
	echo '</ul>';
}

/**
 * Displays authors' stats by the WP Stats plugin.
 * @link http://wordpress.org/extend/plugins/wp-stats
 * @since 0.2
 */
function hybrid_tabs_get_authorsstats() {
	if ( !function_exists( 'get_authorsstats' ) )
		return false;

	echo '<ul class="xoxo authors-stats">';
	get_authorsstats( '', true );
	echo '</ul>';
}

/**
 * Displays the comment member stats by the WP Stats plugin.
 * @link http://wordpress.org/extend/plugins/wp-stats
 * @since 0.2
 */
function hybrid_tabs_get_commentmembersstats() {
	if ( !function_exists( 'get_commentmembersstats' ) )
		return false;

	echo '<ul class="xoxo comment-members-stats">';
	get_commentmembersstats( -1, 0, true );
	echo '</ul>';
}

/**
 * Displays the post category stats by the WP Stats plugin.
 * @link http://wordpress.org/extend/plugins/wp-stats
 * @since 0.2
 */
function hybrid_tabs_get_postcats() {
	if ( !function_exists( 'get_postcats' ) )
		return false;

	echo '<ul class="xoxo post-category-stats">';
	get_postcats( true );
	echo '</ul>';
}

/**
 * Displays the link category stats by the WP Stats plugin.
 * @link http://wordpress.org/extend/plugins/wp-stats
 * @since 0.2
 */
function hybrid_tabs_get_linkcats() {
	if ( !function_exists( 'get_linkcats' ) )
		return false;

	echo '<ul class="xoxo link-category-stats">';
	get_linkcats( true );
	echo '</ul>';
}

/**
 * Displays the post tags stats by the WP Stats plugin.
 * @link http://wordpress.org/extend/plugins/wp-stats
 * @since 0.2
 */
function hybrid_tabs_get_tags_list() {
	if ( !function_exists( 'get_tags_list' ) )
		return false;

	echo '<ul title="xoxo post_tag-stats">';
	get_tags_list( true );
	echo '</ul>';
}

/**
 * Displays the Configurable Tag Cloud plugin.
 * @link http://wordpress.org/extend/plugins/configurable-tag-cloud-widget
 * @since 0.2
 */
function hybrid_tabs_ctc() {
	if ( !function_exists( 'ctc' ) )
		return false;

	echo '<p class="term-cloud post_tag-cloud">';
		ctc();
	echo '</p>';
}

/**
 * Displays the Hot Friends plugin.
 * @link http://wordpress.org/extend/plugins/hot-friends
 * @since 0.2
 */
function hybrid_tabs_hot_friends() {
	if ( function_exists( 'hot_friends' ) )
		hot_friends();
}

/**
 * Displays the flickrRSS plugin.
 * @link http://wordpress.org/extend/plugins/flickr-rss
 * @since 0.2
 */
function hybrid_tabs_get_flickrRSS() {
	if ( function_exists( 'get_flickrRSS' ) )
		get_flickrRSS();
}

/**
 * Displays the most rated posts by the WP Post Ratings plugin.
 * @link http://wordpress.org/extend/plugins/wp-postratings
 * @since 0.2
 */
function hybrid_tabs_get_most_rated() {
	if ( !function_exists( 'get_most_rated' ) )
		return false;

	echo '<ul class="xoxo most-rated">';
	get_most_rated( '', 0, 10, 0, true );
	echo '</ul>';
}

/**
 * Displays the highest rated posts by the WP Post Ratings plugin.
 * @link http://wordpress.org/extend/plugins/wp-postratings
 * @since 0.2
 */
function hybrid_tabs_get_highest_rated() {
	if ( !function_exists( 'get_highest_rated' ) )
		return false;

	echo '<ul class="xoxo highest-rated">';
	get_highest_rated( '', 0, 10, 0, true );
	echo '</ul>';
}

/**
 * Displays the lowest rated posts by the WP Post Ratings plugin.
 * @link http://wordpress.org/extend/plugins/wp-postratings
 * @since 0.2
 */
function hybrid_tabs_get_lowest_rated() {
	if ( !function_exists( 'get_lowest_rated' ) )
		return false;

	echo '<ul class="xoxo lowest-rated">';
	get_lowest_rated( '', 0, 10, 0, true );
	echo '</ul>';
}

/**
 * Displays the WP Cumulus plugin.
 * @link http://wordpress.org/extend/plugins/wp-cumulus
 * @since 0.2
 */
function hybrid_tabs_wp_cumulus_insert() {
	if ( function_exists( 'wp_cumulus_insert' ) )
		wp_cumulus_insert();
}

/**
 * Displays latest comments by the Get Recent Comments plugin.
 * @link http://wordpress.org/extend/plugins/get-recent-comments
 * @since 0.2
 */
function hybrid_tabs_recent_comments() {
	if ( !function_exists( 'get_recent_comments' ) )
		return false;

	echo '<ul class="xoxo recent-comments">';
	get_recent_comments();
	echo '</ul>';
}

/**
 * Displays latest trackbacks by the Get Recent Comments plugin.
 * @link http://wordpress.org/extend/plugins/get-recent-comments
 * @since 0.2
 */
function hybrid_tabs_recent_trackbacks() {
	if ( !function_exists( 'get_recent_trackbacks' ) )
		return false;

	echo '<ul class="xoxo recent-trackbacks">';
	get_recent_trackbacks();
	echo '</ul>';
}

/**
 * Displays a radom quote by the Quote This plugin.
 * @link http://justintadlock.com/archives/2009/03/26/quote-this-wordpress-plugin
 * @since 0.2
 * @param object $tab The tab object.
 */
function hybrid_tabs_quote_this( $tab ) {
	$type = str_replace( '_quote_this', '', $tab->name );
	quote_this( array( 'type' => $type, 'orderby' => 'rand', 'format' => 'p' ) );
}

/**
 * Custom tab that can be filtered with custom function.
 * @deprecated 0.2 Use register_hybrid_tab() instead.
 * @since 0.1
 */
function hybrid_tabs_custom_1() {
	echo apply_filters( 'hybrid_tabs_custom_1', '' );
}

/**
 * Custom tab that can be filtered with custom function.
 * @deprecated 0.2 Use register_hybrid_tab() instead.
 * @since 0.1
 */
function hybrid_tabs_custom_2() {
	echo apply_filters( 'hybrid_tabs_custom_2', '' );
}

/**
 * Custom tab that can be filtered with custom function.
 * @deprecated 0.2 Use register_hybrid_tab() instead.
 * @since 0.1
 */
function hybrid_tabs_custom_3() {
	echo apply_filters( 'hybrid_tabs_custom_3', '' );
}

/**
 * Custom tab that can be filtered with custom function.
 * @deprecated 0.2 Use register_hybrid_tab() instead.
 * @since 0.1
 */
function hybrid_tabs_custom_4() {
	echo apply_filters( 'hybrid_tabs_custom_4', '' );
}

/**
 * Custom tab that can be filtered with custom function.
 * @deprecated 0.2 Use register_hybrid_tab() instead.
 * @since 0.1
 */
function hybrid_tabs_custom_5() {
	echo apply_filters( 'hybrid_tabs_custom_5', '' );
}

/**
 * Custom tab that can be filtered with custom function.
 * @deprecated 0.2 Use register_hybrid_tab() instead.
 * @since 0.1
 */
function hybrid_tabs_custom_6() {
	echo apply_filters( 'hybrid_tabs_custom_6', '' );
}

?>