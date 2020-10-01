<?php


class Request{
    private $date;
    private $patient_id;
    private $table;

    public function __construct($table,$date,$patient_id){
        //constructor for the record class

        $this->table=$table;
        $this->date=$date;
        $this->patient_id=$patient_id;
    }

    public function getPatientID(){
        //get patient id of the record/request
        return $this->patient_id;

    }

    public function getTable(){
        //get the table of request

        return $this->table;

    }

    public function getDate(){
        //get the date of the request

        return $this->date;

    }


}

?>