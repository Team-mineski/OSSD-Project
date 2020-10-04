<!DOCTYPE html>
<html lang="en">
  <head>
   
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
   
    <script src="../../js/jQuery-2.2.4.min.js"></script>
    <script src="../../js/bootstrap.min.js"></script>
    <link rel = "stylesheet" href = "../../bootstrap/css/bootstrap.min.css" integrity="" crossorigin="anonymous">
    <link rel = "stylesheet" href = "../../css/mainStyles.css">
    <!-- <link rel="stylesheet" media="screen" href="../../css/styles.css"> -->


  


  </head>


      <nav class="navbar navbar-expand-md ">
      <a class="navbar-brand" href="<?=PROOT?>home"><img src="../../../css/hoslogo.png"></a>


    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#doc_menu" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon">
    </span>
  </button>
    <div class="navbar-header">
        <div align='start' class = "mainHeading"> LADY RIDGEWAY HOSPITAL FOR CHILDREN, COLOMBO  </div>
        <div align='start' class= "mainSubHeading"> DERMATOLOGY CLINIC </div>
    </div>

		<div class="collapse navbar-collapse" id="doc_menu">
			<ul class="navbar-nav ml-auto dropdown">
				<li class="nav-item">
					<a class="nav-link" href="\Tuto\" >Home</a>
        </li>
                
				<li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" 
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Tools
            </a>
                   
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="nav-link dropdown-item" href="/Tuto/app/views/NewPatient/NewPatientForm.php" style ="color:green">New Patient</a>
              <a class="nav-link dropdown-item" href="/Tuto/app/views/Searching.php">Update Patient</a>
              <a class="nav-link dropdown-item" href="/Tuto/app/views/Filtering/FilterBar.php">Filter Patients</a>
              <a class="nav-link dropdown-item" href="/Tuto/app/views/DischargedPatient/Intermediate.php">View Discharged Patients</a>
            </div>

        </li>
                     
                <li class="nav-item dropdown">
					<a class="nav-link" href="/Tuto/register/logout">logout</a>
				</li>

                
			</ul>
		
	</nav>
     
 
</html>
