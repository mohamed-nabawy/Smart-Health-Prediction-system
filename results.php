<?php
session_start();
?>
<!DOCTYPE html>
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



	<div   style="position:relative;min-height:1px;padding-right:15px;text-align:center;">


	<?php
  
if (is_file("results.png"))
  {
    unlink("results.png");
  }

	$email = $_SESSION['e_mail'];
		
	$userid_query = "SELECT user_id FROM users WHERE e_mail = '$email'";
	$useridquery = mysqli_query($connect, $userid_query);
	$row = mysqli_fetch_assoc($useridquery);
	$user_id = $row["user_id"];
  
	$output = shell_exec( 'echo '.$_SESSION['symp_data'].' | F:\Anaconda2\python mr.py '. $user_id);
  

  $_SESSION['symp_data'] = "";
	$stuff = json_decode($output);
  //$name = basename('results.png');


echo $output ;

	?>

	<br><br><br>
        
        <img src="results.png" alt="ice.jpg" >


  </div>
    
            <br><br><br><br><br><br><br><br><br><br><br>
                     <!-- The Footer-->
        
         <div class="home_h">
        <footer class="page-footer">
          <div class="container">
            <div class="row">
              <div class="col l6 s12">
                
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



      
