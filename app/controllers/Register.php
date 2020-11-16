<?php

class Register extends Controller
{

  function __construct($controller, $action)
  {
    parent::__construct($controller, $action);
    $this->load_model('Users');
    $this->view->setLayout('default');

  }

  public function loginAction()
  {

      $validation = new Validate();
      if($_POST){
      $validation->check($_POST,[
        'username' => [
          'display' => "Username",
          'required' => true

        ],
        'password' =>[
          'display' => "Password",
          'required' => true,
          'min' => 6
        ]
      ]);
        if($validation->passed()){
        //dnd($this->UsersModel);
        $user = $this->UsersModel->findByUsername($_POST['username']);
        //dnd(password_verify(Input::get('password'), $user->password));
        if($user && password_verify(Input::get('password'), $user->password)){
          $remeber =(isset($_POST['remember_me']) && Input::get('remember_me')) ? true : false;
          $user->login($remeber);
          session_start();
          $_SESSION["username"] = $_POST['username'];
          $_SESSION["type"] = currentUser()->acl;
          //dnd($_POST);
          Router::redirect('');
        }
        else{
          $validation->addError("There is an error with your username and password.");
        }
      }
    }
    $this->view->displayErrors = $validation->displayErrors();
    $this->view->render('register/login');

  }

  public function logoutAction()
  {
    if(currentUser()){
      unset($_SESSION["username"]);
      currentUser()->logout();
    }
    Router::redirect('register/login');


  }

  public function registerAction()
  {

    $validation = new Validate();
    $posted_values = ['fname' =>'', 'lname'=>'', 'username'=>'', 'email'=>'', 'password'=>'', 'confirm'=>''];
    if ($_POST) {
      
      $posted_values = posted_values($_POST);
      $validation->check($_POST, [
        'fname' => [
        'display' => 'First Name',
        'required' => 'true'
        ],
        'lname' => [
          'display' => 'Last Name',
          'required' => 'true'
        ],
        'username' => [
          'display' => 'Username',
          'required' => 'true',
          'unique' => 'users',
          'min' => 6,
          'max' => 150
        ],
        'email' => [
          'display' => 'Email',
          'required' => 'true',
          'unique' => 'users',
          'max' => 150
        ],
        'password' => [
          'display' => 'Password',
          'required' => 'true',
          'min' => 6
        ],
        'confirm' => [
          'display' => 'Confirm Password',
          'required' => 'true',
          'matches' => 'password'
        ]
      ]);

      if ($validation->passed()) {


        $newUser = new Users();
        $newUser->registerNewUser($_POST);

        Router::redirect('');
      }
    }
    $this->view->post = $posted_values;
    $this->view->displayErrors = $validation->displayErrors();
    $this->view->render('register/register');

  }

}
