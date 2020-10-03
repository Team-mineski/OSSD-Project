<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title><?=  $this->siteTitle(); ?></title>

    <link rel="stylesheet" href="<?=PROOT?>bootstrap/css/bootstrap.min.css" media="screen" title="no title" charset="utf-8">

    <script src="<?=PROOT?>js/jQuery-2.2.4.min.js"></script>
    <script src="<?=PROOT?>js/bootstrap.min.js"></script>
 

    <link rel="stylesheet" media="screen" href="<?=PROOT?>img/test.css">
    <link rel = "stylesheet" href = "/Tuto/css/navNsideStyles.css">
    <link rel = "stylesheet" href = "/Tuto/css/mainStyles.css">
    <

    <?=  $this->content('head'); ?>


  </head>
  <body class ="mainbody " id ="body1" >
      <div class="offset">
        <?php include 'main_menu.php' ?>
        
      </div>
      <!-- <div class="offset"> -->
         
        
      <!-- </div> -->



      <?= $this->content('body'); ?>

    




  </body>
</html>
