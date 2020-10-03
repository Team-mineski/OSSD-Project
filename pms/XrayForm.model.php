<?php

include_once "XrayRequestTable.model.php";

class XrayForm{

    private $table_path;
    private $parent_database;
    private $date;
    private $regNo;
    private $bht_no;
    private $surgeon;
    private $signature;
    private $status;
    private $date_stamp;
    private $xray_no;
    private $xray_room;
    private $size;
    private $remarks;
    private $sign_radio;
    private $region;

    public function __construct(
        $parent_database,
        $date,
        $regNo,
        $bht_no,
        $surgeon,
        $signature,
        //$status,
        $date_stamp,
        $xray_no,
        $xray_room,
        $size,
        $remarks,
        $sign_radio,
        $region
    ){

        $this->table_path="xray_table";
        $this->parent_database=$parent_database;
        $this->date=$date;
        $this->regNo=$regNo;
        $this->bht_no=$bht_no;
        $this->surgeon=$surgeon;
        $this->signature=$signature;
        $this->date_stamp=$date_stamp;
        $this->xray_no=$xray_no;
        $this->xray_room=$xray_room;
        $this->size=$size;
        $this->remarks=$remarks;
        $this->sign_radio=$sign_radio;
        $this->region=$region;
    }


    public function writeToTable(){
        $dateToday = date('Y-m-d');
        $database = $this->parent_database;
        $dateToday = date('Y-m-d');
        $database->enterData("xray_table",
        array('test_request_date', 'regNo','bht_no','surgeon',
        'signature', 'stamp','xray_no','xray_room',
        'size', 'remarks','sign_radio','completed_date','region'),
        
        array($this->date,$this->regNo,$this->bht_no,$this->surgeon,$this->signature,$this->date_stamp,
        $this->xray_no,$this->xray_room,$this->size,$this->remarks,$this->sign_radio,$dateToday,$this->region),
    );
        $request_table=new XrayRequestTable($this->parent_database);
        $request_table->deleteRowByID($this->regNo);
        header("Location: /Tuto/");

    }
        

    }

?>