<?php
include_once "ECGReport.model.php";
include_once "Database.model.php";
include_once "Patient.class.php";



session_start();
if (!(isset($_SESSION["username"]))){
    header("Location: ../register/login");
    return;
  }
//$database=unserialize($_SESSION['database']);
//$database->connectDatabase();
$database=Database::getInstance();

$patient = unserialize($_SESSION['patient']);
$patient_id=$patient->getRegNo();
$date=$_SESSION['request_date'];

$ecg_form = new ECG($database,$patient_id,$date);

$ecg_form->writeToTable();

 ?>
