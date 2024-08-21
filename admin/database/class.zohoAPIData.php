<?php
namespace Admin\Database;

class ZohoAPIData {
    private $jgs_zoho_table;
    public function __construct(){
        global $wpdb;
        $this->jgs_zoho_table = $wpdb->prefix . "jgs_zoho_table";
    }

    public function zohoApiDataStore($data) {
        global $wpdb;

        // Array to store candidate IDs from the response
        $candidate_ids_in_response = [];

        foreach ($data as $candidate) {

            // Extract and store candidate ID
            $candidate_id = $candidate[0];
            $candidate_ids_in_response[] = $candidate_id;

            $insert_data = [
                'candidate_id' => $candidate_id,
                'candidate_stage' => $candidate[1],
                'created_at' => $candidate[2],
                'candidate_name' => $candidate[3],
                'role' => $candidate[4],
            ];

            // Check if the candidate_id already exists in the database
            $existing_candidate = $wpdb->get_row(
                $wpdb->prepare(
                    "SELECT * FROM $this->jgs_zoho_table WHERE candidate_id = %s",
                    $candidate_id
                )
            );

            if ($existing_candidate) {
                // If the candidate exists, update the record
                $wpdb->update(
                    $this->jgs_zoho_table,
                    $insert_data,
                    ['candidate_id' => $candidate_id]
                );
            } else {
                // If the candidate does not exist, insert the new record
                $wpdb->insert($this->jgs_zoho_table, $insert_data);
            }
        }

        // Convert array of candidate IDs into a comma-separated string for use in the SQL query
        $candidate_ids_placeholder = implode(',', array_fill(0, count($candidate_ids_in_response), '%s'));

        // Remove records from the database that are not in the response
        $wpdb->query(
            $wpdb->prepare(
                "DELETE FROM $this->jgs_zoho_table WHERE candidate_id NOT IN ($candidate_ids_placeholder)",
                ...$candidate_ids_in_response
            )
        );
    }


    public function zohoApiDataFetch(){
        global $wpdb;
        $wpdb->get_results("SELECT * FROM $this->jgs_zoho_table");

        fopen('dataBaseData.txt', 'r');
        fwrite('dataBaseData.txt', json_encode($wpdb));
        fclose('dataBaseData.txt');

    }

    public function zohoApiDataDelete($candidate_id){}
    public function zohoApiDataUpdate($candidate_id){
        global $wpdb;
        $data = [
            'candidate_stage' => 'Engaged',
            'updated' => '2'
        ];
        $where = [
          'candidate_id' => $candidate_id
        ];

        $updated = $wpdb->update($this->jgs_zoho_table, $data, $where);

        if ($updated){
            echo 'Changed candidate stage successfully';
            return true;
        }else{
            echo 'Error updating candidate stage';
            return false;
        }
    }
    public function zohoApiDataInsert($candidate_id){}
    public function zohoApiDataGet(){
        global $wpdb;
        $time = date('Y-m-d');

        // Corrected SQL query, removed the extra closing parenthesis
        $results = $wpdb->get_results($wpdb->prepare(
            "SELECT * FROM $this->jgs_zoho_table WHERE DATE(created_at) = %s AND candidate_stage = 'New' ORDER BY created_at ASC",
            $time
        ), ARRAY_A);

        return $results;
    }

    public function updateZohoDataStatus(){
        global $wpdb;
        $time = date("Y-m-d");

        // Fetch records where the date matches today's date
        $results = $wpdb->get_results($wpdb->prepare(
            "SELECT * FROM $this->jgs_zoho_table WHERE DATE(created_at) = %s AND candidate_stage = 'New' ORDER BY candidate_id ASC",
            $time
        ), ARRAY_A);

        // Update status for the fetched records
        foreach ($results as $record) {
            $wpdb->update(
                $this->jgs_zoho_table,
                array('updated' => '2'), // Set the new status
                array('id' => $record['id']) // Where condition to update the specific record
            );
        }


        // Save the operation results to a file for logging or debugging
        $file = plugin_dir_path(__DIR__) . 'statusUpdateLog.txt';
        file_put_contents($file, "Updated Records: " . print_r($results, true));
    }
}