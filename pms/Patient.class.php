<?php

    include 'State.php';

    class Patient{

        private $regNo;
        private $name;
        private $age;
        private $address;
        private $diagnosis;
        private $dob;
        private $gender;
        private $admission;
        private $bedNo;
        private $contact;
        private $current;

        function __construct( $regNo,$name,$age,$address,$diagnosis,$dob,$gender,$admission,$bedNo,$contact, $state) {
            $this->regNo = $regNo;
            $this->name = $name;
            $this->age = $age;
            $this->address = $address;
            $this->diagnosis = $diagnosis;
            $this->dob = $dob;
            $this->gender = $gender;
            $this->admission = $admission;
            $this->bedNo = $bedNo;
            $this->contact = $contact;
            $this->current = $state;
            if ($state == "New"){
                $this->setState(new NewPatient("New Patient"));
            }
            else {
                if ($state == "Existing"){
                    $this->setState(new ExistingPatient("Existing Patient"));
                }
                else {
                    $this->setState(new DischargedPatient("Discharged Patient"));
                }
            }
        }

        public function setState($state){
            $this->current = $state;
        }

        public function displayUI(){
            $this->current->displayUI($this);
        }

        public function goNext(){
            $this->current->goNext($this);
        }
        
        public function getRegNo(){
            return $this->regNo;
        }

        public function getName(){
            return $this->name;
        }

        public function getAge(){
            return $this->age;
        }
        public function getAddress(){
            return $this->address;
        }
        public function getAdmissionStatus(){
            return $this->admission;
        }
        public function getDiagnosis(){
            return $this->diagnosis;
        }
        
        public function getDOB(){
            return $this->dob;
        }
        public function getBedNo(){
            return $this->bedNo;
        }
        
        public function getGender(){
            return $this->gender;
        }

        public function getContact(){
            return $this->contact;
        }
        public function setDiagnosis($diagnosis){
            $this->diagnosis = $diagnosis;
        }
        public function setAddress($address){
            $this->address = $address;
        }
        public function setContact($contact){
            $this->contact = $contact;
        }
        public function setAdmission($admission){
            $this->admission = $admission;
        }
        public function setBed($bedNo){
            $this->bedNo = $bedNo;
        }

    }
?>