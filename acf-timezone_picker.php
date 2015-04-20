<?php

/*
Plugin Name: Advanced Custom Fields: Timezone
Plugin URI: https://github.com/DocWatson/acf-timezone-picker
Description: An Advanced Custom Fields plugin that allows you to pick from a list of TimeZones
Version: 1.0.0
Author: Beau Watson
Author URI: http://beauwatson.com
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

// 1. set text domain
// Reference: https://codex.wordpress.org/Function_Reference/load_plugin_textdomain
load_plugin_textdomain( 'acf-timezone_picker', false, dirname( plugin_basename(__FILE__) ) . '/lang/' );




// 2. Include field type for ACF5
// $version = 5 and can be ignored until ACF6 exists
function include_field_types_timezone_picker( $version ) {

	include_once('acf-timezone_picker-v5.php');

}

add_action('acf/include_field_types', 'include_field_types_timezone_picker');


// 3. Include field type for ACF4
function register_fields_timezone_picker() {

    include_once('acf-timezone_picker-v4.php');

}
add_action('acf/register_fields', 'register_fields_timezone_picker');

?>
