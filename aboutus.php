<?php
session_start();
?>
<!DOCTYPE html>

<html class='home_h'>
     <head>
        <title>Health Prediction App</title>
        <link rel="icon" href="images/icon.png">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
         <!-- <link rel="stylesheet" type="text/css" href="css/style.css"/> -->
         <link rel="stylesheet" type="text/css" href="icons/icons.css"/>
         <link rel="stylesheet" type="text/css" href="css/stylesheet-about.css">
        <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
         <link rel="stylesheet" type="text/css" href="css/animate.min.css">
         <link rel="stylesheet" type="text/css" href="css/materialize.css"/>
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
        
        
        
        
        <!-- Start About Section --> 
<section class="about wow bounceInUp" data-wow-duration="2s" data-wow-offset="300" id="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-title"><i class="fa fa-info-circle" aria-hidden="true"></i> <span> about</span></h2>
                    <p class="lead">Let's find the play makers details</p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <ul class="timeline">
                        <li>
                            <div class="timeline-image wow bounceInDown" data-wow-duration="2s" data-wow-offset="320">
                                <img class="img-circle img-responsive" src="images//1.jpg" alt="">
                            </div>
                            <div class="timeline-panel">
                                <div class="timeline-heading">
                                    <h4 class="subheading">The Team</h4>
                                </div>
                                <div class="timeline-body">
                                    <p class="text-body">Our SuperB team that was capable of working around any problem to achieve  the amazing results</p>
                                </div>
                            </div>
                        </li>
                        <li class="timeline-inverted">
                            <div class="timeline-image wow bounceInLeft" data-wow-duration="2s" data-wow-offset="340">
                                <img class="img-circle img-responsive" src="images/2.png" alt="">
                            </div>
                            <div class="timeline-panel">
                                <div class="timeline-heading">
                                    <h4 class="subheading">The idea</h4>
                                </div>
                                <div class="timeline-body">
                                    <p class="text-body">The idea and the determination to achieve it will never die</p>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="timeline-image wow bounceInRight" data-wow-duration="2s" data-wow-offset="360">
                                <img class="img-circle img-responsive" src="images/3.jpg" alt="">
                            </div>
                            <div class="timeline-panel">
                                <div class="timeline-heading">
                                    <h4 class="subheading">the project</h4>
                                </div>
                                <div class="timeline-body">
                                    <p class="text-body">Having a doctor in your pocket is the dream of each person, So Why Don't we make it real?</p>
                                </div>
                            </div>
                        </li>
                        <li class="timeline-inverted">
                            <div class="timeline-image wow bounceInUp" data-wow-duration="2s" data-wow-offset="380">
                                <img class="img-circle img-responsive" src="images/4.jpg" alt="">
                            </div>
                            <div class="timeline-panel">
                                <div class="timeline-heading">
                                    <h4 class="subheading">The Dream</h4>
                                </div>
                                <div class="timeline-body">
                                    <p class="text-body">DOn't say it is a dream, Say it is a Plan !</p>
                                </div>
                            </div>
                        </li>
                        <li class="timeline-inverted">
                            <div class="timeline-image">
                                <h4>Be Part
                                    <br>Of Our
                                    <br>Story!</h4>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
	<!-- End About Section -->
        <!-- The Footer-->
        
        
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
            
        
        
        
        
        
        
        <!-- The End of The Footer-->
<script src="js/jquery.nicescroll.min.js"></script>
<script src="js/script.js"></script>
<script src="js/wow.min.js"></script>
 <script src="js/jquery.newsTicker.min.js"></script>
 <script src="js/jquery.li-scroller.1.0.js"></script>

    </body>
</html>



