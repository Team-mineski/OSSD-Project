<?php
include '../../models/DatabaseConnection/Database.php';
include '../../classes/Patient.php';
include '../../views/home/cache.php';
include '../layouts/docmenu.php';

if (!(isset($_SESSION))) {
    session_start();
    if ((!(isset($_SESSION["username"]))) || ($_SESSION["type"] != "Doctor")) {
        header("Location: ../../../restricted/index");
        return;
    }
}
$medical = Database::getInstance();

if (isset($_SESSION["Patient"])) {
    $patient =  $_SESSION["Patient"];
    $regNo = $patient->getRegNo();
}

if (isset($_POST['date'])) {
    $date = $_POST['date'];
}

$results = $medical->retrieveDataByDate("ecg_table", array(
    'test_request_date', 'regNo', 'BHT_no', 'surgeon', 'standard_lead',
    'other_lead', 'sigMO', 'reg_no', 'remarks',   'finishedDate', 'sigcardio'
), $date, $regNo);
if ($results) {

    $bht_no = $results['BHT_no'];
    $surgeon =  $results['surgeon'];
    $standard_lead =  $results['standard_lead'];
    $other_lead =   $results['other_lead'];
    $sigMO = $results['sigMO'];
    $reg_no =  $results['reg_no'];
    $remarks = $results['remarks'];
    $finishedDate = $results['finishedDate'];
    $sigcardio =  $results['sigcardio'];
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>Electrocardiograph Examination Results Form</title>

    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" 
            integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" 
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" 
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" 
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        <link rel = "stylesheet" href = "../../../css/navNsideStyles.css">
    <link rel = "stylesheet" href = "../../../css/mainStyles.css"> -->
    <script src="../../../js/jQuery-2.2.4.min.js"></script>
    <script src="../../../bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../../../bootstrap/css/bootstrap.min.css" integrity="" crossorigin="anonymous">
    <link rel="stylesheet" href="../../../css/navNsideStyles.css">
    <link rel="stylesheet" href="../../../css/mainStyles.css">
</head>

<body>

    <header>
        <div class="container text-center">
            <h3> REQUISITION FOR ELECTROCARDIOGRAPH EXAMINATION </h3>
            <br>
        </div>
    </header>

    <div class="container">
        <form action="" class="main-form">
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="name_add"> NAME AND ADDRESS:</label>
                        <textarea name="name_add" id="name_add" cols="30" rows="5" class="form-control form-control-sm" readonly><?php echo $patient->getAddress(); ?></textarea>

                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="bedno"> BED No:</label>
                        <input type="number" name="bedno" id="bedno" class="form-control form-control-sm" readonly value=<?php echo $patient->getBedNo(); ?>>

                    </div>

                </div>

                <div class="col">
                    <div class="form-group">
                        <label for="wardno"> WARD No:</label>
                        <input type="number" name="wardno" id="wardno" class="form-control form-control-sm" readonly value=<?php echo 19; ?>>

                    </div>

                </div>
            </div>


            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="bht"> B.H.T No:</label>
                        <input type="text" name="bht" id="bht" class="form-control form-control-sm" readonly value=<?php echo $patient->getBedNo(); ?>>

                    </div>
                </div>
                <div class="col">
                    <div class="form-group w-25">
                        <label for="age"> Age:</label>
                        <input type="text" name="age" id="age" class="form-control form-control-sm" readonly value=<?php echo $patient->getAge(); ?>>

                    </div>

                </div>

                <div class="col">
                    <div class="form-group w-25">
                        <label for="sex"> Sex:</label>
                        <select name="sex" id="sex" class="form-control form-control-sm" disabled="true">
                            <option><?php echo $patient->getGender() ?></option>
                        </select>
                    </div>

                </div>
            </div>

        </form>

        <table class="table table-bordered">
            <thead>
                <th scope="col"> CLINICAL HISTORY</th>
                <th scope="col"> ELECTROCARDIOGRAPH EAXMINATION</th>


            </thead>

            <tbody>
                <tr>
                    <td rowspan="3"> SURGEON/ PHYSICIAN </td>
                    <td colspan="2">
                        <label for="sleads">STANDARD LEADS</label>
                        <input type="text" name="sleads" id="sleads" class="form-control form-control-sm" readonly value=<?php echo $standard_lead; ?>>


                <tr>
                    <td>
                        <label for="anyleads">ANY OTHER LEADS </label>
                        <input type="text" name="anyleads" id="anyleads" class="form-control form-control-sm" readonly value=<?php echo $other_lead; ?>>
                    </td>

                </tr>
                <tr>
                    <td>
                        <label for="sigmo">SIGNATURE M/O </label>
                        <input type="text" name="sigmo" id="sigmo" class="form-control form-control-sm" readonly value=<?php echo $sigMO; ?>>
                    </td>
                </tr>
                </td>

                </tr>

            </tbody>

        </table>
        <br>
        <hr class="newhr">


    </div>

    <div class="container">
        <div class=" text-center">
            <h5><b>FOR THE USE OF THE DEPARTMENT OF CARDIOGRAPHY ONLY</b></h5>
        </div>
        <br>

        <div class="form-group w-50  ">
            <label for="regno">REGISTERED No: </label>
            <input type="text" name="regno" id="regno" class="form-control form-control-sm " readonly value=<?php echo $reg_no; ?>>
        </div>
        <div class="form-group w-50  ">
            <label for="remark"> REMARKS: </label>
            <textarea name="remark" id="remark" cols="30" rows="4" class="form-control form-control-sm" readonly><?php echo $remarks; ?>  </textarea>
        </div>

        <br>

    </div>


</body>

<footer>
    <div class="container">
        <div class="row ">

            <div class="col">
                <input type="text" name="date" class="form-control form-control-sm" placeholder="DATE STAMP" readonly value=<?php echo $finishedDate; ?>>
            </div>

            <div class="col">
                <input type="text" name="signcard" class="form-control form-control-sm " placeholder="SIGNATURE OF CARDIOGRAPHER" readonly value=<?php echo $sigcardio; ?>>

            </div>

        </div>
        <hr class="newhr">
        <div class="printvisible">
            <button class="btn btn-outline-success mr-4" name="test" onclick="window.print();"> Print </button>
        </div>
        <br>

    </div>
</footer>

</html>