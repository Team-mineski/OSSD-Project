<?php $this->setSiteTitle('Delete'); ?>
<?php $this->start('head'); ?>
<?php $this->end(); ?>
<?php $this->start('body'); ?>

<body  >
  
  <div class="container mainbodyAdmin" >
    <h3 class="textStyle top">DELETE MEMBER!</h3>
    <form class="form" action="" method="post">
      <div class="form-group">
        <label class = "badge badge-danger">Attention! You are going to delete a member form the system</label>
      </div>

      <div class="input-group mb-3 w-50">
        <div class="input-group-prepend">
          <label class="input-group-text textStyle" for="acl">Account Type</label>
        </div>
      
      <select class="custom-select grpstyle"  id="acl" name="acl">
        <option <?php echo ($this->user['acl']=='choose')?'selected':''; ?>  value="choose">Choose...</option>
        <option <?php echo ($this->user['acl']=='Admin')?'selected':''; ?>  value="Admin">Admin</option>
        <option <?php echo ($this->user['acl']=='Doctor')?'selected':''; ?> value="Doctor">Doctor</option>
        <option <?php echo ($this->user['acl']=='xray_lab')?'selected':''; ?> value="xray_lab">X-ray Lab Assistant</option>
        <option <?php echo ($this->user['acl']=='ecg_lab')?'selected':''; ?> value="ecg_lab">ECG Lab Assistant</option>
        <option <?php echo ($this->user['acl']=='specimen_exam_lab')?'selected':''; ?> value="specimen_exam_lab">Specimen Exam Lab Assistant</option>
        <option <?php echo ($this->user['acl']=='biochemical_lab')?'selected':''; ?> value="biochemical_lab">Biochemical Lab Assistant</option>
        <option <?php echo ($this->user['acl']=='microbio_lab')?'selected':''; ?> value="microbio_lab">Microbio Lab Assistant</option>
      </select>
    </div>


      <div class="input-group mb-3 form-group w-50">
          <input name="username" id="username" type="text" class="form-control boxstyles" value=<?php echo $this->user['username']; ?>  >

          <div class="input-group-append">
            <button class="btn btn-outline-success" type="submit">Search</button>
          </div>
        </div>

        <?php echo $this->user['message']; ?>
        <?php echo $this->user['smessage']; ?>

        <div class="form-group w-50">
          <label for="fname" class="textStyle">First Name</label>
          <label class="input-group-text boxstyles"><?=$this->user['fname']?></label>
        </div>

        <div class="form-group w-50">
          <label for="fname" class="textStyle">Last Name</label>
          <label class="input-group-text boxstyles"><?= $this->user['lname']?></label>
        </div>

        <div class="form-group w-50">
          <label for="fname" class="textStyle">Email</label>
          <label class="input-group-text boxstyles"><?=$this->user['email']?></label>
        </div>


        <div class="pull-right">
          <input id="delete" name="delete" type="submit" class="btn btn-danger btn-large" value="Delete">
        </div>

    </form>
  </div>
</body>
<?php $this->end(); ?>
