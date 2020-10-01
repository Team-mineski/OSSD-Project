<?php 



class LabAssistant{
    private $la_type; // Lab assistant type


    public function setLAType($la_type){
        $this->la_type=$la_type;
    }
    public function getLAType(){
        return $this->la_type;
    }
}