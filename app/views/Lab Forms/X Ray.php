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
    $_SESSION["date"] = $date;
}
else if (isset($_SESSION['date'])){
    $date = $_SESSION["date"];
}

$results = $medical->retrieveDataByDate("xray_table",array('test_request_date', 'regNo','bht_no','surgeon','signature', 'stamp',
            'xray_no','xray_room','size', 'remarks','sign_radio','completed_date','region'), $date, $regNo);
            if ($results) { 
                  $date = $results['test_request_date'];
                  $bht_no = $results['bht_no'];
                  $surgeon =  $results['surgeon'];
                  $signature =  $results['signature'];
                  $stamp =  $results['stamp'];
                  $xray_no =  $results['xray_no'];
                  $xray_room = $results['xray_room'];
                  $size = $results['size'];
                  $remarks =  $results['remarks'];
                  $sign_radio =  $results['sign_radio'];
                  $completed_date = $results['completed_date'];
                  $region = explode( ',', $results['region'] );
                
            }
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>X-Ray Diagnostic Examination Results Form</title>
        <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" 
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" 
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" 
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" 
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="../../../style.css">
        <link rel="stylesheet" href="../../../css/styles.css"> -->
        <script src="../../../js/jQuery-2.2.4.min.js"></script>
        <script src="../../../bootstrap/js/bootstrap.min.js"></script>
        <link rel = "stylesheet" href = "../../../bootstrap/css/bootstrap.min.css" integrity="" crossorigin="anonymous">
        <link rel = "stylesheet" href = "../../../css/navNsideStyles.css">
        <link rel = "stylesheet" href = "../../../css/mainStyles.css">

  </head>
  <body>
    <header>
        <div class="container text-center">
            <h4> REQUISITION FOR X-RAY DIAGNOSTIC EXAMINATION   </h4>
            <br>
        </div>
    </header>

    <div class="container">
        <div class="form-group w-25" >
            <label for="date"  >Date:</label>
            <input type="date" name="date" id="date" class="form-control form-control-sm " value = '<?php echo $date;?>' readonly>

        </div>

        <table class="table table-bordered">
            <tbody>
                <tr>
                    <td colspan="2" rowspan="2">

                        <div class="form-group ">
                            <label for="name"> Name:</label>
                            <input type="text" name="name" id="name" class="form-control form-control-sm" value='<?php echo $patient->getName();?>' readonly>
        
                        </div>

                        <div class="form-group " >
                            <label for="address" > Address:</label> 
                            <textarea name="address" id="address" cols="40" rows="" class="form-control form-control-sm" readonly><?php echo $patient->getAddress();?> </textarea>
                        </div>

                    </td>
                    <td>  
                        <div class="form-group w-50" >
                            <label for="wardno" >Ward No:</label> 
                            <input type="text" name="wardno" id="wardno" class="form-control form-control-sm " value='<?php echo '19';?>' readonly>
                        </div>

                        <td>
                            <div class="form-group w-50">
                            <label for="sex">  Sex:</label>
                            <input type="text" name="gender" id="gender"  class="form-control form-control-sm " value='<?php echo $patient->getGender();?>' readonly>
        
                            </div> 
                        </td>
                        
                        
                        <tr>
                            <td>
                                <div class="form-group w-50">
                                    <label for="bht">  B.H.T No:</label>
                                    <input type="number" name="bht" id="bht" class="form-control form-control-sm " value='<?php echo $bht_no;?>' readonly>
                
                                </div> 
                            </td>

                            <td>
                                <div class="form-group w-75">
                                    <label for="age"> Age:</label>
                                    <input type="text" name="age" id="age" class="form-control form-control-sm "value='<?php echo $patient->getAge();?>' readonly>
                        
                                </div>
                            </td>
                        </tr>

                    </td>
                </tr>

                <tr>
                    <td colspan="2"> 
                        
                        <p><b> Clinical History </b></p>
                    </td>
                    <td> 
                        <p><b>Region and Nature of Examination </p></b>
                    </td>
                    <td rowspan="2">
                        <div class="form-check ">
                            <input class="form-check-input" type="checkbox" id="assault" name="region[]"value ="assault"  onclick="return false" <?php echo in_array("assault", $region  , TRUE) ?  "checked" : "" ;?> >
                            <label class="form-check-label " for="assault"> ASSAULT</label>

                        </div>

                        <div class="form-check">
                            <input class="form-check-input " type="checkbox" id="accident"name="region[]"value ="accident"  onclick="return false" <?php echo in_array("accident", $region  , TRUE) ?  "checked" : "" ;?> >
                            <label class="form-check-label" for="accident"> ACCIDENT</label>

                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="inward"name="region[]"value ="inward"  onclick="return false" <?php echo in_array("inward", $region  , TRUE) ?  "checked" : "" ;?> >
                            <label class="form-check-label" for="inward"> IN WARD </label>

                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="trolley"name="region[]"value ="trolley"  onclick="return false" <?php echo in_array("trolley", $region  , TRUE) ?  "checked" : "" ;?> >
                            <label class="form-check-label" for="trolley"> TROLLEY</label>

                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="chair"name="region[]"value ="chair"  onclick="return false" <?php echo in_array("chair", $region  , TRUE) ?  "checked" : "" ;?> >
                            <label class="form-check-label" for="chair"> CHAIR </label>

                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="walking"name="region[]"value ="walking"  onclick="return false" <?php echo in_array("walking", $region  , TRUE) ?  "checked" : "" ;?> >
                            <label class="form-check-label" for="walking"> WALKING </label>

                        </div>

                    </td>

                </tr>
                <tr>
                    <td colspan="2">
                        <div class="form-group  " >
                            <input type="text" name="sign" id="sign" class="form-control form-control-sm  "value='<?php echo $surgeon?>' readonly>
                            <div class="text-center">
                                <label for="sign"  >Surgeon / Physician</label> 
                            </div>
                        </div>
                    </td>

                    <td>
                        <div class="form-group  " >
                            <input type="text" name="sign" id="sign" class="form-control form-control-sm  "value='<?php echo $signature;?>' readonly>
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
                            <textarea name="datestamp" id="datestamp" cols="30" rows="" class="form-control form-control-sm" readonly><?php echo $completed_date;?></textarea>
                        </div>
                    </td>

                    <td>
                        <div class="form-group ">
                            
                            <label for="xno"> X-ray No: </label>
                            <input type="text" name="xno" id="xno" class="form-control form-control-sm "value='<?php echo $xray_no;?>' readonly>
                        
                        </div>

                        <td>
                            <div class="form-group " >
                                <label for="films" > Size and No. of films used :</label> 
                                <textarea name="datestamp" id="films" cols="30" rows="3" class="form-control form-control-sm" readonly><?php echo $size;?></textarea>
                            </div>

                        </td>

                        <td>
                            <div class="form-group  ">
                                <label for="remark"> Remarks: </label>
                                <textarea name="remark" id="remark" cols="30" rows="3" class="form-control form-control-sm" readonly><?php echo $remarks;?></textarea>  
                            </div> 


                        </td>

                    </td>
                    
                </tr>

                <tr>
                    <td> 
                        <div class="form-group ">
                            
                            <label for="xroom"> X-ray Room: </label>
                            <input type="text" name="xroom" id="xroom" class="form-control form-control-sm "value='<?php echo $xray_room;?>' readonly>
                        
                        </div>


                    </td>

                    <td colspan="2" >
                        <div class="form-group  " >
                            <input type="text" name="signrad" id="signrad" class="form-control form-control-sm  "value='<?php echo $sign_radio;?>' readonly>
                            <div class="text-center">
                                <label for="signrad"  >Signature of Radiographer</label> 
                            </div>
                        </div>
                        
                    </td>
                </tr>
    
            </tbody>
        </table>
        <div class = "printvisible">
                  <button class="btn btn-outline-success mr-4"  name = "test" onclick="window.print();"> Print </button>
            </div>
    </div>
    <br>
   
  </body>
</html>