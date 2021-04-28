<?php
/**
* @package Lang-changer
*/

namespace Inc\Api\Callbacks;

use \Inc\Base\BaseController;

class AdminCallbacks extends BaseController
{
    public function adminDashboard()
    {
        return require_once ("$this->plugin_path/templates/admin.php");
    }
    
    public function subPage()
    {
        return require_once ("$this->plugin_path/templates/subpage.php");
    }
    
    public function helpPage()
    {
        return require_once ("$this->plugin_path/templates/help.php");
    }
    
    public function lang_ChangerOptionsGroup($input)
    {
        
        return $input;
    }
    public function lang_ChangerAdminSection()
    {
        
       echo 'We are in page Callback';
    }
    public function lang_ChangerTextExample()
    {
        $value = esc_attr( get_option( 'text_example' ));
        
        echo '<input type="text" class="regular-text" name="text_example" value="' . $value . '" placeholder="Enter Text Here...">';
    }
    public function lang_ChangerFirstName()
    {
        $value = esc_attr( get_option( 'first_name' ));
        
        echo '<input type="text" class="regular-text" name="first_name" value="' . $value . '" placeholder="First Name">';
    }

    
}