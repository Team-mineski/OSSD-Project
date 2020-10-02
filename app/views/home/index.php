<?php $this->setSiteTitle('Home'); ?>

<?php $this->start('body'); ?>



<!-- <div class="landing">
  <div class="home-wrap">
    <div  class="home-inner">

    </div>

  </div>

</div> -->

<div class="container mainbodyAdmin">
<div class="welcomeHeading text-center">
	<h1 style="padding:20px"><?php if (currentUser()) {
    echo currentUser()->username;
  }else {
    echo "";
  }

  ?>
  </h1>
  <h1>
  Welcome to the website</h1>

</div>
</div>

<?php $this->end(); ?>
