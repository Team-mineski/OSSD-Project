<?php
include_once "ECGRequestTable.model.php";

class ECG
{
  private $date;
  private $regNo;
  private $BHT_no;
  private $surgeon;
  private $standard_lead;
  private $other_lead;
  private $sigMO;
  private $reg_no;
  private $remarks;
  private $finishedDate;
  private $sigCardio;
  private $table_path;
  private $parent_database;
  private $request_date;

  function __construct($parent_database, $regNo, $date)
  {
    $this->date = $date;
    $this->request_date = $date;
    $this->table_path = "ecg_table";
    $this->parent_database = $parent_database;
    $this->regNo = $regNo;
    $this->BHT_no = htmlentities($_POST["bht"]);
    $this->surgeon = htmlentities($_POST["surgeon"]);
    $this->standard_lead = htmlentities($_POST["sleads"]);
    $this->other_lead = htmlentities($_POST["anyleads"]);
    $this->sigMO = htmlentities($_POST["sigmo"]);
    $this->reg_no = htmlentities($_POST["regno"]);
    $this->remarks = htmlentities($_POST["remark"]);
    $this->finishedDate = htmlentities($_POST["dates"]);
    $this->sigCardio = htmlentities($_POST["signcardio"]);
  }


  public function writeToTable()
  {

    $database = $this->parent_database;
    $database->enterData(
      "ecg_table",

      array(
        'test_request_date', 'regNo', 'BHT_no', 'surgeon', 'standard_lead',
        'other_lead', 'sigMO', 'reg_no', 'remarks',
        'finishedDate', 'sigcardio'
      ),

      array(
        $this->date, $this->regNo, $this->BHT_no, $this->surgeon, $this->standard_lead, $this->other_lead, $this->sigMO,
        $this->reg_no, $this->remarks, $this->finishedDate, $this->sigCardio
      )
    );

    $request_table = new ECGRequestTable($this->parent_database);
    $request_table->deleteRowByID($this->regNo);
    header("Location: /Tuto/");
  }
}
