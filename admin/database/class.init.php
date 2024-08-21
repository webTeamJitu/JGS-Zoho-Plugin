<?php
namespace Admin\Database;

use database\DBConsts;

if (!defined('ABSPATH')) {
    exit;
}
class Init {
    private $table_name;
    private $jgs_zoho_table;
    private $charset_collate;
    public $version;

    public function __construct() {
        global $wpdb;
        global $dbjgs_version;

        $this->table_name = $wpdb->prefix . "jgs";
        $this->jgs_zoho_table = $wpdb->prefix . "jgs_zoho_table";

        // Only run this during plugin activation, not on every instantiation
        if (!$this->version || version_compare($this->version, $dbjgs_version, '<')) {
            $this->installDb();
        }
    }

    public function installDb() {
        global $wpdb;
        global $dbjgs_version;

        $this->jgsCreateZohoDefaultDataTable();
        $this->seedData();
        $this->jgsCreateZohoTable();

        update_option('jgs_db_version', $this->version);
    }

    public function jgsCreateZohoDefaultDataTable() {
        global $wpdb;
        $charset_collate = $wpdb->get_charset_collate();

        $sql = "CREATE TABLE {$this->table_name} (
            id int(9) NOT NULL AUTO_INCREMENT,
            redirect_uri varchar(255) DEFAULT NULL,
            client_id varchar(255) DEFAULT NULL,
            client_secret varchar(255) DEFAULT NULL,
            refresh_token varchar(255) DEFAULT NULL,
            access_token varchar(255) DEFAULT NULL,
            expires_in int DEFAULT NULL,
            scope varchar(255) DEFAULT NULL,
            PRIMARY KEY  (id)
        ) $charset_collate;";

        include_once ABSPATH . 'wp-admin/includes/upgrade.php';
        dbDelta($sql);
    }

    public function jgsCreateZohoTable() {
        global $wpdb;
        $charset_collate = $wpdb->get_charset_collate();

        $sql = "CREATE TABLE {$this->jgs_zoho_table} (
            id int(9) NOT NULL AUTO_INCREMENT,
            candidate_id varchar(255) DEFAULT NULL,
            candidate_name varchar(255) NOT NULL,
            candidate_status varchar(100) NOT NULL,
            role varchar(100) NULL,
            candidate_stage varchar(100) NOT NULL,
            created_at datetime NOT NULL,
            updated mediumint(9) DEFAULT 1,
            updated_at datetime DEFAULT NULL,
            PRIMARY KEY  (id)
        ) $charset_collate;";

        include_once ABSPATH . 'wp-admin/includes/upgrade.php';
        dbDelta($sql);
    }

    public function uninstallDb() {
        global $wpdb;
        $wpdb->query("DROP TABLE IF EXISTS {$this->table_name}");
        $wpdb->query("DROP TABLE IF EXISTS {$this->jgs_zoho_table}");
    }

    private function seedData() {
        global $wpdb;

        // Seed only if table is empty
        $row = $wpdb->get_row("SELECT * FROM {$this->table_name} LIMIT 1");

        if (is_null($row)) {
            $data = [
                'redirect_uri' => 'https://ba79-41-209-57-189.ngrok-free.app/zohoapi/gettoken',
                'client_id' => '1000.CWHP1B4K51EV9DDI41J1LYRVYWSN2I',
                'client_secret' => 'fa614f81a3dc7fe22848c4e4cedf41aa256e9901f8',
                'scope' => 'ZohoRecruit.modules.all',
                'refresh_token' => '1000.55767621209b1f2027071b51d4c0fd2a.2795750ba6c88da34b3ed25ebb878b1b'
            ];

            $wpdb->insert($this->table_name, $data);
        }
    }
}