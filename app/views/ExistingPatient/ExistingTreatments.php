<?php
include '../../classes/Patient.php';
include '../../views/layouts/docmenu.php';
// include '../../views/HeaderAndFooter/header.php';
include '../../models/DatabaseConnection/Database.php';

if (!(isset($_SESSION))) {
    session_start();
    if ((!(isset($_SESSION["username"]))) || ($_SESSION["type"] != "Doctor")) {
        header("Location: ../restricted/index");
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
    <link rel="stylesheet" href="../../../bootstrap/css/bootstrap.min.css" integrity="" crossorigin="anonymous">
    <link rel="stylesheet" href="../../../css/navNsideStyles.css">
    <link rel="stylesheet" href="../../../css/mainStyles.css">
    <link rel="stylesheet" href="../../../img/test.css">
    <title> </title>
</head>

<body class='mainbody'>
    <div class="container">


        <table class="table table-bordered">
            <thead>
                <tr>
                    <th style="text-align:center" scope="col" class="textStyle"> <b>Date</b></th>
                    <th style="text-align:center" scope="col" class="textStyle"><b>Presented Clinical Signs</b> </th>
                    <th style="text-align:center" scope="col" class="textStyle"><b> Prescribed Medicine</b></th>
                    <th style="text-align:center" scope="col" class="textStyle"><b>Additional Notes</b> </th>
                </tr>
            </thead>
            <tbody>
                <?php
                $results = $_SESSION["results"];

                if (sizeof($results) != 0) {
                    foreach ($results as $row) {
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
            </tr>";
                    }
                }
                ?>

                <form action="../../controllers/PatientForms/ExistingTreatmentSubmit.php" method="post">
                    <tr>
                        <td> <input type="text" value="<?php echo date('Y-m-d'); ?>" readonly class="boxstyles" /></td>
                        <td> <textarea id="signs" name="signs" value=' ' rows="4" cols="30" class="boxstyles"></textarea></td>
                        <td> <textarea id="medicine" name="medicine" value=' ' rows="4" cols="30" class="boxstyles"></textarea></td>
                        <td> <textarea id="notes" name="notes" value=' ' rows="4" cols="30" class="boxstyles"></textarea></td>
                    </tr>
            </tbody>
        </table>
        <div style="text-align:center">
            <button class="btn btn-outline-success mr-4" type="submit" name="treatment_submit">Submit</button>
        </div>
        </form>
        <br>
    </div>

</body>

</html>