<?php

include_once 'TestRequestTable.model.php';

class MicrobioRequestTable extends TestRequestTable{
    public static $allowed_la='microbio_lab';
    public function __construct($parent_database){
        $this->table_path="microbio_request_table";    // add path for this
        $this->test_type="microbio";
        $this->parent_database=$parent_database;

    }
}



?>