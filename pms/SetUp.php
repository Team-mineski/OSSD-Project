<?php

    function setup(){
        $medical = Database::getInstance();
        
        $medical -> makeTable("microbio_table",
        array('result_id','test_request_date','regNo','lab_no','BHT_no',
        'specimen_test','probable_diagnosis','clinic_details','prior_antibiotic',
        'antibiotic_given','sig_MO','name_mo','designation','completed_date'), 
        array('INT PRIMARY KEY NOT NULL AUTO_INCREMENT','DATE DEFAULT NULL', 'VARCHAR(20) DEFAULT NULL','INT DEFAULT NULL','varchar(20) DEFAULT NULL',
        'VARCHAR(60) NOT NULL', 'VARCHAR(60) NOT NULL','VARCHAR(120) NOT NULL',' VARCHAR(10) NOT NULL',
        'VARCHAR(60) NOT NULL', 'VARCHAR(20) NOT NULL','VARCHAR(40) NOT NULL',' VARCHAR(10) NOT NULL','DATE DEFAULT NULL'));
        
        $medical -> makeTable("specimen_exam_table", 
        array('result_id','test_request_date','serial_no','regNo', 'BHT_no','exams','collect_date',
        'collect_time', 'sigMO','institution_No','counter_date',
        'counter_time', 'received_by','remarks','lab_no',
        'lab_date', 'lab_received_by','lab_note','lab_sig',
        'report', 'report_check','sentdate'), 
        array('INT PRIMARY KEY NOT NULL AUTO_INCREMENT','DATE DEFAULT NULL','VARCHAR(20) DEFAULT NULL ','VARCHAR(20) DEFAULT NULL ', 'VARCHAR(20) DEFAULT NULL','VARCHAR(60) DEFAULT NULL',' DATE DEFAULT NULL',
        'TIME DEFAULT NULL ', 'VARCHAR(30) DEFAULT NULL','VARCHAR(30) DEFAULT NULL',' DATE DEFAULT NULL',
        'TIME DEFAULT NULL', 'VARCHAR(30) NOT NULL','VARCHAR(30) NOT NULL',' VARCHAR(20) NOT NULL',
        'DATE NOT NULL ', 'VARCHAR(20) NOT NULL','VARCHAR(30) NOT NULL',' VARCHAR(25) NOT NULL',
        'VARCHAR(40) NOT NULL', 'VARCHAR(20) NOT NULL','DATE NOT NULL'));

        $medical -> makeTable("ecg_table", 
        array('result_id','test_request_date','regNo', 'BHT_no','surgeon','standard_lead',
        'other_lead', 'sigMO','reg_no','remarks',
        'finishedDate', 'sigcardio'), 
        array('INT PRIMARY KEY NOT NULL AUTO_INCREMENT','DATE DEFAULT NULL','VARCHAR(20) DEFAULT NULL', 'VARCHAR(10) DEFAULT NULL','VARCHAR(20) DEFAULT NULL','VARCHAR(60) DEFAULT NULL','VARCHAR(60) DEFAULT NULL',
        'VARCHAR(30) DEFAULT NULL', 'VARCHAR(10) DEFAULT NULL','VARCHAR(60) DEFAULT NULL',' DATE DEFAULT NULL',
        'VARCHAR(30) DEFAULT NULL'));
        
        $medical -> makeTable("xray_table", 
        array('result_id','test_request_date','regNo','bht_no','surgeon',
        'signature', 'stamp','xray_no','xray_room',
        'size', 'remarks','sign_radio','completed_date','region'), 
        
        array('INT PRIMARY KEY NOT NULL AUTO_INCREMENT','DATE DEFAULT NULL','VARCHAR(20) NOT NULL','varchar(20) DEFAULT NULL','VARCHAR(60) NOT NULL',
        'varchar(60) NOT NULL', 'VARCHAR(60) NOT NULL','VARCHAR(60) NOT NULL','varchar(60) NOT NULL',
        'varchar(60) NOT NULL', 'VARCHAR(60) NOT NULL','VARCHAR(60) NOT NULL','date DEFAULT NULL','VARCHAR(300) NOT NULL'));

        $medical -> makeTable("biochemical_table", 
        array('result_id','regNo','test_request_date', 'lab_ref_no','bht_no','fasting_status',
        'clinical_history', 'serum','plasma_glu','csf',
        'officer', 'date_request','date_filled','time_filled','nursing_officer',
        'date_lab_rec', 'time_lab_rec','last_check'), 
        array('INT PRIMARY KEY NOT NULL AUTO_INCREMENT','VARCHAR(20) DEFAULT NULL ', 'DATE DEFAULT NULL','INT DEFAULT NULL ','varchar(20) DEFAULT NULL','varchar(20) DEFAULT NULL',
        'varchar(200) DEFAULT NULL', ' varchar(500) DEFAULT NULL',' varchar(200) DEFAULT NULL','  varchar(100) DEFAULT NULL',
        ' varchar(100) DEFAULT NULL', 'date DEFAULT NULL ','date DEFAULT NULL',' TIME NOT NULL',' varchar(50) DEFAULT NULL',
        'date DEFAULT NULL ', 'TIME DEFAULT NULL ','VARCHAR(100) DEFAULT NULL'));
    }

?>