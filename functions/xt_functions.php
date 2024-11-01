<?php

/**
 * @package WordPress
 * @subpackage WP_XTENDED
 */
 
 
 
/**
 * xt_sidebars()
 * 
 * @param mixed $sidebars
 * @param string $class_name
 * @return void
 */
function xt_sidebars($sidebars=array(),$class_name='widget'){
	if ( function_exists('register_sidebar') ){
    register_sidebar(array(
        'before_widget' => '<li id="%1$s" class="widget %2$s">',
        'after_widget' => '</li>',
        'before_title' => '<h3 class="widgettitle">',
        'after_title' => '</h3>',
    ));
 	foreach($sidebars as $name) {
		register_sidebar(array('name'=> $name,
			'before_widget' => '<div class="{$class_name}">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="widgettitle">',
			'after_title' => '</h3>',
		));
	}
	}
}


/**
 * xt_shortcode_widget()
 * @abstract Add shortcode functionality to your sidebar text widget 
 * 
 * @return void
 */
function xt_shortcode_widget(){
	add_filter('widget_text', 'do_shortcode');
}

/**
 * xt_first_image()
 * 
 * @return
 */
function xt_first_image()
{
    global $post, $posts;
    $first_img = '';
    ob_start();
    ob_end_clean();
    $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content,
        $matches);
    $first_img = $matches[1][0];

    if (empty($first_img))
    { //Defines a default image
        //$first_img = "/images/default.jpg";
        return false;
    }
    return $first_img;
}


/**
 * image_attachment()
 * 
 * @param mixed $key
 * @param mixed $width
 * @param mixed $height
 * @return
 */
function xt_image_meta($key, $width=500, $height=300)
{
    global $post;
    $custom_field = get_post_meta($post->ID, $key, true);
	
    if ($custom_field)
    { //if the user set a custom field
        echo '<img src="' . $custom_field . '" alt="" width="' . $width . '" height="' .
            $height . '"/>';
    } else
    { //else, return
        return;
    }
}


function xt_thumbs($img,$w=150,$h=150,$zc=1,$q=80){
	// <img src="/scripts/timthumb.php?src=/images/whatever.jpg&w=150&h=200&zc=1" alt="" />
	$dir = get_bloginfo('wpurl').'/wp-content/plugins/xtended/libs/';
echo "<img src='{$dir}thumbs.php?src={$img}&w={$w}&h={$h}&zc={$zc}' alt='{$img}' />";
}


//WPMU Specfic functions


//get the most active blogs
function xt_most_active_blogs($limit = 5)
{
    if (function_exists('get_most_active_blogs'))
    {
        $most_active = get_most_active_blogs($limit, false);
        foreach ($most_active as $active)
        {
            $name = explode('.', $active['domain']);
            echo '<strong><a href="http://' . $active['domain'] . ' " >' . ucfirst($name[0]) .
                '</a> (' . $active['postcount'] . ' )</strong><br />';
        }
    }

}


function xt_theme(){
	include_once(TEMPLATEPATH.'/'.'index.php');
}


function xt_pages($_page=null,$dir='views')
    {
    	
		global $post, $posts;
    	
    	if($_page != NULL AND file_exists(TEMPLATEPATH.'/'.$dir.'/'.$_page.'.php')){
    		return TEMPLATEPATH.'/'.$dir.'/'.$_page;
    	}
    	
    	


        if (is_single())
        {
            //try and id the page
            $page = 'single.php';
        }


        if (is_author())
        {
            $page = 'author.php';
        }

        if (is_date() or is_year() or is_month() or is_time())
        {
            $page = 'date.php';
        }

        if (is_search())
        {
            $page = 'single.php';
        }

        if (is_404())
        {
            $page = '404.php';
        }

        if (is_page())
        {
            if ($id = $post->ID)
            {                
                $page = get_post_meta($id, '_wp_page_template', true);              
                
            } else
                $page = 'page.php';
        }
        
        if($page AND file_exists(TEMPLATEPATH.'/'.$dir.'/'.$page)){
        	return TEMPLATEPATH.'/'.$dir.'/'.$page;
        } else {
        	return false;
        }

    }


function xt_resize_image($img,$width,$height,$x_pos=0,$y_pos=0) {
	
	$image = new fImage($img);
	$image->crop($x_pos,$y_pos,$width,$height);
	$image->saveChanges();
	
}

function xt_rename_file($newname){
	$file = new fFile();
	$name = $file->rename($newname,false);
	return $name;
}

function xt_copy_file($file,$new_dir){
	$file = new fFile($file);
	$file->rename();
}

/**
 * xt_hide_generator()
 * hides the wordpress generator
 * @return void
 */
function xt_hide_generator(){
	remove_action('wp_head', 'wp_generator');
}

/**
 * xt_disable_xmlrpc()
 * disable xmrpc headers
 * @return void
 */
function xt_disable_xmlrpc(){
		remove_action('wp_head', 'rsd_link');
	remove_action('wp_head', 'wlwmanifest_link');
}

/**
 * xt_remove_login()
 * 
 * @return void
 */
function xt_remove_login(){
	//via:- WP ENGINEER
	if ( basename($_SERVER['PHP_SELF']) == 'wp-login.php' )
	add_action( 'style_loader_tag', create_function( '$a', "return null;" ) );
}


/**
 * _custom_login()
 * Customise the login
 * @param string $css
 * @return void
 * @example add_action('login_head', 'custom_login');
 * function custom_login(){
 	* _custom_login(login.css);
 }
 */
function xt_custom_login($css=NULL){
	//via:- WP ENGINEER
	if($css == NULL){
		echo '<link rel="stylesheet" type="text/css" href="' . 
		PLUGINDIR . '/xtended/css/login.css" />'
		;	
	} else {
		echo '<link rel="stylesheet" type="text/css" href="' . get_bloginfo('template_directory') . '/'.$css .'" />' 
		;
	}
}




/**
 * xt_post_id()
 * get the post ID outside the loop
 * 
 * @return
 */
function xt_post_id(){
	global $wp_query;
	if($postid = $wp_query->post->ID)
	return $postid;
	else 
	return false;	
}

function xt_page_template(){
	if($id = xt_post_id()){
		
	} else 
	return false;
}

/**
 * Recent Comments
 */
function xt_recent_post($cat='',$num=5){
	
	$feat_posts = get_posts('numberposts='.$num.'&category='.$cat);
	foreach ($feat_posts as $feat) {
	echo '<li><a href="'.get_permalink($feat->ID).'">'.$feat->post_title.'</a></li>';
	}
}




/**
 * Get the most populat post
 * wp_recipies
 */
function xt_popular_post($limit=5){
	global $wpdb;
$result = $wpdb->get_results("SELECT comment_count,ID,post_title FROM $wpdb->posts ORDER BY comment_count DESC LIMIT 0 , {$limit}");
foreach ($result as $post) {
setup_postdata($post);
$postid = $post->ID;
$title = $post->post_title;
$commentcount = $post->comment_count;
if ($commentcount != 0) 
echo '<li><a href="'.get_permalink($postid).'" title="'.$title .' >"'.$title.'</a> </li>';

}
}


/**
 * Displays Breadcrumbs style if breadcrumbs
 * wp recipies
 */
function xt_breadcrumbs() {

if ((is_page() && !is_front_page()) || is_home() || is_category() || is_single()) {
   echo '<ul id="breadcrumbs">';
   echo '<li class="front_page"><a href="'.get_bloginfo('url').'">Home</a></li>';
   $post_ancestors = get_post_ancestors($post);
   if ($post_ancestors) {
      $post_ancestors = array_reverse($post_ancestors);
      foreach ($post_ancestors as $crumb)
          echo '<li><a href="'.get_permalink($crumb).'">'.get_the_title($crumb).'</a></li>';
   }
   if (is_category() || is_single()) {
      $category = get_the_category();
      echo '<li><a href="'.get_category_link($category[0]->cat_ID).'">'.$category[0]->cat_name.'</a></li>';
   }
   if (!is_category())
      echo '<li class="current"><a href="'.get_permalink().'">'.get_the_title().'</a></li>';
   echo '</ul>';
}

}



/**
 * 
/*
** $str -String to truncate
** $length - length to truncate
** $trailing - the trailing character, default: "..."
//take off chars for the trailing
*/

function xt_truncate($str, $length=10, $trailing='...')
{

	  $length-=mb_strlen($trailing);
	  if (mb_strlen($str)> $length)
	  {
		 // string exceeded length, truncate and add trailing dots
		 return mb_substr($str,0,$length).$trailing;
	  }
	  else
	  {
		 // string was already short enough, return the string
		 $res = $str;
	  }
	  return $res;
}

function xt_img_path($path){
	$img = explode(get_bloginfo('wpurl'), $path);
	if($img[1])
	return $img[1];
	else return $img[0];
}

function xt_vtip(){
	$css = '<script type="text/javascript" src="'.XT_JS.'vtip/vtip-min.js"></script> 
	';
	$vtip = '<link rel="stylesheet" type="text/css" href="'.XT_JS.'vtip/css/vtip.css" />
	 ';
	echo $vtip ;
	echo $css;
}

function xt_load_vtip(){
	add_action('wp_head','xt_vtip');
}

function tooltip(){
	$ti = '<script type="text/javascript" src="'.XT_JS.'tooltip/script.js"></script>';
	echo $ti ;
}

function xt_load_tooltip(){
	add_action('wp_head','tooltip');
}