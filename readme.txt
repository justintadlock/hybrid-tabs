=== Hybrid Tabs ===

Contributors: greenshady
Donate link: http://themehybrid.com/donate
Tags: widget, jquery, javascript
Requires at least: 2.8
Tested up to: 3.7
Stable tag: 0.2.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Adds a tabbed widget to the Hybrid theme that can be used in multiple widget areas.

== Description ==

This plugin has been retired.  I've replaced it with a much better plugin that can work with any theme.  Check out [Whistles](http://wordpress.org/plugins/whistles), which allows you to create tabs, toggles, and accordions.

Thank you to all the supporters of this plugin over the years.

### Forks

If you'd like to fork this plugin or even take over the project altogether, let me know.  I'm done with it.

== Installation ==

1. Upload `hybrid-tabs.zip` to the `/wp-content/plugins/` directory.
2. Activate the plugin through the *Plugins* menu in WordPress.
3. Add the <em>Hybrid Tabs</em> widget to one of your widget areas from the *Widgets* panel.

More detailed instructions can be found in the plugin's `readme.html` file.

== Frequently Asked Questions ==

= Why create this plugin? =

Users wanted a tabbed widget that would work well with child themes of the <a href="http://themehybrid.com/themes/hybrid" title="Hybrid WordPress theme">Hybrid theme framework</a>.  This plugin allows that.

= What does this plugin do, exactly? =

It creates a new widget called *Hybrid Tabs* that offers a several tab-content options.

= What tabs are available by default? =

* Bookmarks/Links (individual link category lists).
* Authors.
* Calendar.
* Categories.
* Daily archives.
* Meta.
* Monthly archives.
* Pages.
* Recent posts (alphabetical).
* Recent posts (chronological).
* Random.
* Tag/term clouds (based on all taxonomies).
* Weekly archives.
* Yearly archives.

= Can I get more tabs? =

If you have any of these plugins activated, they will create additional tab options for you:

* <a href="http://wordpress.org/extend/plugins/configurable-tag-cloud-widget" title="Configurable Tag Cloud">Configurable Tag Cloud</a>
* <a href="http://wordpress.org/extend/plugins/events-calendar" title="Events Calendar">Events Calendar</a>
* <a href="http://wordpress.org/extend/plugins/flickr-rss" title="flickrRSS">flickrRSS</a>
* <a href="http://wordpress.org/extend/plugins/get-recent-comments" title="Get Recent Comments">Get Recent Comments</a>
* <a href="http://wordpress.org/extend/plugins/hot-friends" title="Hot Friends">Hot Friends</a>
* <a href="http://wordpress.org/extend/plugins/quote-this" title="Quote This">Quote This</a>
* <a href="http://wordpress.org/extend/plugins/sidebar-login" title="Sidebar Login">Sidebar Login</a>
* <a href="http://wordpress.org/extend/plugins/wp-cumulus" title="WP Cumulus">WP Cumulus</a>
* <a href="http://wordpress.org/extend/plugins/wp-postratings" title="WP Post Ratings">WP Post Ratings</a>
* <a href="http://wordpress.org/extend/plugins/wp-postviews" title="WP Post Views">WP Post Views</a>
* <a href="http://wordpress.org/extend/plugins/wp-stats" title="WP Stats">WP Stats</a>
* <a href="http://wordpress.org/extend/plugins/wp-wall" title="WP Wall">WP Wall</a>

= Can I make custom tabs? =

Of course.  Included in the plugin's `readme.html` file is a set of instructions on how to create your own tabs for this widget.

= I don't understand any of this.  What should I do? =

You should do a little reading.  The `readme.html` file included with the plugin has links to tons of resources.  Everything you need to know is there.

== Screenshots ==

There are currently no screenshots.

== Changelog ==

**Version 0.2**

* Completely recoded from the ground up.
* Widget uses WordPress 2.8's new widget class.
* Created additional tab options.
* Added the `register_tab()` function for creating custom tabs.
* Added support for several plugins.
* Removed support for versions of WordPress prior to 2.8.

**Version 0.1**

* Plugin launch.