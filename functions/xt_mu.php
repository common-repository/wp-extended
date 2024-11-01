<?php 

/**
 * WPMU FUNCTIONS
 */


//$current_site = get_current_site();

function xt_admin_email($domain = '')
{
    if (function_exists('get_admin_users_for_domain'))
    {
        $result = get_admin_users_for_domain($domain);
        return $result;
    }
}

function xt_site_info($param = 'id')
{
    if (function_exists('get_current_site'))
    {
        $current_site = get_current_site();
        if ($param = 'id')
            return $current_site->id;

        if ($param = 'domain')
            return $current_site->domain;

        if ($param = 'site_name')
            return $current_site->site_name;
    }
}

function xt_admin_id()
{
    if (function_exists('get_user_id_from_string'))
    {
        $email = get_bloginfo('admin_email');
        return get_user_id_from_string($email);
    }

}

function xt_bloginfo($string = 'name')
{
    if (function_exists('get_bloginfo'))
    {
        return get_bloginfo($string);
    }
}

function xtmu_sitelist(){
	$blog_list = get_blog_list( 0, 10 );
foreach ($blog_list AS $blog) {
	$name = explode('/',$blog['path']);
    //echo 'Blog '.$blog['blog_id'].': '.$blog['domain'].$blog['path'].'<br />';
    echo "<li><a href=\"http://{$blog['domain']}{$blog['path']}\">{$name[2]}</a></li>";
}
}