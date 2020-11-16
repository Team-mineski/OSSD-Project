<?php
include '../../classes/Patient.php';
include '../../views/layouts/docmenu.php';
include_once '../../views/HeaderAndFooter/Discharged.php';
include '../../models/DatabaseConnection/Database.php';


if (!(isset($_SESSION))) {
  session_start();
  if ((!(isset($_SESSION["username"]))) || ($_SESSION["type"] != "Doctor")) {
    header("Location: ../../../restricted/index");
    return;
  }
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <script src="../../../js/jQuery-2.2.4.min.js"></script>
  <script src="../../../bootstrap/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="../../../bootstrap/css/bootstrap.min.css" integrity="" crossorigin="anonymous">
  <link rel="stylesheet" href="../../../css/navNsideStyles.css">
  <link rel="stylesheet" href="../../../css/mainStyles.css">
  <title></title>
</head>

<body>
  <?php

  $medical = Database::getInstance();
  if (isset($_POST['RegNo'])) {
    $regNo = $_POST["RegNo"];
    $_SESSION["RegNo"] = $regNo;
  } else if (isset($_SESSION['RegNo'])) {
    $regNo = $_SESSION["RegNo"];
  }

  $columns = array('RegNo', 'FullName', 'Gender', 'FullAddress', 'DateOfBirth', 'Disease',  'BedNo', 'ContactNo');

  $results =  $medical->joinPatientWithDiagnosis("dischargedpatients", $columns, "RegNo", $regNo);
  if ($results) {
    $regNo = $results['RegNo'];
    $diagnosis =  $results['Disease'];
    $name = $results['FullName'];
    $gender =  $results['Gender'];
    $address =  $results['FullAddress'];

    $dob =  $results['DateOfBirth'];
    $bday = new DateTime($dob);
    $today = new DateTime();
    $diff = $today->diff($bday);
    $y = $diff->y;
    $m = $diff->m;
    $d = $diff->d;
    if ($y != 0) {
      $age = $y . " year/s";
    } else if ($m != 0) {
      $age = $m . " month/s " . $d . " day/s";
    } else {
      $age = $d . " day/s";
    }

    $contact = $results['ContactNo'];
    $bedNo = $results['BedNo'];
    if ($bedNo == '') {
      $admission = "Not admitted";
    } else {
      $admission = "Admitted";
    }
  }
  $patient = new Patient($regNo, $name, $age, $address, $diagnosis, $dob, $gender, $admission, $bedNo, $contact, "Discharged");
  $_SESSION["Patient"] = $patient;
  $_SESSION["RegNo"] = $regNo;
  $patient->displayUI();
  ?>