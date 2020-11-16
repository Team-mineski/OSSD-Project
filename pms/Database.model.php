<?php

class Database{
    private $name = "hospital";   //Database name
    private $host = "localhost";    //Database server
    private $user = "root";  //Database username
    private $password = "";    //Database password
    private static $instance;
    private static $link;

    protected function __construct(){
        $this->createDatabase();
    }

    public function createDatabase(){
        $sql = "CREATE DATABASE IF NOT EXISTS $this->name";
        $link = $this->makeLink();
        if (!(mysqli_query($link, $sql))) {
            echo "ERROR: Was not able to execute $sql. " . mysqli_error($link);
        }
    }

    public static function getInstance(){
        {
            if (self::$instance == null)
            {
              self::$instance = new Database();
            }
            return self::$instance;
          }
    }

    public function makeLink(){
        if (self::$link==null)
        {
                $link = mysqli_connect($this->host, $this->user, $this->password);    //second parameter is username, 3rd is password
                
                if($link === false){
                    die("ERROR: Could not connect. " . mysqli_connect_error());
                }
                self::$link = $link;
                
        }
        return self::$link;   //this link is used for all operations
    }

    public function getDatabaseName(){
        return $this->database_name;
    }

    public function insertTable($table){
        $this->table_list[]=$table;
    }


    public function makeTable($tableName, $columns, $attributes)
    {   
        $link = $this->makeLink();
        $selected = mysqli_select_db($link, $this->name)  
                or die("Could not select database"); 
        $sql = "CREATE TABLE IF NOT EXISTS $tableName(";
        for ($i=0; $i<count($columns); $i+=1){
            $sql = $sql . $columns[$i] .' '. $attributes[$i];
            if ($i!=count($columns)-1){
                $sql = $sql.' ,';
            }
        }
        $sql = $sql . ")";
        if (!(mysqli_query($link, $sql))) {
            echo "ERROR: Was not able to execute $sql. " . mysqli_error($link);
        }
        
    }

    function enterData($table,$columns, $data){
        $link = $this->makeLink();
        
        $selected = mysqli_select_db($link, $this->name)  
                or die("Could not select database"); 
        $sql = 'INSERT INTO ' . $table. ' (';
        for ($i=0; $i<count($columns); $i+=1){
            $sql = $sql . $columns[$i] ;
            if ($i!=count($columns)-1){
                $sql = $sql.' ,';
            }
        }
        $sql = $sql.") VALUES (";
        for ($i=0; $i<count($data); $i+=1){
            $sql = $sql . "'" . $data[$i]. "'" ;
            if ($i!=count($data)-1){
                $sql = $sql.' ,';
            }
        }
        $sql = $sql.") ";
        if(mysqli_query($link, $sql)){
            //echo "Records inserted successfully.";
        } else{
            echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
        }
    }

    function joinPatientWithDiagnosis( $columns, $patientID){  //in controllers/ExistingPatient.php to get all details including diagnosis
        $link = $this->makeLink();
        
        $selected = mysqli_select_db($link, $this->name)  
                or die("Could not select database"); 
        $sql = "SELECT ";
        for ($i=0; $i<count($columns); $i++){
            $sql .=  $columns[$i];
            if ($i!=(count($columns)-1)){
                $sql .= ",";
            }
        }
        $sql .= " FROM " . $this->name.'.patients';
        $sql.=" JOIN diseases ON patients.DiagnosisID = diseases.DiagnosisID WHERE PatientID = $patientID";
        
        $results = (mysqli_query($link, $sql));
        return $results;

    }

    function getLastRecord($TableName){
        $link = $this->makeLink();
        
        $selected = mysqli_select_db($link, $this->name)  
                or die("Could not select database"); 
        $sql = "SELECT * FROM $TableName ORDER BY RegNo DESC LIMIT 1";
        $results = (mysqli_query($link, $sql));
        return $results;
    }

    function deleteData($table,$regNo){
        $link = $this->makeLink();
        $selected = mysqli_select_db($link, $this->name)  
                or die("Could not select database"); 
        $sql = "DELETE FROM " . $table. " WHERE RegNo = '".$regNo."'";
        $results = (mysqli_query($link, $sql));
        return $results;

    }

    function checkQuery( $table_name, $columns, $regNo){
        $link = $this->makeLink();
        $query = "SELECT ";
        for ($i=0; $i<count($columns); $i++){
            $query = $query . $columns[$i];
            if ($i!=(count($columns)-1)){
                $query = $query.",";
            }
        }
       $query = $query . " FROM " . $table_name . " WHERE  RegNo ='" . $regNo . "'";
       $results = (mysqli_num_rows($result)($link, $query));
       return ($results==0);
    }

    function retrieveData( $table_name, $columns, $regNo){
        $link = $this->makeLink();
        $query = "SELECT ";
        for ($i=0; $i<count($columns); $i++){
            $query = $query . $columns[$i];
            if ($i!=(count($columns)-1)){
                $query = $query.",";
            }
        }
       $query = $query . " FROM " . $table_name . " WHERE  RegNo ='" . $regNo . "'";
       $results = (mysqli_query($link, $query));
       return $results;
    }

    function getDataForForm( $table_name, $columns, $regNo){
        $link = $this->makeLink();
        $query = "SELECT ";
        for ($i=0; $i<count($columns); $i++){
            $query = $query . $columns[$i];
            if ($i!=(count($columns)-1)){
                $query = $query.",";
            }
        }
       $query = $query . " FROM " . $table_name . " WHERE  patient_id ='" . $regNo . "'";
       $results = (mysqli_query($link, $query));
       return $results;
    }

    function retrieveDataByDate($table_name, $columns, $date, $regNo){
        $link = $this->makeLink();
        $query = "SELECT ";
        for ($i=0; $i<count($columns); $i++){
            $query = $query . $columns[$i];
            if ($i!=(count($columns)-1)){
                $query = $query.",";
            }
        }
       $query = $query . " FROM " . $table_name . " WHERE  (patient_id, date) =('" . $regNo . "','".$date ."')";
       $results = (mysqli_query($link, $query));
       if (!($results)) {
            echo "ERROR: Was not able to execute $query. " . mysqli_error($link);
            return $results;
        }
        else{
            return $results;
        }
       
    }

    function retrieveAllData( $table_name){
        $link = $this->makeLink();
        $query = "SELECT * FROM ".$this->name.'.'.$table_name;
       $results = (mysqli_query($link, $query));
       if (!($results)) {
        echo "ERROR: Was not able to execute $query. " . mysqli_error($link);
    }
       return $results;
    }

    public function updateData($regNo, $columns, $values, $tableName){
        $link = $this->makeLink();
        echo '<br>';
        $selected = mysqli_select_db($link, $this->name)  
                or die("Could not select database"); 
        $query = "SELECT ";
        $select=' ';
        $add = ' ';
        for ($i=0; $i<count($columns); $i++){
            $select = $select . $columns[$i];
            $add = $add . $columns[$i] . '='.  "'" . $values[$i].  "'" ;
            echo '<br>';
            echo $add;
            echo '<br>';
            if ($i!=(count($columns)-1)){
                $add = $add.",";
                $select = $select . ',';
            }
        }
        $query = $query. $select;
        $query = $query . " FROM " . $tableName . " WHERE  RegNo ='" . $regNo . "'";
        if (!(mysqli_query($link, $query))) {
            echo "ERROR: Was not able to execute $sql. " . mysqli_error($link);
        }

        $sql = "UPDATE ". $tableName . " SET " . $add ." WHERE RegNo = '" . $regNo. "'";
        if (!(mysqli_query($link, $sql))) {
            echo "ERROR: Was not able to execute $sql. " . mysqli_error($link);
        }

    }
}

?>