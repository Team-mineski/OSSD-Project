<?php

include_once "SpecimenExamRequestTable.model.php";
class SpecimenExam
{

  private $table_path;
  private $parent_database;
  private $serial_no;
  private $date;
  private $regNo;
  private $BHT_no;
  private $matandexams;
  private $coldate;
  private $coltime;
  private $sig_MO;
  private $institutionNo;
  private $counterdate;
  private $countertime;
  private $counterreceived;
  private $remarks;
  private $labno;
  private $labdate;
  private $labreceived;
  private $labnotice;
  private $labsig;
  private $report;
  private $reportcheck;
  private $sentdate;


  function __construct($parent_database, $regNo, $date)
  {
    $this->table_path = "specimen_exam_table";
    $this->parent_database = $parent_database;
    $this->regNo = $regNo;
    $this->date = $date;
    $this->serial_no = htmlentities($_POST["serialno"]);
    $this->matandexams = htmlentities($_POST["exams"]);
    $this->coldate = htmlentities($_POST["coldate"]);
    $this->coltime = htmlentities($_POST["coltime"]);
    $this->sig_MO = htmlentities($_POST["signmo"]);
    $this->institutionNo = htmlentities($_POST["insno"]);
    $this->counterdate = htmlentities($_POST["cdate"]);
    $this->countertime = htmlentities($_POST["ctime"]);
    $this->counterreceived = htmlentities($_POST["cReceived"]);
    $this->remarks = htmlentities($_POST["remark"]);
    $this->lab_no = htmlentities($_POST["labno"]);
    $this->labdate = htmlentities($_POST["labdate"]);
    $this->labreceived = ($_POST["Received"]);
    $this->labnotice = htmlentities($_POST["labnote"]);
    $this->labsig = htmlentities($_POST["labsign"]);
    $this->report = htmlentities($_POST["repspec"]);
    $this->reportcheck = htmlentities($_POST["repcheck"]);
    $this->sentdate = htmlentities($_POST["senton"]);
  }

  public function writeToTable()
  {
    $database = $this->parent_database;
    $database->enterData(
      "specimen_exam_table",

      array(
        'test_request_date', 'serial_no', 'regNo', 'BHT_no', 'exams', 'collect_date',
        'collect_time', 'sigMO', 'institution_No', 'counter_date',
        'counter_time', 'received_by', 'remarks', 'lab_no',
        'lab_date', 'lab_received_by', 'lab_note', 'lab_sig',
        'report', 'report_check', 'sentdate'
      ),

      array(
        $this->date, $this->serial_no, $this->regNo, $this->BHT_no, $this->matandexams, $this->coldate, $this->coltime,
        $this->sig_MO, $this->institutionNo, $this->counterdate, $this->countertime,
        $this->counterreceived, $this->remarks, $this->lab_no, $this->labdate, $this->labreceived, $this->labnotice,
        $this->labsig, $this->report, $this->reportcheck, $this->sentdate
      ),
    );
    $request_table = new SpecimenExamRequestTable($this->parent_database);
    $request_table->deleteRowByID($this->regNo);
    header("Location: /Tuto/");
  }
}
