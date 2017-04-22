<html>
<!--- This is a fiel where admin can view data and i need to more feature  -->
<div align="center">
<?php

/* Intialize variables for the database */
/* Need to find a way to hide admin username and password*/

$ahost = 'localhost';
$auser = 'root';
$apassword = 'ramkabir';
$database = 'desertrose';

/*Connect to the database using varible prints out error message if database is unavalible */
$connect =  mysql_connect($ahost, $auser, $apassword) 
         or die('Could not connect:' . mysql_errno());

/*Specifies which daabase to use*/
mysql_select_db($database, $connect);

/* Gets the button information from home.php file, it uses switch case to swich over different view */
switch ($_POST['client'])
{

	/* This get client table information are try to prints it, I need to work more on the formating */
	case "client":
		$query = "SELECT * FROM `client`";
		$result = mysql_query($query) or die ('A error occured:' .mysql_error());
		
		if (!$result) {
    		echo "Could not successfully run query ($query) from DB: " . mysql_error();
   		 	exit;
		}

		if (mysql_num_rows($result) == 0) {
    		echo "No rows found, nothing to print so am exiting";
    		exit;
		}
		/* It fetches the data from the  database */
		while ($row = mysql_fetch_assoc($result)) {
			/* The formating for outpting data needs more work*/
			echo  "<p> "."id: " . $row["id"] ."Client Name:" . $row["fname"]. " ". $row["mname"].  "". $row["lanme"]. "Address:" .$row["stname"] . "City: ". $row["city"]. "State:" .$row["state"]. "Zipcode:" .$row["zip"]. "Phone Number:". $row["phonenum"]. "Email:" . $row["email"]. "Licence number#" .$row["liencenum"]. "<br>" . "</p>";      
		}	
		/* Closes the connection and frees the data*/
	mysql_close($conn);
	mysql_free_result($result);
	break;

	case "client contact":
		echo "orders";
	break;

}

?>

</div>
<!--- Creates a go back button and redirect to admin page -->
<div align="right">
<form action="home.php">
<input type="submit" value ="Go back!">
</form>

</html>


