<?php

abstract class TestCommand{
    private $tableName;

    public abstract function execute($medical,$data);
}

class Xray_request_table extends TestCommand{

    public function execute($medical,$data){
        $medical->enterData("xray_request_table", array('regNo','date'),$data);
    }
}

class Biochemical_request_table extends TestCommand{


    public function execute($medical,$data){
        $medical->enterData("biochemical_request_table", array('regNo','date'),$data);
    }
}

class Ecg_request_table extends TestCommand{


    public function execute($medical,$data){
        $medical->enterData("ecg_request_table", array('regNo','date'),$data);
    }
}

class Specimen_exam_request_table extends TestCommand{


    public function execute($medical,$data){
        $medical->enterData("specimen_exam_request_table", array('regNo','date'),$data);
    }
}

class Microbio_request_table extends TestCommand{

    public function execute($medical,$data){
        $medical->enterData("microbio_request_table", array('regNo','date'),$data);
    }
}
?>