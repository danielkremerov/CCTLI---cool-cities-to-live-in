<?php
// Main Php file containing differnet queries that are than returned to the main file.

session_start();
// basic query that is loaded on start rertieving all data for the mao
  function populateAllMarkers(){ // including search by country
                 $query= "SELECT * FROM basedata";


      return $query;
    }

// this functions makes sure that the correct combintion of the three interactive filters is used the query (as 1, 2 or all 3 filters can be triggered)
function populateFilteredMarkers($country,$minTemp,$maxTemp,$minCost,$maxCost){ // including search by country, temp filter and cost filter
       if($country!=""&& $maxTemp!=""&& $maxCost!=""){ // all 3 filters triggered
                           $query= "SELECT * FROM basedata WHERE basedata.Country = '$country' AND basedata.Temperature >= $minTemp AND basedata.Temperature <= $maxTemp AND basedata.CostOfLiving >= $minCost AND basedata.CostOfLiving <= $maxCost";
     }elseif ($country!=""&& $maxTemp!="") { //country and temp filter triggerd
       $query= "SELECT * FROM basedata WHERE basedata.Country = '$country' AND basedata.Temperature >= $minTemp AND basedata.Temperature <= $maxTemp ";
     }elseif ($country!=""&& $maxCost!="") { //country and cost filter triggered
       $query= "SELECT * FROM basedata WHERE basedata.Country = '$country' AND basedata.CostOfLiving >= $minCost AND basedata.CostOfLiving <= $maxCost";
     }elseif ($maxCost!=""&& $maxTemp!="") { // cost and temp filter triggerd
       $query= "SELECT * FROM basedata WHERE basedata.Temperature >= $minTemp AND basedata.Temperature <= $maxTemp AND basedata.CostOfLiving >= $minCost AND basedata.CostOfLiving <= $maxCost";
     }elseif ($country!="") {
       $query= "SELECT * FROM basedata WHERE basedata.Country = '$country'";
     }elseif ($maxCost!="") {
       $query= "SELECT * FROM basedata WHERE basedata.CostOfLiving >= $minCost AND basedata.CostOfLiving <= $maxCost";
     }elseif ($maxTemp!="") {
       $query= "SELECT * FROM basedata WHERE basedata.Temperature >= $minTemp AND basedata.Temperature <= $maxTemp";
     }else {
      $query= "SELECT * FROM basedata";
     }
  return $query;
}

// seperate function only for temeprature range
function populateMarkerTemperature($minTemp, $maxTemp){ // including search by country
        $query = "SELECT * FROM basedata WHERE temperature BETWEEN '$minTemp' AND '$maxTemp' ";

return $query;
}
// seperate function only for  cost range
function populateMarkerCost($minCost, $maxCost){ // including search by country
        $query = "SELECT * FROM basedata WHERE CostOfLiving BETWEEN '$minCost' AND '$maxCost' ";

return $query;
}


// function to populate the filter with distinct countries (stopped working in the final version )
function CountryFilter(){
  include("db_connection.php");

  $query= "SELECT DISTINCT Country FROM basedata";
    if ($result = pg_query($dhb, $query)) {
      // Loop through result
      while ($result = db_assocArrayAll($dhb, $query)):

        $Country[] = $result[0];

            endwhile;
            //store arrays in Session variables

           $_SESSION["Country"] =   $Country;

    }
    foreach(array_keys($_SESSION["Country"]) as $key) { ?>
  <option value= "<?php echo $_SESSION["Country"][$key];?>"><?php echo $_SESSION["Country"][$key]; ?></option>

<?php   }

}
// city search
function SearchbyCity($city){

  $query= "SELECT * FROM basedata Where CityName = '$city'";
      return $query;
    }




// retrieve comments (works differently through comentdata.php in final version)

function showComments($selectedCity){
 include("db_connection.php");

  $query = "SELECT Comment.CommentID, User.Name, Comment.Content, Comment.Timestamp FROM Comment
  LEFT JOIN User ON Comment.UserID = User.Id WHERE Comment.City ='$selectedCity'
  ORDER BY Comment.Timestamp DESC";

  //$query2 = "SELECT * FROM comment WHERE blogPostID = '$currentPost'";
  if ($result = pg_query($pg, $query)) {

    // Loop through result
    while ($row = pg_fetch_assoc($result)):

      $commentID[]  = $row['CommentID'];
      $commentUserName[] = $row['Name'];
      $commentTitle[] = $row['Title'];
      $commentContent[] = $row['Content'];
      $commentTimeStamp[] =$row['Timestamp'];



          endwhile;
          //store arrays in Session variables
         $_SESSION["commentID"] =  $commentID;
         $_SESSION["commentUserName"] =   $commentUserName;
         $_SESSION["Title"] =   $commentTitle;
         $_SESSION["Content"] =   $commentContent;
         $_SESSION["Timestamp"] =   $commentTimeStamp;?>

<?php foreach(array_keys($_SESSION["commentID"]) as $key) { ?>
<p><span class="badge"><?php echo $_SESSION["commentUserName"] [$key]; ?> commented: <?php   echo $_SESSION["Content"] [$key]; ?></span></p>

<?php   }}}

function showCommentsUser($userID){
 include("db_connection.php");

 $query = "SELECT Comment.City, Comment.CommentID, User.Name, Comment.Content, Comment.Timestamp FROM Comment
 LEFT JOIN User ON Comment.UserID = User.Id WHERE Comment.UserID ='$userID'
 ORDER BY Comment.Timestamp DESC";

  //$query2 = "SELECT * FROM comment WHERE blogPostID = '$currentPost'";
  if ($result = pg_query($pg, $query)) {

    // Loop through result
    while ($row = pg_fetch_assoc($result)):

      $commentID[]  = $row['CommentID'];
      $commentCity[]  = $row['City'];
      $commentUserName[] = $row['Name'];
      $commentTitle[] = $row['Title'];
      $commentContent[] = $row['Content'];
      $commentTimeStamp[] =$row['Timestamp'];



          endwhile;
          //store arrays in Session variables
         $_SESSION["commentID"] =  $commentID;
         $_SESSION["commentCity"] =  $commentCity;
         $_SESSION["commentUserName"] =   $commentUserName;
         $_SESSION["Title"] =   $commentTitle;
         $_SESSION["Content"] =   $commentContent;
         $_SESSION["Timestamp"] =   $commentTimeStamp;?>

<?php foreach(array_keys($_SESSION["commentID"]) as $key) { ?>
<p><?php echo $_SESSION["commentUserName"] [$key]; ?> commented: <?php   echo $_SESSION["Content"] [$key]; ?> about <?php   echo $_SESSION["commentCity"] [$key]; ?> </p>


<?php   }}


}

// function to create new comment and alert
function insertComment($currentCity,$commentContent){
  include("db_connection.php");
    $userID = $_SESSION['loggeInUser']; // retrieve loggedinuser and automatically put in the database
  $query = "INSERT INTO commentlist (userid, city, content) VALUES
($userid, '$currentCity', '$commentContent')";
  $result = pg_query($dbh, $query);
  echo "<script>alert('Comment inserted')</script>";


}
//function to create new comment and alert if it worked or not
function  createnewCity($city,$country,$continent,$cost,$temperature,$internet,$safety,$latitude,$longitude){
  include("db_connection.php");
  if(!empty($_SESSION['loggeInUser'])){
  $name = $_SESSION['loggeInUser']; // retrieve loggedinuser and automatically put in the database
  $query = "INSERT INTO basedata VALUES
(0, '$city', '$country', '$continent', '$cost', $temperature, '$internet', '$safety', '$latitude', '$longitude', 'user')";
  $result = pg_query($dbh, $query);
echo "<script>alert('City inserted')</script>";
  echo "<script>window.open('index.php','_self')</script>";
}
else {
    echo "<script>alert('Please Login to create new content')</script>";
}
}

//  function for creating a linegraph for the three selected HDI countries
function createLineGraph($country1,$country2,$country3){
  include("db_connection.php");

$query = "SELECT HDI.Year,$country1 ,$country2 , $country3 FROM HDI";
$results = db_assocArrayAll($dbh,$query);

// ...however, we want a Javascript array, for the rest of the Javascript to use
echo "<script type='text/javascript'>";
echo "var hdidata = ".json_encode($results,JSON_NUMERIC_CHECK);
echo "console.log(hdidata)";
echo "</script>";

}  ?>
