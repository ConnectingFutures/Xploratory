<?php
namespace ULTP_PRO;

defined('ABSPATH') || exit;

class ULTP_PRO_Initialization{

    public function __construct(){
        $this->requires();
    }

    // Require File
    public function requires() {
        require_once ULTP_PRO_PATH.'classes/Notice.php';
        new \ULTP_PRO\Notice();
        if ( ultimate_post_pro()->is_ultp_free_ready() ) {
            $this->include_addons();
        }

        // Pro Plugin Updater Class
        require_once ULTP_PRO_PATH.'classes/updater/License.php';
        new \ULTP_PRO\License();

        register_activation_hook(ULTP_PRO_PATH.'ultimate-post-pro.php', array($this, 'install_hook'));
    }

    public function install_hook(){
        ultimate_post_pro()->set_addons_data();
    }

    // Include Addons directory
	public function include_addons() {
		$addons_dir = array_filter(glob(ULTP_PRO_PATH.'addons/*'), 'is_dir');
		if (count($addons_dir) > 0) {
			foreach( $addons_dir as $key => $value ) {
				$addon_dir_name = str_replace(dirname($value).'/', '', $value);
				$file_name = ULTP_PRO_PATH . 'addons/'.$addon_dir_name.'/init.php';
				if ( file_exists($file_name) ) {
					include_once $file_name;
				}
			}
		}
    }
    
    
}