<?php
/**
 Plugin Name: [ Conditional Logic Boilerplate ]
 Plugin URI: https://www.yourdomainname.com
 Description: Boilerplate for Conditional Logic Filters
 Version: 1.0
 Author: Your Name goes here
 Text Domain: your-textdomain
 Domain Path: /languages
 Author URI: https://www.yourdomainname.com
 */

define( 'BOILERPLATE_VERSION' 	, '1.0' );
define( 'BOILERPLATE_DIR'			, plugin_dir_path( __FILE__ ) );
define( 'BOILERPLATE_FILE'		, __FILE__ );
define( 'BOILERPLATE_URL' 		, plugins_url( '/', __FILE__ ) );

add_action( 'plugins_loaded', 'boilerplate_setup_textdomain' );

function boilerplate_setup_textdomain(){

	// textdomain
	load_plugin_textdomain( 'your-textdomain', false, plugin_basename( dirname( __FILE__ ) ) . '/languages' );

	/**
	 * Load the BB Logic files
	 *
	 * Don't worry, checks for Themer version
	 * happen before enqueueing things
	 *
	 * @since  1.0
	 */
	include_once( 'easy-bb-logic.php' );

}

