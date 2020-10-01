<?php

include_once 'TestRequestTable.model.php';

class SpecimenExamRequestTable extends TestRequestTable{
    public static $allowed_la='specimen_exam_lab';
    public function __construct($parent_database){
        $this->table_path="specimen_exam_request_table";    // add path for this
        $this->test_type="specimen_exam";
        $this->parent_database=$parent_database;

    }
}



?>