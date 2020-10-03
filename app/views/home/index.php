<?php $this->setSiteTitle('Home'); ?>

<?php $this->start('body'); ?>



<!-- <div class="landing">
  <div class="home-wrap">
    <div  class="home-inner">

    </div>

  </div>

</div> -->
<div class="container-fluid homebody ">
<div class="imageview">
<div class="welcomeHeading text-center">

	<?php if (currentUser()) {
  
    echo "<h1 style=\"margin-top:15px\"> Welcome Back!!</h1>";
    echo "<h2 style=\"padding:5px ;color:#FEA736; \">";
    echo currentUser()->username;
    echo "</h2>";
  }else {
  echo "<h1 style=\"margin-top:15px\"> Welcome!!</h1>";
  }

  ?>
 
  

</div>
</div>
</div>

<?php $this->end(); ?>
