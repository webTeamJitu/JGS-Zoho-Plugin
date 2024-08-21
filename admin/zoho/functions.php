<?php

namespace Admin\Zoho\WP_Admin_Calls;

use Admin\Database\Data;
use Admin\Database\ZohoAPIData;

class ZohoData{
    private $accessToken;
    private $refreshToken;
    private $candidateId;
    private $apiURL;
    private $candidateAppliedRole;
    private $jobId;

    public function __construct(){
        include_once(plugin_dir_path(__DIR__) . 'database/class.data.php');
        include_once (plugin_dir_path(__DIR__) . 'database/class.zohoAPIData.php');
        include_once (plugin_dir_path(__DIR__) . 'zoho/tokens.php');

        $this->data = new Data();
        $this->zohoAPIData = new ZohoAPIData();
//        $this->tokensRefresh = new ZohoTokenRefresher();

        if(class_exists('Admin\Zoho\Tokens\ZohoTokenRefresher')){
            $this->tokensRefresh = new \Admin\Zoho\Tokens\ZohoTokenRefresher();
        }

        $this->accessToken = $this->data->get_access_token();
        $this->refreshToken = $this->data->get_refresh_token();
        $this->apiURL = 'https://recruit.zoho.com/recruit/v2/Candidates';
    }

    private $candidateID;

    public function fetchCandidates(){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->apiURL);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Authorization: Zoho-oauthtoken " . $this->accessToken,
        ]);
        $response = curl_exec($ch);
        curl_close($ch);

        $responseData = json_decode($response, true);

        // Check if the response contains an invalid token error
        if (isset($responseData['code']) && $responseData['code'] === 'INVALID_TOKEN' || $responseData['code'] === 'AUTHENTICATION_FAILURE') {
            // Log the invalid token error
            error_log('Invalid OAuth token detected. Please refresh the token.');

            // Optionally, update the WordPress option to notify the admin
            update_option('jgs_invalid_oauth_token', true);

            // Optionally, trigger a token refresh and retry the request
            if (method_exists($this->tokensRefresh, 'refreshAccessToken')) {
                $this->tokensRefresh->refreshAccessToken();

                // Reattempt the request with the new token
                $this->accessToken = $this->data->get_access_token(); // Get the new access token
                return $this->fetchCandidates();
            }

            return;
        }

        $fetchedDataZoho = [];

        if (isset($responseData['data']) && !empty($responseData['data'])) {
            foreach ($responseData['data'] as $candidate) {
                if ($candidate['Candidate_Stage'] === 'New') {
                    $this->candidateAppliedRole = $candidate['Applied_Role'];
                    if ($this->candidateAppliedRole) {
                        $this->job_titles_filter($this->candidateAppliedRole);
                        $this->candidateAppliedRole = $this->jobId;
                    }

                    $fetchedDataZoho[] = [
                        $candidate['id'],
                        $candidate['Candidate_Stage'],
                        $candidate['Created_Time'],
                        $candidate['Full_Name'],
                        $this->candidateAppliedRole
                    ];
                }
            }
            $file = plugin_dir_path(__DIR__). 'responseData.txt';
            file_put_contents($file, json_encode($fetchedDataZoho, JSON_PRETTY_PRINT));
            $this->zohoAPIData->zohoApiDataStore($fetchedDataZoho);

            echo 'saved successfully';
        } else {
            $file = plugin_dir_path(__DIR__) . 'file.json';
            file_put_contents($file, print_r($response, true));
        }
    }



    private function job_titles_filter($jobTitle){
        switch($jobTitle) {
            case 'Application Support-Gross Salary Kes 30,000': //ZR_316_JOB
                $this->jobId = '776132000000513858';
                break;
            case 'Business Process Support -Gross Salary Kes 24,000': //ZR_317_JOB
                $this->jobId = '776132000000513859';
                break;
            case 'Certified Salesforce Administrator-Gross Salary Kes 80,000': //ZR_380_JOB
                $this->jobId = '776132000000513922';
                break;
            case 'Data Entry-Gross Salary Kes 24,000': //ZR_315_JOB
                $this->jobId = '776132000000513857';
                break;
            case 'Sales and Customer Support-Gross Salary Kes 24,000': //ZR_311_JOB
                $this->jobId = '776132000000513853';
                break;
            case 'Talent Acquistion Associate-Gross Salary Kes. 65,000': //ZR_355_JOB
                $this->jobId = '776132000000513897';
                break;
            default:
                $this->jobId = null;
        }
    }
}

?>
