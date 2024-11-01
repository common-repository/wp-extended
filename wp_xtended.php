<?php
/*
Plugin Name: WP_Xtended
Plugin URI: http://www.anotherflava.com
Version: 0.1 beta
Author: shawnsandy
Description: Extends wordpress to include custom libaries (Flourish, Zend)
*/

/*
== Installation ==

1. Unzip xtended.zip 
2. Upload to to the /wp-content/plugins/ directory
3. Activate the plugin through the 'Plugins' menu in WordPress by clicking "Wp_Ztended"
4. Go to your WO Extended Panel.
5. Read the instructions on how to use and plugin and Install addition libaries
6. ....
*/

/*  Copyright 2009  Shawn Sandy  (email : shawnsandy04@gmail.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/


/**
 * Defines some server paths
 */


/**
  * XT plugin path
  */ 
define('XT_DIR', WP_PLUGIN_DIR . '/xtended/');

/**
 * XT plugin url
 */
define('XT_URL', WP_PLUGIN_URL . '/xtended/');


define('XT_JS', WP_PLUGIN_URL.'/xtended/js/');
/**
 * PHP libaries (flourish, Zend...)
 */
define('XT_LIBS', XT_DIR . 'libs/');
/**
 * Plugin functions directory
 */
define('XT_FUNCTIONS', XT_DIR . 'functions/');

/**
 * Views directory
 */
 define('XT_VIEWS',XT_DIR.'views/');
 
 /**
  * Current page url just in case
  */
define('XT_CURRENT','http://'.$_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"]);

/**
 * Path to the "Zend" directory 
 * default $_SERVER["DOCUMENT_ROOT"]."zend/library"
 */
define('ZEND_DIR', $_SERVER["DOCUMENT_ROOT"]."/zend/library");

/**
 * Flourish Library
 */
 
define('FLOURISH_DIR', $_SERVER["DOCUMENT_ROOT"]."/flourish");


/**
 * include the autoloader REQUIRED
 */
 
require_once(XT_FUNCTIONS.'xt_loader.php');



/**
 * xt_mu()
 * include mu function in the theme
 * @return void
 */
function xt_mu(){
	require_once(XT_FUNCTIONS.'xt_mu.php');
}

/**
 * xt_mu()
 * include mu function in the theme
 * @return void
 */
function xt_shortcode(){
	require_once(XT_FUNCTIONS.'xt_shortcodes.php');
}


function xt_theme_options(){
	require_once(XT_FUNCTIONS.'theme_functions.php');
}

/**
 * include the custom loader(s) REQUIRED
 */
if(file_exists(XT_DIR.'custom_loader.php')){
	require_once(XT_DIR.'custom_loader.php');
}


/**
 * view()
 * 
 * @param mixed $view the name of the php file in the views floder without extensions
 * @return void
 * @example view('views');
 */
function view($view){
	
	include(XT_VIEWS . $view . '.php');
}

/**
 * NOW Some Wordpress
 */



add_action('admin_menu', 'xt_admin_menu');



/**
 * xt_admin_menu()
 * 
 * @return void
 */
function xt_admin_menu()
{
    add_menu_page('wp_xtended', 'WP Xtended', 8, basename(__file__), 'xt_menu');
    
    add_submenu_page(basename(__file__),'XT Templates','XT Themes',8,'xt-themes','xt_themes');
    
    add_submenu_page(basename(__file__),'960 CSS Framework','960 CSS',8,'xt-960','xt_css');
    
    add_submenu_page(basename(__file__),'Flourish: Help','Flourish Info',8,'xt-flourish','xt_flourish_view');
    
    add_submenu_page(basename(__file__),'Zend: Help','Zend Info',8,'xt-zend','xt_zend_view');
    
    add_submenu_page(basename(__file__),'WP_Xtended: Help','XT Help',8,'xt-help','xt_help');
}

/**
 * xt_verify()
 * 
 * @return void
 */
function xt_verify()
{ ?>
<div class="warp">
    <?php
	if (!file_exists(ZEND_DIR . '/Zend/Exception.php'))
        echo "<h5 style=\"color:red;\">Zend library not found...</h5> ZEND_DIR:- ". ZEND_DIR .
		'<br /> Current directory ' . $_SERVER["PHP_SELF"] ;
?>

    <?php
	if (!file_exists(XT_LIBS . 'flourish/fCore.php'))
        echo "<h5 style=\"color:red;\">Flourish library not found...</h5>";
?>

   <?php
	 if (!file_exists(XT_LIBS . 'flourish/fCore.php') )
    {
        echo "<h5 style=\"color:red;\">Please got to XT_Help for Library Download & Install Instructions</h5>";
    } else
    echo "<h5>OK seems link we are ready to rock & roll</h5>";
?>
</div>
<?
}

/**
 * xt_menu()
 * 
 * @return void
 */
function xt_menu()
{
   view('xt_extended');
}

/**
 * xt_help()
 * 
 * @return void
 */
function xt_help(){
	
	view('help');
}

function xt_flourish_view()
{
	view('flourish');
}

function xt_zend_view(){
	view('zend');
}

function xt_themes(){
	view('themes');
}

function xt_css(){
	view('960css');
}

/**
 * @version WP 2.7
 * Add action link(s) to plugins page
 */
function set_plugin_meta27($links) {
 
	$plugin = plugin_basename(__FILE__);
 
	$settings_link = sprintf( '<a href="options-general.php?page=%s">%s</a>', 'wp_xtended.php', __('Settings') );
	array_unshift( $links, $settings_link );
 
	return $links;
}
 
add_filter( 'plugin_action_links_' . $plugin, 'set_plugin_meta27' );

?>