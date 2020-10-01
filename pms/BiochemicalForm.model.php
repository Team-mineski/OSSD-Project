<?php


include_once "BiochemicalRequestTable.model.php";

class BiochemicalForm{
    private $date;
    private $table_path;
    private $parent_database;
    private $regNo;
    private $lab_ref_no;
    private $bht_no;
    private $fasting_status;
    private $clinical_history;
    private $serum=array();
    private $plasma_glu=array();
    private $csf=array();
    private $officer;
    private $date_request;
    private $date_filled;
    private $time_filled;
    private $date_lab_rec;
    private $time_lab_rec;
    private $last_check;
    private $nursing_officer;

    public function __construct($parent_database,$regNo,$date,$bht){
        
        $this->table_path="biochemical_table";
        $this->parent_database=$parent_database;
        $this->regNo=$regNo;
        $this->lab_ref_no=$_POST['refnum'];
        $this->bht_no=$bht;
        $this->fasting_status=$_POST['inlineCheckbox1'];
        $this->clinical_history=$_POST['clinical_history'];
        $this->serum=implode(",",$_POST['Serum']);
        $this->plasma_glu=implode(',',$_POST['Plasma']);
        $this->csf=implode(',',$_POST['CSF']);
        $this->officer=$_POST['offname'];
        $this->date_request=$_POST['Date'];
        $this->date = $date;
        $this->date_filled=$_POST['Date2'];
        $this->time_filled=$_POST['time1'];
        $this->nursing_officer=$_POST['offname2'];
        $this->date_lab_rec=$_POST['datefinal'];
        $this->time_lab_rec=$_POST['timefinal'];
        $this->last_check=implode(',',$_POST['last_checkbox']);
}

    public function writeToTable(){
/*
        $query="INSERT INTO medical.biochemical_table(`regNo`, `lab_ref_no`, `bht_no`, `fasting_status`, `clinical_history`, `serum`, 
        `plasma_glu`, `csf`, `officer`, `date`, 
        `date_filled`,`time_filled`,`nursing_officer`,`date_lab_rec`,`time_lab_rec`,`last_check`) 
        VALUES ('$this->regNo','$this->lab_ref_no','$this->bht_no','$this->fasting_status','$this->clinical_history',
        '$this->serum','$this->plasma_glu','$this->csf','$this->officer','$this->date_request','$this->date_filled',
        '$this->time_filled','$this->nursing_officer',
        '$this->date_lab_rec','$this->time_lab_rec','$this->last_check')";        //name format use for naming tables is <test_type>_table
        echo $query;*/
        $database = $this->parent_database;
        $database->enterData("biochemical_table",
        array('regNo', 'test_request_date','lab_ref_no','bht_no','fasting_status',
        'clinical_history', 'serum','plasma_glu','csf',
        'officer', 'date_request','date_filled','time_filled','nursing_officer',
        'date_lab_rec', 'time_lab_rec','last_check'), 
        
        array($this->regNo,$this->date,$this->lab_ref_no,$this->bht_no,$this->fasting_status,$this->clinical_history,
        $this->serum,$this->plasma_glu,$this->csf,$this->officer,$this->date_request,$this->date_filled,$this->time_filled,
        $this->nursing_officer,
        $this->date_lab_rec,$this->time_lab_rec,$this->last_check),
    );
        $request_table=new BiochemicalRequestTable($this->parent_database);
        $request_table->deleteRowByID($this->regNo);
        header("Location: /Tuto/");

    }

    //temporary














}



?>