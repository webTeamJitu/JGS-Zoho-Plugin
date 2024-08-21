<?php

namespace  Admin\JGSZoho;

class Admin {
    public function __construct() {
        // Constructor code
    }

    public function index() {
        wp_mail('hello@example.com', 'WP Crontrol', 'WP Crontrol rocks yoh!');

        echo  "hello";

        // $clientId = "1000.CWHP1B4K51EV9DDI41J1LYRVYWSN2I";
        // $redirectUri = "https://ba79-41-209-57-189.ngrok-free.app/zohoapi/gettoken";
        // $scope = "ZohoRecruit.modules.all"; // Adjust scope as needed
        // // $scope = "ZohoRecruit.setup.operation.all";
        
        // $authUrl = "https://accounts.zoho.com/oauth/v2/auth?response_type=code&client_id=$clientId&scope=$scope&redirect_uri=$redirectUri";
        // echo "<a href='$authUrl'>Login with Zoho</a>";
        // // Redirect the user to Zoho's OAuth 2.0 authorization URL
        // header("Location: $authUrl");
        // exit();
    }

}

