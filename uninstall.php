<?php
/**
   * responsive-twitter-widget  plugin is uninstalled.
   *
   * @package   responsive-twitter-widget
   * @author    engrmostafijur <engr.mostafijur@gmail.com>
   * @license   http://www.gnu.org/licenses/gpl-2.0.html
   * @link      http://pixelsolution4it.com/
   * @copyright 2015 engrmostafijur
 */
// If uninstall, not called from WordPress, then exit
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}

// Delete plugin settings
delete_option( 'rtw_responsive_twitter_widget' );
delete_site_option( 'rtw_responsive_twitter_widget' );
