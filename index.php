<?php
//This is the main file, containing the HTML of the "Discover" page, that contains the map, filters, comments, tour etc..

// establishing the session to be able to use the global php session variables
session_start();
// file that contains the db connection
include("php/db_connection.php");
// file that contains the standarized database access functions from the course
include("php/db_functions.php");
// file that contains other database access functions that I wrote
include("php/SQLfunctions.php");
// file that contains help functons for transfering input from the filters into the right format for database queries
include("php/HelpFunctions.php");
// file that retrieves the sql data for the map and returns it in JSON
include("php/mapdata.php");
// file that retrieves the sql data for the comments and returns it in JSON
include("php/commentdata.php");
 ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <title>CCTLI</title>
        <meta charset="utf-8">
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSS stylesheets -->

        <!-- Bootstrap core CSS -->
        <link href="css/bootstrap.css" rel="stylesheet">
        <!-- Leaflet CSS -->
        <link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet/v0.7.7/leaflet.css" />
        <!-- personal Stylesheet -->
        <link href="css/design.css" rel="stylesheet">
        <!--Choropleth layer Stylesheet -->
        <link href="css/hdilayer.css" rel="stylesheet">
        <!-- IntroJs library Stylesheet -->
        <link href="css/introjs.css" rel="stylesheet">

        <!-- CSS stylesheets end -->

        <!-- Javascript Files -->

        <!-- Jquery CDN-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
        <!-- Leaflet CDN -->
        <script src="http://cdn.leafletjs.com/leaflet/v0.7.7/leaflet.js"></script>
        <!-- Javascript Files containing request to Flickr API for "random photo" feature-->
        <script type="text/javascript" src="js/photo.js"></script>
        <!-- IntroJs library -->
        <script type="text/javascript" src="js/intro.js"></script>
        <!-- Geojson for Choropleth layer -->
        <script type="text/javascript" src="js/countries.js"></script>
        <!-- Choropleth layer Code -->
        <script type="text/javascript" src="js/HDILayer.js"></script>
        <!-- Custom Code for selectors -->
        <script src="js/country.js"></script>


        <title>Example using PHP</title>
        <meta charset="UTF-8">


        <body>

            <!-- start of Navbar -->
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
                            <li class="active"><a href="index.php">Discover</a></li>
                            <li><a href="analytics.php" data-step="7" data-intro=" The Analyise page enables you to compare countries and cities side-side using different graphs. ">Analyse</a></li>
                            <li><a href="personal.php" data-step="8" data-intro=" The Contribute page gives you the possibility to signup with a new account, log in to an existing account and contribute to the page by creating comments about cities or even adding whole new cities to our CCTLI database.">Contribute</a></li>
                        </ul>
                        <div id="loggedInuser">
                            <!--Display LoggedInUser -->
                            <?php $_SESSION['loggeInUser']; ?>
                        </div>

                    </div>
                    <!--/.nav-collapse -->
                </div>
            </nav>
            <!-- End of Navbar -->

            <!-- Start of Title-bar section -->
            <section id="title-bar">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <!-- Data step specified the (first) html element that is linked to the IntroJS library, data-intro specifies the text -->
                            <h1 data-step="1" data-intro="The goal of this website is to give people an opportunity to discover appealing cities for living and travelling as
							                     globalisation enables us to become Citizens of the World ">Welcome to CCTLI - Cool Cities to Live In </h1>
                            <p>This page helps people to find alternative places around the world to travel and stay for longer</p>
                            <!-- Button that triggers the IntroJs Libray for taking a tour-->
                            <a class="btn btn-large btn-success" href="javascript:void(0);" onclick="javascript:introJs().setOption('showProgress', true).start();">First time visitor? Press me - to have a website tour!</a>
                        </div>
                    </div>
            </section>
            <!-- End of Title-bar section -->

            <!-- Main Section Containing Map and Control Bar -->
            <section id="mapSection">
                <div id="wrapper" class="col-md-12">
                    <div id="controlColumn" class="col-md-2">
                        <div id="controlBar" class="container">
                            <div class="row">
                                <h4>Search city</h4>
                            </div>
                            <div class="row">
                                <div data-step="3" data-intro="This is the Control bar for the map: You can search a particular city from our database, or apply any combination of the three interactive filters to narrow down your selection." id="searchContainer" class="container">
                                    <!-- Search via Form element-->
                                    <form class="" action="index.php" method="post">
                                        <input type="text" name="searchInput" autocomplete="on" class="form-control" placeholder="Search by city" required>
                                </div>
                                <button type="submit" name="searchSubmit" class="btn btn-default">Search</span></button>
                                </form>
                            </div>

                            <div class="row">
                                <h4>Interactive filters</h4>
                                <p>pick one or more filters</p>
                            </div>
                            <!-- Form that contains three filters in dropdowns-->
                            <form action="index.php" method="post">
                                <div id="interactiveFilter" class="container">
                                    <div class="row">
                                        <label>Filter by Country</label>
                                    </div>
                                    <div id="filterRow" class="row">
                                        <div class="col-md-12">
                                            <!-- Country Dropdown -->
                                            <select id="CountrySelector" name="CountrySelector" class="selector"></select>
                                        </div>
                                    </div>
                                    <div class="row ">
                                        <!-- Temeperature Dropdown -->
                                        <label>Filter by Temperature</label>
                                        <div id="filterRow " class="row ">
                                            <div class="col-md-12 ">
                                                <select id="filterdropdown " class="selector " name="TemperatureSelector ">
      							<option value= " ">All</option>
      							<option value= "1 "> 0 - 10 &#8451;</option>
      							<option value= "2 ">10 - 20 &#8451;</option>
      							<option value= "3 ">20 - 30 &#8451;</option>
      							<option value= "4 ">30 - 40 &#8451;</option>
      							</select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row ">
                                        <!-- Living Cost Dropdown -->
                                        <label>Filter by Living Costs</label>
                                    </div>
                                    <div id="filterRow " class="row ">
                                        <div class="col-md-12 ">
                                            <select id="filterdropdown " class="selector " name="LivingCostSelector "> 	<!-- User has the option to select a range of costs (default is an empty value)-->
    							 <option value= " ">All</option>
    							 <option value= "1 "> 0 - 1000 $/month</option>
    							 <option value= "2 ">1000 - 2000 $/month</option>
    							 <option value= "3 ">2000 - 3000 $/month</option>
    							 <option value= "4 ">3000 - 4000 $/month</option>
    							 </select>
                                        </div>
                                    </div>
                                    <div class="row ">
                                        <!-- Button to submit selection of all filters  -->
                                        <button id="SubmitFilter " class="btn btn-default " type="submit " name="SubmitFilter ">Submit</button>
                                    </div>
                            </form>
                            <div class="row ">
                                <h4 data-step="4 " data-intro="This is a custom overlay of the Human Development Index of most countries in the world as a Choropleth Map. The HDI can help you to determine whether this country is worth considering for the longer
                                                term. In the Analytics section of the website, you can even compare countries side-by-side on the HDI, including the historical development (that can be used as a projection for the future) ">HDI Layer</h4>

                            </div>
                            <div class="row ">
                                <!-- Buttons triggering HDI Layer -->
                                <button id="hideHDI " type="button " style="display:none " onclick="location.reload(); ">Reload map</button>
                                <button id="showHDI " type="button ">Display HDI Layer on map</button>
                            </div>
                            <div class="row ">
                                <p></p>
                                <h4>Show Comments of Cities</h4>
                            </div>

                            <!-- Form to retrieve comments-->
                            <form class=" " action="index.php " method="post " data-step="5 " data-intro="Check out what other users of the website wrote about a particular city. On the Contribution page, you can also write your own comments, so other users can see them. ">

                                <input type="text " id="CommentHolder " name="CommentHolder " placeholder="Type City " required>
                                <button type="submit " name="showComment " class="btn btn-default ">ShowComment</span></button>
                            </form>
                            <p id="comments "></p>
                            </div>

                        </div>
                    </div>

                    <div id="mapColumn " class="col-md-10 ">
                        <!-- Div that contains the map-->
                        <div id="map "></div>
                        <div data-step="2 " data-intro=" The central element of the website is a world map. The map contains markers of the best places to live in according to nomadlist.com and our users. You can zoom in and out and click on the eyes to get interesting
                                                information about the cities. In addition on the right, you can select different layers, in order to see whether the places have appealing topographical attributes, crystal clear water for great times at the
                                                beach or amazing metropolis with a lot of light and action at night time. "></div>
                        <div class="row ">
                            <h5>click on marker to see a photo of the place</h5>
                        </div>
                    </div>

                </div>
            </section>
            <section id="bottomsection ">
                <div class="row ">
                    <div class="col-md-12 ">
                        <div class="col-md-6 ">
                            <p data-step="6 " data-intro=" After clicking on a marker, a photo of this place is displayed here. Note: this is a random photo from Flickr that is related to the selected city. CCTLI is not responsible for the content of the photos. "></p>

                            <h3 id="photoTitle "></h3>
                            <!-- Here the photo from the leaflet API is placed-->
                            <div id="photo " style="height:500px; width:800px; border: 2px solid black; align:center ">
                            </div>

                        </div>
                        <div class="col-md-6 ">
                            <!-- Further articles and refrences as list with links-->
                            <h3 id="referencelist " style="text-align:center ">Further articles related to the presented data</h3>
                            <ul id="listofreferences " class="list-group ">
                                <li class="list-group-item list-group-item-warning "><a href="https://www.forbes.com/sites/tanyamohn/2014/03/19/tips-for-becoming-a-successful-digital-nomad/#751f50d4416b ">For a more comprehensive understanding of a digital nomad, this article is might give more perspective on the use of the presented data</li>
  <li class="list-group-item list-group-item-warning "><a href ="http://futurelondon.cushmanwakefield.co.uk/wp-content/uploads/2017/01/Capital-Watch-Issue-03-2016_Future-of-Work.pdf ">This article about the future of work, might inspire to dive deeper in exploring different cities for living</li>
</ul>
     	<h3 id="referencelist " style="text-align:center ">List of Data references with links</h3>
		<ul id="listofreferences " class="list-group ">
  <li class="list-group-item list-group-item-warning "><a href ="https://www.nomadlist.com " > Information about Cities from Nomadlist.com</li>
  <li class="list-group-item list-group-item-warning "><a href ="http://hdr.undp.org/en/composite/HDI ">Data for the Human Development Index (1990 - 2015) from the World Bank</li>
    <li class="list-group-item list-group-item-warning "><a href ="http://www.latlong.net/ ">Coordinates of the cities</li>
	 <li class="list-group-item list-group-item-warning "><a href ="https://github.com/johan/world.geo.json/blob/master/countries.geo.json ">Geo.json coordinates for HDI layer</li>
	  <li class="list-group-item list-group-item-info "><a href ="mailto:daniel.kremerov.16@ucl.ac.uk ">For all questions please contact me: daniel.kremerov.16@ucl.ac.uk</li>


</ul>

   </div>
   </div>
   </section>



        </body>
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



                <!-- End of HTML - start of Javascript -->




                </footer>

    </html>

    <!-- File that contains the leaflet library -->
<script src="js/maplogic.js "></script>

    <script>
        // code for handeling the HDI button
        $(document).ready(function() {
            var myData = '<option selected="selected " value=" ">All</option>';

            for (var i = 0; i < jsonData.Table.length; i++) {
                myData += "<option value='" + jsonData.Table[i].Country + "'>" + jsonData.Table[i].Country + "</option>";
            }
            $("#CountrySelector").html(myData);
        });
        var mapIcon = document.getElementsByClassName('leaflet-marker-icon');
        for (i = 0; i <
            mapIcon.length; i++) {
            mapIcon.item(i).addEventListener("click", getCityName);
        }

        function getCityName() {
            var popup = d ocument.getElementsByClassName("city-name");
            var cityName = p opup[0].innerHTML;

            {
                var content = [commentList[item].content];
                document.getElementById('comments').innerHTML += (content + '<p>');
                console.log(name);
            }
            $(document).ready(function() {
                $("#showHDI").click(function() {
                    GeoJson();
                    $("#showHDI").hide();
                    $("#hideHDI").show();
                });
                $("#hideHDI").click(function() {
                    $("#showHDI").show();
                    $("#hideHDI").hide();
                });
            });
        }
    </script>
