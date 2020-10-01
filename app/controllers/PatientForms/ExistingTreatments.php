<?php
include '../../views/layouts/docmenu.php';
// include '../../views/HeaderAndFooter/header.php';
include '../../models/DatabaseConnection/Database.php';

if (!(isset($_SESSION))){
  session_start();
  if (!(isset($_SESSION["username"]))){
    header("Location: ../register/login");
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
        <link rel = "stylesheet" href = "../../../img/test.css">
    <title> </title>
  </head>
  <body class ='mainbody'>
    <div class="container">

    
  <table class="table table-bordered" >
    <thead>
      <tr>
          <th style="text-align:center" scope="col" class ="textStyle"> <b>Date</b></th>
          <th style="text-align:center" scope="col" class ="textStyle"><b>Presented Clinical Signs</b> </th>
          <th style="text-align:center" scope="col" class ="textStyle"><b> Prescribed Medicine</b></th>
          <th style="text-align:center" scope="col" class ="textStyle"><b>Additional Notes</b> </th>
      </tr>
    </thead>
    <tbody>
  <?php
        $medical = Database::getInstance();
        $columns = array('RegNo','Date', 'ClinicalSignsPresented','PrescribedDrugs',"AdditionalNotes");
        if (isset($_SESSION["regNo"]))
          {
            $regNo = $_SESSION["regNo"];
          }

        if (isset($_SESSION['error'])){
          echo $_SESSION['error'];
          unset($_SESSION['error']);
        }

        if (isset($_POST["treatment_submit"])){
          $columns = array('RegNo','Date', 'ClinicalSignsPresented','PrescribedDrugs','AdditionalNotes');  //don't need to add the ID column
            $medicine = htmlspecialchars($_POST["medicine"]);
            $signs = htmlspecialchars($_POST["signs"]);
            $notes= htmlspecialchars($_POST["notes"]);
            if ((strlen($medicine)<1) & (strlen($signs)<1) & (strlen($notes)<1)){
              $_SESSION['error'] = "Cannot submit a completely empty form";
              header("Location: ExistingTreatments.php");
              return;
            }
            $medical -> enterData("history", $columns, array($regNo,date('Y-m-d'), $signs, $medicine,$notes));
            header("Location: ExistingPatient.php");
      }

        $results =  $medical->retrieveData("history", $columns, $regNo);
        
        if (sizeof($results)!=0) {
          foreach ($results as $row){
            $date = $row['Date'];
            $signs =  $row['ClinicalSignsPresented'];
            $drugs =  $row['PrescribedDrugs'];
            $notes =  $row['AdditionalNotes'];
            echo 
            "<tr>
              <td> <input type=\"text\" value=$date readonly class='boxstyles'/> </td>
              <td> <textarea id=\"signs\" name = \"signs\"   rows=\"4\" cols=\"30\" readonly class='boxstyles'>$signs</textarea></td>
              <td> <textarea id=\"medicine\" name = \"medicine\"   rows=\"4\" cols=\"30\" readonly class='boxstyles'>$drugs</textarea></td>
              <td> <textarea id=\"notes\" name = \"notes\"   rows=\"4\" cols=\"30\" readonly class='boxstyles'>$notes</textarea></td>
            </tr>"
        ;
          }
        }
          ?>

    <form action="ExistingTreatments.php" method = "post">
        <tr>
          <td> <input type="text" value="<?php echo date('Y-m-d');?>" readonly class="boxstyles"/></td>
          <td> <textarea id="signs" name = "signs" value='' rows="4" cols="30" class="boxstyles"></textarea></td>
          <td> <textarea id="medicine" name = "medicine" value='' rows="4" cols="30" class="boxstyles"></textarea></td>
          <td> <textarea id="notes" name = "notes" value='' rows="4" cols="30" class="boxstyles"></textarea></td>
        </tr>
        </tbody>
  </table>
        <div style="text-align:center">  
            <input type="submit" class =" btn btn-outline-success"name="treatment_submit" id="treatment_submit"/>  
        </div>
        </form>
        <br>
        </div>
    </body>
</html>