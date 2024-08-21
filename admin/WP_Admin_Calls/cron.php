<?php

namespace WP_Admin_Calls;

class Cron {
    public function __construct() {
        add_action( 'wp_admin_calls_daily_cron', array( $this, 'daily_cron' ) );
    }

    public function daily_cron() {
        $this->delete_expired_forms();
    }

}
?>
