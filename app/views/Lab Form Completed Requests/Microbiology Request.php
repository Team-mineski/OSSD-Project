<?php
include '../layouts/docmenu.php';
include '../../models/DatabaseConnection/Database.php';
include '../../classes/Patient.php';

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
  <script src="../../../js/jQuery-2.2.4.min.js"></script>
  <script src="../../../bootstrap/js/bootstrap.min.js"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="../../../bootstrap/css/bootstrap.min.css" integrity="" crossorigin="anonymous">
  <link rel="stylesheet" href="../../../css/navNsideStyles.css">
  <link rel="stylesheet" href="../../../css/mainStyles.css">
  <title></title>
</head>

<div class="container ">

  <form action="" method="post">

    <table class="table table-bordered">
      <thead>
        <tr>
          <th style="text-align:center" scope="col" class="textStyle"><b>Test Request Date</b> </th>
          <th style="text-align:center" scope="col" class="textStyle"><b> Test Results</b></th>
        </tr>
      </thead>
      <tbody>
  </form>
</div>
<br>

<body class="mainbody">

  <?php

  $medical = Database::getInstance();
  $results =  $medical->retrieveData("microbio_table", array('test_request_date'), $_SESSION["regNo"]);
  if (sizeof($results) != 0) {
    foreach ($results as $row) {
      $date =  $row['test_request_date']; //THIS NEEDS TO BE THE COMPLETED DATE NOT THE REQUESTED DATE
      echo
        "
            <tr>
            <form action = \"../../views/Lab Forms/Microbiology Request.php\" method = post>
                <td style=\"text-align:center\"> <input type=\"text\"  name = \"date\" value=$date readonly class ='boxstyles'/> </td>
                <td style=\"text-align:center\">
                    <button type = \"submit\" name = \"test\" class ='btn btn-outline-success'> View Results </button>
                </form>
                </td>
                </tr>";
    }
    echo "</table>";
  }




  ?>






</body>

</html>