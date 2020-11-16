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
$results = $medical->retrieveDataByDate("specimen_exam_table", array(
    'test_request_date', 'serial_no', 'regNo', 'BHT_no', 'exams', 'collect_date',
    'collect_time', 'sigMO', 'institution_No', 'counter_date',
    'counter_time', 'received_by', 'remarks', 'lab_no',
    'lab_date', 'lab_received_by', 'lab_note', 'lab_sig',
    'report', 'report_check', 'sentdate'
),  $date, $regNo);
if ($results) {


    $date = $results['test_request_date'];
    $serial_no = $results['serial_no'];
    $lab_no = $results['lab_no'];
    $BHT_no =  $patient->getBedNo();
    $exams =  $results['exams'];
    $collect_date =  $results['collect_date'];

    $collect_time =  $results['collect_time'];
    $sigMO = $results['sigMO'];
    $institution_No = $results['institution_No'];
    $counter_date =  $results['counter_date'];

    $counter_time =  $results['counter_time'];
    $received_by =  $results['received_by'];
    $remarks =  $results['remarks'];
    $lab_no = $results['lab_no'];

    $lab_date =  $results['lab_date'];
    $lab_received_by =  $results['lab_received_by'];
    $lab_note =  $results['lab_note'];
    $lab_sig = $results['lab_sig'];

    $report = $results['report'];
    $report_check =  $results['report_check'];
    $sentdate =  $results['sentdate'];
}

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title> Specimen Examination Results Form</title>

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
            <h4> MEDICAL RESEARCH INSTITUTE </h4>
            <h3> REQUEST FOR EXAMINATION OF SPECIMEN</h3>

        </div>
    </header>

    <div class="container">
        <hr class="newhr">
        <div class="container text-center">
            <h5> To be filled by the Medical Officer requesting Examination </h5>
        </div>
        <br>

        <div class="main-form">
            <div class="row">
                <div class="col">
                    <div class="form-group w-75">
                        <label for="serialno">Serial No: </label>
                        <input type="text" name="serialno" id="serialno" class="form-control form-control-sm  " readonly value=<?php echo $serial_no; ?>>
                    </div>

                </div>

                <div class="col">
                    <div class="form-group w-75 ">
                        <label for="bht">BHT No:</label>
                        <input type="text" name="bht" id="bht" class="form-control form-control-sm " readonly value=<?php echo $BHT_no; ?>>
                    </div>

                </div>

                <div class="col">
                    <div class="form-group w-75">
                        <label for="wardno">Ward No:</label>
                        <input type="text" name="wardno" id="wardno" class="form-control form-control-sm " readonly value=<?php echo 19; ?>>
                    </div>

                </div>

            </div>

            <div class="form-group w-25 ">
                <label for="bedno">Bed No:</label>
                <input type="text" name="bedno" id="bedno" class="form-control form-control-sm " readonly value=<?php echo $patient->getBedNo(); ?>>
            </div>

            <div class="form-group  ">
                <label for="m_e">Material and Examination requested:</label>
                <input type="text" name="m_e" id="m_e" class="form-control form-control-sm " readonly value=<?php echo $exams; ?>>
            </div>


            <div class="row">
                <div class="col">
                    <div class="form-group w-50">
                        <label for="date"> Date of collection:</label>
                        <input type="date" name="date" id="date" class="form-control form-control-sm" readonly value=<?php echo $collect_date; ?>>

                    </div>
                </div>
                <div class="col">
                    <div class="form-group w-50">
                        <label for="time"> Time:</label>
                        <input type="time" name="time" id="time" class="form-control form-control-sm" readonly value=<?php echo $collect_time; ?>>

                    </div>

                </div>
            </div>

            <br>
            <p> <b> Clinical history (a full clinical history will facilitate laboratory diagnosis) </b></p>
            <br>


            <div class="d-flex justify-content-end">
                <div class="form-group w-25 ">
                    <input type="text" name="sign" id="sign" class="form-control form-control-sm  " readonly value=<?php echo $sigMO; ?>>
                    <div class="text-center">
                        <label for="sign">Signature of Medical Officer</label>
                    </div>
                </div>
            </div>


            <div class="form-group w-50">
                <label for="address"> Address:</label>
                <textarea name="address" id="address" cols="" rows="" class="form-control form-control-sm" readonly><?php echo $patient->getAddress(); ?></textarea>
            </div>

            <div class="d-flex justify-content-end">
                <div class="form-group w-25 ">
                    <label for="date">Date</label>
                    <input type="date" name="date" id="date" class="form-control form-control-sm  " readonly value=<?php echo $date; ?>>

                </div>
            </div>

            <hr class="newhr">

            <div class="container text-center">
                <h5> To be filled in at the counter </h5>
            </div>
            <br>

            <div class="row">
                <div class="col">
                    <div class="form-group w-75">
                        <label for="insno">Institution No: </label>
                        <input type="text" name="insno" id="insno" class="form-control form-control-sm  " readonly value=<?php echo $institution_No; ?>>
                    </div>

                </div>

                <div class="col">
                    <div class="form-group ">
                        <label for="date">Date:</label>
                        <input type="date" name="date" id="date" class="form-control form-control-sm  " readonly value=<?php echo $counter_date; ?>>

                    </div>

                </div>

                <div class="col">
                    <div class="form-group ">
                        <label for="time"> Time:</label>
                        <input type="time" name="time" id="time" class="form-control form-control-sm" readonly value=<?php echo $counter_time; ?>>

                    </div>
                </div>

            </div>

            <div class="form-group w-50">
                <label for="Received">Received By:</label>
                <input type="text" name="Received" id="Received" class="form-control form-control-sm " readonly value=<?php echo $received_by; ?>>
            </div>

            <div class="form-group w-50  ">
                <label for="remark"> Remarks: </label>
                <textarea name="remark" id="remark" cols="" rows="5" class="form-control form-control-sm" readonly><?php echo $remarks; ?></textarea>
            </div>

            <br>
            <hr class="newhr">
            <br>

        </div>

    </div>

    <header>
        <div class="container text-center">
            <h4> LABORATORY USE ONLY </h4>
            <br>
        </div>
    </header>


    <div class="container">
        <form action="" class="main-form">
            <div class="row">
                <div class="col">
                    <div class="form-group ">
                        <label for="labno">Laboratory No: </label>
                        <input type="text" name="labno" id="labno" class="form-control form-control-sm  " readonly value=<?php echo $lab_no; ?>>
                    </div>

                </div>

                <div class="col">
                    <div class="form-group w-50 ">
                        <label for="date">Date:</label>
                        <input type="date" name="date" id="date" class="form-control form-control-sm " readonly value=<?php echo $lab_date; ?>>
                    </div>

                </div>

                <div class="col">
                    <div class="form-group ">
                        <label for="Received">Received By:</label>
                        <input type="text" name="Received" id="Received" class="form-control form-control-sm " readonly value=<?php echo $received_by; ?>>
                    </div>

                </div>

            </div>

        </form>
        <hr class="newhr">
    </div>

    <div class="container">

        <div class=" text-center">
            <p>
                <h5><b> LABORATORY NOTICE</b></h5>
            </p>
        </div>
        <div class="form-group">
            <textarea name="labnote" id="" cols="" rows="10" class="form-control form-control-sm" readonly><?php echo $lab_note; ?></textarea>
        </div>

        <div class="form-group w-25">
            <input type="text" name="sign" class="form-control form-control-sm " placeholder="SIGNATURE " readonly value=<?php echo $lab_sig; ?>>
        </div>
        <hr class="newhr">

    </div>

    <div class="container">
        <div class="main-form">
            <div class="form-group   ">
                <label for="repspec">Report on Specimen: </label>
                <input type="text" name="repspec" id="repspec" class="form-control form-control-sm " readonly value=<?php echo $report; ?>>
            </div>

            <hr class="newhr">

            <div class="row">
                <div class="col">
                    <div class="form-group ">
                        <label for="repcheck">Report checked by: </label>
                        <input type="text" name="repcheck" id="repcheck" class="form-control form-control-sm " readonly value=<?php echo $report_check; ?>>
                    </div>

                </div>

                <div class="col">
                    <div class="form-group ">
                        <label for="senton">Sent on: </label>
                        <input type="date" name="senton" id="senton" class="form-control form-control-sm " readonly value=<?php echo $sentdate; ?>>
                    </div>

                </div>



            </div>
            <hr class="newhr">
            <div class="printvisible">
                <button class="btn btn-outline-success mr-4" name="test" onclick="window.print();"> Print </button>
            </div>

        </div>
        <br>


    </div>


</body>

</html>