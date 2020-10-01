<?php

/**
 *
 */
class Restricted extends Controller
{

  public function __construct($controller,$action)
  {
    parent::__construct($controller,$action); // run parent constructor
  }

  public function indexAction(){
    $this->view->render('restricted/index');
  }
}


 ?>
