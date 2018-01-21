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
        
        <div class="col-md-12">
    <div class="contact-info">
        <h4><span>Visit-Us</span></h4>
        <address>
            <span class="fa fa-map-marker fa-lg"></span>Ain Shams University Faculty of Engineering, Abdou Basha Square, Cairo<br>
            Egypt
        </address>
        <hr>
        <div>
            <h4><span>Email-Us</span></h4>
             <a href="mailto:example@example.com"><span class="fa fa fa-envelope fa-lg"></span>example@example.com</a>
            <a href="mailto:example@example.com"><span class="fa fa fa-envelope fa-lg"></span>example@example.com</a>
            <hr>
            <h4><span>Call-Us</span></h4>
            <p><span class="fa fa fa-phone fa-lg"></span>02-xxxx-xxxx</p>
            <p><span class="fa fa fa-phone fa-lg"></span>02-xxxx-xxxx</p>
            <hr>
            <h4><span>Follow-Us</span></h4>
            <a title="Follow Us on Facebook" href="#" target="_blank"><span class="fa fa-facebook-official fa-lg"></span>Facebook</a>
            <a title="Follow Us on Twitter" href="#" target="_blank"><span class="fa fa-twitter-square fa-lg"></span>Twitter</a>
            <a title="Follow Us on Instagram" href="#" target="_blank"><span class="fa fa-instagram fa-lg"></span>Instagram</a>
            <a title="Follow Us on Google-Plus" href="#" target="_blank"><span class="fa fa-google-plus-official fa-lg"></span>Google-Plus</a>
            <a title="Follow Us on Youtube" href="#" target="_blank"><span class="fa fa-youtube-square fa-lg"></span>Youtube</a>
            <a title="Follow Us on Linked-In" href="#" target="_blank"><span class="fa fa-linkedin-square fa-lg"></span>Linked In</a>
        </div>
    </div>  
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


