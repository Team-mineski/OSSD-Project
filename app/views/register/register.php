<?php $this->setSiteTitle('Register'); ?>
<?php $this->start('head'); ?>
<?php $this->end(); ?>
<?php $this->start('body'); ?>
<body >
  <div class="container mainbodyAdmin">
  <h3 class="text-start top textStyle">Register Here</h3>
    <form class="form" action="" method="post">
      <div class="alert-danger"><?= $this->displayErrors ?></div>
        <div class="form-group w-50">
          <label for="fname" class ="textStyle">First Name</label>
          <input type="text" id = "fname" name="fname" class="form-control boxstyles" value="<?=$this->post['fname']?>">
        </div>
        <div class="form-group w-50">
          <label for="lname" class ="textStyle">Last Name</label>
          <input type="text" id = "lname" name="lname" class="form-control boxstyles" value="<?=$this->post['lname']?>">
        </div>
        <div class="form-group w-50">
          <label for="email" class ="textStyle">E-mail</label>
          <input type="email" id = "email" name="email" class="form-control boxstyles" value="<?=$this->post['email']?>">
        </div>

        <div class="input-group  form-group w-50">
          <div class="input-group-prepend">
            <label class="input-group-text textStyle" for="acl">Account Type</label>
          </div>
          <select class="custom-select grpstyle" id="acl" name = "acl" >
            <!-- <option selected class="textStyle">Choose...</option> -->
            <option value="Admin" class="textStyle">Admin</option>
            <option  value="Doctor" class="textStyle">Doctor</option>
            <option value="xray_lab" class="textStyle">X-Ray Lab Assistant</option>
            <option value="ecg_lab" class="textStyle">ECG Lab Assistant</option>
            <option value="specimen_exam_lab" class="textStyle">Specimen Exam Lab Assistant</option>
            <option value="biochemical_lab" class="textStyle">Biochemical Lab Assistant</option>
            <option value="microbio_lab" class="textStyle">Microbiology Lab Assistant</option>
            
          </select>
        </div>

        <div class="form-group">
          <label class = "badge badge-danger">Attention! Different user types have different permissions in the system.</label>
        </div>

        <div class="form-group w-50">
          <label for="username" class ="textStyle">Choose a username</label>
          <input type="text" id = "username" name="username" class="form-control boxstyles" value="<?=$this->post['username']?>">
        </div>
        <div class="form-group w-50">
          <label for="password" class ="textStyle">Choose a password</label>
          <input type="password" id = "password" name="password" class="form-control boxstyles" value="<?=$this->post['password']?>">
        </div>
        <div class="form-group w-50">
          <label for="confirm" class ="textStyle">Confirm password</label>
          <input type="password" id = "confirm" name="confirm" class="form-control boxstyles" value="<?=$this->post['confirm']?>">
        </div>
        <div class="pull-right">
          <input type="submit" class="btn  btn-outline-success" value="Register">
        </div>

    </form>
    <br>
    <br>
  </div>
    
</body>
  
<?php $this->end(); ?>
