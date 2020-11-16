
<?php
include '../../models/DatabaseConnection/Database.php';
include '../../models/Validation.php';
include '../../classes/Patient.php';
include '../../classes/Test.php';
include '../../views/home/cache.php';

if (!(isset($_SESSION))) {
  session_start();
  if ((!(isset($_SESSION["username"]))) || ($_SESSION["type"] != "Doctor")) {
    header("Location: ../restricted/index");
    return;
  }
}

$errors = array();
$medical = Database::getInstance();

if (isset($_POST['name'])) {
  try {
    $name = Validation::str($_POST['name']);
  } catch (Exception $e) {
    array_push($errors, "Name incorrectly entered");
  }
}

if (isset($_POST['regNo'])) {

  try {
    $regNo = Validation::str(trim(htmlspecialchars($_POST['regNo'])));
    //$_SESSION["regNo"] = $regNo;
  } catch (Exception $e) {
    array_push($errors, "Registration number incorrectly entered");
  }
}

if (isset($_POST['contact'])) {
  try {
    $contact = Validation::phone($_POST['contact']);
  } catch (Exception $e) {
    array_push($errors, "Contact number incorrectly entered");
  }
}


if (isset($_POST['diagnosis'])) {
  try {
    $diagnosis = Validation::str(trim(htmlspecialchars($_POST['diagnosis'])));
  } catch (Exception $e) {
    array_push($errors, "Diagnosis incorrectly entered");
  }
}
if (isset($_POST['gender'])) {
  try {
    $gender = Validation::str(trim(htmlspecialchars($_POST['gender'])));
  } catch (Exception $e) {
    array_push($errors, "Gender incorrectly entered");
  }
}

if (isset($_POST['address'])) {
  try {
    $address = Validation::str(trim(htmlspecialchars($_POST['address'])));
  } catch (Exception $e) {
    array_push($errors, "Address incorrectly entered");
  }
}

if (isset($_POST['dob'])) {
  $dob = htmlentities($_POST['dob']);
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
}


if (isset($_POST['admitted'])) {
  $status = $_POST['admitted'];
  if ($status == true) {
    $status = "Admitted";
    if (isset($_POST['bed'])) {
      $bed = trim(htmlspecialchars($_POST['bed']));
    }
  } else {
    $status =  "Not admitted";
    $bed = '';
  }
}

if (isset($_POST["medicine"])) {
  $medicine = htmlspecialchars($_POST["medicine"]);
}

if (isset($_POST["signs"])) {
  $signs = htmlspecialchars($_POST["signs"]);
}

if (isset($_POST['tests'])) {
  $tests = $_POST['tests'];
}
if (isset($_POST['notes'])) {
  $notes = $_POST['notes'];
}

if (isset($_POST["submit"])) {
  if (empty($errors)) {
    $results = $medical->checkForDiagnosis('diseases', array("DiagnosisID"), $diagnosis);
    if (sizeof($results) != 0) {
      foreach ($results as $row) {
        $diagnosisID = $row["DiagnosisID"];
      }
    } else {
      $medical->enterData(
        "diseases",
        array('Disease'),
        array($diagnosis)
      );
      $results = $medical->checkForDiagnosis('diseases', array("DiagnosisID"), $diagnosis);
      if (sizeof($results) != 0) {   //PLEASE FIND A BETTER METHOD TO GET THE MOST RECENTLY ENTERED ID
        foreach ($results as $row) {
          $diagnosisID = $row["DiagnosisID"];
        }
      }
    }
    echo $diagnosisID;

    $patient = new Patient($regNo, $name, $age, $address, $diagnosis, $dob, $gender, $status, $bed, $contact, "New");
    $_SESSION["Patient"] = $patient;
    $error = $medical->enterData(
      "patients",
      array(
        'RegNo', 'FullName', 'Gender', 'FullAddress',
        'DateOfBirth', 'DiagnosisID', 'BedNo', 'ContactNo'
      ),
      array($regNo, $name, $gender, $address, $dob, $diagnosisID,  $bed, $contact)
    );

    if ($error == false) {
      $_SESSION["Recheck"] = "Please recheck the data you entered";
      header("Location: ../../views/NewPatient/NewPatientForm.php");
      return;
    } else {
      $columns = array('RegNo', 'Date', 'ClinicalSignsPresented', 'PrescribedDrugs', "AdditionalNotes");  //don't need to add the ID column
      if ($signs != '' or $medicine != '' or $notes != '') {
        $medical->enterData(
          "history",
          $columns,
          array($_POST["regNo"], date('y/m/d'), $signs, $medicine, $notes)
        );
      }

      if (!(empty($tests))) {
        foreach ($tests as $test) {
          $class_name = ucfirst($test);
          $command = new $class_name; //command design pattern
          $command->execute($medical, array($regNo, date('Y-m-d')));
          $medical->enterData($test, array('patient_id', 'sdate'), array($regNo, date('Y-m-d')));
        }
      }
      $patient->displayUI();
    }
  } else {
    $_SESSION["Errors"] = $errors;
    header("Location: ../../views/NewPatient/NewPatientForm.php");
    return;
  }
}

?>