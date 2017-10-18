<?php
/* This is a login.php file and it checkts user data in database */
/*Gets ther username and password from the index.html file*/
$iuser = $_POST['user'];
$ipass = $_POST['pass'];

/* Intialize variables for the database */
/* Need to find a way to hide admin username and password*/
$ahost = 'localhost';
$auser = 'root';
$apassword = 'ramkabir';
$database = 'desertrose';

/*Connect to the database using varible prints out error message if database is unavalible */
$connect =  mysql_connect($ahost, $auser, $apassword) 
	 or die('Could not connect:' . mysql_errno());


try {
$conn = new PDO("mysql:host=$ahost;dbname=$database", $auser, $apassword);

// set the PDO error mode to exception
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


if ( !$user_data =  $conn->prepare("SELECT * from users WHERE user = :iuser") )
	echo "Prepare Error (Selecting usernames): ($conn->errno) $conn->error";

if ( !$user_data->bindParam(":iuser", $iuser) )
	echo "Binding Parameter (Username) Error: ($conn->errno) $conn->error";

if ( !$user_data->execute() )
	echo "Execute Error (Executing username query): ($user_data->errno) $user_data->error";

if ( !$pass_data =  $conn->prepare("SELECT * from users WHERE password = :ipass") )
	echo "Prepare Error (Selecting password): ($conn->errno) $conn->error";

if ( !$pass_data->bindParam(":ipass", $ipass) )
	echo "Binding Parameter (password) Error: ($conn->errno) $conn->error";

if ( !$pass_data->execute() )
	echo "Execute Error (Executing password query): ($pass_data->errno) $pass_data->error";

while($row_user = $user_data->fetch(PDO::FETCH_ASSOC)){
	$serveruser = $row_user["user"];

}

while($row_pass = $pass_data->fetch(PDO::FETCH_ASSOC)){
	$serverpass = $row_pass["password"];
}
echo $serveruser;
echo $serverpass;

/* This if blocks checks the  username and password */
if($serveruser&&$serverpass){


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

$user_data->close();
$pass_data->close(); 

} catch (Exception $e) {

echo "Error in connection to database" . $e->getMessage() . "</br>";

die();

}
//header('Location: fail.php');


?>
