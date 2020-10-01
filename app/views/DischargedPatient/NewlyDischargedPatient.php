<?php
include '../layouts/docmenu.php';
include '../../classes/Patient.php';
include '../HeaderAndFooter/header.php';
include '../HeaderAndFooter/Discharged.php';
include '../../models/DatabaseConnection/Database.php';

if (!(isset($_SESSION))){
  session_start();
  if (!(isset($_SESSION["username"]))){
    header("Location: ../../../register/login");
    return;
  }
}

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel = "stylesheet" href = "../../../bootstrap/css/bootstrap.min.css" integrity="" crossorigin="anonymous">
    <link rel = "stylesheet" href = "../../../css/navNsideStyles.css">
    <link rel = "stylesheet" href = "../../../css/mainStyles.css">
    <title></title>
  </head>
  <body >
  <?php

    $medical = Database::getInstance();
    $patientID = $_SESSION["PatientID"];
    $patient = $_SESSION["Patient"];
    $regNo = $patient->getRegNo();
    $name = $patient->getName();
    $age = $patient->getAge();
    $gender = $patient->getGender();
    $address = $patient->getAddress();
    $dob = $patient->getDOB();
    $diagnosis = $patient->getDiagnosis();
    $contact = $patient->getContact();
    $bedNo = $patient->getBedNo();
    if (isset($_SESSION["Patient"])){
        unset($_SESSION["Patient"]);
        unset($_SESSION["regNo"]);
    }
    $patient->goNext();
    $diagnosis = $medical->getDiagnosisID($diagnosis);
    $medical->enterData("dischargedPatients", array('RegNo', 'FullName','Gender', 'FullAddress',
      'DateOfBirth', 'DiagnosisID','BedNo','ContactNo'),
      array($regNo,$name, $gender,$address,$dob,$diagnosis['DiagnosisID'],$bedNo, $contact));
    $medical->deleteData("patients", $patientID, "PatientID");
    $medical->moveData("history", "dischargedhistory", "RegNo", $regNo);
    $medical->deleteData("history", $regNo, "RegNo");
    $medical->deleteData("patients", $patientID, "RegNo");
    $medical->deleteData("xray_request_table", $regNo, "RegNo");
    $medical->deleteData("specimen_exam_request_table", $regNo, "RegNo");
    $medical->deleteData("microbio_request_table", $regNo, "RegNo");
    $medical->deleteData("ecg_request_table", $regNo, "RegNo");
    $medical->deleteData("biochemical_request_table", $regNo, "RegNo");
    $patient->displayUI();
  ?>