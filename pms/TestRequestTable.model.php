<?php

include_once 'Database.model.php';
include_once 'Request.class.php';
include_once 'LabAssistant.class.php';

//This class is an abstract class for all the Request tables.

abstract class TestRequestTable
{
    //protected $test_type;
    protected $table_path;
    protected $test_type;
    protected $parent_database;
    protected $requests = array();

    public function loadRequests()
    {
        $results = $this->parent_database->retrieveAllData($this->table_path);
        while ($row = mysqli_fetch_assoc($results)) {
            $request = new Request($this, $row["Date"], $row["RegNo"]);
            $this->requests[] = $request;
        }
    }

    public function getRequests()
    {
        return $this->requests;
    }

    public function getTestType()
    {
        return $this->test_type;
    }


    public function getAllowedLA()
    {
        return $this->allowed_la;
    }

    public function deleteRowByID($regNo)
    {
        $this->parent_database->deleteData($this->table_path, $regNo);
    }
}
