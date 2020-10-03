<?php
include '../../models/DatabaseConnection/Database.php';
include '../../classes/Patient.php';
include '../../views/home/cache.php';
include '../layouts/docmenu.php';

if (!(isset($_SESSION))){
    session_start();
    if (!(isset($_SESSION["username"]))){
        header("Location: ../../../register/login");
      return;
    }
  }
  $medical = Database::getInstance();
  
  if (isset($_SESSION["Patient"])){
      $patient =  $_SESSION["Patient"];
      $regNo = $patient->getRegNo();
  }
  
  if (isset($_POST['date'])){
      $date = $_POST['date'];
  }
  
  $results = $medical->retrieveDataByDate("microbio_table", array('test_request_date','regNo','lab_no','BHT_no',
            'specimen_test','probable_diagnosis','clinic_details','prior_antibiotic',
            'antibiotic_given','sig_MO','name_mo','designation','completed_date'),  $date, $regNo);
              if ($results) { 
        
                    $date = $results['test_request_date'];
                    $lab_no = $results['lab_no'];
                    $BHT_no =  $patient->getBedNo();
                    $specimen_test =  $results['specimen_test'];
                    $probable_diagnosis =  $results['probable_diagnosis'];
                    $clinic_details =  $results['clinic_details'];
                    $prior_antibiotic = $results['prior_antibiotic'];
                    $antibiotic_given = $results['antibiotic_given'];
                    $sig_MO =  $results['sig_MO'];
                    $name_mo =  $results['name_mo'];
                    $designation =  $results['designation'];
                    $completed_date =  $results['completed_date'];
                  
              }
?>
<!DOCTYPE html>

<html lang="en" dir="ltr">
	<head>
		<meta charset="utf-8">
        <title>Microbiology Results Form</title>
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
        <link rel = "stylesheet" href = "../../../bootstrap/css/bootstrap.min.css" integrity="" crossorigin="anonymous">
        <link rel = "stylesheet" href = "../../../css/navNsideStyles.css">
        <link rel = "stylesheet" href = "../../../css/mainStyles.css">
    </head>
	<body>
        <header>
            <div class="container text-center">
                <h4> Lady Ridgeway Hospital</h4>
                <h3> MICROBIOLOGY REQUEST FORM </h3>
            </div>
        </header>

        <div class="container">
            <table class="table table-bordered">
              
                <tbody>
                    <tr>
                        <td rowspan="2">  Date &amp; Time of <br> collection of specimen </td>
                        <td colspan="2"> <b> LAB USE ONLY </b> </td>
                        <tr>

                            <td >  
                                <div class="form-group w-50" >
                                    <label for="Date">Date of receipt</label> 
                                    <input type="date" name="date_of_recipt" id="Date" class="form-control form-control-sm"readonly  value= <?php echo $date;?>  > 
                                </div>
                            </td>
                            <td>
                                <label for="labno">Lab No.</label>
                                <input type="number" name="labno" id="labno" class="form-control form-control-sm"readonly  value= <?php echo $lab_no;?>  >
                                
                            </td>
                        </tr>
                    </tr>
                  

                </tbody>


            </table>



            <form action="" class="main-form">
                <div class="form-group ">
                    <label for="name"> Name:</label>
                    <input type="text" name="name" id="name" class="form-control form-control-sm"readonly  value= <?php echo $patient->getName();?>  >

                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group w-25">
                            
                            <label for="age"> Age:</label>
                            <input type="text" name="age" id="age" class="form-control form-control-sm "readonly  value= <?php echo $patient->getAge();?>  >
                        
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group w-25">
                            <label for="sex">  Sex:</label>
                            <select name="sex" id="sex" class="form-control form-control-sm" disabled ="true">
                                <option ><?php echo $patient->getGender() ?></option>
                        </select>
        
                        </div> 

                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <div class="form-group w-50">
                            <label for="ward"> Ward:</label>
                            <input type="text" name="ward" id="ward" class="form-control form-control-sm"readonly  value= <?php echo 19;?>  >
        
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group w-50">
                            <label for="clinic">  BHT No./ Clinic NO.:</label>
                            <input type="text" name="clinic" id="clinic" class="form-control form-control-sm "readonly  value= <?php echo $BHT_no;?>  >
        
                        </div> 

                    </div>
                </div>

                <div class="form-group">
                    <label for="test"> Specimen &amp; Test:</label>
                    <input type="text" name="test" id="test" class="form-control form-control-sm"readonly  value= <?php echo $specimen_test;?>  >

                </div>

                <div class="form-group">
                    <label for="diagnosis"> Probable diagnosis:</label>
                    <input type="text" name="diagnosis" id="diagnosis" class="form-control form-control-sm "readonly  value= <?php echo $patient->getDiagnosis();?>  >

                </div>

                <div class="form-group">
                    <label for="clinic_detail"> Relevant clinical detail:</label>
                    <textarea name="clinic_detail" id="clinic_detail" cols="30" rows="5" class="form-control form-control-sm"readonly> <?php echo $clinic_details;?></textarea>    

                </div>

                <div class="form-group w-25">
                    <label for="prior-anti">  Antibiotic given prior to culture:</label>
                    <select name="prior-anti" id="prior-anti" class="form-control form-control-sm" disabled ="true">
                                <option ><?php echo $prior_antibiotic; ?></option>
                    </select>

                </div> 





                <div class="form-group">
                    <label for="antibiotic"> Antibiotic given/ to be given:</label>
                    <textarea name="antibiotic" id="antibiotic" cols="30" rows="5" class="form-control form-control-sm" readonly> <?php echo $antibiotic_given;?></textarea>    

                </div>


            </form>

            <div class="card border-secondary">
                <div class="card-body">
                    
                    <div class="form-group w-50">
                        <label for="name"> Signature of Medical Officer:</label>
                        <input type="text" name="name" id="name" class="form-control form-control-sm"readonly  value= <?php echo $sig_MO;?>  >
    
                    </div>

                    <div class="form-group w-50">
                        <label for="name"> Name:</label>
                        <input type="text" name="name" id="name" class="form-control form-control-sm"readonly  value= <?php echo $name_mo;?>  >
    
                    </div>

                    <div class="form-group w-25">
                        <label for="designation">  Designation:</label>
                        <select name="designation" id="designation" class="form-control form-control-sm" disabled ="true">
                                <option ><?php echo $designation; ?></option>
                        </select>
    
                    </div> 
                
                    

                </div>
              </div>
              <hr class="newhr">
            <div class = "printvisible">
                  <button class="btn btn-outline-success mr-4"  name = "test" onclick="window.print();"> Print </button>
            </div>

            
        </div>
        <br>
        


       

		
	</body>
</html>