<?php

namespace Admin\UI;

use Admin\UI\Menus;

class Dashboard {
    private $menus;

    public function __construct() {
        // Include the Menus class
        include_once(plugin_dir_path(__FILE__) . 'class.menus.php');
        $this->menus = new Menus();
        add_action('admin_menu', array($this, 'create_menu'));
    }

    public function create_menu() {
        $this->menus->add_admin_menu();
    }
}
?>
