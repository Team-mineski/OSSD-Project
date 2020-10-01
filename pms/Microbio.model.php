
<?php
include_once "MicrobioRequestTable.model.php";
 class Microbio{
   private $date;
   private $regNo;
   private $lab_no;
   private $BHT_no;
   private $specimen_test;
   private $probable_diagnosis;
   private $clinic_detail;
   private $prior_antibiotic;
   private $antibiotic_given;
   private $sig_MO;
   private $name_MO;
   private $designation;
   private $table_path;
   private $parent_database;
   private $completed_date;

   public function __construct($parent_database,$regNo,$date){
     $this->date = $date;
     $this->table_path="microbio_table";
     $this->parent_database=$parent_database;
     $this->regNo = $regNo;
     $this->lab_no = $_POST["labno"];
     $this->BHT_no = $_POST["clinicno"];
     $this->specimen_test = $_POST["test"];
     $this->probable_diagnosis = $_POST["diagnosis"];
     $this->clinic_detail = $_POST["clinic_detail"];
     $this->prior_antibiotic = $_POST["prior-anti"];
     $this->antibiotic_given = $_POST["antibiotic"];
     $this->sig_MO = $_POST["sigmo"];
     $this->name_MO = $_POST["namemo"];
     $this->designation = $_POST["designation"];
     $this->completed_date = date('Y-m-d');
   }


   public function writeToTable(){
     /*
     $query = "INSERT INTO medical.microbio_table  (`date`,`regNo`,`lab_no`,`BHT_no`,
       	`specimen_test`,`probable_diagnosis`,`clinic_details`,`prior_antibiotic`,`antibiotic_given`,`sig_MO`,`name_mo`,`designation`,`completed_date`)
        VALUES ( '$this->date','$this->regNo' ,'$this->lab_no','$this->BHT_no','$this->specimen_test',
        '$this->probable_diagnosis','$this->clinic_detail','$this->prior_antibiotic','$this->antibiotic_given','$this->sig_MO',
        '$this->name_MO','$this->designation','$this->completed_date'); ";
      echo $query;
      //$result =mysqli_query( $this->parent_database->getConnection(),$query);
      $request_table=new MicrobioRequestTable($this->parent_database);
      $request_table->deleteRowByID($this->regNo);
      //header("Location: TestRequestLoader.controller.php");

     if(mysqli_query( $this->parent_database->getConnection(),$query)){
      $request_table=new MicrobioRequestTable($this->parent_database);
      $request_table->deleteRowByID($this->regNo);
      header("Location: TestRequestLoader.controller.php");
    }
      else{
        echo "error".mysqli_error($this->parent_database->getConnection());
    }*/
    $database = $this->parent_database;
        $database->enterData("microbio_table",

        array('test_request_date','regNo','lab_no','BHT_no',
        'specimen_test','probable_diagnosis','clinic_details','prior_antibiotic',
        'antibiotic_given','sig_MO','name_mo','designation','completed_date'), 
        
        array($this->date,$this->regNo ,$this->lab_no,$this->BHT_no,$this->specimen_test,
        $this->probable_diagnosis,$this->clinic_detail,$this->prior_antibiotic,$this->antibiotic_given,$this->sig_MO,
        $this->name_MO,$this->designation,$this->completed_date)
    );
        $request_table=new MicrobioRequestTable($this->parent_database);
        $request_table->deleteRowByID($this->regNo);
        header("Location: /Tuto/");

    }
   }

  ?>
