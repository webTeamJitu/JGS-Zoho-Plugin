<?php

namespace  database;
class DBConsts {
    public function getCharsetAndCollate(){
        global $wpdb;
        $charset_collate = '';

        if(!empty($wpdb->charset)){
            $charset_collate = "DEFAULT CHARACTER SET $wpdb->charset";
        }
        if(!empty($wpdb->collate)){
            $charset_collate .= " COLLATE $wpdb->collate";
        }
        return $charset_collate;
    }
}