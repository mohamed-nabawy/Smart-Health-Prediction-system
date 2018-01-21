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
        
        
        
        
    <div class="row">
    <form action="Calculator.php" class="col s12" method="post">
        <div class="row">
    <div class="input-field col s12">
		Weight (in KGs): <input type="text" name="weight" id="weight"  >
		Height (in Meter): <input type="text" name="height" id="height" >
		<input type="submit" name="BMI" value="Calculate Body mass index"/>
		<?php
			if(isset($_POST['BMI']))
			{	
				$weight = $_POST['weight'];
				$height = $_POST['height'];
				$BMI = $weight/($height * $height);
				if($BMI >= "0" && $BMI < "16")
				{	echo nl2br("\n");
					echo "Severe Thinness range and Your BMI is: ".$BMI;
				}
				elseif($BMI >= "16" && $BMI < "17")
				{
					echo nl2br("\n");
					echo "Moderate Thinness range and Your BMI is: ".$BMI;
				}
				elseif($BMI >= "17" && $BMI < "18.5")
				{
					echo nl2br("\n");
					echo "Mild  Thinness range and Your BMI is: ".$BMI;
				}
				elseif($BMI >= "18.5" && $BMI < "25")
				{
					echo nl2br("\n");
					echo "Normal range and Your BMI is: ".$BMI;
				}
				elseif($BMI >= "25" && $BMI < "30")
				{
					echo nl2br("\n");
					echo "Overweight range and Your BMI is: ".$BMI;
				}					
				elseif($BMI >= "30" && $BMI < "35")
				{
					echo nl2br("\n");
					echo "Obese Class 1 range and Your BMI is: ".$BMI;	
				}
				elseif($BMI >= "35" && $BMI < "40")
				{
					echo nl2br("\n");
					echo "Obese Class 2 range and Your BMI is: ".$BMI;	
				}
				elseif($BMI >= "40")
				{
					echo nl2br("\n");
					echo "Obese Class 3 range and Your BMI is: ".$BMI;	
				}					
			}
		?>	

	</div>
	</div>
    </form>
    </div>  
 
    <div class="row">
    <form action="Calculator.php" class="col s12" method="post">
        <div class="row">
    <div class="input-field col s12">

		Height (in Centimeters): <input type="text" name="height_ideal" id="height" >
		<input type="submit" name="CIW" value="Calculate Ideal weight"/>
		<?php
			
			if(isset($_POST['CIW']))
			{	
				$height_ideal = $_POST['height_ideal'];
				$total_inches = round(($height_ideal/2.54),0);
				$inches = $total_inches - (5 * 12);
				$email = $_SESSION['e_mail'];
				
				$gender_query = "SELECT gender FROM users WHERE e_mail = '$email'";
				$genderquery = mysqli_query($connect, $gender_query);
				$row = mysqli_fetch_assoc($genderquery);
				$gender = $row["gender"];
				switch($gender)
				{
					case 'Male':
						$gender_ideal = 1;
					break;
					case 'Female':
						$gender_ideal = 2;
					break;						
				}
				if($gender_ideal == "1")
				{
					$Robinson = 52 + 1.9 * $inches;
					$Miller = 56.2 + 1.41 * $inches;
					$Hamwi = 48 + 2.7 * $inches;
					$Devine = 50 + 2.3 * $inches;
					$WHO_min = ($height_ideal /100) * ($height_ideal/100) * 18.5;
					$WHO_max = ($height_ideal /100) * ($height_ideal/100) * 25;
					echo nl2br("\n");
					echo "Based on the Robinson formula (1983), your ideal weight is ".$Robinson;
					echo nl2br("\n");
					echo "Based on the Miller formula (1983), your ideal weight is ".$Miller;
					echo nl2br("\n");
					echo "Based on the Devine formula (1974), your ideal weight is ".$Devine;
					echo nl2br("\n");
					echo "Based on the Hamwi formula (1964), your ideal weight is ".$Hamwi;
					echo nl2br("\n");
					echo 'Based on the healthy BMI recommendation, your recommended weight is '.$WHO_min.'-'.$WHO_max;
				}
				elseif($gender_ideal == "2")
				{
					$Robinson = 49 + 1.7 * $inches;
					$Miller = 53.1 + 1.36 * $inches;
					$Hamwi = 45.5 + 2.2 * $inches;
					$Devine = 45.5 + 2.3 * $inches;
					$WHO_min = ($height_ideal /100) * ($height_ideal/100) * 18.5;
					$WHO_max = ($height_ideal /100) * ($height_ideal/100) * 25;
					echo nl2br("\n");
					echo "Based on the Robinson formula (1983), your ideal weight is ".$Robinson;
					echo nl2br("\n");
					echo "Based on the Miller formula (1983), your ideal weight is ".$Miller;
					echo nl2br("\n");
					echo "Based on the Devine formula (1974), your ideal weight is ".$Devine;
					echo nl2br("\n");
					echo "Based on the Hamwi formula (1964), your ideal weight is ".$Hamwi;
					echo nl2br("\n");
					echo 'Based on the healthy BMI recommendation, your recommended weight is '.$WHO_min.'-'.$WHO_max;				
				}
			}
		?>	
	
	</div>
	</div>
    </form>
    </div>  
    <div class="row">
    <form action="Calculator.php" class="col s12" method="post">
        <div class="row">
    <div class="input-field col s12">

		Height (in Centimeters): <input type="text" name="height_fats" id="height_fats"  >
		Neck (in Centimeters): <input type="text" name="Neck" id="Neck" >
		Waist (in Centimeters): <input type="text" name="Waist" id="Waist" >
		Hip (in Centimeters): <input type="text" name="Hip" id="Hip" >
		<input type="submit" name="Fats" value="Calculate Body Fats"/>
		<?php
			if(isset($_POST['Fats']))
			{	
				$height_fats = $_POST['height_fats'];
				$Neck = $_POST['Neck'];
				$Waist = $_POST['Waist'];
				$Hip = $_POST['Hip'];
				$email = $_SESSION['e_mail'];
				
				$gender_query = "SELECT gender FROM users WHERE e_mail = '$email'";
				$genderquery = mysqli_query($connect, $gender_query);
				$row = mysqli_fetch_assoc($genderquery);
				$gender = $row["gender"];
				switch($gender)
				{
					case 'Male':
						$gender_fats = 1;
					break;
					case 'Female':
						$gender_fats = 2;
					break;						
				}				
				if($gender_fats == "1")
				{
					$Body_fats = 495/(1.0324 - 0.19077 * (log10($Waist - $Neck))+0.15456 * (log10($height_fats))) - 450;
					if($Body_fats >= 2 && $Body_fats <= 5)
					{
						echo nl2br("\n");
						echo 'Your Body fats = '.round($Body_fats,2).'% (Essential Fats)';
						echo nl2br("\n");
						echo "Calcuations are Based on U.S. Navy method.";
					}
					elseif($Body_fats > 5 && $Body_fats <= 13)
					{
						echo nl2br("\n");
						echo 'Your Body fats = '.round($Body_fats,2).'% (Athletes)';
						echo nl2br("\n");
						echo "Calcuations are Based on U.S. Navy method.";
						}
					elseif($Body_fats > 13 && $Body_fats <= 17)
					{
						echo nl2br("\n");
						echo 'Your Body fats = '.round($Body_fats,2).'% (Fitness)';
						echo nl2br("\n");
						echo "Calcuations are Based on U.S. Navy method.";
						}
					elseif($Body_fats > 17 && $Body_fats <= 25)
					{
						echo nl2br("\n");
						echo 'Your Body fats = '.round($Body_fats,2).'% (Acceptable)';
						echo nl2br("\n");
						echo "Calcuations are Based on U.S. Navy method.";
						}
					elseif($Body_fats > 25)
					{
						echo nl2br("\n");
						echo 'Your Body fats = '.round($Body_fats,2).'% (Obese)';
						echo nl2br("\n");
						echo "Calcuations are Based on U.S. Navy method.";
					}
				}
				elseif($gender_fats == "2")
				{
					$Body_fats = 495/(1.29579-0.35004 * (log10($Waist + $Hip - $Neck))+0.22100 * (log10($height_fats)) - 450);
					if($Body_fats >= 12 && $Body_fats <= 15)
					{
						echo nl2br("\n");
						echo 'Your Body fats = '.round($Body_fats,2).'% (Essential Fats)';
						echo nl2br("\n");
						echo "Calcuations are Based on U.S. Navy method.";
					}
					elseif($Body_fats > 15 && $Body_fats <= 20)
					{
						echo nl2br("\n");
						echo 'Your Body fats = '.round($Body_fats,2).'% (Athletes)';
						echo nl2br("\n");
						echo "Calcuations are Based on U.S. Navy method.";
					}
					elseif($Body_fats > 20 && $Body_fats <= 24)
					{
						echo nl2br("\n");
						echo 'Your Body fats = '.round($Body_fats,2).'% (Fitness)';
						echo nl2br("\n");
						echo "Calcuations are Based on U.S. Navy method.";
					}
					elseif($Body_fats > 24 && $Body_fats <= 31)
					{
						echo nl2br("\n");
						echo 'Your Body fats = '.round($Body_fats,2).'% (Acceptable)';
						echo nl2br("\n");
						echo "Calcuations are Based on U.S. Navy method.";
					}
					elseif($Body_fats > 31)
					{
						echo nl2br("\n");
						echo 'Your Body fats = '.round($Body_fats,2).'% (Obese)';
						echo nl2br("\n");
						echo "Calcuations are Based on U.S. Navy method.";
					}
					}
			}
		?>	
	</div>
	</div>
    </form>
    </div> 
    <div class="row">
    <form action="Calculator.php" class="col s12" method="post">
        <div class="row">
    <div class="input-field col s12">

		Height (in Centimeters): <input type="text" name="height_bmr" id="height_bmr" >
		Weight (in KGs): <input type="text" name="weight_bmr" id="weight_bmr" >
		<input type="submit" name="BMR" value="Calculate required calories"/>
		<?php
			
			if(isset($_POST['BMR']))
			{	
				$height_bmr = $_POST['height_bmr'];
				$weight_bmr = $_POST['weight_bmr'];
				
				
				$email = $_SESSION['e_mail'];
				
				$gender_query = "SELECT gender FROM users WHERE e_mail = '$email'";
				$genderquery = mysqli_query($connect, $gender_query);
				$row = mysqli_fetch_assoc($genderquery);
				$Gender = $row["gender"];
				switch($Gender)
				{
					case 'Male':
						$gender_bmr = 1;
					break;
					case 'Female':
						$gender_bmr = 2;
					break;						
				}	
				$age_query = "SELECT DOB FROM users WHERE e_mail = '$email'";
				$DOB_query = mysqli_query($connect, $age_query);
				$row = mysqli_fetch_assoc($DOB_query);
				$DOB = new DateTime($row["DOB"]);
				$cDate=new DateTime();
				$age=$cDate->format("Y")-$DOB->format("Y");

				
				if($gender_bmr == "1")
				{
					$BMR = 10 * $weight_bmr + 6.25 * $height_bmr  - 5 * $age +5;
					echo nl2br("\n");
					echo 'Your body needs '.round($BMR,0).' Calories/Day to maintain your weight';

				}
				elseif($gender_bmr == "2")
				{
					$BMR = 10 * $weight_bmr + 6.25 * $height_bmr  - 5 * $age + 161;
					echo 'Your body needs '.round($BMR,0).' Calories/Day to maintain your weight';
				}
			}
		?>	
	
	</div>
	</div>
    </form>
    </div>  	
    </body>
</html>
