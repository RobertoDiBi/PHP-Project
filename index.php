<?php
    include 'classes/MovieAPI.php';
    include 'classes/Database.php';
    include 'classes/Movie.php';
    include 'classes/Review.php';
    include 'classes/User.php';
    include 'classes/Seat.php';
    include 'classes/SeatBooked.php';
    
    $cookie="";
    if(isset($_COOKIE['userLogin'])){
        $cookie = $_COOKIE['userLogin'];
        
    }
    
    $cookie = stripcslashes($cookie);
    $loggedin_user = json_decode($cookie, true);
    if($loggedin_user != null && $loggedin_user !=''){
        session_start();
        $login = 'succ';
    }

    // Logout
    if (isset($_GET['signout'])) {
        session_destroy();
        unset($_COOKIE['userLogin']);
        unset($_SESSION['username']);
    }
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Gutzo's Tomatoes
            <?php 
                if(isset($_GET['content'])){
                switch ($_GET['content']){
                    case 'home':
                        echo '| Home';
                    break;
                    case 'movies':
                    case 'movie-info':
                        echo '| Movies';
                    break;
                    case 'our-cinema':
                            echo '| Our Cinema';
                        break;
                    case 'login':
                            echo '| Login';
                        break;
                    case 'registration':
                        echo '| Registration';
                        break;
                    case 'seatBooking':
                        echo '| Seat Selection';
                        break;
                    case 'reviewAndPay':
                        echo '| Review And Pay';
                        break;
                    case 'movie-info':
                        echo '| Movie Info';
                        break;
                    case 'site-map':
                        echo '| Site Map';
                        break;
                              
            }
                }else{
                echo '| Home';
            }
            ?>
        </title>
        <meta name="description" content="Gutzo's Tomatoes reviews score are the most trusted recommendation sources for quality entertainment." />
        <meta name="keywords" content="Movie,cinema, montreal, now playing,gutzo, tomatoes, review, movie review, top movies, best movies"/>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400,400i,700,700i,600,600i">
        <link href="https://fonts.googleapis.com/css?family=Exo+2" rel="stylesheet">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css" integrity="sha384-+d0P83n9kaQMCwj8F4RJB66tzIwOKmrdb46+porD/OvrJ+37WqIM7UoBtwHO6Nlg" crossorigin="anonymous">
        <link rel="stylesheet" href="assets/fonts/simple-line-icons.min.css">
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/css/mainStyle.css">
    </head>

    <body class="bodyStyle">
        <div class="container containerStyle">
            <nav class="navbar navbar-light navbar-expand-lg clean-navbar ">
                <div class="container "><a class="navbar-brand logo" href="index.php?content=home"><img src="assets/img/logos/Logo%20V1.png" class="img-fluid" width="350"/></a><button class="navbar-toggler " data-toggle="collapse" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
                    <div class="collapse navbar-collapse"
                         id="navcol-1">
                        <ul class="nav navbar-nav ml-auto navButton">
                            <?php
                            $content = '';
                            if (isset($_GET['content'])) {
                                $content = $_GET['content'];
                                //sanitize it for security reasons
                                $content = filter_var($content, FILTER_SANITIZE_STRING);
                            }
                            ?>
                            <li class="nav-item <?php if ($content == 'home' or empty($content)) {echo'active';} ?>" role="presentation">
                                <a class="nav-link" href="index.php?content=home">Home</a>
                            </li>
                            <li class="nav-item <?php if ($content == 'movies' || $content == 'movie-info' || $content == 'seatBooking') {echo'active';} ?>" role="presentation">
                                <a class="nav-link" href="index.php?content=movies">Movies</a>
                            </li>
                            <li class="nav-item <?php if ($content == 'our-cinema') {echo'active';} ?>" role="presentation">
                                <a class="nav-link" href="index.php?content=our-cinema">Our Cinema</a>
                            </li>
                            <?php if(!isset($_SESSION['username'])):?>
                            <li class="nav-item <?php if ($content == 'login') {echo'active';} ?>" role="presentation">
                                <a class="nav-link" href="index.php?content=login">Login</a>
                            </li>
                            <li class="nav-item <?php if ($content == 'registration') {echo'active';} ?>" role="presentation">
                                <a class="nav-link"href="index.php?content=registration">Register</a>
                            </li>
                            <?php else:?>
                            <li class="nav-item <?php if ($content == 'Sign out') {echo'active';} ?> dropdown" role="presentation" id="signOut">
                                <a class="nav-link dropdown-toggle" href="#" id="navbraDropdown" data-toggle="dropdown" aria-haspopup="false" aria-expanded="true">
                                  <?php echo trim($_COOKIE['userLogin'],"\"");?>
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="<?php unset($_COOKIE['userLogin']); setcookie('userLogin', '', time() - 3600);
                                    echo 'index.php?content=home&signout=true';?>">Sign out</a></li>
				</ul>
                            </li>
                            
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </nav>
            <main class="page landing-page">
                <?php
                //set up the home page as default
                $content = (empty($content)) ? "home" : $content;
                //inclode the chosen page
                include 'content/' . $content . '.php';
                ?>
            </main><!-- end content -->
        </div>
        <footer class="page-footer dark"id="myFooter">
            <div class="container">
                <div>
                    
                </div>
                <div class="row">
                    <div class="col-sm-6 col-md-3 col-lg-3">
                        <h5 class="darkGreen">Get Started</h5>
                        <ul>
                            <li><a href="index.php?content=home"><i class="fas fa-home darkGreen"></i> Home</a></li>
                            <li><a href="index.php?content=movies"><i class="fas fa-film"></i> Movies<span class="glyphicon glyphicon-envelope"></span></a></li>
                            <li><a href="index.php?content=login"><i class="fas fa-sign-in-alt"></i> Login</a></li>
                            <li><a href="index.php?content=site-map"><i class="fas fa-sitemap"></i> Site Map</a></li>
                        </ul>
                    </div>
                    <div class="col-sm-6  col-md-3 col-lg-3">
                        <h5>About us</h5>
                        <ul>
                            <li><a href="index.php?content=our-cinema">Our Cinema</a></li>
                            <li><a href="index.php?content=our-cinema#gallery">Gallery</a></li>
                            <li><a href="index.php?content=our-cinema">Contact us</a></li>
                            
                        </ul>
                    </div>

                    <div class="col-sm-12 col-md-6 col-lg-6">
                        <div class="social-networks">
                            <a href="https://twitter.com/" target="blank" class="twitter"><i class="fab fa-twitter"></i></a>
                            <a href="https://www.facebook.com/" target="blank" class="facebook"><i class="fab fa-facebook-square"></i></a>
                            <a href="https://www.instagram.com/" target="blank" class="instagram"><i class="fab fa-instagram"></i></a>
                            <a href="https://www.snapchat.com/" target="blank" class="snapchat"><i class="fab fa-snapchat-ghost"></i></a>
                            <a href="https://plus.google.com/discover" target="blank" class="google"><i class="fab fa-google-plus-g"></i></a>
                        </div>
                        <a class="navbar-brand logo" href="index.php?content=home"><img class="img-fluid" src="assets/img/logos/Logo%20V1.png" width=""/></a>
                    </div>
                    <div class="col-sm-2"></div>
                </div>
            </div>
            <div class="footer-copyright">
                <p>© 2018 Copyright - All rights reserved to: Roberto Di Biase</p>
            </div>
        </footer>


        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/js/theme.js"></script>
        <script>           
            var lastChecked;
            var totSelected = parseInt(document.getElementById("totSelected").innerText);
            
            var $checks = $('input:checkbox').change(function(e) {
                var numChecked = $checks.filter(':checked').length;
                
                
                if(totSelected === numChecked){
                    $('#review').prop('disabled', false);
                    alert("All seat selected. \nIf you want to change seats select a different one, otherwise click Review and Pay.")
                }
                
                if(numChecked <= totSelected){
                    $("#totTickets").text(numChecked+"/"+ totSelected);
                }
                
                if (numChecked > totSelected) {
                    //alert("sorry, you have already selected 3 checkboxes!");
                    lastChecked.checked = false; 
                }
                lastChecked = this; 
                
                if(numChecked < totSelected){
                   $('#review').prop('disabled', true); 
                }
               
            });
            
            
            
            $('confirmPurchase').submit(function(e) {
                
                
                alert("Your seats are successfully reserved.\n You will be redirected to the Home page.");
                
                if($('confirmPurchase').is(":disabled")){
                    alert("You must agree our Terms and Conditions in order to proceed");
                }
            });
           
        </script>

    </body>
</html>