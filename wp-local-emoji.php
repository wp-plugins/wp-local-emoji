<?php
/*
 * Plugin Name: WP Local Emoji
 * Plugin URI: https://www.extendwings.com
 * Description: Use emoji without external items
 * Version: 0.1.0
 * Author: Daisuke Takahashi(Extend Wings)
 * Author URI: https://www.extendwings.com
 * License: AGPLv3 or later
 * Text Domain: wp-local-emoji
 * Domain Path: /languages/
*/


if(!function_exists('add_action')) {
	echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
	exit;
}

add_action('init', array('WP_Local_Emoji', 'init'));

class WP_Local_Emoji {
	static $instance;

	const VERSION = '0.1.0';

	static function init() {
		if( !self::$instance ) {
			if( did_action('plugins_loaded') )
				self::plugin_textdomain();
			else
				add_action('plugins_loaded', array(__CLASS__, 'plugin_textdomain') );

			self::$instance = new WP_Local_Emoji;
		}
		return self::$instance;
	}

	private function __construct() {
		add_filter('emoji_url', array( &$this, 'emoji_url'), 10, 2);
	}

	function emoji_url( $emoji_url ) {
		return plugins_url('72x72/', __FILE__ );
	}

	static function plugin_textdomain() {
		load_plugin_textdomain('wp-local-emoji', false, dirname( plugin_basename(__FILE__) ) . '/languages/');
	}
}
