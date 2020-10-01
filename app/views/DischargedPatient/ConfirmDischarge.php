<?php
include '../layouts/docmenu.php';
include './HeaderAndFooter/header.php'; 
include '../models/DatabaseConnection/Database.php';
include '../cache.php';
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
    <script src="../../../js/jQuery-2.2.4.min.js"></script>
    <script src="../../../bootstrap/js/bootstrap.min.js"></script>
    <link rel = "stylesheet" href = "../bootstrap/css/bootstrap.min.css" integrity="" crossorigin="anonymous">

    <link rel = "stylesheet" href = "../../../css/navNsideStyles.css">
    <link rel = "stylesheet" href = "../../../css/mainStyles.css">
 
    <title></title>
  </head>
  
  <body>
  
  <div class = containor  style="margin-left:20px; margin-right:20px;">
  <br>
  <br>
    <h4> Search for patient </h4>
    <br>
    <form action ="" method = "post">

      <div class="form-row">
          <div class="form-group col-md-3">
              <input type="Search" class="form-control" name='regNo' placeholder="Enter registration number..." autocomplete="off" required>
          </div>
      </div>
      <br>
      <button type="submit" name = 'submit'>Search</button>

    </form>
    </div>

    <?php

        $medical = Database::getInstance(); 

        if (isset($_POST['regNo'])){
          $_SESSION["regNo"] = $_POST['regNo'];
          header("Location:../../controllers/PatientForms/ExistingPatient.php");
    }


    ?>

  </body>

</html>
