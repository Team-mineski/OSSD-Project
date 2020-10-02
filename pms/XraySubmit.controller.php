<?php

include_once "Patient.class.php";
include_once "XrayForm.model.php";
include_once "Database.model.php";


session_start();
if (!(isset($_SESSION["username"]))){
    header("Location: ../register/login");
    return;
  }
//$database=unserialize($_SESSION['database']);
//$database->connectDatabase();
$database = Database::getInstance();
$patient = unserialize($_SESSION['patient']);
$regNo=$patient->getRegNo();
$bht=$patient->getBedNo();
$date=$_SESSION['request_date'];

$xray_form=new XrayForm($database,$date, $regNo,$bht,htmlentities($_POST['sign']),htmlentities($_POST['signature']),
                        date('Y-m-d'),htmlentities($_POST['xno']),htmlentities($_POST['xroom']),htmlentities($_POST['films']),
                        htmlentities($_POST['remark']),
                        htmlentities($_POST['signrad']),implode(',',$_POST['region']));
$xray_form->writeToTable();

?>