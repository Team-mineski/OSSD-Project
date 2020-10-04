<?php

/*This file contains the html form filled with details in the database*/


include "../app/views/layouts/labmenu.php";
include_once 'Patient.class.php';
session_start();
if ((!(isset($_SESSION["username"])))||($_SESSION["type"]!="xray_lab"))
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
    <title>X-Ray Request Form</title>
        <link rel = "stylesheet" href = "../bootstrap/css/bootstrap.min.css" integrity="" crossorigin="anonymous">
        <link rel="stylesheet" href="../css/styles.css">
       <link rel="stylesheet" href="../css/labReportStyles.css">

  </head>
  <body>
    <header>
        <div class="container text-center">
            <h4 class="mainHeading"> REQUISITION FOR X-RAY DIAGNOSTIC EXAMINATION   </h4>
            <br>
        </div>
    </header>
    <form action='XraySubmit.controller.php' method='post'>    
    <div class="container">
        <div class="form-group w-25" >
            <label for="date"  >Date:</label>
            <input type="date" name="date" id="date" class="form-control form-control-sm "  value="<?php echo $test_date;?>" readonly>

        </div>

        <table class="table table-bordered">
            <tbody>
                <tr>
                    <td colspan="2" rowspan="2">

                        <div class="form-group ">
                            <label for="name"> Name:</label>
                            <input type="text" name="name" id="name" class="form-control form-control-sm" value="<?php echo $patient->getName(); ?>" readonly> 
        
                        </div>

                        <div class="form-group " >
                            <label for="address" > Address:</label> 
                            <textarea type="text" name="address" id="address" cols="40" rows="" class="form-control form-control-sm"  readonly><?php echo $patient->getAddress(); ?></textarea>
                        </div>

                    </td>
                    <td>  
                        <div class="form-group w-50" >
                            <label for="wardno" >Ward No:</label> 
                            <input type="text" name="wardno" id="wardno" class="form-control form-control-sm " value='19' readonly>
                        </div>

                        <td>
                            <div class="form-group w-50">
                            <label for="sex">  Sex:</label>
                            <select name="sex" id="sex" class="form-control form-control-sm" selected value="<?php echo $patient->getGender(); ?>" disabled=true readonly>
                                <option value="<?php echo $patient->getGender(); ?>" > <?php echo $patient->getGender(); ?></option>
                            </select>
        
                            </div> 
                        </td>
                        
                        
                        <tr>
                            <td>
                                <div class="form-group w-50">
                                    <label for="bht">  B.H.T No:</label>
                                    <input type="text" name="bht" id="bht"  class="form-control form-control-sm " readonly value = "<?php echo $patient->getBedNo(); ?>">
                
                                </div> 
                            </td>

                            <td>
                                <div class="form-group w-25">
                                    <label for="age"> Age:</label>
                                    <input type="text" name="age" id="age" class="form-control form-control-sm " value="<?php echo $patient->getAge(); ?>" readonly>
                        
                                </div>
                            </td>
                        </tr>

                    </td>
                </tr>

                <tr>
                    <td colspan="2"> 
                        
                        <p class="optionText">Clinical History </p>
                    </td>
                    <td> 
                    <p class="optionText">Region and Nature of Examination </p>
                    </td>
                    <td rowspan="2">
                        <div class="form-check ">
                            <input class="form-check-input" type="checkbox" id="assault" name="region[]"value ="assault" >
                            <label class="form-check-label " for="assault"> ASSAULT</label>

                        </div>

                        <div class="form-check">
                            <input class="form-check-input " type="checkbox" id="accident"name="region[]"value ="accident">
                            <label class="form-check-label" for="accident"> ACCIDENT</label>

                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="inward"name="region[]"value ="inward">
                            <label class="form-check-label" for="inward"> IN WARD </label>

                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="trolley"name="region[]"value ="trolley">
                            <label class="form-check-label" for="trolley"> TROLLEY</label>

                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="chair"name="region[]"value ="chair">
                            <label class="form-check-label" for="chair"> CHAIR </label>

                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="walking"name="region[]"value ="walking">
                            <label class="form-check-label" for="walking"> WALKING </label>

                        </div>

                    </td>

                </tr>
                <tr>
                    <td colspan="2">
                        <div class="form-group  " >
                            <input type="text" name="sign" id="sign" class="form-control form-control-sm  ">
                            <div class="text-center">
                                <label for="sign"  >Surgeon / Physician</label>         
                            </div>
                        </div>
                    </td>

                    <td>
                        <div class="form-group  " >
                            <input type="text" name="signature"  class="form-control form-control-sm  ">
                            <div class="text-center">
                                <label for="sign"  >Signature  M/O</label> 
                            </div>
                        </div>

                    </td>

                </tr>

                <tr>
                    <td rowspan="2">

                        <div class="form-group " >
                            <label for="datestamp" > Date Stamp:</label> 
                            <textarea name="datestamp" id="datestamp" cols="30" rows="" class="form-control form-control-sm" readonly><?php echo date('Y-m-d'); ?> </textarea>
                        </div>
                    </td>

                    <td>
                        <div class="form-group ">
                            
                            <label for="xno"> X-ray No: </label>
                            <input type="text" name="xno" id="xno" class="form-control form-control-sm ">
                        
                        </div>

                        <td>
                            <div class="form-group " >
                                <label for="films" > Size and No. of films used :</label> 
                                <textarea name="films"  cols="30" rows="3" class="form-control form-control-sm"></textarea>
                            </div>

                        </td>

                        <td>
                            <div class="form-group  ">
                                <label for="remark"> Remarks: </label>
                                <textarea name="remark" id="remark" cols="30" rows="3" class="form-control form-control-sm"></textarea>  
                            </div> 


                        </td>

                    </td>
                    
                </tr>

                <tr>
                    <td> 
                        <div class="form-group ">
                            
                            <label for="xroom"> X-ray Room: </label>
                            <input type="text" name="xroom" id="xroom" class="form-control form-control-sm ">
                        
                        </div>


                    </td>

                    <td colspan="2" >
                        <div class="form-group  " >
                            <input type="text" name="signrad" id="signrad" class="form-control form-control-sm  ">
                            <div class="text-center">
                                <label for="signrad">Signature of Radiographer</label> 
                            </div>
                        </div>
                        
                    </td>
                </tr>
    
            </tbody>

        </table>

        <input type='submit' class="btn btn-info" value="Submit">


    </div>
</form>
   
  </body>
</html>