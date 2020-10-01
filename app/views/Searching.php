<?php
include './layouts/docmenu.php';
// error
 //include './HeaderAndFooter/header.php';
include '../models/DatabaseConnection/Database.php';
//  include 'home/cache.php';
if (!(isset($_SESSION))){
  session_start();
  if (!(isset($_SESSION["username"]))){
    header("Location: ../../register/login");
    //header("Location: ../register/login.php");
    return;
  }
  if (isset($_SESSION["regNo"]))
  {
    unset($_SESSION['regNo']);
  }
  if (isset($_SESSION["Patient"]))
  {
    unset($_SESSION['Patient']);
  }
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel = "stylesheet" href = "../../bootstrap/css/bootstrap.min.css" integrity="" crossorigin="anonymous">

    <link rel = "stylesheet" href = "../../css/navNsideStyles.css">
    <link rel = "stylesheet" href = "../../css/mainStyles.css">
    <!-- <link rel = "stylesheet" href = "../../css/styles.css">
    <link rel = "stylesheet" href = "../../style.css"> -->
    <title> Existing Patient</title>
  </head>

  <body class = 'mainbody'>
  <div class = "container">
  
    <form action ="../controllers/PatientForms/ExistingPatient.php" method = "post">
      <div class="row h-100 ">

        <div class="col-lg-5  align-self-center">
          <img src="../../css/bigsearch.png" alt="" class ="bigsearch">
        </div>

        <div class="col-lg-3 align-self-center">
        <?php

          if (isset($_SESSION['error'])){
            echo "<br> <br>";
            $error = $_SESSION['error'];
            echo "<h4 align ='center' class ='textStyle'>$error</h4> ";
            unset($_SESSION['error']);
          }
?>

              <div class="form-group ">
                <h3 class ="mainText"> Search for patient </h3>
                <input type="Search" class="form-control boxstyles" name='regNo'
                placeholder="Enter registration number..." autocomplete="off" required>
              </div>

        </div>

        <div class="col-lg-4 align-self-center ">
              <button type="submit" name = 'submit' class ="roundsearchbtn">
                <img src="../../css/search.png" alt="" class="searchicon"></button>
              </div>
      </div>
    </div>

    </form>

    </div>

  </body>

</html>
