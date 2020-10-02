<?php
include_once 'Request.class.php';
include_once 'Database.model.php';
include_once "Patient.class.php";
include_once 'PatientTable.model.php';
include_once 'TestRequestTable.model.php';

include_once "XrayRequestTable.model.php";
include_once "ECGRequestTable.model.php";
include_once "MicrobioRequestTable.model.php";
include_once "BiochemicalRequestTable.model.php";
include_once "SpecimenExamRequestTable.model.php";

session_start();
if (!(isset($_SESSION["username"]))){
    header("Location: ../register/login");
    return;
  }

$requests=$_SESSION['requests'];

$database = Database::getInstance();
$request_index=$_POST['test_request'];     // getting index of selected test in array of requests
$request=$requests[$request_index];     //getting relavent request object
$patient_id=$request->getPatientID();         //requested patient's id
echo $patient_id;
$test_type=$request->getTable()->getTestType();
$request_date=$request->getDate();

$patient_table=new PatientTable($database);      // initiating a new Patient Table
$patient=$patient_table->getPatientByID($patient_id);     //get requested patient details from database as patient object
$_SESSION['patient']=serialize($patient);
$_SESSION['request_date']=$request_date;
switch($test_type){
    case "xray":
        header("Location:XrayReport.viewer.php");
        break;
    case "ecg":
        header("Location:ECGReport.viewer.php");
        break;
    case "biochemical":
        header("Location:BiochemicalReport.viewer.php");
        break;
    case "microbio";
        header("Location:Microbio.viewer.php");
        break;
    case "specimen_exam":
        header("Location:SpecimenExam.viewer.php");
        break;
}





?>