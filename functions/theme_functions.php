<?php



add_action('admin_menu', 'theme_menu');

function theme_menu()
{
    add_theme_page('base_options', 'Xtended Options', 8, basename(__file__),
        'theme_menus');
}

function theme_menus()
{
	
    if (fRequest::isPost())
    {
    	

			//echo fRequest::get('twitter');
			if(fRequest::get('xt_restore')){
				update_option('xt_twitter','');
				update_option('xt_background','');
				update_option('xt_logo','');
				
			} else {
			if ($twitter = fRequest::get('twitter'))
            {
            	
            	update_option('xt_twitter',$twitter);
            	

            }
            
            if ($background = fRequest::get('background'))
            {
				
            	update_option('xt_background',$background);
            
            }
            
            if ($logo = fRequest::get('site_logo'))
            {
            
            	update_option('xt_logo',$logo);

            }	
				
			}
			
            

    }

?>
  <div class="wrap">
  <h1>Theme Options</h1>
  
 <form action="" method="post">
   <p><label for="background">Set Background</label> 
     Url<br />
   <input name="background" type="text" id="background" value="<?= get_option('xt_background'); ?>" size="65" /></p>
   <p>
     <label for="twitter">Twitter ID: </label><br />

     <input name="twitter" type="text" id="twitter" value="<?= get_option('xt_twitter'
); ?>" size="65" />
   </p>
   <p>
     <label for="site_logo">Header Logo image Url::</label>
     <br />
     <input name="site_logo" type="text" id="site_logo" value="<?= get_option('xt_logo'); ?>" size="65" />
   </p>

   <p><input name="" type="submit" value="Save Theme Options" /></p>
   
 </form>
 
 <form action="" method="post"><p><input name="xt_restore" type="submit" value="Restore Default" /></p></form>
</div>
<? }



?>