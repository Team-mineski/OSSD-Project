<?php

include_once "LabAssistant.class.php";
include_once "Database.model.php";

class Factory{
    private $database;
    public function __construct($database){
        $this->database=$database;
    }
    public function makeTestRequestTable($lab_assistant){
        switch($lab_assistant->getLAType()){
            case XrayRequestTable::$allowed_la:
                return new XrayRequestTable($this->database);
                break;
            case ECGRequestTable::$allowed_la:
                return new ECGRequestTable($this->database);
                break;
            case MicrobioRequestTable::$allowed_la:
                return new MicrobioRequestTable($this->database);
                break;
            case BiochemicalRequestTable::$allowed_la:
                return new BiochemicalRequestTable($this->database);
                break;
            case SpecimenExamRequestTable::$allowed_la:
                return new SpecimenExamRequestTable($this->database);
                break;
        }

    
    
    }

}






?>