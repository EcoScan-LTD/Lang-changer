<?php
/**
* @package Lang-changer
*/

/*
 Plugin Name: Lang-changer
 Plugin URI: https://aneurinj.com
 Description: Change Language of websites
 Version: 1.0.0
 Author: Aneurin Jones
 Author URI: https://aneurinj.com
 License: GPLv2 or later
 Text Domain: Lang-changer-plugin
 Domain Path: /languages
 */

defined('ABSPATH') or die('Please use Correctly');

if ( file_exists(dirname(__FILE__) . '/vendor/autoload.php'))
{
    require_once dirname(__FILE__) . '/vendor/autoload.php';
}



use Inc\Base\Activate;
use Inc\Base\Deactivate;


function activate_lang_Changer()
{
    Activate::activate();
}

function deactivate_lang_Changer()
{
    Deactivate::deactivate();
}


add_action('wp_head', 'add_JS_to_Head');
function add_JS_to_Head()
{
    if ( is_page('app-i-use') ) {
        echo "
        <script>
            function myFunction()
            {
                var x = document.getElementById('myDIV');
                if (x.style.display === 'none') {
                x.style.display = 'block';    
                } else {
                x.style.display = 'none';  
            }
        }
        </script>";
    } else {
       
    }

}


function button_Toggle()
{
    
    
    echo'<form method="post">
    <input type="submit" name="test" id="test" value="Welsh" /><br/>
    <input type="submit" name="test2" id="test2" value="English" /><br/>
    </form>';
    
   
    function testfun()
    {
        add_filter( 'locale', function($locale) {
            if($locale == "en_US")
            {
                $locale = "cy";
                
            }
            else
            {
                $locale = "en_US";
            }
           
            return $locale;
        });
    }
    
    if(array_key_exists('test',$_POST)){

        testfun();
    }
    
    echo '<button onclick="myFunction()">';
    _e('Translate', 'Lang-changer-plugin' );


        
    echo'</button><div id="myDIV">This is my DIV element.</div>';
 
}
add_action('admin_menu', 'button_Toggle');


function getext_translate($translated_text, $text, $domain)
{
    if($translated_text=='Translate' && $domain =='Lang-changer-plugin')
    {
        if(get_locale() =="cy")
        {
           
            $translated_text = 'Welsh Translated';
        }
    }
    return $translated_text;
}
add_filter('gettext', 'getext_translate', 20, 3);

register_activation_hook(__FILE__, 'activate_lang_Changer');
register_deactivation_hook(__FILE__, 'deactivate_lang_Changer');



if ( class_exists('Inc\\Init'))
{
     Inc\Init::register_services();
}