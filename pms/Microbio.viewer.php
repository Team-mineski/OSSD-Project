<?php
include "../app/views/layouts/labmenu.php";
include_once "Patient.class.php";
session_start();
if (!(isset($_SESSION["username"]))){
    header("Location: ../register/login");
    return;
  }
$patient = unserialize($_SESSION['patient']);
$test_date=$_SESSION['request_date'];



 ?>
<html lang="en" dir="ltr">
	<head>
		<meta charset="utf-8">
        <title>microbiology request</title>
        <link rel = "stylesheet" href = "../bootstrap/css/bootstrap.min.css" integrity="" crossorigin="anonymous">
         <link rel="stylesheet" href="../style.css">
       <link rel="stylesheet" href="../css/labReportStyles.css">
    </head>
	<body>
        <header>
            <div class="container text-center">
                <h3 class="mainHeading"> MICROBIOLOGY REQUEST FORM </h3>
            </div>
        </header>
      <form action="Microbio.control.php" method="POST">
        <div class="container">
            <table class="table table-bordered">

                <tbody>
                    <tr>
                        <td rowspan="2">  Date &amp; Time of <br> collection of specimen </td>
                        <td colspan="2" class ="optionText"> <b> LAB USE ONLY </b> </td>
                        <tr>

                            <td >
                                <div class="form-group w-75" >
                                    <label for="Date">Date of receipt</label>
                                    <input type="date" name="date_of_receipt" id="Date" class="form-control form-control-sm">
                                </div>
                            </td>
                            <td>

                                <label for="labno">Lab No.</label>
                                <input type="number" name="labno" id="labno" class="form-control form-control-sm">

                            </td>
                        </tr>
                    </tr>


                </tbody>


            </table>


                <div class="form-group w-50 ">
                    <label for="name"> Name:</label>
                    <input type="text" name="name" id="name" class="form-control form-control-sm" value= <?php  echo $patient->getName(); ?> readonly >

                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group w-25">

                            <label for="age"> Age:</label>
                            <input type="text" name="age" id="age" class="form-control form-control-sm " selected value= <?php  echo $patient->getAge(); ?> readonly >

                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group w-25">
                            <label for="sex">  Sex:</label>
                            <select name="gender" id="sex" class="form-control form-control-sm" value= <?php  echo $patient->getGender(); ?> disabled = "true" >
                                <option value="Male"> <?php  echo $patient->getGender(); ?></option>

                            </select>

                        </div>

                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <div class="form-group w-50">
                            <label for="ward"> Ward:</label>
                            <input type="text" name="ward" id="ward" class="form-control form-control-sm" value = 19 readonly>

                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group w-50">
                            <label for="clinic">  BHT No./ Clinic NO.:</label>
                            <input type="text" name="clinicno" id="clinic" class="form-control form-control-sm "readonly value= <?php  echo $patient->getBedNo(); ?>  >

                        </div>

                    </div>
                </div>

                <div class="form-group">
                    <label for="test"> Specimen &amp; Test:</label>
                    <input type="text" name="test" id="test" class="form-control form-control-sm">

                </div>

                <div class="form-group">
                    <label for="diagnosis"> Probable diagnosis:</label>
                    <input type="text" name="diagnosis" id="diagnosis" class="form-control form-control-sm "readonly value= <?php  echo $patient->getDiagnosis(); ?>  >

                </div>

                <div class="form-group">
                    <label for="clinic_detail"> Relevant clinical detail:</label>
                    <textarea name="clinic_detail" id="clinic_detail" cols="30" rows="5" class="form-control form-control-sm"></textarea>

                </div>

                <div class="form-group w-25">
                    <label for="prior-anti">  Antibiotic given prior to culture:</label>
                    <select name="prior-anti" id="prior-anti" class="form-control form-control-sm boxstyles">
                        <option value="YES"> Yes</option>
                        <option value="NO"> No</option>
                    </select>

                </div>


                <div class="form-group">
                    <label for="antibiotic"> Antibiotic given/ to be given:</label>
                    <textarea name="antibiotic" id="antibiotic" cols="30" rows="5" class="form-control form-control-sm"></textarea>

                </div>



              <hr class="newhr">
              <br>
              <br>
              <div class="form-group w-50">
                        <label for="sigmo"> Signature of Medical Officer:</label>
                        <input type="text" name="sigmo" id="sigmo" class="form-control form-control-sm">

              </div>

              <div class="form-group w-50">
                        <label for="namemo"> Name:</label>
                        <input type="text" name="namemo" id="namemo" class="form-control form-control-sm">

              </div>

              <div class="form-group w-25 ">
                        <label for="designtion">  Designation:</label>
                        <select name="designation" id="designation" class="form-control form-control-sm boxstyles">
                            <option value="HO"> HO</option>
                            <option value="MO"> MO</option>
                            <option value="SHO"> SHO</option>
                            <option value="REG"> REG</option>
                            <option value="SR"> SR</option>
                        </select>

              </div>

              <input type="submit" name="submitform" class="btn btn-info" value="Submit">
        </div>
        <br>


      </form>

	</body>
</html>
