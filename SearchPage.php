<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
session_start();



?>
<html>
    <head>
        <title>Health Prediction App</title>
        <link rel="icon" href="images/icon.png">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
      <link rel="stylesheet" type="text/css" href="css/materialize.css"/>
        <!-- <link rel="stylesheet" type="text/css" href="css/style.css"/> -->
        <link rel="stylesheet" type="text/css" href="icons/icons.css"/>
                 <link rel="stylesheet" type="text/css" href="css/stylesheet-about.css">
        <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
         <link rel="stylesheet" type="text/css" href="css/animate.min.css">
        <script src="js/jquery-3.1.1.min.js"></script>
        <script src="js/materialize.js"></script>
        <script src="js/newjavascript.js"></script>
    </head>
    <body>
        <div class="navbar-fixed"> 
  <nav>
    <div class="nav-wrapper">
      <a href="My_Profile.php" class="brand-logo"><img class="responsive-img" alt="header" src="images/Logo.png" /></a>
      <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
      <ul class="right hide-on-med-and-down">
          <li><a href="userhistory.php">User History</a></li>
         <li><a href="aboutus.php">About Us</a></li>
        <li><a href="contactus.php">Contact Us</a></li>
        <li><a href="logout.php">Log Out</a></li>
      </ul>
      <ul class="side-nav" id="mobile-demo">
         <li><div class="userView">
      <div class="background">
        <img src="images/office.jpg">
      </div>
      <a href="#!user"><img class="circle" src="images/Unknown_Person.png"></a>
<a href="#!name"><span class="white-text name"><img class="circle" src="images/Unknown_Person.png"></span></a>
      <a href="#!email"><span class="white-text email"><?php echo $_SESSION['e_mail']; ?></span></a>
    </div></li>
    <li><a href="userhistory.php">User History</a></li>
    <li><a href="aboutus.php">About Us</a></li>
    <li><a href="contactus.php">Contact Us</a></li>
    <li><div class="divider"></div></li>
   <li><a href="logout.php">Log Out</a></li>
      </ul>
      
    </div>
  </nav>
         </div>
        <?php
			
			$hostname = "localhost";
			$username = "root";
			$password = "";
			$databaseName = "healthapp";
			
			$connect = mysqli_connect($hostname, $username, $password, $databaseName);
			
			if(mysqli_connect_errno())
			{
				echo "Failed to connect: ".mysqli_connect_errno(); 
			}
			
		?>
        <br>

    <div class="row">
    <form action="SearchPage.php" class="col s12" method="post">
        <div class="row">
    <div class="input-field col s12">

    <select name="regions">
      <option value="" disabled selected>Choose the region of the pain</option>
      <option value="1">General</option>
      <option value="2">Head</option>
      <option value="3">Hair</option>
      <option value="4">Ears</option>
      <option value="5">Orbital</option>
      <option value="6">Nasal</option>
      <option value="7">Oral</option>
      <option value="8">Neck</option>
      <option value="9">Buccal</option>
      <option value="10">Acromial</option>
      <option value="11">Axillary</option>
      <option value="12">Thoracic</option>
      <option value="13">Arms</option>
      <option value="14">Abdominal</option>
      <option value="15">Back</option>
      <option value="16">Legs</option>
      <option value="17">Femoral</option>
      <option value="18">Joints</option>
      <option value="19">Feet</option>
      <option value="20">Hands</option>
      <option value="21">Pubic</option>
      <option value="22">Skin</option>
      <option value="23">Mind</option>
      <option value="24">Blood</option>
      <option value="25">Respiratory device</option>
      <option value="26">Vocal cords</option>

		  <?php
		   
			$region = $_POST['regions'];
			echo "selected value is " .$region;
			$query = "SELECT symptom_name FROM symptoms WHERE region_id = '$region'";
			$result_symp = mysqli_query($connect, $query);
			
			
	  ?>

    </select>

	 <label>Choose the Region:</label>
        <input type="submit" name="submit" value="Search Symptoms" class="btn waves-effect waves-light btn"/>
  </div>



            <?php
			if($_GET){
				if(isset($_GET['submit'])){
					submit();
				}
			}

			function submit()
				{
				echo "selected value is " .$region;
				$query = "SELECT symptom_name FROM symptoms WHERE region_id = '$region'";
				$result_symp = mysqli_query($connect, $query);
				}
			?>
            


    <div class="input-field col s12">

       <br>

      <select multiple name="symptoms[]">

      <option value="" disabled selected>Choose Symptom(s)</option>


	  <?php while($row1 = mysqli_fetch_array($result_symp)):;?>

      <option>   <?php echo $row1[0]; ?>   </option>

	  <?php endwhile;?>

    </select>

        <br>

    <label>Choose the Symptoms: </label>

	<input type="submit" name="add_symptoms" value="Add Symptoms" class="btn waves-effect waves-light btn"/>
  <?php

    if($_POST){
			if(isset($_POST['add_symptoms']))
			{
					addSymptoms();
			}
    }
			
			function addSymptoms()
      {
        if(isset($_POST['symptoms'])){

        if(is_array($_POST['symptoms']))
        {
           foreach($_POST['symptoms'] as $selected_symptom) {
            $symp_data = "$selected_symptom%";
            $_SESSION['symp_data'] = $_SESSION['symp_data'] . $selected_symptom."%";
           }
           echo "<h5 style='color:blue;'>Your symptoms have been added successfully.</h5>";
        }
      
      }
      else
      {
      echo "<h5 style='color:red;'> Please, choose at least one symptom to add from the symptoms dropdown !</h5>";

      }
    }
  ?>
	</div>
        </div>





   <center>
  <input type="submit" name="diagnose" value="Diagnose!" class="btn waves-effect waves-light btn"/>

       <?php


    if(isset($_POST['diagnose']))
      {
          check_symptoms_count();
      }
       
       function check_symptoms_count(){

        if(count(str_split($_SESSION['symp_data']) ) >= 2)
        {
         echo "<script>location.href='results.php';</script>";
 
        }
        else
        {
        $_SESSION['symp_data'] ="";

      echo "<h4 style='color:red;'> Please, enter at least 2 symptoms to get some results !</h4>";
             
  }
}

  ?>



  </center>



    </form>

    </div>
        
        
     
        <!-- The Footer-->
        
        <div class="home_h">
        <footer class="page-footer">
          <div class="container">
            <div class="row">

                <div class="col-md-6 col-sm-6 col-xs-12">
                    
                    <h2>follow us on <i class="fa fa-thumbs-o-up animated infinite tada" aria-hidden="true"></i></h2>
                </div>
              <div class="col l4 offset-l2 s12">
                
                <ul>
                    <li><a class="grey-text text-lighten-3" href="#!"><i class="fa fa-facebook-official" aria-hidden="true"></i> Follow Us on Facebook</a></li>
                    <li><a class="grey-text text-lighten-3" href="#!"><i class="fa fa-instagram" aria-hidden="true"></i> Follow Us on Instagram</a></li>
                   
                </ul>
              </div>
            </div>
          </div>
          <div class="footer-copyright">
            <div class="container">
             Copyright © 2017 SHPS
            </div>
          </div>
        </footer>
    </div>
        
        
        
        
        
        
        <!-- The End of The Footer-->
        
        

    </body>
</html>
