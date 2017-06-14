<?php
// retrieves comments to city that was selected
include('db_connection.php');
include('db_functions.php');

$senddata = $_POST['book_name'];
   if(isset($_POST['showComment'])){ // this if is triggered once submit is clicked

    $city = $_POST['CommentHolder'];

	echo $city;
  // this queries joins the comment and user table to display comments as well as the username of the person
	$query = "SELECT  userlist.name, commentlist.city, commentlist.content FROM commentlist LEFT JOIN userlist ON commentlist.userid = userlist.id WHERE city = '$city'";
}







// store results in an php array
$results = db_assocArrayAll($dbh,$query);


// transform it the php array to a JSON array
echo "<script type='text/javascript'>";
echo "var commentList = ".json_encode($results,JSON_NUMERIC_CHECK);
echo "</script>";

?>
