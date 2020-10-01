<?php


/**
 *
 */
class Home extends Controller
{
  public function __construct($controller , $action)
  {

    parent::__construct($controller , $action);
  }

  public function indexAction()
  {

    //dnd($_SESSION);
    if (currentUser()) {

      if(currentUser()->acl == 'Doctor'){

         
        $this->view->render('home/contents');

      }else if(currentUser()->acl == 'ecg_lab'){

        $this->view->post = currentUser()->acl;
        $this->view->render('home/TestRequestViewer.viewer');

      }else if(currentUser()->acl == 'xray_lab'){

        $this->view->post = currentUser()->acl;
        $this->view->render('home/TestRequestViewer.viewer');

      }else if(currentUser()->acl == 'specimen_exam_lab'){

        $this->view->post = currentUser()->acl;
        $this->view->render('home/TestRequestViewer.viewer');

      }else if(currentUser()->acl == 'biochemical_lab'){

        $this->view->post = currentUser()->acl;
        $this->view->render('home/TestRequestViewer.viewer');

      }else if(currentUser()->acl == 'microbio_lab'){

        $this->view->post = currentUser()->acl;
        $this->view->render('home/TestRequestViewer.viewer');

      }
      else {
          $this->view->render('home/index');
      }
    }else {
      $this->view->render('home/index');
    }

    

  //  $this->redirect('/home/abc/asas');

  }



}


 ?>
