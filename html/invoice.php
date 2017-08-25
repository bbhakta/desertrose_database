<?php
session_start();
ob_start();
require('fpdf/fpdf.php');

//admin information for conneting to mysql and slecet database
$ahost = 'localhost';
$auser = 'root';
$apassword = 'ramkabir';
$database = 'desertrose';

$connect =  mysql_connect($ahost, $auser, $apassword) 
         or die('Could not connect to database Line #155:' . mysql_errno());

mysql_select_db($database, $connect) or die("Unable to connet to database Line #157" .mysql_errno());

/* Enter client data into database*/

/* 
	TODO: Need to find a way so if client is returing they do not need to enter information about them again, and need to find a way to link
 	their id with patietn id
 */


// /* HEREEEEEEEEEEEEEEEEEEEEEEEE

$oid = $_SESSION['oid'];

$filename = "/var/www/html/invoice" . $oid .".pdf";
header("Content-type: application/pdf");
header("Content-Length: " . filesize($filename));

// Send the file to the browser.
readfile($filename);
//echo $oid;
		


?>
