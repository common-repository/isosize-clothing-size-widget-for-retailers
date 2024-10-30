<?php
/*
Plugin Name: Isosize widget test
Plugin URI: http://www.isosize.com
Description: Isosize widget. Finding your perfect clothes size couldn't be easier.
Version: 2.0.1
Author: Isosize
Author URI: http://www.isosize.com
License: Standard GPL License - GPLv2
*/


/*
Prevent Direct Access.
blocking direct access to plugin PHP files by adding the following line at the top of each of them,
to refrain from executing sensitive standalone PHP code before calling any WordPress functions
*/
defined( 'ABSPATH' ) or die( 'Restricted access!' );


/*
function showing the widget via isosize-widget file and jquery
*/
function isosize_show_widget(){
    wp_enqueue_script('isosize-widget', plugin_dir_url(__FILE__) . 'isosize-widget.js', array('jquery'));

}
// when hook is activated ie when x part is loaded, add the widget
//add_action( 'wp_head', 'isosize_show_widget'); // loads in head
add_action('wp_enqueue_scripts','isosize_show_widget');

/*
 Add widget css file.
 wp_enqueue_style(1,2,3,4,5);
    1. the name – whatever, best to be similar to the style – compulsory
    2. the location – where the style is stored –  compulsory
    3. any dependent stylesheets – what other styles if any are required – optional
    4. the version – name this whatever, best to name it what the version actually is – optional – defaults to WordPress version number
    5. media type – for example, ‘all’, ‘print’, ‘handheld’ –  optional – defaults to all
*/
function isosize_adding_styles_widget() {
	wp_enqueue_style('isosize-stylesheet-widget', plugin_dir_url(__FILE__) . 'isosize-stylesheet-widget.css');
}
// has to be in the head tag for css to be loaded
add_action('wp_head', 'isosize_adding_styles_widget');


//////////////SETTING PAGE ////////////////////


/*
 Attach settings page
 Get the filesystem directory path (with trailing slash) for the plugin __FILE__ passed in
*/
require_once( plugin_dir_path( __FILE__ ) . 'isosize-settings.php' );

/*
    Page title – used in the title tag of the page (shown in the browser bar) when it is displayed.
    Menu title – used in the menu on the left.
    Capability – the user level allowed to access the page.
    Menu slug – the slug used for the page in the URL.
    Function – the name of the function you will be using to output the content of the page.
    Icon – A url to an image or a Dashicons string.
    Position – The position of your item within the whole menu.
*/

function isosize_register_settings_submenu() {
	//add_options_page( 'Isosize Widget Settings', 'Isosize widget', 'manage_options', basename( __FILE__ ), 'isosize_render_settings_page' );
    add_menu_page('Isosize Widget Settings', 'Isosize settings', 'administrator', 'isosize-plugin-settings', 'isosize_render_settings_page', 'dashicons-admin-generic');
    //add_menu_page('Isosize Widget Settings', 'Isosize settings', 'administrator', 'my-plugin-settings', 'my_plugin_settings_page', 'dashicons-admin-generic');
}
add_action( 'admin_menu', 'isosize_register_settings_submenu' );


/*Adding css file to widget setting page*/
/*
function isosize_adding_styles_settings() {
	wp_enqueue_style('isosize-stylesheet-settings', plugin_dir_url(__FILE__) . 'isosize-stylesheet-settings.css');
}
*/
//add_action('admin_enqueue_scripts', 'isosize_adding_styles_settings');


?>
