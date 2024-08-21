<?php

namespace Admin\UI;

use Admin\Database\Data;

class Menus {
    public function __construct() {
        // Constructor code
        include_once(plugin_dir_path(__DIR__) . 'database/class.data.php');

        $this->data = new Data();

    }
    
    public function add_admin_menu() {
        add_menu_page(
            'Jitu Global Staffing Application Form',
            'Jitu Global Staffing Application Form',
            'manage_options',
            'jitu-global-staffing-application-form',
            array($this, 'render'),
            'dashicons-admin-generic',
            6
        );
    }

    public function render() {
        $all_data = $this->data->get_all_data();
        $client_id = $this->data->get_client_id();
        
        echo '<div class="wrap">';
        echo '<h1>Jitu Global Staffing Application Form</h1>';
        echo '<p>Welcome to the Jitu Global Staffing Application Form.</p>';
        echo '</div>';

        //display data stored in database as a table
        echo '<table class="wp-list-table widefat fixed striped">';
        echo '<thead>';
        echo '<tr>';
        echo '<th>ID</th>';
        echo '<th>Redirect URI</th>';
        echo '<th>Client ID</th>';
        echo '<th>Client Secret</th>';
        echo '<th>Refresh Token</th>';
        echo '<th>Access Token</th>';
        echo '<th>Expires In</th>';
        echo '<th>Scope</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';
        foreach ($all_data as $row) {
            echo '<tr>';
            echo '<td>' . $row->id . '</td>';
            echo '<td>' . $row->redirect_uri . '</td>';
            echo '<td>' . $row->client_id . '</td>';
            echo '<td>' . $row->client_secret . '</td>';
            echo '<td>' . $row->refresh_token . '</td>';
            echo '<td>' . $row->access_token . '</td>';
            echo '<td>' . $row->expires_in . '</td>';
            echo '<td>' . $row->scope . '</td>';
            echo '</tr>';
            echo '</tbody>';
            echo '</table>';
        }

        $this->editFormRender();
    }

    public function editFormRender() {
        echo '<div class="wrap">';
        echo '<h1>Edit Form</h1>';
        echo '<form method="post" action="'.$this->editFormProcess().'">';
        echo '<label for="redirect_uri">Redirect URI:</label>';
        echo '<input type="text" name="redirect_uri" value="' . $this->data->get_redirect_uri() . '"><br>';
        echo '<label for="client_id">Client ID:</label>';
        echo '<input type="text" name="client_id" value="' . $this->data->get_client_id() . '"><br>';
        echo '<label for="client_secret">Client Secret:</label>';
        echo '<input type="text" name="client_secret" value="' . $this->data->get_client_secret() . '"><br>';
        echo '<label for="refresh_token">Refresh Token:</label>';
        echo '<input type="text" name="refresh_token" value="' . $this->data->get_refresh_token() . '"><br>';
        echo '<label for="access_token">Access Token:</label>';
        echo '<input type="text" name="access_token" value="' . $this->data->get_access_token() . '"><br>';
        echo '<label for="expires_in">Expires In:</label>';
        echo '<input type="text" name="expires_in" value="' . $this->data->get_expires_in() . '"><br>';
        echo '<label for="scope">Scope:</label>';
        echo '<input type="text" name="scope" value="' . $this->data->get_scope() . '"><br>';
        echo '<input type="submit" name="submit" value="Submit">';
        echo '</form>';
        echo '</div>';
    }

    public function editFormProcess() {
        if (isset($_POST['submit'])) {
            $data = [
                'redirect_uri' => $_POST['redirect_uri'],
                'client_id' => $_POST['client_id'],
                'client_secret' => $_POST['client_secret'],
                'refresh_token' => $_POST['refresh_token'],
                'access_token' => $_POST['access_token'],
                'expires_in' => $_POST['expires_in'],
                'scope' => $_POST['scope']
            ];
            
        $this->data->update_data(1,$data);
        echo '<div class="updated"><p>Data updated successfully.</p></div>';
        }
    }
}
?>
