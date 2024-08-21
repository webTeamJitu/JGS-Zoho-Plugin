<?php
namespace Admin\Zoho;

use Admin\Database\ZohoAPIData;
class zohoCalls {
    private $accessToken;
    private $candidateId;
    private $jobId;
    private $apiURL;
    private $db;
    private $databaseInitData;
    private  $jobTitle;
    public function __construct(){
        $this->include_files();
        $this->init_classes();
       $this->apiURL = 'https://recruit.zoho.com/recruit/v2/Candidates/actions/associate';
    }

    private function init_classes() {
        if (class_exists('Admin\Database\Init')) {
            $this->db = new \Admin\Database\Init();
        }
        if (class_exists('Admin\Database\Data')){
            $this->dbData = new \Admin\Database\Data();
        }
        if(class_exists('Admin\Database\Init')){
            $this->zohoAPIData = new \Admin\Database\ZohoAPIData();
        }
    }

    public function include_files(){
       require_once(plugin_dir_path(__DIR__) . '/database/class.data.php');
       require_once(plugin_dir_path(__DIR__) . '/database/class.init.php');
       require_once (plugin_dir_path(__DIR__) .  'database/class.zohoAPIData.php');
    }


//    public function zohoChangeStatus(){
//        $this->databaseInitData = $this->zohoAPIData->zohoApiDataGet();
//
//        $this->accessToken = $this->dbData->get_access_token();
//        foreach($this->databaseInitData as $dbData){
//            $this->jobId = $dbData['role'];
//            $this->candidateId = $dbData['candidate_id'];
//        }
//
//        // $this->zohoAPIData->zohoApiDataFetch();
//        $updateData = [
//            "data" => [
//                ["jobids" => [$this->jobId],
//                "ids" => [$this->candidateId],
//                "Candidate_Stage" => "Engaged",
//                "Comments" => "Record Successfully Updated"]
//            ]
//        ];
//
//        //write updateData to file
//        $file = plugin_dir_path(__DIR__) . 'Datatoupdate.txt';
//        file_put_contents($file, print_r($updateData, true));
////        return;
//
//        $ch = curl_init();
//        curl_setopt($ch, CURLOPT_URL, $this->apiURL);
//        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
//        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($updateData));
//        curl_setopt($ch, CURLOPT_HTTPHEADER, [
//            "Authorization: Zoho-oauthtoken $this->accessToken",
//            "Content-Type: application/json"
//        ]);
//
//        $response = curl_exec($ch);
//        curl_close($ch);
//
//        $responseData = json_decode($response, true);
//
//        echo "<pre>";
//        print_r($responseData);
//
//        echo "</pre>";
//        $file = plugin_dir_path(__DIR__) . 'Respondeds.txt';
//
//        if (isset($responseData['data'][0]['code']) && $responseData['data'][0]['code'] == 'SUCCESS') {
//            echo "Candidate stage updated successfully.";
//            // echo "<a href='index.php'>Go back</a>";
//            // echo "<br>";
//            // echo "<a href='accesstoken/index.php'>Get access token</a>";
//            // echo "<br>";
//            // echo "<a href='move/index.php'>Move to next stage</a>";
//            // echo "<br>";
//            // echo "<pre>";
//            echo "Candidate ID: " . $responseData['data'][0]['id'];
//            echo "</pre>";
//            echo "<a href='delete/index.php'>Delete candidate</a>";
//
//            //write to file
//            file_put_contents($file, print_r( $responseData, true));
//        } else {
//            echo "<pre>";
//            // echo "error: " . $responseData['data'][0]['message'];
//            echo "</pre>";
//            echo "Error updating candidate stage.";
//            file_put_contents($file, print_r( $responseData, true));
//        }
//        }

    public function zohoChangeStatus() {
        $this->databaseInitData = $this->zohoAPIData->zohoApiDataGet();
        $this->accessToken = $this->dbData->get_access_token();

        $updateData = ["data" => []];

        foreach($this->databaseInitData as $dbData) {
            $this->jobId = $dbData['role'];
            $this->candidateId = $dbData['candidate_id'];

            $updateData['data'][] = [
                "jobids" => [$this->jobId],
                "ids" => [$this->candidateId],
                "Candidate_Stage" => "Engaged",
                "Comments" => "Record Successfully Updated"
            ];
        }

        // Write updateData to file for debugging purposes
        $file = plugin_dir_path(__DIR__) . 'Datatoupdate.txt';
        file_put_contents($file, print_r($updateData, true));
//        return;

        // Initialize cURL
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->apiURL);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($updateData));
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Authorization: Zoho-oauthtoken $this->accessToken",
            "Content-Type: application/json"
        ]);

        $response = curl_exec($ch);
        curl_close($ch);

        $responseData = json_decode($response, true);

        // Output and log the response
        echo "<pre>";
        print_r($responseData);
        echo "</pre>";

        $file = plugin_dir_path(__DIR__) . 'Respondeds.txt';
        file_put_contents($file, print_r($responseData, true));

        if (isset($responseData['data'][0]['code']) && $responseData['data'][0]['code'] == 'SUCCESS') {
            echo "Candidate stages updated successfully.";
        } else {
            echo "Error updating candidate stages.";
        }
    }

}