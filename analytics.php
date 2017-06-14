<?php
//This is the file contains the HTML for the Analyse page. Next to the normal navbar, there are only divs that are addressed by the chart.js file
include('db_connection.php');
include('db_functions.php');
include('php/chartdata.php');
include("php/SQLfunctions.php");

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">


        <title>Your Analytics Page</title>

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
                        <li class="active"><a href="analytics.php">Analyse</a></li>
                        <li><a href="personal.php">Contribute</a></li>
                    </ul>
                </div>
                <!--/.nav-collapse -->
            </div>
        </nav>

        <section id="title-bar">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h1>Compare cities and countries with CCTLI Analytics</h1>
                        <p>Look through the charts to get a more comprehensive understanding of differences and similarities between cities and countries</p>
                        <p </div>
                    </div>
                </div>
        </section>
        <!-- End of Title-bar section -->





        <section id="firstsection">
            <div class="jumbotron" id="personalJumbotron">
                <div class="container">
                    <div class="row">
                        <h4>This Chart lets you easily identify cheap and expensives places based on the Nomadlist's monthly living costs in US Dollar</h4>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div id="CostChart"></div>
                        </div>
                    </div>
                    <div class="row">
                        <h4>This Chart displays the safty score of places baed on Nomadlist, with 100 being the best, meaning safest, score.</h4>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div id="SafetyChart"></div>
                        </div>
                    </div>
                    <div class="row">
                        <h4>This Chart shows the Internetspeed in MPES based on Nomadlist's data</h4>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div id="InternetChart"></div>
                        </div>
                    </div>
                    <div class="row">
                        <h4>Lastly you can select three countries and compare their Human Development Index over the period 1990 - 2015. The data comes from the world bank</h4>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <select id="countryOne">
	<option value="thailand">Thailand</option>
	<option value=hungary">Hungary</option>
	<option value=unitedstates">United States</option>
	<option value="portugal">Portugal</option>
	<option value="spain">Spain</option>
	<option value="czechrepublic">Czech Republic</option>
	<option value="indonesia">Indonesia</option>
	</select>


                            <select id="countryTwo">
	<option value="thailand">Thailand</option>
	<option value="hungary">Hungary</option>
	<option value="unitedstates">United States</option>
	<option value="vietnam">Vietnam</option>
	<option value="portugal">Portugal</option>
	<option value="spain">Spain</option>
	<option value="czechrepublic">Czech Republic</option>
	<option value="indonesia">Indonesia</option>
	</select>

                            <select id="countryThree">
	<option value="thailand">Thailand</option>
	<option value="hungary">Hungary</option>
	<option value="unitedstates">United States</option>
	<option value="vietnam">Vietnam</option>
	<option value="portugal">Portugal</option>
	<option value="spain">Spain</option>
	<option value="czechrepublic">Czech Republic</option>
	<option value="indonesia">Indonesia</option>
	</select>
                            <button id="showHDI" type="button">Compare HDI</button>
                            <button id="hideHDI" type="button" style="display:none" ">Reload to show other comparision" </button>
                </div>
            </div>
			<div class="row ">
                <div class="col-md-12 ">
                 <div id="HdiChart " ></div>
                </div>
            </div>
            <div class="row ">
                <div class="col-md-8 ">

                   </div>
                   </div>
        </div>
        </div>
    </section>


    <footer>
        <div class="container ">
            <div class="row ">
                <div class="col-md-6 ">
                  <ul>
                <li><a href="index.php ">Discover</a></li>
                <li><a href="analytics.php ">Analyse</a></li>
				<li><a href="personal.php ">Contribute</a></li>
                  </ul>
                </div>
                <div class="col-md-6 ">
				<p>Coursework for INSTG033 from University College London </p>
                  <p>Copyright &copy; 2017, All Rights reserved </p>
                </div>
            </div>
        </div>

    </footer>

    <!-- Jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js "></script>

  <!-- Raphael JS and Morris JS required for generating the graphs -->
<script src='https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.2/raphael-min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.0/morris.min.js'></script>
  <!-- Javascript file that contains the js of the charts-->
	<script src="js/charts.js "></script>



</body>

</html>
