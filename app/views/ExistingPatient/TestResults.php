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
    <script src="../../../js/jQuery-2.2.4.min.js"></script>
    <script src="../../../bootstrap/js/bootstrap.min.js"></script>
    <link rel = "stylesheet" href = "../../../bootstrap/css/bootstrap.min.css" integrity="" crossorigin="anonymous">
    <link rel = "stylesheet" href = "../../../css/navNsideStyles.css">
    <link rel = "stylesheet" href = "../../../css/mainStyles.css">

    <title></title>
  </head>
</div>
<br>
  <body class ="mainbody">
  <div class = "container d-flex justify-content-center" >

  <div class="form-group w-25">
        <button type="button" class="btn btn-outline-success mr-4 btn-block justify-content-center"  onclick="window.location.href = '../TestResults/BiochemicalInvestigations.php';">Biochemical Investigations</button>
        <button type="button" class="btn btn-outline-success mr-4 btn-block"  onclick="window.location.href = '../TestResults/ECG.php';">ECG  </button>
        <button type="button" class="btn btn-outline-success mr-4 btn-block"  onclick="window.location.href = '../TestResults/microbio.php';">Microbiology Tests</button>
        <button type="button" class="btn btn-outline-success mr-4 btn-block"  onclick="window.location.href =  '../TestResults/SpecimenExamination.php';">Specimen Examinations</button>
        <button type="button" class="btn btn-outline-success mr-4 btn-block"  onclick="window.location.href = '../TestResults/XRay.php';">X-Rays</button>
        
  </div>
</div>

  </body>
</html>

