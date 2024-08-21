<?php

namespace Admin\Zoho\Tokens;

use Admin\Database\Data;

class ZohoTokenRefresher {
    private $refreshToken;
    private $clientId;
    private $clientSecret;
    private $tokenUrl;

    public function __construct() {
        include_once(plugin_dir_path(__DIR__) . 'database/class.data.php');
        $this->data = new Data();

        $this->clientId = $this->data->get_client_id();
        $this->refreshToken = $this->data->get_refresh_token();
        $this->clientSecret = $this->data->get_client_secret();
        $this->tokenUrl = "https://accounts.zoho.com/oauth/v2/token";

        // $this->refreshToken = "1000.55767621209b1f2027071b51d4c0fd2a.2795750ba6c88da34b3ed25ebb878b1b";
        // $this->clientId = "1000.CWHP1B4K51EV9DDI41J1LYRVYWSN2I";
        // $this->clientSecret = "fa614f81a3dc7fe22848c4e4cedf41aa256e9901f8";
    }

    public function refreshAccessToken() {
        $postData = [
            'grant_type' => 'refresh_token',
            'client_id' => $this->clientId,
            'client_secret' => $this->clientSecret,
            'refresh_token' => $this->refreshToken,
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->tokenUrl);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);
        curl_close($ch);

        $responseData = json_decode($response, true);

        if (isset($responseData['access_token'])) {
            $this->data->update_access_token($responseData['access_token']);
            $file = plugin_dir_url(__DIR__) . 'token.txt';

            //write token to file
            fopen($file, "a");
            fwrite($file, $responseData['access_token']);
            fclose($file);

            return "New Access Token: " . $responseData['access_token'];
        } else {
            return "Error refreshing token: " . $response;
        }
    }
}

// Usage
// $tokenRefresher = new ZohoTokenRefresher();
// echo $tokenRefresher->refreshAccessToken();
