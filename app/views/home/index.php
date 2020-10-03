<?php $this->setSiteTitle('Home'); ?>

<?php $this->start('body'); ?>




<div class="imageview">
<div class="welcomeHeading text-center">

	<?php if (currentUser()) {
  
    echo "<h1 style=\"margin-top:15px\"> Welcome Back</h1><div>";
    echo "<h2 style=\" color:#FEA736; \">";
    echo currentUser()->username;
    echo "</h2></div>";
  }else {
  echo "<h1 style=\"margin-top:15px\"> Welcome to the <div>Website </div></h1>";
  }

  ?>
 
  

</div>
</div>

<?php $this->end(); ?>
