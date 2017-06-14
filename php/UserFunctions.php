<?php
include('db_connection.php');
include("php/SQLfunctions.php");
/* this file contains the php functions for user signup and login
*/
session_start();


    function Signup($name,$email,$password){ //function to insert (signup) a new user - called when pressed the signup button
      if(strlen($password)<6){ //password verification
          echo "<script>alert('The password is too short (min 6 characters)')</script>";
          exit();
          // password length verfication
        }

        include("db_connection.php");
        //email verfication start
       $query = "SELECT * FROM userlist WHERE Email = '$email'";
	   $result = pg_query($dbh, $query);

        $check = pg_num_rows($result);
        if($check==1){   // check if email is already existing
            echo "<script>alert('This email is already registered!')</script>";
            exit();
        }      //email verification end


        else { //insert a new user

          $query = "INSERT INTO userlist(Name, Email, Password) VALUES ('$name', '$email', '$password')";
          if ($result = pg_query($dbh, $query)) {

            echo "<script>alert('Signup succesful')</script>";
  
}}

      }


      function loginUser($email,$password){ //basic Login function - called when pressed the login button
	  include("db_connection.php");

    $query = "SELECT * FROM userlist WHERE Email = '$email' AND password = '$password'";
    $result = pg_query($dbh, $query);
    $check = pg_num_rows($result);
    if($check==1){ //only verfication so far is to check if combo of email and password exists




          echo "<script>alert('Login succesful')</script>";
		  $_SESSION['loggedInUser']  = $email;

    }
    else{
      echo "<script>alert('Combination of email and password is incorrect. Try again!')</script>";
}

}
 ?>
