<?php
/* This is a login.php file and it checkts user data in database */
/*Gets ther username and password from the index.html file*/
$iuser = $_POST['user'];
$ipass = $_POST['pass'];

/* Intialize variables for the database */
/* Need to find a way to hide admin username and password*/
$ahost = 'localhost';
$auser = 'root';
//$apassword = 'ramkabir';
$apassword = '';
$database = 'desertrose';

/*Connect to the database using varible prints out error message if database is unavalible */
$connect =  mysql_connect($ahost, $auser, $apassword) 
	 or die('Could not connect:' . mysql_errno());

/*Specifies which daabase to use*/
mysql_select_db($database, $connect);

/* Mysql query which gets username pas password from the database */
$query =  "SELECT * FROM `users` WHERE user = '$iuser'";
$querypass = "SELECT * FROM `users` WHERE  password = '$ipass'";

/*Executes the query, and if it has problem executing it prints out error message*/
$result = mysql_query($query) or die('A error occured: '. mysql_error());
$resultpass = mysql_query($querypass) or die('A error ocurred: ' . mysql_error());

/*This is a way to get data from our database it returns data as array*/
$row = mysql_fetch_array($result);
$rowpass = mysql_fetch_array($resultpass);

/*Sets the username and password */
$serveruser = $row["user"];
$serverpass = $row["password"];

/* This if blocks checks the  username and password */
if($serveruser&&$serverpass){
	if(!$result){
		die("Username or passwrod is invalid");
	}
	echo "<br><center> Database output </b></center><br><br>";
	mysql_close();
/* Check if user is admin if it is admin then it'll redirect to home.php file*/
	if($ipass == $serverpass && $iuser == $serveruser && $iuser =="admin"){
		header('Location: home.php');
/* Check if user is client then  it'll redirect to client.php file*/
	} elseif($ipass == $serverpass){
		header('Location: client.php');
	} else {
		echo "Sorry bad login";
		header('Location: fail.php');
	}
}
//header('Location: fail.php');


?>
