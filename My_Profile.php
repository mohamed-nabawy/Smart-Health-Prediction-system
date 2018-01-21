<?php
session_start();
?>
<html class="home">
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
       <!-- <link href='https://fonts.google.com/?category=Serif,Sans+Serif,Monospace&selection.family=Roboto+Slab' rel='stylesheet'>
        <link href='https://fonts.googleapis.com/css?family=Lobster' rel='stylesheet'> -->
        <script>
              $(document).ready(function(){
          // the "href" attribute of the modal trigger must specify the modal ID that wants to be triggered
             $('.modal').modal();
                });
        </script>
        
     
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
       
        <div class="back">
            <h1>Welcome,  <?php echo $_SESSION['first_name']; ?> <?php echo $_SESSION['last_name']; ?></h1>
        </div>
     <div id="index-banner" class="parallax-container">
    <div class="section no-pad-bot">
      <div class="container">
        <br><br>
        <h1 class="header center teal-text text-lighten-2">Search with Symptoms</h1>
        <div class="row center">
          <h5 class="header col s12 light">A simple System that will by a magical way</h5>
          <h5 class="header col s12 light">diagnoses your case in few Seconds</h5>
        </div>
        <div class="row center">
            <a href="SearchPage.php" id="download-button" class="btn-large waves-effect waves-light teal lighten-1">Search</a>
        </div>
        <br><br>

      </div>
    </div>
              <div class="parallax"><img src="images/best-doctors.jpg" alt="Unsplashed background img 1"></div>
  </div>
    
    <br> <br>
    
 
    
        <br> <br>
        
  <center>
              <div class="row">
          <div class="col s12 m12">
          <div class="card #26a69a teal lighten-1">
            <div class="card-content white-text">
              <span class="card-title">Medical News</span>
              <p>Want to know the news about medical new researches ?!</p>
            </div>
            <div class="card-action">
                <a href="http://www.medicalnewstoday.com/" target="_blank" >Visit Medical News Today</a>
            </div>
          </div>
        </div>
      </div>
        
     </center> 
    <center>
        <br><br>
  <!-- Modal Trigger -->
  <a class="waves-effect waves-light btn" href="#modal1">More tests about your health</a>

  <!-- Modal Structure -->
  <div id="modal1" class="modal bottom-sheet">
    <div class="modal-content">
      <h4>Diabetes</h4>
      <p>Here you can know the probability of affecting by Diabetes in the next 10 years by answering these questions  </p>
    </div>
    <div class="modal-footer">
        <a href="DiabetesTest.php" style="background-color: #26a69a; color: white;"  class="modal-action modal-close waves-effect waves-green btn-flat">Go</a>
    </div>
          <div class="modal-content">
      <h4>Body Calculator</h4>
      <p>Here you can Calculate your Body Mass Index, Ideal weight, Body Fats and Required Calories for your body </p>
    </div>
    <div class="modal-footer">
        <a href="Calculator.php" style="background-color: #26a69a; color: white;" class="modal-action modal-close waves-effect waves-green btn-flat">Go</a>
    </div>
  </div>
  
    </center>

    <br><br><br><br><br><br>
   
    
    
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