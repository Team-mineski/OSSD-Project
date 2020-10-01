<?php

    function setup(){
        $medical = Database::getInstance();

        $medical -> makeTable("diseases",array('DiagnosisID', 'Disease'),
        array("INT NOT NULL PRIMARY KEY AUTO_INCREMENT", "VARCHAR(70) NOT NULL"));
        
        $medical -> makeTable("patients",array('PatientID','RegNo', 'FullName',  'Gender', 'FullAddress', 'DateOfBirth', 'DiagnosisID', 
        'BedNo','ContactNo') ,
        array("INT NOT NULL PRIMARY KEY AUTO_INCREMENT","VARCHAR(20) NOT NULL UNIQUE", "VARCHAR(70) NOT NULL", "VARCHAR(10) NOT NULL",
        "VARCHAR(50) NOT NULL", "DATE NOT NULL","INT", "VARCHAR(30) NOT NULL","VARCHAR(15) NOT NULL"," FOREIGN KEY (DiagnosisID) REFERENCES diseases(DiagnosisID) ON DELETE CASCADE" ));

        $medical -> makeTable("dischargedPatients",array('DischargedPatientID','RegNo', 'FullName', 'Gender', 'FullAddress', 'DateOfBirth', 
        'DiagnosisID', 'BedNo','ContactNo') ,
        array("INT NOT NULL PRIMARY KEY AUTO_INCREMENT","VARCHAR(20) NOT NULL", "VARCHAR(70) NOT NULL", "VARCHAR(10) NOT NULL",
        "VARCHAR(50) NOT NULL", "DATE NOT NULL", "INT NOT NULL","VARCHAR(10)","VARCHAR(15) NOT NULL" ));

        $columns = array('ID','RegNo','Date','ClinicalSignsPresented', 'PrescribedDrugs', 'AdditionalNotes');
        $attributes = array('INT PRIMARY KEY NOT NULL AUTO_INCREMENT', 'VARCHAR(20) NOT NULL',' DATE NOT NULL',
        'VARCHAR(150) NOT NULL','VARCHAR(100) NOT NULL','VARCHAR(100)');
        $medical -> makeTable("history", $columns, $attributes);

        $columns = array('ID','RegNo','Date','ClinicalSignsPresented', 'PrescribedDrugs', 'AdditionalNotes');
        $attributes = array('INT PRIMARY KEY NOT NULL AUTO_INCREMENT', 'VARCHAR(20) NOT NULL',' DATE NOT NULL',
        'VARCHAR(150) NOT NULL','VARCHAR(100) NOT NULL','VARCHAR(100)');
        $medical -> makeTable("dischargedhistory", $columns, $attributes);
        
        $columns = array('RequestID','RegNo','Date');
        $attributes = array('INT PRIMARY KEY NOT NULL AUTO_INCREMENT','VARCHAR(20) NOT NULL', ' DATE NOT NULL');
        
        $medical -> makeTable("xray_request_table", $columns, $attributes);
        $medical -> makeTable("specimen_exam_request_table", $columns, $attributes);
        $medical -> makeTable("microbio_request_table", $columns, $attributes);
        $medical -> makeTable("ecg_request_table", $columns, $attributes);
        $medical -> makeTable("biochemical_request_table", $columns, $attributes);

    }

?>