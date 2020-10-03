<?php
include "../app/views/layouts/labmenu.php";
include_once 'Patient.class.php';
session_start();

if ((!(isset($_SESSION["username"])))||($_SESSION["type"]!="biochemical_lab"))
    {
        header("Location: ../restricted/index");
        return;
    }

$patient = unserialize($_SESSION['patient']);
$test_date=$_SESSION['request_date'];
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
	<head>
		<meta charset="utf-8">
        <title> Biochemical Investigations Request Form</title>
        <link rel = "stylesheet" href = "../bootstrap/css/bootstrap.min.css" integrity="" crossorigin="anonymous">
        <!-- <link rel="stylesheet" href="../css/styles.css"> -->
       <link rel="stylesheet" href="../css/labReportStyles.css">
	</head>
	<body>
        <header>
        <form action="BiochemicalSubmit.controller.php" method="post">
            <div class="container text-center">
                <div class=" form group row">
                
                    <div class="col-8">
                        <h4 class="mainHeading"> DEPARTMENT OF CHEMICAL PATHOLOGY</h4>
                        <h5 class="mainHeading">  Request Form for Biochemical Investigations</h5>

                    </div>
                    
                    <div class="col-4">
                        <div class="form-group w-50">
                            <label for="ref"> Lab Reference No.</label> 
                            <input type="text" name="refnum" id="ref" class="form-control" required>
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
                                <input type="text" name="name" id="name" class="form-control form-control-sm" value='<?php echo $patient->getName();?>' readonly>
            
                            </div>

                            <div class="form-group w-25">
                            
                                <label for="age"> Age :</label>
                                <input type="text" name="age" id="age" class="form-control form-control-sm " value="<?php echo $patient->getAge();?>" readonly>
                            
                            </div>

                            <div class="form-group w-25">
                                <label for="sex">  Gender :</label>
                                <select name="sex" id="sex" class="form-control form-control-sm" disabled=true>
                                    <option value=<?php echo $patient->getGender();?>> <?php echo $patient->getGender();?></option>
                                </select>
            
                            </div> 

                            <div class="form-group w-50" >
                                <label for="Dob">Date of Birth :</label> 
                                <input type="date" name="dob" id="Dob" class="form-control form-control-sm" value="<?php echo $patient->getDOB();?>" readonly >
                            </div>                            

                        </td>

                        <td>
                            <div class="form-group w-50 ">
                                <label for="BHT"> BHT/Clinic No. :</label>
                                <input type="text" name="BHT" id="BHT" class="form-control form-control-sm"  readonly value =" <?php echo $patient->getBedNo(); ?>">
            
                            </div>

                            <div class="form-group w-50">
                                <label for="ward"> Ward/Clinic :</label>
                                <input type="text" name="ward" id="ward" class="form-control form-control-sm" value="19" readonly>
            
                            </div>

                            <div class="form-group w-50">
                                <label for="teleno"> Telephone No. of Patient  :</label>
                                <input type="text" name="teleno" id="teleno" class="form-control form-control-sm"  value="<?php echo $patient->getContact();?>" readonly >
            
                            </div>
                        </td>
                    </tr>
                </tbody>


            </table>
            
            <p class="optionText">Fasting Status :</p>

            <div class="custom-control custom-checkbox custom-control-inline">
                <input type="radio" class="custom-control-input" id="inlineCheckbox1" name="inlineCheckbox1" value="lessFour">
                <label class="custom-control-label" for="inlineCheckbox1"> &lt; 4 Hrs </label>
    
            </div>

            <div class="custom-control custom-checkbox custom-control-inline">
                <input type="radio" class="custom-control-input" id="inlineCheckbox2" name="inlineCheckbox1" value="Four">
                <label class="custom-control-label" for="inlineCheckbox2"> 4 Hrs </label>
    
            </div>
            <div class="custom-control custom-checkbox custom-control-inline">
                <input type="radio" class="custom-control-input" id="inlineCheckbox3" name="inlineCheckbox1" value="Six">
                <label class="custom-control-label" for="inlineCheckbox3"> 6 Hrs </label>
    
            </div>
            <div class="custom-control custom-checkbox custom-control-inline">
                <input type="radio" class="custom-control-input" id="inlineCheckbox4" name="inlineCheckbox1" value="EightToTen">
                <label class="custom-control-label" for="inlineCheckbox4"> 8 - 10 Hrs </label>
    
            </div>

            <div class="custom-control custom-checkbox custom-control-inline">
                <input type="radio" class="custom-control-input" id="inlineCheckbox5" name="inlineCheckbox1" value="TenToTwelve">
                <label class="custom-control-label" for="inlineCheckbox5"> 10 - 12 Hrs </label>
    
            </div>

            


           <p></p>

            <div class="form-group " >
                <label for="address" > Relevant clinical history and diagnosis :</label> 
                <textarea  id="address" cols="" rows="2" class="form-control form-control-sm" name="clinical_history"><?php echo $patient->getDiagnosis();?></textarea>
            </div>

            <hr class="newhr"> 

            <p class="optionText"><b>Please send in separate request forms for Serum, Plasma(Glucose) and CSF </b></p>

        </div>

        <div class="container ">
        
            <div class=" row ">
                <div class=" col text-left">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="customCheck1" name="Serum[]" value="Calcium">
                        <label class="custom-control-label" for="customCheck1"> Calcium </label>
                    </div>

                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="customCheck2" name="Serum[]" value="Phosphate">
                        <label class="custom-control-label" for="customCheck2"> Phosphate </label>
                    </div>

                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="customCheck3" name="Serum[]" value="ALP">
                        <label class="custom-control-label" for="customCheck3"> ALP </label>
                    </div>

                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="customCheck4" name="Serum[]" value="Total Protein">
                        <label class="custom-control-label" for="customCheck4"> Total Protein </label>
                    </div>

                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="customCheck5" name="Serum[]" value="Albumin">
                        <label class="custom-control-label" for="customCheck5"> Albumin </label>
                    </div>

                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="customCheck6" name="Serum[]" value="Uric Acid">
                        <label class="custom-control-label" for="customCheck6"> Uric Acid </label>
                    </div>

                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="customCheck7" name="Serum[]" value="AST">
                        <label class="custom-control-label" for="customCheck7"> AST </label>
                    </div>

                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="customCheck8" name="Serum[]" value="ALT">
                        <label class="custom-control-label" for="customCheck8"> ALT </label>
                    </div>

                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="customCheck9" name="Serum[]" value="Total Bilirubin">
                        <label class="custom-control-label" for="customCheck9"> Total Bilirubin </label>
                    </div>

                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="customCheck10" name="Serum[]" value="Direct Bilirubin">
                        <label class="custom-control-label" for="customCheck10"> Direct Bilirubin </label>
                    </div>

                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="customCheck11" name="Serum[]" value="GGT">
                        <label class="custom-control-label" for="customCheck11"> GGT</label>
                    </div>

                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="customCheck12" name="Serum[]" value="LDH">
                        <label class="custom-control-label" for="customCheck12">LDH</label>
                    </div>

                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="customCheck13" name="Serum[]" value="Creatine Kinase">
                        <label class="custom-control-label" for="customCheck13"> Creatine Kinase</label>
                    </div>

                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="customCheck14" name="Serum[]" value="CRP">
                        <label class="custom-control-label" for="customCheck14">  CRP </label>
                    </div>

                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="customCheck15" name="Serum[]" value="Amylase">
                        <label class="custom-control-label" for="customCheck15"> Amylase</label>
                    </div>

                    <div class=" custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="customCheck16" name="Serum[]" value="Ceruloplasmin">
                        <label class="custom-control-label" for="customCheck16">  Ceruloplasmin </label>
                    </div>

                   
                </div>
            
            

                <div class="col text-left">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="customCheck17" name="Serum[]" value="Urea">
                        <label class="custom-control-label" for="customCheck17"> Urea </label>
                    </div>

                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="customCheck18" name="Serum[]" value="Creatinine">
                        <label class="custom-control-label" for="customCheck18"> Creatinine </label>
                    </div>

                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="customCheck19" name="Serum[]" value="Sodium">
                        <label class="custom-control-label" for="customCheck19"> Sodium </label>
                    </div>

                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="customCheck20" name="Serum[]" value="Potassium">
                        <label class="custom-control-label" for="customCheck20"> Pottasium </label>
                    </div>

                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="customCheck21" name="Serum[]" value="Chloride">
                        <label class="custom-control-label" for="customCheck21"> Chloride </label>
                    </div>

                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="customCheck22" name="Serum[]" value="Magnesium">
                        <label class="custom-control-label" for="customCheck22"> Magnesium </label>
                    </div>

                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="customCheck23" name="Serum[]" value="Osmolality">
                        <label class="custom-control-label" for="customCheck23"> Osmolality </label>
                    </div>

                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="customCheck24" name="Serum[]" value="Cholesterol">
                        <label class="custom-control-label" for="customCheck24"> Cholesterol </label>
                    </div>

                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="customCheck25" name="Serum[]" value="Triglyceride">
                        <label class="custom-control-label" for="customCheck25"> Triglyceride </label>
                    </div>

                    <b> Plasma Glucose</b>

                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="customCheck26" name="Plasma[]" value="Random">
                        <label class="custom-control-label" for="customCheck26"> Random</label>
                    </div>

                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="customCheck27" name="Plasma[]" value="Fasting">
                        <label class="custom-control-label" for="customCheck27"> Fasting</label>
                    </div>

                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="customCheck28" name="Plasma[]" value="Post Prandial/2Hrs after glucose load">
                        <label class="custom-control-label" for="customCheck28"> Post Prandial/2Hrs after glucose load</label>
                    </div>

                    <b>CSF</b>

                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="customCheck29" name="CSF[]" value="Glucose">
                        <label class="custom-control-label" for="customCheck29"> Glucose</label>
                    </div>

                    <div class=" custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="customCheck30" name="CSF[]" value="Protein">
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
                           <b class="optionText"> Name and Designation of the requesting medical</b>

                            <div class="form-group ">
                            
                                <label for="offname"> Officer :</label>
                                <input type="text" name="offname" id="offname" class="form-control form-control-sm ">
                            
                            </div>


                            <div class="form-group w-25" >
                                <label for="Date">Date :</label> 
                                <input type="date" name="Date" id="Date" max=<?php echo date('Y-m-d');?> class="form-control form-control-sm">
                            </div>                            

                        </td>

                        <td>
                            <b class="optionText">To be filled by the Nursing Officer</b>

                            <div class="form-group w-50" >
                                <label for="Date2">Date :</label> 
                                <input type="date" name="Date2" id="Date2" max=<?php echo date('Y-m-d');?> class="form-control form-control-sm">
                            </div> 

                            <div class="form-group w-50">
                                <label for="time1"> Time :</label>
                                <input type="time" name="time1" id="time1" class="form-control form-control-sm" >
            
                            </div>

                            <div class="form-group ">
                            
                                <label for="offname2"> Name :</label>
                                <input type="text" name="offname2" id="offname2" class="form-control form-control-sm ">
                            
                            </div>
   
                        </td>
                    </tr>
                </tbody>


            </table>
  
        </div>

        <div class="container">
            <hr class="newhr">
            <b class="optionText">To be filled at the laboratory reception.</b>
            <br>

            <p> Date and Time of sample receipt :</p>
            <div class="row text-left ">
                <div class="col ">
                    <div class="form-group w-50">
                        <input type="date" class="form-control" max=<?php echo date('Y-m-d');?> name="datefinal">
                    </div>
                </div>

                <div class="col ">
                    <div class="form-group w-50 ">
                        <input type="time" class="form-control" name="timefinal">
                    </div>
                </div>

            </div>
            <br>

            <div class="custom-control custom-checkbox custom-control-inline">
                <input type="checkbox" class="custom-control-input" id="inlineCheckbox10" name="last_checkbox[]" value="Lipaemic" >
                <label class="custom-control-label" for="inlineCheckbox10"> <b> Lipaemic</b> </label>
    
            </div>

            <div class="custom-control custom-checkbox custom-control-inline">
                <input type="checkbox" class="custom-control-input" id="inlineCheckbox11" name="last_checkbox[]" value="Haemolyzed" >
                <label class="custom-control-label" for="inlineCheckbox11"> <b>Haemolyzed</b>  </label>
    
            </div>
            <div class="custom-control custom-checkbox custom-control-inline">
                <input type="checkbox" class="custom-control-input" id="inlineCheckbox12" name="last_checkbox[]" value="Lcteric" >
                <label class="custom-control-label" for="inlineCheckbox12"> <b>Lcteric</b>  </label>
    
            </div>
            <div class="custom-control custom-checkbox custom-control-inline">
                <input type="checkbox" class="custom-control-input" id="inlineCheckbox13" name="last_checkbox[]" value="Insufficient" >
                <label class="custom-control-label" for="inlineCheckbox13"> <b>Insufficient</b>  </label>
    
            </div>

            <div class="custom-control custom-checkbox custom-control-inline">
                <input type="checkbox" class="custom-control-input" id="inlineCheckbox14" name="last_checkbox[]" value="Clotted" >
                <label class="custom-control-label" for="inlineCheckbox14"> <b>Clotted</b>  </label>
    
            </div>
            <br>
            <br>
            <footer>
                <p style="color: #297578;"><b> Please folllow the instructions provided to your unit. For further
                    information and clarifications please contact Department of Chemical Pathology.
                    011-2693711 Ext.:314
                </b></p>
            </footer>
            <input type='submit' class="btn btn-info" value="Submit">   

        </div>
        </form >

        


	</body>
</html>
