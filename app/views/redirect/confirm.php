<?php $this->setSiteTitle('Confirm'); ?>
<?php $this->start('head'); ?>
<?php $this->end(); ?>
<?php $this->start('body'); ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="./bootstrap/css/bootstrap.min.css" integrity="" crossorigin="anonymous">
  <link rel="stylesheet" href="../../css/mainStyles.css">
  <!-- <link rel = "stylesheet" href = "../../css/styles.css"> -->
  <title></title>
</head>

<body>
  <div class="container mainbodyAdmin">
    <h1 class="text-center top mainHeading">Confirm Operation</h1>
    <div class="container h100 deletecon ">

      <div class="row h-100 justify-content-center align-items-center">
        <div class="col-10 col-md-8 col-lg-6">
          <form class="form " action="" method="post">
            <div align="center">
              <img src="../../css/warning.png" alt="" class="warningIcon">
            </div>

            <h2 align="center" class="attentionText">Member account deletion:</h2>
            <h6 align="center" class="attentionText"> You are going to delete a member from the system</h6>
            <br>


            <div align="center" class=" form-group">
              <input name="password" id="password" type="password" placeholder="Enter your password" class="form-control innercol" value=<?php echo $this->post['password'] ?>>

              <!-- <div class="input-group-append">
                  <button class="btn btn-outline-secondary" type="submit">Submit</button>
                </div> -->
            </div>
            <div align="center" class=" form-group  ">
              <button type="button" class="btn btn-outline-danger deletebtn">Submit</button>

            </div>


            <?php echo $this->post['message'] ?>
            <?php echo $this->post['button'] ?>
            <?php echo $this->post['smessage'] ?>

          </form>

        </div>

      </div>
    </div>
  </div>
</body>
<?php $this->end(); ?>