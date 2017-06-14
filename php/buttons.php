<?php
/* this file contains the php code that is triggered when different buttons are pressed. The values from the respective form
are retrieved via a php POST and than passed further in php functions with database queries. Most functions return the
the variable $query where the respective query is stored and than on page reload is used.
*/

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
//   $query = populateAllMarkers();
} //default function t?>


   <?php if(isset($_POST['searchSubmit'])){ // this if is triggered once submit is clicked

    $city = $_POST['searchInput'];
    $query = SearchbyCity($city); }
    ?>

   

       <?php if(isset($_POST['LoginButton'])){
         echo "test";
         $email = $_POST['EmailLogin'];
         $password = $_POST['PasswordLogin'];
        loginUser($email,$password);
       } ?>
