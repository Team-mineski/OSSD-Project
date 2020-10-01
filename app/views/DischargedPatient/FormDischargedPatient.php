
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel = "stylesheet" href = "../../../bootstrap/css/bootstrap.min.css" integrity="" crossorigin="anonymous">

    <link rel = "stylesheet" href = "../../../css/mainStyles.css">
    <title></title>
  </head>
  <body >
  <div class = containor  style="margin-left:35px; margin-right:35px;">

    <form action ="" method = "">

        <div class="form-row">

          <div class="col-md-3 mb-3 col-md-offset-4 mr-3">
              <label for="regNo">Registration Number</label>
              <input type="text" class="form-control" id="regNo" name="regNo" placeholder="Registration Number" value='<?php echo $patient->getRegNo();?>' readonly>          
          </div>
          
        </div>
        
        <div class="form-row">

          <div class="col-md-6 mb-3 col-md-offset-2">
            <label for="name">Full Name</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Full Name" value='<?php echo  $patient->getName();?>' readonly>
          </div>

          <div class="ml-5">
            <div class="col-md-7 mb-3 col-md-offset-4 mr-3">
                <label for="age">Age</label>
                <input type="text" class="form-control" id="age" name="age" placeholder="Age" value='<?php echo  $patient->getAge();?>' readonly>          
            </div>
          </div>
          
        </div>

        <div class="form-row">

          <div class="col-md-6 mb-3 col-md-offset-4">
              <label for="diagnosis">Diagnosis</label>
              <input type="text" class="form-control" id="diagnosis" name="diagnosis" placeholder="Diagnosis" value='<?php echo $patient->getDiagnosis();?>' readonly>          
          </div>
          
        </div>

        <div class="form-row">

          <div class="col-md-6 mb-3 col-md-offset-4">
              <label for="address">Full Address</label>
              <input type="text" class="form-control" id="address" name="address" placeholder="Full Address" value='<?php echo$patient->getAddress();?>' readonly>          
          </div>

          <div class="ml-5">
          <div class="col-md-10 mb-3 col-md-offset-4">
              <label for="address">Contact No.</label>
              <input type="text" class="form-control" id="contact" name="contact" placeholder="Contact Number"  value='<?php echo $patient->getContact();?>' readonly>          
          </div>
          </div>
          
        </div>

        <div class="form-row">
          <div class="col-md-2 mb-3 col-md-offset-4">
              <label for="dob">Date of Birth</label>
              <input type="date" class="form-control" id="dob" name="dob" value='<?php echo $patient->getDOB();?>' readonly>          
          </div>
          <div class="col-md-2 mb-3 col-md-offset-4">
              <label for="gender">Gender</label>
              <input type="text" class="form-control" id="gender" name="gender" value='<?php echo $patient->getGender();?>' readonly>          
        </div>

          <div class="col-md-2 mb-3 col-md-offset-4">
              <label for="gender">Admission Status</label>
              <input type="text" class="form-control" id="admission" name="admission" value='<?php echo $patient->getAdmissionStatus();?>' readonly>          
          
          </div>
          <?php 
          $bedNo=$patient->getBedNo();
          if ($bedNo!=''){
            echo "<div class=\"col-md-2 mb-3 col-md-offset-4\">
            <label for=\"gender\">Bed Number</label>
            <input type=\"text\" class=\"form-control\" id=\"bedNo\" name=\"bedNo\" value='$bedNo' readonly>          
        
        </div>";
          }
          ?>
        </div>
        <br>
        <button type="button" class="btn btn-primary mr-4" onclick="window.location.href = '../../../';">Return to Main Menu</button>
        <!--
        <div class="form-row">
          <button type="button" class="btn btn-primary mr-4" onclick="window.location.href = 'DischargedPatientHistory.php';">History</button>
          <button type="button" class="btn btn-primary mr-4" onclick="window.location.href = 'DischargedPatientTestResults.php';">Test Results</button>
          

          </div>
          -->