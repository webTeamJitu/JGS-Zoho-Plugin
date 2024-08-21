<?php

/*
 * Plugin Name: Jitu Global Staffing Application Form
 * Plugin URI: https://www.zohocrm.com/plugins/Jitu-Global-Staffing-Application-Form
 * Description: This plugin allows you to create a Jitu Global Staffing Application Form in Zoho CRM.
 * Author: Jitu
 * Author URI: https://www.zohocrm.com/plugins/Jitu-Global-Staffing-Application-Form
 * Version: 1.0.0
 * Compatible with Zoho CRM versions: 7.0.0
 * Compatible with PHP versions: 5.2.4
 */
namespace JituGlobalStaffing;

if (!defined('ABSPATH')) {
    exit;
}

class JituGlobalStaffing {
    private $admin;
    private $db;
    private $zohoCalls;
    private $data;
    private $tokensRefresh;
    private $zoho;

    public function __construct() {
        $this->define_constants();
        $this->include_files();
        $this->init_classes();
        $this->setup_hooks();
    }

    private function define_constants() {
        define('JGS_PLUGIN_NAME', 'Jitu Global Staffing Application Form');
        define('JGS_PLUGIN_VERSION', '1.0.0');
        define('JGS_PLUGIN_AUTHOR', 'Jitu');
        define('JGS_PLUGIN_AUTHOR_URI', 'https://www.zohocrm.com/plugins/Jitu-Global-Staffing-Application-Form');
        define('JGS_PLUGIN_DIR_URL', plugin_dir_url(__FILE__));
        define('JGS_PLUGIN_DIR_PATH', plugin_dir_path(__FILE__));
        define('JGS_PLUGIN_BASENAME', plugin_basename(__FILE__));
    }

    private function include_files() {
        include_once(JGS_PLUGIN_DIR_PATH . 'admin/ui/class.dashboard.php');
        include_once(JGS_PLUGIN_DIR_PATH . 'admin/database/class.init.php');
        include_once(JGS_PLUGIN_DIR_PATH . 'admin/database/class.data.php');
        include_once(JGS_PLUGIN_DIR_PATH . 'admin/zoho/functions.php');
        include_once(JGS_PLUGIN_DIR_PATH . 'admin/zoho/tokens.php');
        include_once(JGS_PLUGIN_DIR_PATH . 'admin/zoho/class.zohoCalls.php');
        include_once(JGS_PLUGIN_DIR_PATH . 'admin/index.php');
        include_once(JGS_PLUGIN_DIR_PATH . 'form.php');
    }

    private function init_classes() {
        if (class_exists('Admin\Zoho\ZohoCalls')) {
            $this->zohoCalls = new \Admin\Zoho\ZohoCalls();
        }
        if (class_exists('Admin\UI\Dashboard')) {
            $this->dashboard = new \Admin\UI\Dashboard();
        }
        if (class_exists('Admin\Database\Init')) {
            $this->db = new \Admin\Database\Init();
        }
        if (class_exists('Admin\Database\Data')) {
            $this->data = new \Admin\Database\Data();
        }
        if (class_exists('Admin\Database\ZohoAPIData')) {
            $this->databaseActions = new \Admin\Database\ZohoAPIData();
        }
        if (class_exists('Admin\JGSZoho\Admin')) {
            $this->admin = new \Admin\JGSZoho\Admin();
        }
        if (class_exists('Admin\Zoho\WP_Admin_Calls\ZohoData')) {
            $this->zoho = new \Admin\Zoho\WP_Admin_Calls\ZohoData();
        }
        if (class_exists('Admin\Zoho\Tokens\ZohoTokenRefresher')) {
            $this->tokensRefresh = new \Admin\Zoho\Tokens\ZohoTokenRefresher();
        }
    }

    private function setup_hooks() {
        add_action('wp_enqueue_scripts', [$this, 'enqueue_assets']);
        add_shortcode('jitu_global_staffing', [$this, 'render_form']);
        add_filter('cron_schedules', [$this, 'custom_cron_schedules']);
        add_action('jgs_test_cron_job', [$this, 'run_test_success']);
        add_action('jgs_change_status_cron', [$this, 'jgs_change_status_cron']);
        add_action('admin_notices', [$this, 'display_invalid_token_notice']);

        register_activation_hook(__FILE__, [$this, 'activate']);
        register_deactivation_hook(__FILE__, [$this, 'deactivate']);
    }

    public function custom_cron_schedules($schedules) {
        $schedules['every_minute'] = [
            'interval' => 60,
            'display'  => esc_html__('Every Minute')
        ];
        return $schedules;
    }

    public function activate() {
        if ($this->db) {
            $this->db->installDb();
        }

        // Register the cron for fetching data
        if (!wp_next_scheduled('jgs_test_cron_job')) {
            wp_schedule_event(time(), 'every_minute', 'jgs_test_cron_job');
        }

        // Register the cron for changing status
        if(!wp_next_scheduled('jgs_change_status_cron')){
            wp_schedule_event(time(), 'every_minute', 'jgs_change_status_cron');
        }
    }

    public function deactivate() {
        if ($this->db) {
            $this->db->uninstallDb();
        }

        // Unschedule the cron for fetching data
        $fetch_timestamp = wp_next_scheduled('jgs_test_cron_job');
        wp_unschedule_event($fetch_timestamp, 'jgs_test_cron_job');

        // Unschedule the cron for changing status
        $status_change_timestamp = wp_next_scheduled('jgs_change_status_cron');
        wp_unschedule_event($status_change_timestamp, 'jgs_change_status_cron');
    }

    public function enqueue_assets() {
        if (is_page('jitu-staffing-job-application-form')) {
            wp_enqueue_style('zf-css', JGS_PLUGIN_DIR_URL . 'css/style.css', [], JGS_PLUGIN_VERSION);
            wp_enqueue_script('zf-js', JGS_PLUGIN_DIR_URL . 'js/scripter.js', ['jquery'], JGS_PLUGIN_VERSION, true);
        }
    }

    public function render_form($atts, $content = null) {
        return form();
    }

    public function run_test_success() {
        $response = $this->zoho->fetchCandidates();

        if (isset($response['code']) && $response['code'] === 'INVALID TOKEN') {
            update_option('jgs_invalid_oauth_token', true);
        } else {
            delete_option('jgs_invalid_oauth_token');
        }
    }

    public function jgs_change_status_cron() {
        $this->zohoCalls->zohoChangeStatus();
    }

    public function display_invalid_token_notice() {
        if (get_option('jgs_invalid_oauth_token')) {
            echo '<div class="notice notice-error is-dismissible">
            <p><strong>Invalid OAuth Token:</strong> The OAuth token used in the Jitu Global Staffing plugin is invalid. Please refresh the token.</p>
        </div>';
        }
    }
}

// Initialize the plugin
new JituGlobalStaffing();
