<?php

include_once 'TestRequestTable.model.php';

class XrayRequestTable extends TestRequestTable{
    public static $allowed_la='xray_lab';
    public function __construct($parent_database){
        $this->test_type='xray';
        $this->parent_database=$parent_database;
        $this->table_path="xray_request_table";    // add path for this
    }

}



?>