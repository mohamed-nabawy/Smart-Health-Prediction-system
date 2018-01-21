<!DOCTYPE html>
<?php
session_start();
?>
<html>
    <head>
        <title>Health Prediction App</title>
        <link rel="icon" href="images/icon.png">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="css/stylesheet-about.css">
        <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
         <link rel="stylesheet" type="text/css" href="css/animate.min.css">
      <link rel="stylesheet" type="text/css" href="css/materialize.css"/>
        <!-- <link rel="stylesheet" type="text/css" href="css/style.css"/> -->
        <link rel="stylesheet" type="text/css" href="icons/icons.css"/>
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
      <a href="#!name"><span class="white-text name"><?php echo $_SESSION['first_name']; ?> <?php echo $_SESSION['last_name']; ?></span></a>
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
        
         <center>
        
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
		$total_points = 0;
			
		?>
    <div class="row">
    <form action="DiabetesTest.php" class="col s12" method="post">
        <div class="row">
    <div class="input-field col s12">
		  <?php
		   	$email = $_SESSION['e_mail'];
				
			$age_query = "SELECT DOB FROM users WHERE e_mail = '$email'";
			$DOB_query = mysqli_query($connect, $age_query);
			$row = mysqli_fetch_assoc($DOB_query);
			$DOB = new DateTime($row["DOB"]);
			$cDate=new DateTime();
			$age=$cDate->format("Y")-$DOB->format("Y");
			if($age >= 18 && $age <= 44)
			{
				$total_points += 0;
			}
			elseif($Body_fats > 44 && $Body_fats <= 54)
			{
				$total_points += 2;
			}
			elseif($Body_fats > 54 && $Body_fats <= 64)
			{
				$total_points += 3;
			}
			elseif($Body_fats > 64)
			{
				$total_points += 4;
			}
	  ?>
    <select name="BMI">
      <option value="" disabled selected>What is you Body Mass Index (Your weight in KGs)/(Your height in M²)?</option>
      <option value="0-25">0-25</option>
      <option value="26-30">26-30</option>
      <option value="31 or more">31 or more</option>
	  <?php	   

			switch($_POST['BMI'])
			{
				case '0-25':
					$total_points += 0;
				break;
				case '26-30':
					$total_points += 1;
				break;
				case '31 or more':
					$total_points += 3;
				break;							
			}			
	  ?>
	</select>
    <select name="WaistCirumference">
	<?php
	
		$email = $_SESSION['e_mail'];
		
		$gender_query = "SELECT gender FROM users WHERE e_mail = '$email'";
		$genderquery = mysqli_query($connect, $gender_query);
		$row = mysqli_fetch_assoc($genderquery);
		$gender = $row["gender"];
	?>
      <option value="" disabled selected>What's your waist circumference?</option>
      <option value="1"><?php if($gender == "Male") echo "0-94"; elseif($gender == "Female") echo "0-80"; ?></option>
      <option value="2"><?php if($gender == "Male") echo "95-102"; elseif($gender == "Female") echo "81-88"; ?></option>
      <option value="3"><?php if($gender == "Male") echo "103 or more"; elseif($gender == "Female") echo "89 or more"; ?></option>
	  <?php	   

		switch($_POST['WaistCirumference'])
			{
				case '1':
					$total_points += 0;
				break;
				case '2':
					$total_points += 3;
				break;
				case '3':
					$total_points += 4;
				break;							
			}			
	  ?>
	  </select>
    <select name="Exercise">
      <option value="" disabled selected>Do you exercise for 30 minutes daily?</option>
      <option value="Yes">Yes</option>
      <option value="No">No</option>
	  <?php	   

			switch($_POST['Exercise'])
			{
				case 'Yes':
					$total_points += 0;
				break;
				case 'No':
					$total_points += 2;
				break;						
			}			
	  ?>
	  </select>
    <select name="Food">
      <option value="" disabled selected>Do you eat vegetables and fruits daily?</option>
      <option value="Yes">Yes</option>
      <option value="No">No</option>
	  <?php	   

			switch($_POST['Food'])
			{
				case 'Yes':
					$total_points += 0;
				break;
				case 'No':
					$total_points += 2;
				break;						
			}			
	  ?>
	  </select>
    <select name="HTN">
      <option value="" disabled selected>Do you take any medicine for Hypertension?</option>
      <option value="Yes">Yes</option>
      <option value="No">No</option>
	  <?php	   

			switch($_POST['HTN'])
			{
				case 'Yes':
					$total_points += 2;
				break;
				case 'No':
					$total_points += 0;
				break;						
			}			
	  ?>
	  </select>
    <select name="Previous">
      <option value="" disabled selected>Have you ever had a high blood sugar concentration as a symptom to any other disease?</option>
      <option value="Yes">Yes</option>
      <option value="No">No</option>
	  <?php	   

			switch($_POST['Previous'])
			{
				case 'Yes':
					$total_points += 5;
				break;
				case 'No':
					$total_points += 0;
				break;						
			}			
	  ?>
	  </select>
    <select name="Relatives">
      <option value="" disabled selected>Do you have any relatives who are diagnosed with Diabetes?</option>
      <option value="Yes (First-degree)">Yes (First-degree)</option>
	  <option value="Yes (Second-degree)">Yes (Second-degree)</option>
      <option value="No">No</option>
	  <?php	   

			switch($_POST['Relatives'])
			{
				case 'Yes (First-degree)':
					$total_points += 5;
				break;
				case 'Yes (Second-degree)':
					$total_points += 3;
				break;
				case 'No':
					$total_points += 0;
				break;							
			}
	  ?>
	  </select>
    </div>
	<input type="submit" name="submit" value="Get Results" class="btn waves-effect waves-light btn" />
        
        <div id="diabetesresult">
            <br>
	<?php
		if(isset($_POST['submit']))
		{	
			if($total_points >= "0" && $total_points <= "14")
			{
					echo "The probability of being diagnosed with Diabetes in 10 years is 17%";
			}
			elseif($total_points >= "15" && $total_points <= "20")
			{
				echo "The probability of being diagnosed with Diabetes in 10 years is 33%";
			}
			elseif($total_points >= "21")
			{
				echo "The probability of being diagnosed with Diabetes in 10 years is 50%";
			}
		}
	?>
        </div>
	</div>

    </form>
    </div>  
    </center>  
    
    <!-- The Footer-->
        <div class='home_h'>
        
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
