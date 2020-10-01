<?php

/**
 *
 */
class Redirect extends Controller
{
  public function __construct($controller , $action)
  {
    parent::__construct($controller , $action);
    $this->load_model('Users');
    $this->view->setLayout('default');
  }

  public function confirmAction($username)
  {
    $posted_values = ['password'=>'', 'message'=>'' , 'button'=>'' , 'smessage'=>''];
    if ($_POST) {
      $posted_values['password'] = $_POST['password'];
      //$user = $this->UsersModel->findByUsername(''.$username);
      $admin = currentUser();
      //dnd($user->id);
      if($admin && password_verify(Input::get('password'), $admin->password)){
        $posted_values['message'] = '<div class="alert alert-info" role="alert">
          Confirmed! Click below to delete
            </div>';

        $posted_values['button'] = '<div class="input-group-append">
          <button name="button" id="button" value="button" class="btn btn-outline-danger deletebtn" type="submit">Delete Account</button>
        </div>';


        if(isset($_POST['button'])){
          $posted_values['smessage'] = '<hr style="height:2px;border-width:0;color:gray;background-color:gray"><div class="alert alert-success" role="alert">
            Successfully deleted '.$username."'s Account
              </div>";
          $this->UsersModel->deleteUser(''. $username);

        }

        //
        //dnd("Deleted");
        //Router::redirect('');

      }
      else{
        $posted_values['message'] =
        '<div class="alert alert-warning" role="alert">
        Invalid password!
          </div>';
      }
    }
    $this->view->post = $posted_values;
    $this->view->render('redirect/confirm');
  }



}


 ?>
