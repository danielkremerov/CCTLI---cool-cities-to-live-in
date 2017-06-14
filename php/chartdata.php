<?php
// ths code queries the database to retrieve the data for the different charts. It is outpttets as JSON
include('php/db_connection.php');
include('php/db_functions.php');




$query = "SELECT  * FROM hdi";
$query2 = "SELECT cityname, costofliving FROM basedata ORDER by costofliving DESC ";
$query3 = " SELECT cityname, safety FROM basedata ORDER By safety DESC";
$query4 = " SELECT cityname, internetspeed FROM basedata ORDER By internetspeed DESC";

// store results in an php array
$results = db_assocArrayAll($dbh,$query);
$results2 = db_assocArrayAll($dbh,$query2);
$results3 = db_assocArrayAll($dbh,$query3);
$results4 = db_assocArrayAll($dbh,$query4);

// transform it the php array to a JSON array and store in the js varaible commentList --> from here the data can be handeld with php in chart.js
echo "<script type='text/javascript'>";
echo "var hdi = ".json_encode($results,JSON_NUMERIC_CHECK);
echo "</script>";

echo "<script type='text/javascript'>";
echo "var costOfLiving = ".json_encode($results2,JSON_NUMERIC_CHECK);
echo "</script>";

echo "<script type='text/javascript'>";
echo "var safety = ".json_encode($results3,JSON_NUMERIC_CHECK);
echo "</script>";

echo "<script type='text/javascript'>";
echo "var internetspeed = ".json_encode($results4,JSON_NUMERIC_CHECK);
echo "</script>";



?>
