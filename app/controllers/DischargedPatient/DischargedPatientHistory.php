<?php
include '../../models/DatabaseConnection/Database.php';

if (!(isset($_SESSION))) {
  session_start();
  if ((!(isset($_SESSION["username"]))) || ($_SESSION["type"] != "Doctor")) {
    header("Location: ../../../restricted/index");
    return;
  }
}
$medical = Database::getInstance();
$columns = array('RegNo', 'Date', 'ClinicalSignsPresented', 'PrescribedDrugs', "AdditionalNotes");
$regNo = $_SESSION["RegNo"];

$results =  $medical->retrieveData("dischargedhistory", $columns, $regNo);
$_SESSION["results"] = $results;
