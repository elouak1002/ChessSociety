<?php

    // Functions taken from football app correction. 

    require_once('db_prod_cred.php');
    
    function db_connect() {
        $connection = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
        confirm_db_connect($connection);
        return $connection;
    }
    
    function db_disconnect($connection) {
      if (isset($connection)) {
        $connection->close;
      }
    }
    
    function confirm_db_connect() {
        if($connection->connect_errno) {
            $msg = "Database connection failed: ";
            $msg .= $connection->connect_error;
            $msg .= " (" . $connection->connect_errno . ")";
            exit($msg);
          }
    }
    
    function confirm_result_set($result_set) {
        if (!$result_set) {
            exit("Database query failed.");
        }
    }
  
?>