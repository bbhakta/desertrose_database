<?
//gets clinet data
$cfname = $_POST['cfname'];
$clname = $_POST['clname'];
$csname = $_POST['csname'];
$city = $_POST['city'];
$state = $_POST['state'];
$zip = $_POST['zip'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$lnum = $_POST['lnum'];

//admin information for conneting to mysql and slecet database
$ahost = 'localhost';
$auser = 'root';
$apassword = 'ramkabir';
$database = 'desertrose';

$connect =  mysql_connect($ahost, $auser, $apassword) 
         or die('Could not connect:' . mysql_errno());

mysql_select_db($database, $connect) or die("Unable to connet" .mysql_errno());

mysql_query("INSERT into `client` VALUES ('', '$cfname' , '', '$clname', '$csname','$city', '$state', '$zip', '$phone', '$email', '$lnum' )") 
or die('unable to enter data' .mysql_errno());

echo "Data enetered";
mysql_close($connect);

?>

