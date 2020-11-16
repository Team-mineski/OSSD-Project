<?php
include '../layouts/docmenu.php';
include_once '../../models/DatabaseConnection/Database.php';

if (!(isset($_SESSION))) {
  session_start();
  if ((!(isset($_SESSION["username"]))) || ($_SESSION["type"] != "Doctor")) {
    header("Location: ../../../restricted/index");
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
  <link rel="stylesheet" href="../../../bootstrap/css/bootstrap.min.css" integrity="" crossorigin="anonymous">
  <link rel="stylesheet" href="../../../css/navNsideStyles.css">
  <link rel="stylesheet" href="../../../css/mainStyles.css">

  <title></title>
</head>

<body class="mainbody">
  <div class=container " style =" padding:10px;">
    <table class="table table-bordered">
      <br>
      <thead>
        <tr>
          <th style="text-align:center" scope="col" class="textStyle"><b>Date Discharged</b> </th>
          <th style="text-align:center" scope="col" class="textStyle"><b>Patient ID</b> </th>
          <th style="text-align:center" scope="col" class="textStyle"> <b>Patient File</b> </th>
        </tr>
      </thead>
      <tbody>
        <?php
        $medical = Database::getInstance();
        $results =  $medical->retrieveAllData("dischargedpatients");
        if (sizeof($results) != 0) {
          foreach ($results as $row) {
            $regNo = $row['RegNo'];
            $dateOfDischarge = $row['DischargedDate'];
            echo
              "
              <form method=\"post\" action=\"../../controllers/DischargedPatient/AlreadyDischargedPatient.php\">
                <tr>

                <td style=\"text-align:center\">  <input type=\"text\" name=\"date\" class=\"form-control w-50\" value=\"$dateOfDischarge\" readonly>  </td>
                <td style=\"text-align:center\">  <input type=\"text\" style=\"text-align:center\" class=\"form-control w-50\" name=\"RegNo\" value=$regNo readonly>  </td>
                <td style=\"text-align:center\">  <input type=\"submit\" name=\"action\" value=\"View Patient File\" class='btn btn-outline-success'/>  </td>
                
                </tr>
              </form>
              ";
          }
        }
        ?>
      </tbody>
  </div>
</body>


</html>