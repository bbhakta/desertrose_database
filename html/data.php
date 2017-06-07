<html>
<div align ="center">
<?php

/* http://www.fpdf.org/en/script/script10.php */
ob_start();
require('fpdf/fpdf.php');
//gets clinet data
//need to close sql connection and free data

$cfname = $_POST['cfname'];
$clname = $_POST['clname'];
$csname = $_POST['csname'];
$city = $_POST['city'];
$state = $_POST['state'];
$zip = $_POST['zip'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$lnum = $_POST['lnum'];

$cname = $cfname . " " . $clname;

//gets paitent data
$pfname = $_POST['pfname'];
$plname = $_POST['plname'];
$age = $_POST['age'];
$gender = $_POST['gender'];
$pphone = $_POST['pphone'];
$pemail = $_POST['pemail'];

$pname = $pfname . " " . $plname;
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

if($ddate == $tdate && time() < strtotime('1 pm')) {
	//echo "yess"."\n";
	$priority = 0;
}
else {
	//echo "Order can not be completed today "."\n";
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
//$apassword = 'ramkabir';
$apassword = '';
$database = 'desertrose';

$connect =  mysql_connect($ahost, $auser, $apassword) 
         or die('Could not connect:' . mysql_errno());

mysql_select_db($database, $connect) or die("Unable to connet" .mysql_errno());

/* Enter client data into database*/

/* 
	TODO: Need to find a way so if client is returing they do not need to enter information about them again, and need to find a way to link
 	their id with patietn id
 */


/* HEREEEEEEEEEEEEEEEEEEEEEEEE

mysql_query("INSERT into `client` VALUES ('', '$cfname' , '', '$clname', '$csname','$city', '$state', '$zip', '$phone', '$email', '$lnum' )") 
or die('unable to enter client data' .mysql_errno());

*/

/* Enter Patient data into database, by getting clinet id first*/

/*
	TODO: Need to find better way to link client and patient, for time being it is getting client information by quering client id when clinet 
	input thier data
	
 */

/* Gets client id so we will have foregin key reference to client id*/


/* HEREEEEEEEEEEEEEEEEEEEEEEEE
$query =  "SELECT id FROM `client` WHERE fname= '$cfname' and lname ='$clname'";
$result = mysql_query($query) or die('A error occured: '. mysql_error());

$row = mysql_fetch_array($result);
/* Turns the id into int */

/* HEREEEEEEEEEEEEEEEEEEEEEEEE

$cid = (int)$row["id"];

/*Enter patient data*/

/* HEREEEEEEEEEEEEEEEEEEEEEEEE
mysql_query("INSERT into `patient` VALUES ('', '$cid', '$pfname' , '', '$plname', '$age','$gender', '$pphone' )") 
or die('unable to enter patient data' .mysql_errno());

/* Enter ther placeorder data*/

/* HEREEEEEEEEEEEEEEEEEEEEEEEE

mysql_query("INSERT into `placeorder` VALUES ('', '$cid', '$odate', '$ddate' ,'$priority')")
or die('unable to enter placedorder data' .mysql_errno());


/* Enters the pvs data since cid and oid are autoincremented we first need to get those value then input data*/

/* Gets order id*/

/* HEREEEEEEEEEEEEEEEEEEEEEEEE

$oquery =  "SELECT id FROM `placeorder` WHERE cid= '$cid'";
$oresult = mysql_query($oquery) or die('A error occured: '. mysql_error());

$orow = mysql_fetch_array($oresult);
/* Turns the id into int */
/* HEREEEEEEEEEEEEEEEEEEEEEEEE

$oid = (int)$orow["id"];

/*Gets patient id*/

/* HEREEEEEEEEEEEEEEEEEEEEEEEE

$pquery =  "SELECT id FROM `patient` WHERE cid= '$cid'";
$presult = mysql_query($pquery) or die('A error occured: '. mysql_error());

$prow = mysql_fetch_array($presult);
/* Turns the id into int */

/* HEREEEEEEEEEEEEEEEEEEEEEEEE
$pid = (int)$prow["id"];

mysql_query("INSERT into `pvsorder` VALUES('$oid', '$pid', '$removable', '$bite', '$surg', '$add')")
or die('unable to enter pvsorder data' .mysql_errno());


/*Enter received data*/
/* HEREEEEEEEEEEEEEEEEEEEEEEEE

/mysql_query("INSERT into `receivedorder` VALUES('$oid', '$odate')")
or die('unable to enter received data' .mysql_errno());

*/

		$query = "select * FROM `drose`";		 

		 $result = mysql_query($query) or die ('A error occured:' .mysql_error());
		 $number_of_rows= mysql_numrows($result);

		
		if (!$result) {
    		echo "Could not successfully run query ($query) from DB: " . mysql_error();
   		 	exit;
		}

		if (mysql_num_rows($result) == 0) {
    		echo "No rows found, nothing to print so am exiting";
    		exit;
		}

		/* FPDF is used to print data to pdf of view data*/
		//Initialize the 5 columns and the total
		$column_sname = "";
		$column_city = "";
		$column_state = "";
		$column_zip = "";
		$column_phone = "";

		while ($row = mysql_fetch_assoc($result)) {
					/* Gets the data from the table and comines the string */
					/* The formating for outpting data needs more work*/   
					$sname = $row["sname"];
					/* Combine the name string*/
					$city = $row["city"];
					/* Combine the address string*/
					$state = $row["state"];
					/* Combine the phone and name string m*/
					$zip = $row["zip"];
					/* Gets Phone number */
					$phone = $row["phonenum"];

					/* Assign approriate variable so we can print it to pdf*/
					$column_sname = $column_sname.$sname."\n";
					$column_city= $column_city.$city.",\n";
					$column_state = $column_state.$state."\n";
					$column_zip = $column_zip.$zip."\n";
					$column_phone = $column_phone.$phone . "\n";

				}		

		/* Close the conncection */
		//mysql_close($connect);
				
		/* This generate the pdf file still trying to figure out how the formating works*/
		/* Create a new PDF file */
		$pdf=new FPDF();
		$pdf->AddPage();

		$pdf->SetFont('Arial','B',12);
		$pdf->SetY(15);
		//sets the the cell header position
		$pdf->SetX(10);
		//sets the cell size for text
		$pdf->Cell(55,6,'Desert Rose Dental Lab');
		//offset for next cell 
		$pdf->Ln();
		$pdf->SetFont('Arial','' ,10);
		$pdf->Cell(65,6,$column_sname);
		$pdf->Ln();
		$pdf->Cell(24,6,$column_city);
		$pdf->Cell(7,6,$column_state);
		$pdf->Cell(15,6,$column_zip);
		$pdf->Ln();
		$pdf->Cell(40,6,$column_phone);


		$pdf->SetFont('Arial','B',12);
		$pdf->SetY(45);
		//sets the the cell header position
		$pdf->SetX(10);
		//sets the cell size for text
		$pdf->Cell(55,6,'Invoice');
		//offset for next cell 
		$pdf->Ln();
		$pdf->SetFont('Arial','' ,10);
		$pdf->Cell(55,6,$cname);
		$pdf->Ln();
		$pdf->SetX(100);
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(20,6,'Order date',0,0,'R');
		$pdf->Cell(20,6,$tdate,0,0,'R');
		$pdf->SetX(10);
		$pdf->SetFont('Arial','' ,10);
		$pdf->Cell(55,6,$csname);
		$pdf->Ln();
		$pdf->Cell(24,6,$city . ",");
		$pdf->Cell(7,6,$state);
		$pdf->Cell(15,6,$zip);
		$pdf->SetX(100);
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(20,6,'Due date',0,0,'R');
		$pdf->Cell(20,6,$ddate,0,0,'R');
		$pdf->Ln();
		$pdf->SetFont('Arial','' ,10);
		$pdf->Cell(40,6,$phone);
		$pdf->Ln();
		$pdf->Cell(35,6,'Licence Number#');
		$pdf->cell(40,6,$lnum);
		$pdf->Ln();
		//$pdf->Cell(35,6,$column_cid);


		$Y = $pdf->GetY(); 
		$pdf->SetFillColor(232,232,232);
		$pdf->Line(10, $Y+5, 200, $Y+5);
		$pdf->SetY($Y+10);
		$pdf->SetX(10);
		$pdf->SetFont('Arial','B',12);
		$pdf->Cell(90,6,'Activity',1,0,'L',1);
		$pdf->SetX(100);
		$pdf->Cell(20,6,'Qty',1,0,'L',1);
		$pdf->SetX(120);
		$pdf->Cell(20,6,'Rate',1,0,'L',1);
		$pdf->SetX(140);
		$pdf->Cell(20,6,'Amount',1,0,'L',1);
		$pdf->Ln();

		$pdf->SetFont('Arial','' ,10);
		$x = $removable . " " . $bite . " ".  $surg . " " . $add;
		$pdf->MultiCell(90,6,$x,1,'L',false);
		$pdf->MultiCell(90,6,$pname,1,0,'R',flase);
		$pdf->Ln();


		$BY = $pdf->GetY();
		$pdf->Line(10, $BY+5, 200, $BY+5);
		$pdf->SetY($BY+10);
		$pdf->SetX(10);
		$pdf->SetFont('Arial','B',12);
		$pdf->Cell(120,6,'TOTAL',1,0,'L',1);
		$pdf->SetX(120);
		$pdf->Cell(40,6,'Some Amount',1,0,'L',1);
		$pdf->Ln();

		$pdf->Output('invoice.pdf', 'F');
		ob_end_flush();

?>

</div>
<!--- Creates a go back button and redirect to admin page -->
<div align="right">
<form action="index.html">
<input type="submit" value ="Go back!">
</form>

</html>
