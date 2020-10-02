<?php
include '../layouts/docmenu.php';
include '../../models/DatabaseConnection/Database.php';
include '../../views/home/cache.php';
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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" 
            integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" 
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" 
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" 
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        <link rel = "stylesheet" href = "../../../css/navNsideStyles.css">
          <link rel = "stylesheet" href = "../../../css/mainStyles.css">

    <title></title>
  </head>
  <body class ="mainbody">
  <div class = "container">
  <form action ="../../controllers/PatientForms/ExistingPatient.php" method = "post">
     <h5 class ="textStyle"> Tests: </h5>
          <div class="form-row">
          
            <div class="ml-5">

            <input type = 'checkbox' name = 'tests[]' value = 'xray_request_table' > <span class ="textStyle">: X-Ray</span> <br> 
            <input type = 'checkbox' name = 'tests[]' value = 'biochemical_request_table'> <span class ="textStyle">: Biochemical Investigation</span> <br>
            <input type = 'checkbox' name = 'tests[]' value = 'ecg_request_table'>  <span class ="textStyle">: ECG </span>  <br>
            <input type = 'checkbox' name = 'tests[]' value = 'specimen_exam_request_table'> <span class ="textStyle">: Specimen Examination</span> <br>
            <input type = 'checkbox' name = 'tests[]' value = 'microbio_request_table'> <span class ="textStyle"> : Microbiology Request</span><br>
            </div>
          </div>
        <br>

        <button class="btn btn-outline-success mr-4" type = "submit" name = "test_submit"> Submit </button>
    </form>
    </div>

    

    

  </body>
</html>