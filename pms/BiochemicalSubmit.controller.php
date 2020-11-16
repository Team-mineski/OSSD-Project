<?php

include_once 'Patient.class.php';
include_once "BiochemicalForm.model.php";
include_once "Database.model.php";


session_start();
if (!(isset($_SESSION["username"]))) {
  header("Location: ../register/login");
  return;
}
//$database=unserialize($_SESSION['database']);
//$database->connectDatabase();
$database = Database::getInstance();

$patient = unserialize($_SESSION['patient']);
$regNo = $patient->getRegNo();
$bht = $patient->getBedNo();
$date = $_SESSION['request_date'];

$biochemical_form = new BiochemicalForm($database, $regNo, $date, $bht);
$biochemical_form->writeToTable();
