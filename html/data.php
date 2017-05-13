<html>
<div align ="center">
<?
/* This gets the client data from the fourm, this is assigning so many varibles which might not be safe, might need to find different way to do this*/
//need to close sql connection and free data
require('fpdf/fpdf.php');
$cfname = $_POST['cfname'];
$clname = $_POST['clname'];
$csname = $_POST['csname'];
$city = $_POST['city'];
$state = $_POST['state'];
$zip = $_POST['zip'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$lnum = $_POST['lnum'];

//gets paitent data
$pfname = $_POST['pfname'];
$plname = $_POST['plname'];
$age = $_POST['age'];
$gender = $_POST['gender'];
$pphone = $_POST['pphone'];
$pemail = $_POST['pemail'];

/* gets order information this is huge data need to find better to do this */
$bite = $_POST['bite'];
$pivot = $_POST['pivot'];
$night = $_POST['night'];
$bleach = $_POST['bleach'];
$surgical = $_POST['surgical'];


$bclass= $_POST['bclass'];
$ant = $_POST['ant'];
$post = $_POST['post'];
$bel = $_POST['bel'];
$ove = $_POST['ove'];

$lab = $_POST['lab'];
$cbc = $_POST['cbc'];
$pro = $_POST['pro'];
$imp = $_POST['imp'];


$cal= $_POST['cal'];
$met = $_POST['met'];
$iml = $_POST['iml'];
$pd = $_POST['pd'];
$pdd = $_POST['pdd'];
$ld = $_POST['ld'];
$sd = $_POST['sd'];
$dd = $_POST['dd'];

//This is how to get date from user
$ddate = date('Y-m-d',strtotime($_POST['ddate']));
$tdate = date('Y-m-d');

date_default_timezone_set('America/Denver');
$odate = date('Y-m-d H:i:s');

/* Checks todays date and order due date to varifile if order is doable by that day*/
if($ddate == $tdate && time() < strtotime('1 pm')) {
	echo "yess"."\n";
	$priority = 0;
}
else {
	echo "Order can not be completed today "."\n";
	$priority = 1;
}

/*Combines the strings to geather*/
$removable = $bite . " , " . $pivot . ", " . $night . ", " . $bleach . ", " . $surgical .  ".";
$bite = $bclass . ", " . $ant . ", " . $post . ", " . $bel . ", ".  $ove . ".";
$surg = $lab . ", " . $cbc . ", " . $pro . ", " . $imp . ".";
$add = $cal . ", " . $met . ", " . $iml . ", " . $pd . ", " . $pdd . ", " . $ld . ", " . $sd . ", " . $dd . ", " . $date . ".";

//admin information for conneting to mysql and slecet database
$ahost = 'localhost';
$auser = 'root';
$apassword = 'ramkabir';
$database = 'desertrose';

$connect =  mysql_connect($ahost, $auser, $apassword) 
         or die('Could not connect:' . mysql_errno());

mysql_select_db($database, $connect) or die("Unable to connet" .mysql_errno());

/* Enter client data into database*/

/* 
	TODO: Need to find a way so if client is returing they do not need to enter information about them again, and need to find a way to link
 	their id with patietn id
 */



mysql_query("INSERT into `client` VALUES ('', '$cfname' , '', '$clname', '$csname','$city', '$state', '$zip', '$phone', '$email', '$lnum' )") 
or die('unable to enter client data' .mysql_errno());

echo "Client Data enetered";

/* Enter Patient data into database, by getting clinet id first*/

/*
	TODO: Need to find better way to link client and patient, for time being it is getting client information by quering client id when clinet 
	input thier data
	
 */

/* Gets client id so we will have foregin key reference to client id*/

$query =  "SELECT id FROM `client` WHERE fname= '$cfname' and lname ='$clname'";
$result = mysql_query($query) or die('A error occured: '. mysql_error());

$row = mysql_fetch_array($result);
/* Turns the id into int */
$cid = (int)$row["id"];

/*Enter patient data*/
mysql_query("INSERT into `patient` VALUES ('', '$cid', '$pfname' , '', '$plname', '$age','$gender', '$pphone' )") 
or die('unable to enter patient data' .mysql_errno());

/* Enter ther placeorder data*/
mysql_query("INSERT into `placeorder` VALUES ('', '$cid', '$odate', '$ddate' ,'$priority')")
or die('unable to enter placedorder data' .mysql_errno());


/* Enters the pvs data since cid and oid are autoincremented so we first need to get those value then input data*/

/* Gets order id*/
$oquery =  "SELECT id FROM `placeorder` WHERE cid= '$cid'";
$oresult = mysql_query($oquery) or die('A error occured: '. mysql_error());

$orow = mysql_fetch_array($oresult);
/* Turns the id into int */
$oid = (int)$orow["id"];

/*Gets patient id*/
$pquery =  "SELECT id FROM `patient` WHERE cid= '$cid'";
$presult = mysql_query($pquery) or die('A error occured: '. mysql_error());

$prow = mysql_fetch_array($presult);
/* Turns the id into int */
$pid = (int)$prow["id"];

mysql_query("INSERT into `pvsorder` VALUES('$oid', '$pid', '$removable', '$bite', '$surg', '$add')")
or die('unable to enter pvsorder data' .mysql_errno());


/*Enter received data*/
mysql_query("INSERT into `receivedorder` VALUES('$oid', '$odate')")
or die('unable to enter received data' .mysql_errno());

?>

</div>
<!--- Creates a go back button and redirect to admin page -->
<div align="right">
<form action="index.html">
<input type="submit" value ="Go back!">
</form>

</html>