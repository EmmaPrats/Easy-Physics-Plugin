<?php
/*
Plugin Name: Easy Physics
Plugin URI: https://github.com/Onpu93/Easy-Physics-Plugin
Description: Easily create physics-based animations and add them to your site.
Author: Jazz Emma Prats Camps
Author URI: https://github.com/Onpu93/
License: GPLv3
Version: 1.0
*/

defined( 'ABSPATH' ) or die( 'Unauthorized Access!' );
define( 'WP_DEBUG', true );define( 'WP_DEBUG_LOG', true );
define( 'EPTFG_PLUGIN_NAME', 'easy-physics');
define( 'EPTFG_PLUGIN_VER', '1.0');
define( 'EPTFG_PLUGINS_URL', plugins_url( '', __FILE__ ) );
define( 'EPTFG_PLUGIN_BASENAME', plugin_basename(__FILE__) );

include_once( 'admin/easy-physics-admin.php' );
include_once( 'public/easy-physics-public.php' );
