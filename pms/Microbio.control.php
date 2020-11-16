<?php
include_once "Microbio.model.php";
include_once "Database.model.php";
include_once "Patient.class.php";



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
$date = $_SESSION['request_date'];


$microbio_form = new Microbio($database, $regNo, $date);

$microbio_form->writeToTable();
