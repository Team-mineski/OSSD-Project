<?php
include '../models/DatabaseConnection/Database.php';
include '../models/Validation.php';
include '../classes/Patient.php';
if (!(isset($_SESSION))) {
  session_start();
  if ((!(isset($_SESSION["username"]))) || ($_SESSION["type"] != "Doctor")) {
    header("Location: ../restricted/index");
    return;
  }
  $patient = $_SESSION["Patient"];
}
$medical = Database::getInstance();
$errors = array();

if (isset($_POST['admitted'])) {
  $status = $_POST['admitted'];
  if ($status == true) {
    $bed = trim(htmlspecialchars($_POST['bed']));
  }
}
if (isset($_POST['test'])) {


  if (isset($_POST['diagnosis'])) {
    try {
      $disease = Validation::str(trim(htmlspecialchars($_POST['diagnosis'])));
    } catch (Exception $e) {
      array_push($errors, "Diagnosis incorrectly entered");
    }
  }

  if (isset($_POST['contact'])) {
    try {
      $contact = Validation::phone($_POST['contact']);
    } catch (Exception $e) {
      array_push($errors, "Contact number incorrectly entered");
    }
  }

  if (isset($_POST['address'])) {
    try {
      $address = Validation::str(trim(htmlspecialchars($_POST['address'])));
    } catch (Exception $e) {
      array_push($errors, "Address incorrectly entered");
    }
  }
}

if ($bed == '') {
  $admission = "Not admitted";
  $bed = '';
} else {
  $admission = "Admitted";
  
}
$_SESSION["admission"] = $admission;
$patient->setBed($bed);
$patient->setDiagnosis($disease);
$patient->setContact($contact);
$patient->setAddress($address);
$regNo = $patient->getRegNo();

$results = $medical->getDiagnosisID($disease);
if ($results) {
  $diagnosisID = $results["DiagnosisID"];
} else {
  $medical->enterData(
    "diseases",
    array('Disease'),
    array($disease)
  );
  $results = $medical->getDiagnosisID($disease);
  if ($results) {
    $diagnosisID = $results["DiagnosisID"];
  }
}

$medical->updateData(
  $_SESSION["PatientID"],
  array("DiagnosisID", "FullAddress", "ContactNo", "BedNo"),
  array($diagnosisID, $address, $contact, $bed),
  "patients"
);
header("Location: ./PatientForms/ExistingPatient.php");
?>

<script>
  if (window.history.replaceState) {
    window.history.replaceState(null, null, window.location.href);
  }
</script>