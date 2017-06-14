<?php
session_start();
//This file contains the HTML for the "Contribute page" including login and signup form, creating of new cities and comments
include("php/db_connection.php");
include("php/SQLfunctions.php");
// SQL functions that handle user creation and authorization
include("php/UserFunctions.php");?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">


        <title>Your Personal Page</title>

        <!-- Bootstrap core CSS -->
        <link href="css/bootstrap.css" rel="stylesheet">


        <!-- personal Stylesheet -->
        <link href="css/design.css" rel="stylesheet">

    </head>

    <body>

        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
                    <a class="navbar-brand brand-text" href="#">CCTLI</a>
                </div>
                <div id="navbar" class="collapse navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li><a href="index.php">Discover</a></li>
                        <li><a href="analytics.php">Analyse</a></li>
                        <li class="active"><a href="personal.php">Contribute</a></li>
                    </ul>
                    <div id="loggedInuser">
                        <?php $test = $_SESSION['loggedInUser'];
						  echo $test; ?>
                    </div>

                </div>

            </div>
        </nav>

        <section id="title-bar">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h1>Your Personal CCTLI Page</h1>
                        <p>create an Account or Login to write comments and add new cool cities to the website</p>
                    </div>
                </div>
            </div>
        </section>

        <section id="personalpage">
            <div class="jumbotron" id="personalJumbotron">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <h2>Login if you already have an account</h2>
                            </div>
                            <div class="row">
                                <form class="Login" action="personal.php" method="post">
                                    <input type="email" name="EmailLogin" placeholder="Enter Email Address" required>
                                    <input type="text" name="PasswordLogin" placeholder="Enter your Password" required>
                                    <button type="submit" name="LoginButton">Login</button>
                                </form>

                                <?php if(isset($_POST['LoginButton'])){

                      $email = $_POST['EmailLogin'];
                      $password = $_POST['PasswordLogin'];
                     loginUser($email,$password);
                    } ?>
                            </div>
                            <div class="row">
                                <h2>Otherwise Register a new account</h2>
                            </div>
                            <div class="row">
                                <form class="Signup" action="personal.php" method="post">
                                    <input type="text" name="NameSignup" placeholder="Enter your Name" required>
                                    <input type="email" name="EmailSignup" placeholder="Enter Email Address" required>
                                    <input type="text" name="PasswordSignup" placeholder="Enter your Password" required>
                                    <button type="submit" name="SignUpButton">Sign Up</button>
                                </form>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <h2>Lived somewhere for a while? Help us to enrich our database </h2>
                                <h2>Enter details about a new city:</h2>
                                <div class="row">
                                    <form class="NewCity" action="personal.php" method="post">
                                        <input type="text" name="city" placeholder="City">
                                        <input type="text" name="country" placeholder="Country">
                                        <input type="text" name="continent" placeholder="Continent">
                                        <input type="text" name="cost" placeholder="Month. Living Cost ($)">
                                        <input type="text" name="temperature" placeholder="Yearly Temperature (&#8451;)">
                                        <input type="text" name="internet" placeholder="Internet Speed (mb/s)">
                                        <input type="text" name="safety" placeholder="Safety Score (Nomad)">
                                        <input type="text" name="latitude" placeholder="Latitude">
                                        <input type="text" name="longitude" placeholder="Longitude">
                                        <button type="submit" name="submitCountry">Submit</button>
                                    </form>
                                </div>
                                <h2>Enter Comments to an existing city:</h2>
                                <div class="row">
                                    <form class="NewComment" action="personal.php" method="post">
                                        <input type="text" name="name" placeholder="Your Name">
                                        <input type="text" name="city" placeholder="City">
                                        <input type="text" name="content" placeholder="Comment">
                                        <button type="submit" name="submitComment">Submit</button>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-8">

                        </div>
                    </div>
                </div>
            </div>
        </section>


        <footer>

            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <ul>
                            <li><a href="index.php">Discover</a></li>
                            <li><a href="analytics.php">Analyse</a></li>
                            <li><a href="personal.php">Contribute</a></li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <p>Coursework for INSTG033 from University College London </p>
                        <p>Copyright &copy; 2017, All Rights reserved </p>
                    </div>
                </div>
            </div>

            <?php if(isset($_POST['SignUpButton'])){
          $name = $_POST['NameSignup'];
          $email = $_POST['EmailSignup'];
          $password = $_POST['PasswordSignup'];
          Signup($name,$email,$password);
        } ?>

            <?php if(isset($_POST['submitComment'])){
          $name = $_POST['name'];
          $city = $_POST['city'];
          $content = $_POST['content'];
          insertComment($city,$content);
        } ?>

            <?php if(isset($_POST['submitCountry'])){
          $city = $_POST['city'];
          $country = $_POST['country'];
          $continent = $_POST['continent'];
          $cost = $_POST['cost'];
          $temperature = $_POST['temperature'];
          $internet = $_POST['internet'];
          $safety = $_POST['safety'];
          $latitude = $_POST['latitude'];
          $longitude = $_POST['longitude'];
          createnewCity($city,$country,$continent,$cost,$temperature,$internet,$safety,$latitude,$longitude);
        } ?>





        </footer>



        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="js/bootstrap.js"></script>

    </body>

    </html>
