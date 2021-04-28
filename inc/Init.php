<?php
/**
 * @package Lang-changer
 */

namespace Inc;

class Init
{
    
    public static function get_services()
    {
        return array(Pages\Admin::class,  Base\Enqueue::class, Base\SettingsLinks::class );
    }
    
    public static function register_services()
    {
        foreach (self::get_services() as $class)
        {
            $service = self::instantiate( $class);
            if(method_exists($service,'register'))
            {
                $service->register();
            }
        }
        
    }
    
    private static function instantiate( $class )  
    {
        $service = new $class();  
        return $service;
    }
}




// Inc\Base\Activate;
// use Inc\Base\Deactivate;
// use Inc\Pages\Admin;

// class lang_Changer
// {
    
//     public $plugin;
    
//     function __construct()
//     {
//         $this->plugin =  plugin_basename(__FILE__);
//     }
    
    
//     function register()
//     {
//         add_action('init', array($this, 'custom_post_type'));
//         add_action('admin_enqueue_scripts', array($this, 'enqueue' ));
//         add_action('wp_enqueue_scripts', array($this, 'enqueue' ));
//         add_action('admin_menu', array($this,'add_admin_pages' ));
     
        
//         add_filter("plugin_action_links_$this->plugin", array( $this, 'settings_link'));
        
//     }
    

//     function custom_post_type()
//     {
//         register_post_type('translate', ['public' => true, 'label' =>'Translate' ]);
//     }
   
    
// }

// if (class_exists('lang_Changer'))
// {
//     $lang_Changer = new lang_Changer();
//     $lang_Changer->register();
//     //lang_Changer::register();    
// }

