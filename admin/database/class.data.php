<?php

namespace Admin\Database;

class Data {
    public function __construct() {
        // Constructor code
    }

    public function get_all_data() {
        global $wpdb;
        $table_name = $wpdb->prefix . 'jgs';
        $data = $wpdb->get_results("SELECT * FROM $table_name");
        return $data;
    }
    public function get_client_id() {
        global $wpdb;
        $table_name = $wpdb->prefix . 'jgs';
        $data = $wpdb->get_results("SELECT * FROM $table_name");
        $client_id = $data[0]->client_id;
        return $client_id; 
    }

    public function get_client_secret() {
        global $wpdb;
        $table_name = $wpdb->prefix . 'jgs';
        $data = $wpdb->get_results("SELECT * FROM $table_name");
        $client_secret = $data[0]->client_secret;
        return $client_secret;
    }

    public function get_redirect_uri() {
        global $wpdb;
        $table_name = $wpdb->prefix . 'jgs';
        $data = $wpdb->get_results("SELECT * FROM $table_name");
        $redirect_uri = $data[0]->redirect_uri;
        return $redirect_uri;
    }
    public function get_refresh_token() {
        global $wpdb;
        $table_name = $wpdb->prefix . 'jgs';
        $data = $wpdb->get_results("SELECT * FROM $table_name");
        $refresh_token = $data[0]->refresh_token;
        return $refresh_token;
    }
    public function get_access_token() {
        global $wpdb;
        $table_name = $wpdb->prefix . 'jgs';
        $data = $wpdb->get_results("SELECT * FROM $table_name");
        $access_token = $data[0]->access_token;
        return $access_token;
    }
    public function get_expires_in() {
        global $wpdb;
        $table_name = $wpdb->prefix . 'jgs';
        $data = $wpdb->get_results("SELECT * FROM $table_name");
        $expires_in = $data[0]->expires_in;
        return $expires_in;
    }
    public function get_scope() {
        global $wpdb;
        $table_name = $wpdb->prefix . 'jgs';
        $data = $wpdb->get_results("SELECT * FROM $table_name");
        $scope = $data[0]->scope;
        return $scope;
    }
    public function get_job_title(){
        global $wpdb;
        $table_name = $wpdb->prefix . 'jgs_zoho_table';
        $data = $wpdb->get_results("SELECT * FROM $table_name");
        $job_title = $data[0]->job_title;
        return $job_title;
    }

    public function update_data($id, $data) {
        global $wpdb;
        $table_name = $wpdb->prefix . 'jgs';
        $wpdb->update($table_name, $data, array('id' => $id));
    }

    public function delete_data($id) {
        global $wpdb;
        $table_name = $wpdb->prefix . 'jgs';
        $wpdb->delete($table_name, array('id' => $id));
    }

    public function insert_data($data) {
        global $wpdb;
        $table_name = $wpdb->prefix . 'jgs';
        $wpdb->insert($table_name, $data);
    }

    public function update_access_token($access_token) {
        global $wpdb;
        $table_name = $wpdb->prefix . 'jgs';
        $wpdb->update($table_name, array('access_token' => $access_token), array('id' => 1));
    }
}

// $Data = new Data();
?>
