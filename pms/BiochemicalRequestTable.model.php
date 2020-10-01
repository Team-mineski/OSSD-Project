<?php

include_once 'TestRequestTable.model.php';

class BiochemicalRequestTable extends TestRequestTable{
    public static $allowed_la='biochemical_lab';
    public function __construct($parent_database){
        $this->table_path="biochemical_request_table";    // add path for this
        $this->test_type="biochemical";     //test doing by the labarotary
        $this->parent_database=$parent_database;

    }
}



?>