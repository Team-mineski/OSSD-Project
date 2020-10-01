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

$results = $medical->retrieveDataByDate("biochemical_table",array('regNo','test_request_date', 'lab_ref_no','bht_no','fasting_status',
            'clinical_history', 'serum','plasma_glu','csf','officer', 'date_request','date_filled','time_filled','nursing_officer',
            'date_lab_rec', 'time_lab_rec','last)_check'), $date, $regNo);
            if ($results) { 
              
                  $lab_ref_no = $results['lab_ref_no'];
                  $bht_no = $results['bht_no'];
                  $fasting_status =  $results['fasting_status'];
                  $clinical_history =  $results['clinical_history'];
                  $serum =  explode( ',', $results['serum'] );
                  $plasma_glu =  explode( ',',$results['plasma_glu']);
                  $csf = explode( ',',$results['csf'] );
                  $officer = $results['officer'];
                  $date_filled =  $results['date_filled'];
                  $time_filled = $results['time_filled'];
                  $nursing_officer = $results['nursing_officer'];
                  $date_lab_rec =  $results['date_lab_rec'];
                  $time_lab_rec =  $results['time_lab_rec'];
                  $last_check = explode( ',', $results['last_check'] );
                
            }
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
	<head>
		<meta charset="utf-8">
        <title> Biochemical</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" 
            integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" 
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" 
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" 
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        <link rel = "stylesheet" href = "../../../css/navNsideStyles.css">
    <link rel = "stylesheet" href = "../../../css/mainStyles.css">
	</head>
	<body>
        <header>


            <div class="container text-center">
                <div class=" form group row">
                    <div class="col-8">
                        <h4> LADY RIDGEWAY HOSPITAL - COLOMBO 08</h4>
                        <h4> DEPARTMENT OF CHEMICAL PATHOLOGY</h4>
                        <h5> <u> Request Form for Biochemical Investigations</u></h5>

                    </div>
                    <div class="col-4">
                        <div class="form-group w-50">
                            <label for="ref"> Lab Reference No.</label> 
                            <input type="text" name="refnum" id="ref" class="form-control "value = '<?php echo $lab_ref_no;?>' readonly>
                        </div>

                    </div>
                </div>
            </div>            

        </header>

        <div class="container">
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td>
                            <div class="form-group ">
                                <label for="name"> Name :</label>
                                <input type="text" name="name" id="name"  class="form-control form-control-sm" value = '<?php echo $patient->getRegNo();?>' readonly>
            
                            </div>

                            <div class="form-group w-25">
                            
                                <label for="age"> Age :</label>
                                <input type="number" name="age" id="age" class="form-control form-control-sm " value = '<?php echo $patient->getAge();?>' readonly>
                            
                            </div>

                            <div class="form-group w-25">
                                <label for="sex">  Gender :</label>
                                <input type="text" name="gender" id="gender" class="form-control form-control-sm " value = '<?php echo $patient->getGender();?>' readonly>
            
                            </div> 

                            <div class="form-group w-50" >
                                <label for="Dob">Date of Birth :</label> 
                                <input type="date" name="dob" id="Dob" class="form-control form-control-sm" value = '<?php echo $patient->getDOB();?>' readonly>
                            </div>                            

                        </td>

                        <td>
                            <div class="form-group w-50 ">
                                <label for="BHT"> BHT/Clinic No. :</label>
                                <input type="text" name="BHT" id="BHT" class="form-control form-control-sm"  readonly value = '<?php echo $bht_no;?>'>
                            </div>

                            <div class="form-group w-50">
                                <label for="ward"> Ward/Clinic :</label>
                                <input type="text" name="ward" id="ward" class="form-control form-control-sm" value = <?php echo 19;?> readonly>
            
                            </div>

                            <div class="form-group w-50">
                                <label for="teleno"> Tel. No. of Patient  :</label>
                                <input type="tel" name="teleno" id="teleno" class="form-control form-control-sm"value = '<?php echo $patient->getContact();?>' readonly>
            
                            </div>
                        </td>
                    </tr>
                </tbody>


            </table>
            
            <p><b>Fasting Status :</b></p>

            <div class="custom-control custom-checkbox custom-control-inline">
                <input type="checkbox" class="custom-control-input" id="inlineCheckbox1" name="inlineCheckbox1" onclick="return false" <?php echo ($fasting_status== 'lessFour') ?  "checked" : "" ;?> >
                <label class="custom-control-label" for="inlineCheckbox1"> &lt; 4 Hrs </label>
    
            </div>

            <div class="custom-control custom-checkbox custom-control-inline">
                <input type="checkbox" class="custom-control-input" id="inlineCheckbox2" name="inlineCheckbox1"onclick="return false" <?php echo ($fasting_status== 'Four') ?  "checked" : "" ;?> >
                <label class="custom-control-label" for="inlineCheckbox2"> 4 Hrs </label>
    
            </div>
            <div class="custom-control custom-checkbox custom-control-inline">
                <input type="checkbox" class="custom-control-input" id="inlineCheckbox3" name="inlineCheckbox1"onclick="return false" <?php echo ($fasting_status== 'Six') ?  "checked" : "" ;?> >
                <label class="custom-control-label" for="inlineCheckbox3"> 6 Hrs </label>
    
            </div>
            <div class="custom-control custom-checkbox custom-control-inline">
                <input type="checkbox" class="custom-control-input" id="inlineCheckbox4" name="inlineCheckbox1"onclick="return false" <?php echo ($fasting_status== 'EightToTen') ?  "checked" : "" ;?> >
                <label class="custom-control-label" for="inlineCheckbox4"> 8 - 10 Hrs </label>
    
            </div>

            <div class="custom-control custom-checkbox custom-control-inline">
                <input type="checkbox" class="custom-control-input" id="inlineCheckbox5" name="inlineCheckbox1" onclick="return false" <?php echo ($fasting_status== 'TenToTwelve') ?  "checked" : "" ;?> >
                <label class="custom-control-label" for="inlineCheckbox5"> 10 - 12 Hrs </label>
    
            </div>

            


           <p></p>

            <div class="form-group " >
                <label for="address" > Relevant clinical history and diagnosis :</label> 
                <textarea name="address" id="address" cols="" rows="2" class="form-control form-control-sm" readonly><?php echo $clinical_history;?> </textarea>
            </div>

            <hr class="newhr"> 

            <p><b>Please send in separate request forms for Serum, Plasma(Glucose) and CSF </b></p>

        </div>

        <div class="container ">
        
            <div class=" row ">
                <div class=" col text-left">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="customCheck1" name="Serum[]" value="Calcium" onclick="return false" <?php echo in_array("Calcium", $serum  , TRUE) ?  "checked" : "" ;?> >
                        <label class="custom-control-label" for="customCheck1"> Calcium </label>
                    </div>

                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="customCheck2" name="Serum[]" value="Phosphate"onclick="return false" <?php echo in_array("Phosphate", $serum  , TRUE) ?  "checked" : "" ;?> >
                        <label class="custom-control-label" for="customCheck2"> Phosphate </label>
                    </div>

                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="customCheck3" name="Serum[]" value="ALP"onclick="return false" <?php echo in_array("ALP", $serum  , TRUE) ?  "checked" : "" ;?> >
                        <label class="custom-control-label" for="customCheck3"> ALP </label>
                    </div>

                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="customCheck4" name="Serum[]" value="Total Protein"onclick="return false" <?php echo in_array("Total Protein", $serum  , TRUE) ?  "checked" : "" ;?> >
                        <label class="custom-control-label" for="customCheck4"> Total Protein </label>
                    </div>

                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="customCheck5" name="Serum[]" value="Albumin"onclick="return false" <?php echo in_array("Albumin", $serum  , TRUE) ?  "checked" : "" ;?> >
                        <label class="custom-control-label" for="customCheck5"> Albumin </label>
                    </div>

                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="customCheck6" name="Serum[]" value="Uric Acid"onclick="return false" <?php echo in_array("Uric Acid", $serum  , TRUE) ?  "checked" : "" ;?> >
                        <label class="custom-control-label" for="customCheck6"> Uric Acid </label>
                    </div>

                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="customCheck7" name="Serum[]" value="AST"onclick="return false" <?php echo in_array("AST", $serum  , TRUE) ?  "checked" : "" ;?> >
                        <label class="custom-control-label" for="customCheck7"> AST </label>
                    </div>

                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="customCheck8" name="Serum[]" value="ALT"onclick="return false" <?php echo in_array("ALT", $serum  , TRUE) ?  "checked" : "" ;?> >
                        <label class="custom-control-label" for="customCheck8"> ALT </label>
                    </div>

                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="customCheck9" name="Serum[]" value="Total Bilirubin"onclick="return false" <?php echo in_array("Total Bilirubin", $serum  , TRUE) ?  "checked" : "" ;?> >
                        <label class="custom-control-label" for="customCheck9"> Total Bilirubin </label>
                    </div>

                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="customCheck10" name="Serum[]" value="Direct Bilirubin"onclick="return false" <?php echo in_array("Direct Bilirubin", $serum  , TRUE) ?  "checked" : "" ;?> >
                        <label class="custom-control-label" for="customCheck10"> Direct Bilirubin </label>
                    </div>

                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="customCheck11" name="Serum[]" value="GGT"onclick="return false" <?php echo in_array("GGT", $serum  , TRUE) ?  "checked" : "" ;?> >
                        <label class="custom-control-label" for="customCheck11"> GGT</label>
                    </div>

                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="customCheck12" name="Serum[]" value="LDH"onclick="return false" <?php echo in_array("LDH", $serum  , TRUE) ?  "checked" : "" ;?> >
                        <label class="custom-control-label" for="customCheck12">LDH</label>
                    </div>

                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="customCheck13" name="Serum[]" value="Creatine Kinase"onclick="return false" <?php echo in_array("Creatine Kinase", $serum  , TRUE) ?  "checked" : "" ;?> >
                        <label class="custom-control-label" for="customCheck13"> Creatine Kinase</label>
                    </div>

                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="customCheck14" name="Serum[]" value="CRP"onclick="return false" <?php echo in_array("CRP", $serum  , TRUE) ?  "checked" : "" ;?> >
                        <label class="custom-control-label" for="customCheck14">  CRP </label>
                    </div>

                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="customCheck15" name="Serum[]" value="Amylase"onclick="return false" <?php echo in_array("Amylase", $serum  , TRUE) ?  "checked" : "" ;?> >
                        <label class="custom-control-label" for="customCheck15"> Amylase</label>
                    </div>

                    <div class=" custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="customCheck16" name="Serum[]" value="Ceruloplasmin"onclick="return false" <?php echo in_array("Ceruloplasmin", $serum  , TRUE) ?  "checked" : "" ;?> >
                        <label class="custom-control-label" for="customCheck16">  Ceruloplasmin </label>
                    </div>

                   
                </div>
            
            

                <div class="col text-left">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="customCheck17" name="Serum[]" value="Urea"onclick="return false" <?php echo in_array("Urea", $serum  , TRUE) ?  "checked" : "" ;?> >
                        <label class="custom-control-label" for="customCheck17"> Urea </label>
                    </div>

                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="customCheck18" name="Serum[]" value="Creatinine"onclick="return false" <?php echo in_array("Creatinine", $serum  , TRUE) ?  "checked" : "" ;?> >
                        <label class="custom-control-label" for="customCheck18"> Creatinine </label>
                    </div>

                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="customCheck19" name="Serum[]" value="Sodium"onclick="return false" <?php echo in_array("Sodium", $serum  , TRUE) ?  "checked" : "" ;?> >
                        <label class="custom-control-label" for="customCheck19"> Sodium </label>
                    </div>

                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="customCheck20" name="Serum[]" value="Potassium"onclick="return false" <?php echo in_array("Potassium", $serum  , TRUE) ?  "checked" : "" ;?> >
                        <label class="custom-control-label" for="customCheck20"> Pottasium </label>
                    </div>

                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="customCheck21" name="Serum[]" value="Chloride"onclick="return false" <?php echo in_array("Chloride", $serum  , TRUE) ?  "checked" : "" ;?> >
                        <label class="custom-control-label" for="customCheck21"> Chloride </label>
                    </div>

                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="customCheck22" name="Serum[]" value="Magnesium"onclick="return false" <?php echo in_array("Magnesium", $serum  , TRUE) ?  "checked" : "" ;?> >
                        <label class="custom-control-label" for="customCheck6"> Magnesium </label>
                    </div>

                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="customCheck23" name="Serum[]" value="Osmolality"onclick="return false" <?php echo in_array("Osmolality", $serum  , TRUE) ?  "checked" : "" ;?> >
                        <label class="custom-control-label" for="customCheck23"> Osmolality </label>
                    </div>

                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="customCheck24" name="Serum[]" value="Cholesterol"onclick="return false" <?php echo in_array("Cholesterol", $serum  , TRUE) ?  "checked" : "" ;?> >
                        <label class="custom-control-label" for="customCheck24"> Cholesterol </label>
                    </div>

                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="customCheck25" name="Serum[]" value="Triglyceride"onclick="return false" <?php echo in_array("Triglyceride", $serum  , TRUE) ?  "checked" : "" ;?> >
                        <label class="custom-control-label" for="customCheck25"> Triglyceride </label>
                    </div>

                    <b> Plasma Glucose</b>

                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="customCheck26" name="Plasma[]" value="Random"onclick="return false" <?php echo in_array("Random", $plasma_glu  , TRUE) ?  "checked" : "" ;?> >
                        <label class="custom-control-label" for="customCheck26"> Random</label>
                    </div>

                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="customCheck27" name="Plasma[]" value="Fasting"onclick="return false" <?php echo in_array("Fasting", $plasma_glu  , TRUE) ?  "checked" : "" ;?> >
                        <label class="custom-control-label" for="customCheck27"> Fasting</label>
                    </div>

                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="customCheck28" name="Plasma[]" value="Post Prandial/2Hrs after glucose load"onclick="return false" <?php echo in_array("Post Prandial/2Hrs after glucose load", $plasma_glu  , TRUE) ?  "checked" : "" ;?> >
                        <label class="custom-control-label" for="customCheck28"> Post Prandial/2Hrs after glucose load</label>
                    </div>

                    <b>CSF</b>

                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="customCheck29" name="CSF[]" value="Glucose"onclick="return false" <?php echo in_array("Glucose", $csf  , TRUE) ?  "checked" : "" ;?> >
                        <label class="custom-control-label" for="customCheck29"> Glucose</label>
                    </div>

                    <div class=" custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="customCheck30" name="CSF[]" value="Protein"onclick="return false" <?php echo in_array("Protein", $csf  , TRUE) ?  "checked" : "" ;?> >
                        <label class="custom-control-label" for="customCheck30">  Protein</label>
                    </div>

                </div>
                

            </div>

            <br>
            <hr class="newhr">
        </div>

        <div class="container">
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td>
                           <b> Name and Designation of the requesting medical</b>

                            <div class="form-group ">
                            
                                <label for="offname"> Officer :</label>
                                <input type="text" name="offname" id="offname" class="form-control form-control-sm "value = '<?php echo $officer;?>' readonly>
                            
                            </div>


                            <div class="form-group w-25" >
                                <label for="Date">Date :</label> 
                                <input type="date" name="Date" id="Date" class="form-control form-control-sm" value = '<?php echo $date;?>' readonly>
                            </div>                            

                        </td>

                        <td>
                            <b>To be filled by the Nursing Officer</b>

                            <div class="form-group w-50" >
                                <label for="Date2">Date :</label> 
                                <input type="date" name="Date2" id="Date2" class="form-control form-control-sm"value = '<?php echo $date_filled;?>' readonly>
                            </div> 

                            <div class="form-group w-50">
                                <label for="time1"> Time :</label>
                                <input type="time" name="time1" id="time1" class="form-control form-control-sm"value = '<?php echo $time_filled;?>' readonly>
            
                            </div>

                            <div class="form-group ">
                            
                                <label for="offname2"> Name :</label>
                                <input type="text" name="offname2" id="offname2" class="form-control form-control-sm "value = '<?php echo $officer;?>' readonly>
                            
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
  
        </div>

        <div class="container">
            <hr class="newhr">
            <b>To be filled at the laboratory reception.</b>
            <br>

            <p> Date and Time of sample receipt :</p>
            <div class="row text-left ">
                <div class="col ">
                    <div class="form-group w-50">
                        <input type="date" class="form-control" name="datefinal" value = '<?php echo $date_lab_rec;?>' readonly>
                    </div>
                </div>

                <div class="col ">
                    <div class="form-group w-50 ">
                        <input type="time" class="form-control" name="timefinal" value = '<?php echo $time_lab_rec;?>' readonly>
                    </div>
                </div>

            </div>
            <br>

            <div class="custom-control custom-checkbox custom-control-inline">
                <input type="checkbox" class="custom-control-input" id="inlineCheckbox10" name="last_checkbox[]" value="Lipaemic" onclick="return false" <?php echo in_array("Lipaemic", $last_check  , TRUE) ?  "checked" : "" ;?> >
                <label class="custom-control-label" for="inlineCheckbox10"> <b> Lipaemic</b> </label>
    
            </div>

            <div class="custom-control custom-checkbox custom-control-inline">
                <input type="checkbox" class="custom-control-input" id="inlineCheckbox11" name="last_checkbox[]" value="Haemolyzed" onclick="return false" <?php echo in_array("Haemolyzed", $last_check  , TRUE) ?  "checked" : "" ;?> >
                <label class="custom-control-label" for="inlineCheckbox11"> <b>Haemolyzed</b>  </label>
    
            </div>
            <div class="custom-control custom-checkbox custom-control-inline">
                <input type="checkbox" class="custom-control-input" id="inlineCheckbox12" name="last_checkbox[]" value="Lcteric" onclick="return false" <?php echo in_array("Lcteric", $last_check  , TRUE) ?  "checked" : "" ;?> >
                <label class="custom-control-label" for="inlineCheckbox12"> <b>Lcteric</b>  </label>
    
            </div>
            <div class="custom-control custom-checkbox custom-control-inline">
                <input type="checkbox" class="custom-control-input" id="inlineCheckbox13" name="last_checkbox[]" value="Insufficient" onclick="return false" <?php echo in_array("Insufficient", $last_check  , TRUE) ?  "checked" : "" ;?> >
                <label class="custom-control-label" for="inlineCheckbox13"> <b>Insufficient</b>  </label>
    
            </div>

            <div class="custom-control custom-checkbox custom-control-inline">
                <input type="checkbox" class="custom-control-input" id="inlineCheckbox14" name="last_checkbox[]" value="Clotted" onclick="return false" <?php echo in_array("Clotted", $last_check  , TRUE) ?  "checked" : "" ;?> >
                <label class="custom-control-label" for="inlineCheckbox14"> <b>Clotted</b>  </label>
    
            </div>
            <br>
            <br>
            <footer>
                <p><b> Please folllow the instructions provided to your unit. For further
                    information and clarifications please contact Department of Chemical Pathology.
                    011-2693711 Ext.:314
                </b></p>
            </footer>

        </div>
        </form >

        


	</body>
</html>
