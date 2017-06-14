<?php
include('db_connection.php');
include('db_functions.php');

// depending on which query is triggered the map array is populated with different data (this is how the markes on the map eventually change)



if(isset($_POST['SubmitFilter'])){ // this if is triggered once submit is clicked

  $country = $_POST['CountrySelector'];
  $minTemp = (int)determineMinTemp($_POST['TemperatureSelector']);
  // the selected value is passed into a "helper" function  to retrieve the respective boundary value and casted to an explicit integer
  $maxTemp = (int)determineMaxTemp($_POST['TemperatureSelector']);
  $minCost = (int)determineMinCost($_POST['LivingCostSelector']);
  $maxCost = (int)determineMaxCost($_POST['LivingCostSelector']);
  $query = populateFilteredMarkers($country,$minTemp,$maxTemp,$minCost,$maxCost);
  // the five inputs are passed in an function in SQLfunctions.php to retrieve the respective inforomation
  }else {
   $query = "SELECT * from basedata";
} //default function t


    if(isset($_POST['searchSubmit'])){ // this if is triggered once submit is clicked

    $city = $_POST['searchInput'];
    $query = SearchbyCity($city); }


// this captures all the results as an array in PHP...
$results = db_assocArrayAll($dbh,$query);

// ...however, we want a Javascript array, for the rest of the Javascript to use
echo "<script type='text/javascript'>";
echo "var myData = ".json_encode($results,JSON_NUMERIC_CHECK);
echo "</script>";


?>
