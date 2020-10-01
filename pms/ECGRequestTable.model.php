<?php

include_once 'TestRequestTable.model.php';

class ECGRequestTable extends TestRequestTable{
    public static $allowed_la='ecg_lab';
    public function __construct($parent_database){
        $this->table_path="ecg_request_table";    // add path for this
        $this->test_type="ecg";
        $this->parent_database=$parent_database;

    }
}



?>