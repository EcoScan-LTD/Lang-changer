<?php
/**
* @package Lang-changer
*/

namespace Inc\Pages;


use \Inc\Base\BaseController;
use \Inc\Api\SettingsApi;
use \Inc\Api\Callbacks\AdminCallbacks;

class Admin extends BaseController
{
    
    public $settings;
    
    public $callbacks;
    
    public $pages = array();
    
    public $subpages = array();
    
    
    public function register()
    {
        $this->settings = new SettingsApi();
        
        $this->callbacks = new AdminCallbacks();
        
        $this->setPages();
        
        $this->setSubpages();
        
        
        $this->setSettings();
        
        $this->setSections();
        
        $this->setFields();
        
        
        $this->settings->addPages($this->pages)->withSubPage('Dashboard')->addSubPages($this->subpages)->register();
    }
    
    public function setPages()
    {
        $this->pages =
        [
            ['page_title' => 'Lang-changer Plugin',
                'menu_title'=> 'Lang-changer',
                'capability' => 'manage_options',
                'menu_slug' => 'lang_Changer',
                'callback' => array($this->callbacks, 'adminDashboard'),
                'icon_url' => 'dashicons-translation',
                'position' => 110
                ],
                ['page_title' => 'Lang-changer Plugin Help',
                    'menu_title'=> 'Help',
                    'capability' => 'manage_options',
                    'menu_slug' => 'lang_Changer_plugin_Help',
                    'callback' => array($this->callbacks, 'helpPage'),
                    'icon_url' => 'dashicons-external',
                    'position' => 111
                    ]
                    ];
        
    }
    
    public function setSubpages()
    {
        $this->subpages =
        [
            [
                'parent_slug' => 'lang_Changer',
                'page_title' => 'Sub-page 1',
                'menu_title'=> 'Sub-Page 1',
                'capability' => 'manage_options',
                'menu_slug' => 'sub_page_1',
                'callback' => array($this->callbacks, 'subPage')
            ],
            [
                'parent_slug' => 'lang_Changer', //Need to be the same as a "pages"  'menu_slug' => 'lang_Changer_plugin', won't appear if can't find in menu to sub menu
                'page_title' => 'Sub-page 2',
                'menu_title'=> 'Sub-Page 2',
                'capability' => 'manage_options',
                'menu_slug' => 'sub_page_2',
                'callback' => array($this->callbacks, 'subPage')
            ]
            ];
        
    }    
    
    public function setSettings()
    {
        $args = array(
            array(           
                
            'option_group' =>'lang_Changer_options_group',
            'option_name' => 'text_example',
                'callback' => array($this->callbacks, 'lang_ChangerOptionsGroup')               
            ),
            array(
                
                'option_group' =>'lang_Changer_options_group',
                'option_name' => 'first_name'
            )
        );
        
        $this->settings->setSettings($args);
    }
    
    public function setSections()
    {
        $args = array(
            array(
                
                'id' =>'lang_Changer_admin_index',
                'title' => 'Settings',
                'callback' => array($this->callbacks, 'lang_ChangerAdminSection'),
                'page' => 'lang_Changer'
            )
        );
        
        $this->settings->setSections($args);
    }
    
    
    public function setFields()
    {
        $args = array(
            array(
                'id' =>'text_example',
                'title' => 'Field Title',
                'callback' => array($this->callbacks, 'lang_ChangerTextExample'),
                'page' => 'lang_Changer',
                'section'=>'lang_Changer_admin_index',
                'args' => array(
                    'label_for'=> 'text_example',
                    'class' => 'example_class'
                )
            ),
            array(
                'id' =>'first_name',
                'title' => 'First Name',
                'callback' => array($this->callbacks, 'lang_ChangerFirstName'),
                'page' => 'lang_Changer',
                'section'=>'lang_Changer_admin_index',
                'args' => array(
                    'label_for'=> 'first_name  ',
                    'class' => 'example_class'
                )
            )
        );
        
        $this->settings->setFields($args);
    }
    
    
//     public function add_admin_pages()
//     {
//         add_menu_page('lang_Changer Plugin','lang_Changer', 'manage_options', 'lang_Changer_plugin', array($this, 'admin_index'), 'dashicons-translation', 110);
//     }
    
//     public function admin_index()
//     {
//         require_once $this->plugin_path . 'templates/admin.php';
//     }
}
