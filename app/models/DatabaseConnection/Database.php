<?php

class Database{
    private $name = "hospital"; 
    var $pdo ;
    private static $instance;

    private function __construct(){
        include_once 'pdo.php';
        $this->pdo = $pdo;
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
    
    public function getDatabaseName(){
        return $this->database_name;
    }

    public function insertTable($table){
        $this->table_list[]=$table;
    }


    public function makeTable($tableName, $columns, $attributes)
    {   
        $stmt = $this->pdo->exec("USE $this->name");
        $sql = "CREATE TABLE IF NOT EXISTS $tableName(";
        for ($i=0; $i<count($columns); $i+=1)
        {
            $sql = $sql . $columns[$i] .' '. $attributes[$i];
            if ($i!=count($columns)-1)
            {
                $sql = $sql.' ,';
            }
        }
        $sql = $sql . ")";
        try
        {
            $stmt = $this->pdo->exec($sql);
        }
        catch(PDOException $e) 
        {
            echo $e->getMessage();
        }
        
        return $stmt;
    }

    function enterData($table,$columns, $data)
    {
        $stmt = $this->pdo->exec("USE $this->name");
        $sql = 'INSERT INTO ' . $this->name.'.'.$table. ' (';
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
        echo $sql;
        try
        {
            $stmt = $this->pdo->exec($sql);
        }
        catch(PDOException $e) 
        {
            echo $e->getMessage();
        }
        return $stmt;
    }

    function getDisease($diagnosisID){
        $stmt = $this->pdo->exec("USE $this->name");
        $sql = "SELECT Disease FROM  diseases WHERE DiagnosisID = $diagnosisID";
        try
        {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetch();
        }
        catch(PDOException $e) 
        {
            echo $e->getMessage();
        }
        return $result;
    }

    function getDiagnosisID($disease){
        $stmt = $this->pdo->exec("USE $this->name");
        $sql = "SELECT DiagnosisID FROM  diseases WHERE Disease = '$disease'";
        try
        {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetch();
        }
        catch(PDOException $e) 
        {
            echo $e->getMessage();
        }
        return $result;
    }


    function getLastRecord($table){
        $stmt = $this->pdo->exec("USE $this->name");
        $sql = "SELECT * FROM  $this->name.$table ORDER BY RegNo DESC LIMIT 1";
        try
        {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetch();
        }
        catch(PDOException $e) 
        {
            echo $e->getMessage();
        }
        return $result;
    }

    function deleteData($table,$patientID,$category){
        $stmt = $this->pdo->exec("USE $this->name");
        $sql = "DELETE FROM " . $this->name.'.'.$table. " WHERE $category = '".$patientID."'";
        try
        {
            $stmt = $this->pdo->exec($sql);
        }
        catch(PDOException $e) 
        {
            echo $e->getMessage();
        }
        return $stmt;

    }

    function moveData($table1,$table2, $category, $value){
        $stmt = $this->pdo->exec("USE $this->name");
        $sql = "INSERT INTO `$table2` SELECT * FROM `$table1` WHERE $category = '$value' ";
        try
        {
            $stmt = $this->pdo->exec($sql);
        }
        catch(PDOException $e) 
        {
            echo $e->getMessage();
        }

    }

    function checkQuery( $table, $columns, $regNo){
        $stmt = $this->pdo->exec("USE $this->name");
        $sql = "SELECT ";
        for ($i=0; $i<count($columns); $i++){
            $sql = $sql . $columns[$i];
            if ($i!=(count($columns)-1)){
                $sql = $sql.",";
            }
        }
       $sql = $sql . " FROM " . $this->name.'.'.$table. " WHERE  RegNo ='" . $regNo . "'";
       try
        {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll();
        }
        catch(PDOException $e) 
        {
            echo $e->getMessage();
        }
        return $result;
    }

    function retrieveData( $table, $columns, $regNo){
        $stmt = $this->pdo->exec("USE $this->name");
        $sql = "SELECT ";
        for ($i=0; $i<count($columns); $i++){
            $sql .= $columns[$i];
            if ($i!=(count($columns)-1)){
                $sql .= ",";
            }
        }
        
       $sql .= " FROM " . $this->name.'.'.$table." WHERE  RegNo ='" . $regNo . "'";
       try
        {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll();   
        }
        catch(PDOException $e) 
        {
            echo $e->getMessage();
        }
        return $result;
    }

    function retrieveDataByDate($table, $columns, $date, $regNo){
        $stmt = $this->pdo->exec("USE $this->name");
        $sql = "SELECT ";
        for ($i=0; $i<count($columns); $i++){
            $sql .= $columns[$i];
            if ($i!=(count($columns)-1)){
                $sql .=",";
            }
        }
       $sql .= " FROM " .$table. " WHERE  (regNo, test_request_date) =('" . $regNo . "','".$date ."')";
       try
        {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetch();
        }
        catch(PDOException $e) 
        {
            echo $e->getMessage();
        }
        return $result;
    }

    function getAutoIncrement($table){
        $stmt = $this->pdo->exec("USE $this->name");
        $sql = "SELECT AUTO_INCREMENT
        FROM information_schema.tables
        WHERE table_name = '$table';";
       try
        {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetch();
        }
        catch(PDOException $e) 
        {
            echo $e->getMessage();
        }
        return $result;
    }

    function joinPatientWithDiagnosis($table, $columns,  $category, $value){  //in controllers/ExistingPatient.php to get all details including diagnosis
        $stmt = $this->pdo->exec("USE $this->name");
        $sql = "SELECT ";
        for ($i=0; $i<count($columns); $i++){
            $sql .=  $columns[$i];
            if ($i!=(count($columns)-1)){
                $sql .= ",";
            }
        }
        $sql .= " FROM " . $this->name.'.'.$table;
        $sql.=" JOIN diseases ON $table.DiagnosisID = diseases.DiagnosisID";
        $sql.= " WHERE $category = '$value'" ;
        try
        {
            
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetch();
        }
        catch(PDOException $e) 
        {
            echo $e->getMessage();
        }
        return $result;

    }
    function filterDataByDiagnosis($table, $columns, $diagnosis){
        $stmt = $this->pdo->exec("USE $this->name");
        $sql = "SELECT ";
        for ($i=0; $i<count($columns); $i++){
            $sql .=  $columns[$i];
            if ($i!=(count($columns)-1)){
                $sql .= ",";
            }
        }
       $sql .= " FROM " . $this->name.'.'.$table;
       $sql.=" JOIN $this->name.patients ON patients.DiagnosisID = diseases.DiagnosisID";
       $sql.= " WHERE  Disease ='" . $diagnosis . "'";
      
       try
        {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll();
        }
        catch(PDOException $e) 
        {
            echo $e->getMessage();
        }
        return $result;
    }

    function checkForDiagnosis($table, $columns, $diagnosis){
        $stmt = $this->pdo->exec("USE $this->name");
        $sql = "SELECT ";
        for ($i=0; $i<count($columns); $i++){
            $sql .=  $columns[$i];
            if ($i!=(count($columns)-1)){
                $sql .= ",";
            }
        }
       $sql .= " FROM " . $this->name.'.'.$table;
       $sql.= " WHERE  Disease ='" . $diagnosis . "'";
      
       try
        {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll();
        }
        catch(PDOException $e) 
        {
            echo $e->getMessage();
        }
        print_r ($result);
        return $result;
    }

    function retrieveAllData( $table){
        //$link = $this->makeLink();
        $stmt = $this->pdo->exec("USE $this->name");
        $sql = "SELECT * FROM ".$this->name.'.'.$table;
        try
        {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll();
        }
        catch(PDOException $e) 
        {
            echo $e->getMessage();
        }
        return $result;
    }

    public function updateData($patientID, $columns, $values, $table){
                
        $stmt = $this->pdo->exec("USE $this->name");
        $sql1 = "SELECT ";
        $select=' ';
        $add = ' ';
        for ($i=0; $i<count($columns); $i++){
            $select .= $columns[$i];
            $add .= $columns[$i] . '='.  "'" . $values[$i].  "'" ;
            if ($i!=(count($columns)-1)){
                $add .=",";
                $select.= ',';
            }
        }
        $sql1 .= $select;
        $sql1 .= " FROM " . $this->name.'.'.$table. " WHERE  PatientID ='" . $patientID . "'";
        $sql2 = "UPDATE ". $table . " SET " . $add ." WHERE PatientID = '" . $patientID. "'";
        try
        {
            $stmt = $this->pdo->prepare($sql1);
            $stmt->execute();
            $stmt = $this->pdo->prepare($sql2);
            $stmt->execute();
            $result = $stmt->fetchAll();
            return $result;
        }
        catch(PDOException $e) 
        {
            echo $e->getMessage();
        }
        
    }
}

?>