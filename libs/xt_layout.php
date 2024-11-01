<?php

class xt_layout extends ctTemplate
{
	
    public function __construct()
    {
    	//load wordpress
        //require_once(ABSPATH.'wp-load.php');
        
    }
    
    public function xt_theme($theme='theme'){
    	$this->loadTemplate($theme);
    }
    
    public function page($_page = null) {
    	
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
            	$_page = get_post_meta($id, '_wp_page_template', true);
                $page =  ($page == 'default' ? 'page.php' : $page);             
                
            } else
            	$page = 'page.php';
                
        }
        
        if($page AND file_exists(TEMPLATEPATH.'/'.$dir.'/'.$page)){
        	return TEMPLATEPATH.'/'.$dir.'/'.$page;
        } else {
        	return false;
        }
    	
    	
    }

}