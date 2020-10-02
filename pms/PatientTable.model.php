<?php

include_once 'Patient.class.php';
class PatientTable{
    private $parent_database;
    private $table_name;

    public function __construct($parent_database){
        $this->parent_database=$parent_database;
        $this->table_name="patients";
    }
    
    public function getPatientByID($regNo){
        // access the database and get required patient details from the patient_id(reg_no)
        //$query="SELECT * FROM ".$this->table_name." WHERE RegNo='$id'";        //name format use for naming tables is <test_type>_table
        //$result=mysqli_query( $this->parent_database->getConnection(),$query);  
        $columns = array('RegNo', 'FullName',  'Gender', 'FullAddress', 'DateOfBirth', 'Disease',  'BedNo','ContactNo');
        //$results =  $medical->retrieveData("patients", $columns, $regNo);
        //$results =  $medical->joinPatientWithDiagnosis( $columns, $patientID);
        $arr = explode ("/", $regNo);  //get the patient id from the registration number
        $patientID = $arr[1];
        $results =  $this->parent_database->joinPatientWithDiagnosis( $columns, $patientID);
        $row=mysqli_fetch_assoc($results);//stops
        $regNo = $row['RegNo'];
        $diagnosis =  $row['Disease'];
        $name = $row['FullName'];
        $gender =  $row['Gender'];
        $address =  $row['FullAddress'];
        $dob =  $row['DateOfBirth'];
        $bday = new DateTime($dob);
        $today = new DateTime();
        $diff = $today->diff($bday);
        $y = $diff->y;
        $m = $diff->m;
        $d = $diff->d;
        if ($y!=0){
        $age = $y . " year/s";
        }
        else if ($m!=0){
        $age = $m . " month/s ".$d." day/s";
        }
        else {
        $age = $d . " day/s";
        }

        $contact = $row['ContactNo'];
        $bedNo = $row['BedNo'];
        if ($bedNo==''){
            $admission="Not admitted";
        }
        else{
            $admission = "Admitted";
        }

        $patient = new Patient($regNo, $name, $age, $address,$diagnosis,$dob,$gender,$admission, $bedNo, $contact,"Existing");
        echo $name;
        return $patient;

}
}
?>