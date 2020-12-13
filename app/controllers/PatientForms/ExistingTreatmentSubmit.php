<?php
include '../../models/DatabaseConnection/Database.php';

if (!(isset($_SESSION))) {
    session_start();
    if ((!(isset($_SESSION["username"]))) || ($_SESSION["type"] != "Doctor")) {
        header("Location: ../restricted/index");
        return;
    }
}
$medical = Database::getInstance();
$columns = array('RegNo', 'Date', 'ClinicalSignsPresented', 'PrescribedDrugs', "AdditionalNotes");
if (isset($_SESSION["regNo"])) {
    $regNo = $_SESSION["regNo"];
} else {
    $patient = $_SESSION["Patient"];
    $regNo = $patient->getRegNo();
}

if (isset($_SESSION['error'])) {
    echo $_SESSION['error'];
    unset($_SESSION['error']);
}

if (isset($_POST["treatment_submit"])) {
    $columns = array('RegNo', 'Date', 'ClinicalSignsPresented', 'PrescribedDrugs', 'AdditionalNotes');  //don't need to add the ID column
    $medicine = htmlspecialchars($_POST["medicine"]);
    $signs = htmlspecialchars($_POST["signs"]);
    $notes = htmlspecialchars($_POST["notes"]);
    if ($medicine != '' || $signs != '' || $notes != '') {
        $medical->enterData("history", $columns, array($regNo, date('Y-m-d'), $signs, $medicine, $notes));
    }
}

$results =  $medical->retrieveData("history", $columns, $regNo);
$_SESSION["results"]=$results;
header("Location: ../../views/ExistingPatient/ExistingTreatments.php");
return;
?>