
<!DOCTYPE html>
<html lang="en">
  <head>
   
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1">
   

    <link rel = "stylesheet" href = "./bootstrap/css/bootstrap.min.css" integrity="" crossorigin="anonymous">

    <link rel = "stylesheet" href = "./css/mainStyles.css">
    <link rel="stylesheet" media="screen" href="./css/labReportStyles.css">

  </head>

    <body class="mainbodyAdmin">
        <div class="container">
            <br>
            <div class="container labheading">
                <h5 align ="center">TEST REQUESTS</h5>

            </div>
            <br>
            

            <div  class="container testcontainer">
                <div class="row h-100 justify-content-center align-items-center">
                    <div class="col col-10 col-md-8 col-lg-6">
                    <?php
                    $acllab = $this->post;
                    
                    include "./pms/TestRequestLoader.controller.php";
                    ?>
                    </div>
                </div>

            </div>
              

        </div>

    
    

    </body>
</html>