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

$xray_form=new XrayForm($database,$date, $regNo,$bht,$_POST['sign'],$_POST['signature'],
date('Y-m-d'),$_POST['xno'],$_POST['xroom'],$_POST['films'],$_POST['remark'],$_POST['signrad'],implode(',',$_POST['region']));
$xray_form->writeToTable();

?>