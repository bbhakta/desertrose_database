<html>
<div align ="center">

<?php
/*
	TODO:
	Mltiple Patient  -> Ask for how many patient
	put each iten in new line
	invoice pcrown ->patient name qt price
			pnight ->patient name qt price

	Upload files -> like google drag and drop
	Look it invoice --> there is error 

	Check if string state has two letter, check if order data and due date are not same
	And also digital orders can be done on same day

	Check if anyof the string containts keywords like select, *, drop remove the string raise error

*/

/* http://www.fpdf.org/en/script/script10.php */
ob_start();
require('fpdf/fpdf.php');
session_start();
//gets clinet data
//need to close sql connection and free data

$cfname = $_POST['cfname'];
$clname = $_POST['clname'];
$csname = $_POST['csname'];
$ccity = $_POST['city'];
$cstate = $_POST['state'];
$czip = $_POST['zip'];
$cphone = $_POST['phone'];
$cemail = $_POST['email'];
$lnum = $_POST['lnum'];

$cname = $cfname . " " . $clname;

//gets paitent data
$pfname = $_POST['pfname'];
$plname = $_POST['plname'];
$age = $_POST['age'];
$gender = $_POST['gender'];
$pphone = $_POST['pphone'];
//$pemail = $_POST['pemail'];

$pname = $pfname . " " . $plname;

/* gets order information this is huge data need to find better to do this */

//check if pvs or digi string is empty if it is empty dont check pvs or digital order
$pvs = $_POST['pvs'];
$digi = $_POST['digi'];

//if pcrow is empty dont check 
$pcrown = $_POST['pcrown'];
$pcdia = $_POST['pcdia'];
$pczir = $_POST['pczir'];
$pcemax = $_POST['pcemax'];
$pcgold = $_POST['pcgold'];
$pcsha = $_POST['pcsha'];


//check if pnight empty if its dont check it
$pnight = $_POST['pnight'];
$pnupp = $_POST['pnupp'];
$pnlow = $_POST['pnlow'];
$pnsof = $_POST['pnsof'];
$pnhar = $_POST['pnhar'];
$pnmay = $_POST['pnmay'];
$pnocl = $_POST['pnocl'];


//check if palign empty if its dont check it
$palign = $_POST['palign'];
$paupp = $_POST['paupp'];
$palow = $_POST['palow'];
$parep = $_POST['parep'];


//check if psurg is empty if its dont check it
$psurg = $_POST['psurg'];
$psimp = $_POST['psimp'];
$pstoo = $_POST['pstoo'];
$pssle = $_POST['pssle'];


//check if pdent is empty if its dont check it
$pdent = $_POST['pdent'];
$pdupp = $_POST['pdupp'];
$pdlow = $_POST['pdlow'];
$pdtoo = $_POST['pdtoo'];


//check if ppart is empty if it is dont check it
$ppart = $_POST['ppart'];
$ppupp = $_POST['ppupp'];
$pplow = $_POST['pplow'];
$ppmiss = $_POST['ppmiss'];
$ppsha = $_POST['ppsha'];


//if dcrow is empty dont check 
$dcrown = $_POST['dcrown'];
$dcdia = $_POST['dcdia'];
$dczir = $_POST['dczir'];
$dcemax = $_POST['dcemax'];
$dcgold = $_POST['dcgold'];
$dcsha = $_POST['dcsha'];


//check if dnight empty if its dont check it
$dnight = $_POST['dnight'];
$dnupp = $_POST['dnupp'];
$dnlow = $_POST['dnlow'];
$dnsof = $_POST['dnsof'];
$dnhar = $_POST['dnhar'];
$dnmay = $_POST['dnmay'];
$dnocl = $_POST['dnocl'];


//check if palign empty if its dont check it
$dalign = $_POST['dalign'];
$daupp = $_POST['daupp'];
$dalow = $_POST['dalow'];
$darep = $_POST['darep'];


//check if psurg is empty if its dont check it
$dsurg = $_POST['dsurg'];
$dsimp = $_POST['dsimp'];
$dstoo = $_POST['dstoo'];
$dssle = $_POST['dssle'];


//check if pdent is empty if its dont check it
$ddent = $_POST['ddent'];
$ddupp = $_POST['ddupp'];
$ddlow = $_POST['ddlow'];
$ddtoo = $_POST['ddtoo'];


//check if ppart is empty if it is dont check it
$dpart = $_POST['dpart'];
$dpupp = $_POST['dpupp'];
$dplow = $_POST['dplow'];
$dpmiss = $_POST['dpmiss'];
$dpsha = $_POST['dpsha'];


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

mysql_query("INSERT into `client` VALUES ('', '$cfname' , '', '$clname', '$csname','$ccity', '$cstate', '$czip', '$cphone', '$cemail', '$lnum' )") 
or die('unable to enter client data Line #169-170' .mysql_errno());

/* Enter Patient data into database, by getting clinet id first*/

/*
	TODO: Need to find better way to link client and patient, for time being it is getting client information by quering client id when clinet 
	input thier data	
 */

/* Gets client id so we will have foregin key reference to client id*/

$query_cid =  "SELECT * FROM `client` WHERE fname='$cfname' and lname='$clname'";

$result_cid = mysql_query($query_cid) or die('A error occured executing query Line #186-187: '. mysql_error());
$row_cid = mysql_fetch_array($result_cid);

$cid = (int)$row_cid["id"];
	#echo $row["lname"];


/* Turns the id into int */
// /* HEREEEEEEEEEEEEEEEEEEEEEEEE

/*Enter patient data*/

mysql_query("INSERT into `clientcontact` VALUES ('$cid', '$odate', '8930')")
or die('unable to enter clientcontact data Line #198-199' .mysql_errno());

// /* HEREEEEEEEEEEEEEEEEEEEEEEEE
mysql_query("INSERT into `patient` VALUES ('', '$cid', '$pfname' , '', '$plname', '$age','$gender', '$pphone' )")
or die('unable to enter patient data Line #202-203' .mysql_errno());

$query_pid =  "SELECT `id` FROM `patient` WHERE cid= '$cid'";
$result_pid = mysql_query($query_pid) or die('A error occured executing query Line #186-187: '. mysql_error());

$row_pid = mysql_fetch_assoc($result_pid);
/* Turns the id into int */

// /* HEREEEEEEEEEEEEEEEEEEEEEEEE

$pid = (int)$row_pid["id"];


/* Enter ther placeorder data*/

// /* HEREEEEEEEEEEEEEEEEEEEEEEEE

mysql_query("INSERT into `placeorder` VALUES ('', '$cid', '$odate', '$ddate' ,'$priority')")
or die('unable to enter placedorder data Line #209-210' .mysql_errno());


$query_oid =  "SELECT `id` FROM `placeorder` WHERE cid= '$cid'";
$result_oid = mysql_query($query_oid) or die('A error executing quere Line #213-214: '. mysql_error());

$row_oid = mysql_fetch_assoc($result_oid);
/* Turns the id into int */



$oid = (int)$row_oid["id"];


if ($pvs != '')
{

	mysql_query("INSERT into `pvsorder` VALUES('$oid','$cid', '$pid')")
	or die('unable to enter received data Line #238-239' .mysql_errno());

	if($pcrown != '')
	{
		/*
		$pcrow = $pcrown . " " . $pcdia . " " . $pczir . " " .
				$pcemax . " " . $pcgold . " " . $pcsha;
		*/
		mysql_query("INSERT into `crown_order` VALUES ('$pvs', '$oid', '$pcdia' , '$pczir', '$pcemax', '$pcgold','$pcsha')")
		or die('unable to enter data into pvs crown order Line #247-248' .mysql_errno());
	}

	if($pnight != '')
	{
		/*
		$pnig = $pnight . " " . $pnupp . " " . $pnlow . " " . $pnsof . " " . $pnhar 
				. " " . $pnmay . " " . $pnocl;
		*/
		mysql_query("INSERT into `night_guard` VALUES ('$pvs', '$oid', '$pnupp' , '$pnlow', '$pnsof', '$pnhar', '$pnmay' ,'$pnocl')")
		or die('unable to enter data into pvs night guard Line #257-258' .mysql_errno());
	}

	if($palign != '')
	{
		/*
		$palig = $palign . " " . $paupp . " " . $palow . " " . $parep;
		*/
		mysql_query("INSERT into `aligner_order` VALUES ('$pvs', '$oid', '$paupp' , '$palow', '$parep')")
		or die('unable to enter data into pvs aligner order Line #266-267' .mysql_errno());
	}

	if($psurg != '')
	{
		/*
		$psur = $psurg . " " . $psimp . " " . $pstoo . " " . $pssle;

		echo "Psurg" . $psur;
		*/
		mysql_query("INSERT into `surgical_order` VALUES ('$pvs', '$oid', '$psimp' , '$pstoo', '$pssle')")
		or die('unable to enter data into pvs surgical order Line #277-278' .mysql_errno());
	}

	if($pdent != '')
	{
		/*
		$pden = $pdent . " " . $pdupp . " " . $pdlow . " " . $pdtoo;

		echo "Pdent " . $pden;
		*/
		mysql_query("INSERT into `denture_order` VALUES ('$pvs', '$oid', '$pdupp' , '$pdlow', '$pdtoo')")
		or die('unable to enter data into pvs denture order Line #288-289' .mysql_errno());
	}

	if($ppart != '')
	{
		/*
		$ppar = $ppart . " " . $ppupp . " " . $pplow . " " . $ppmiss . " " . $ppsha;

		echo "Ppart" . $ppar;
		*/
		mysql_query("INSERT into `partial_order` VALUES ('$pvs', '$oid', '$ppupp' , '$pplow', '$ppmiss', '$ppsha')")
		or die('unable to enter data into pvs partial order Line #299-300' .mysql_errno());
	}


}

if ($digi != '')
{
	mysql_query("INSERT into `digitalorder` VALUES('$oid','$cid', '$pid')")
	or die('unable to enter received data Line #308-309' .mysql_errno());

	if($dcrown != '')
	{
		/*
		$dcrow = $dcrown . " " . $dcdia . " " . $dczir . " " .
		 $dcemax . " " . $dcgold . " " . $dcsha;

		echo "DCrow" . $dcrown;
		*/
		mysql_query("INSERT into `crown_order` VALUES ('$digi', '$oid', '$dcdia' , '$dczir', '$dcemax', '$dcgold','$dcsha')")
		or die('unable to enter data into digi crown order Line #319-320' .mysql_errno());
	}

	if($dnight != '')
	{
		/*
		$dnig = $dnight . " " . $dnupp . " " . $dnlow . " " .
		$dnsof . " " . $dnhar . " " . $dnmay . " " .
		$dnocl;

		echo "Dnight " . " " . $dnig;
		*/
		mysql_query("INSERT into `night_guard` VALUES ('$digi', '$oid', '$dnupp' , '$dnlow', '$dnsof', '$dnhar','$dnmay' ,'$dnocl')")
		or die('unable to enter data into digi night guard Line #332-333' .mysql_errno());
	}

	if($dalign != '')
	{
		/*
		$dalig = $dalign . " " . $daupp . " " . $dalow . " " . $darep;

		echo "Dalign" . $dalig;
		*/
		mysql_query("INSERT into `aligner_order` VALUES ('$digi', '$oid', '$daupp' , '$dalow', '$darep')")
		or die('unable to enter data into digi aligner order Line #343-344' .mysql_errno());
	}

	if($dsurg != '')
	{
		/*
		$dsur = $dsurg . " " . $dsimp . " " . $dstoo . " " . $dssle;

		echo "Dsurg" . $dsur;
		*/
		mysql_query("INSERT into `surgical_order` VALUES ('$digi', '$oid', '$dsimp' , '$dstoo', '$dssle')")
		or die('unable to enter data into digi surgical order Line #354-355' .mysql_errno());
	}

	if($ddent != '')
	{
		/*
		$dden = $ddent . " " . $ddupp . " " . $ddlow . " " . $ddtoo;

		echo "Ddent " . $dden;
		*/
		mysql_query("INSERT into `denture_order` VALUES ('$digi', '$oid', '$ddupp' , '$ddlow', '$ddtoo')")
		or die('unable to enter data into digi denture order Line #365-366' .mysql_errno());
	}

	if($dpart != '')
	{
		/*
		$dpar = $dpart . " " . $dpupp . " " . $dplow . " " . $dpmiss . " " . $dpsha;

		echo "Ppart" . $dpar;
		*/
		mysql_query("INSERT into `partial_order` VALUES ('$digi', '$oid', '$dpupp' , '$dplow', '$dpmiss', '$dpsha')")
		or die('unable to enter data into digi partial order Line #376-377' .mysql_errno());
	}

}

mysql_query("INSERT into `receivedorder` VALUES('$oid','$cid', '$odate')")
or die('unable to enter received data Line #382-383' .mysql_errno());

	$query_drose = "select * FROM `drose`";		 

	$result_drose = mysql_query($query_drose) or die ('A error executing query Line #387:' .mysql_error());
	$number_of_rows= mysql_numrows($result_drose);

	
	if (!$result_drose) {
		echo "Could not successfully run query ($query_drose) from DB: Line #391 " . mysql_error();
		 	exit;
	}

	if (mysql_num_rows($result_drose) == 0) {
		echo "No rows found, nothing to print so I am exiting: Line #397";
		exit;
	}

	/* FPDF is used to print data to pdf of view data*/
	//Initialize the 5 columns and the total
	$column_sname = "";
	$column_city = "";
	$column_state = "";
	$column_zip = "";
	$column_phone = "";

	while ($row = mysql_fetch_assoc($result_drose)) {
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
	$pdf->Cell(55,6,'Invoice #'. $oid);
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
	$pdf->Cell(24,6,$ccity . ",");
	$pdf->Cell(7,6,$cstate);
	$pdf->Cell(15,6,$czip);
	$pdf->SetX(100);
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(20,6,'Due date',0,0,'R');
	$pdf->Cell(20,6,$ddate,0,0,'R');
	$pdf->Ln();
	$pdf->SetFont('Arial','' ,10);
	$pdf->Cell(40,6,$cphone);
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

	$var = '';
	$count = 0;
	$price = 0;
	$total_price = 0;
	
	$qty = 0;
	$total_qty = 0;

	if ($pvs != '') 
	{
		
		if ($pcrown != '')
		{
			
			$var = "PVS: Crown" . "       Patient:". $pname;
			$qty = 1;
			$total_qty = $total_qty + $qty;
			$price = 75.00;
			$total_price = $total_price + $price;
			$count = $count + 1;

			$pdf->SetX(10);
			$pdf->Cell(90,6,$var,1,0,'L',1);
			$pdf->SetX(100);			
			$pdf->Cell(20,6,$qty,1,0,'L',1);
			$pdf->SetX(120);
			$pdf->Cell(20,6,$price,1,0,'L',1);
			$pdf->SetX(140);
			$pdf->Cell(20,6,$price,1,0,'L',1);
			$pdf->Ln();

		}

		if ($pnight != '')
		{
			$var = "PVS: Night Guard" . "       Patient:". $pname;
			$qty = 1;
			$total_qty = $total_qty + $qty;
			$price = 75.00;
			$total_price = $total_price + $price;
			$count = $count + 1;

			$pdf->SetX(10);
			$pdf->Cell(90,6,$var,1,0,'L',1);
			$pdf->SetX(100);			
			$pdf->Cell(20,6,$qty,1,0,'L',1);
			$pdf->SetX(120);
			$pdf->Cell(20,6,$price,1,0,'L',1);
			$pdf->SetX(140);
			$pdf->Cell(20,6,$price,1,0,'L',1);
			$pdf->Ln();

		}

		if($pdent != '')
		{

			$var = "PVS: Denture" . "       Patient:". $pname;
			$qty = 1;
			$total_qty = $total_qty + $qty;
			$price = 75.00;
			$total_price = $total_price + $price;
			$count = $count + 1;

			$pdf->SetX(10);
			$pdf->Cell(90,6,$var,1,0,'L',1);
			$pdf->SetX(100);			
			$pdf->Cell(20,6,$qty,1,0,'L',1);
			$pdf->SetX(120);
			$pdf->Cell(20,6,$price,1,0,'L',1);
			$pdf->SetX(140);
			$pdf->Cell(20,6,$price,1,0,'L',1);
			$pdf->Ln();

		}

		if($ppart != '')
		{

			$var = "PVS: Partial" . "       Patient:". $pname;
			$qty = 1;
			$total_qty = $total_qty + $qty;
			$price = 75.00;
			$total_price = $total_price + $price;
			$count = $count + 1;

			$pdf->SetX(10);
			$pdf->Cell(90,6,$var,1,0,'L',1);
			$pdf->SetX(100);			
			$pdf->Cell(20,6,$qty,1,0,'L',1);
			$pdf->SetX(120);
			$pdf->Cell(20,6,$price,1,0,'L',1);
			$pdf->SetX(140);
			$pdf->Cell(20,6,$price,1,0,'L',1);
			$pdf->Ln();

		}
		
		if($psurg != '')
		{

			$var = "PVS: Surgical guide" . "       Patient:". $pname;
			$qty = 1;
			$total_qty = $total_qty + $qty;
			$price = 75.00;
			$total_price = $total_price + $price;
			$count = $count + 1;

			$pdf->SetX(10);
			$pdf->Cell(90,6,$var,1,0,'L',1);
			$pdf->SetX(100);			
			$pdf->Cell(20,6,$qty,1,0,'L',1);
			$pdf->SetX(120);
			$pdf->Cell(20,6,$price,1,0,'L',1);
			$pdf->SetX(140);
			$pdf->Cell(20,6,$price,1,0,'L',1);
			$pdf->Ln();

		}

		if($palign != '')
		{

			$var = "PVS: Align" . "       Patient:". $pname;
			$qty = 1;
			$total_qty = $total_qty + $qty;
			$price = 75.00;
			$total_price = $total_price + $price;
			$count = $count + 1;

			$pdf->SetX(10);
			$pdf->Cell(90,6,$var,1,0,'L',1);
			$pdf->SetX(100);			
			$pdf->Cell(20,6,$qty,1,0,'L',1);
			$pdf->SetX(120);
			$pdf->Cell(20,6,$price,1,0,'L',1);
			$pdf->SetX(140);
			$pdf->Cell(20,6,$price,1,0,'L',1);
			$pdf->Ln();

		}

	}

	if ($digi != '')
	{

		if ($dcrown != '')
		{

			$var = "Digital: Crown" . "       Patient:". $pname;
			$qty = 1;
			$total_qty = $total_qty + $qty;
			$price = 75.00;
			$total_price = $total_price + $price;
			$count = $count + 1;

			$pdf->SetX(10);
			$pdf->Cell(90,6,$var,1,0,'L',1);
			$pdf->SetX(100);			
			$pdf->Cell(20,6,$qty,1,0,'L',1);
			$pdf->SetX(120);
			$pdf->Cell(20,6,$price,1,0,'L',1);
			$pdf->SetX(140);
			$pdf->Cell(20,6,$price,1,0,'L',1);
			$pdf->Ln();


		}

		if ($dnight != '')
		{

			$var = "Digital: Night Guard" . "       Patient:". $pname;
			$qty = 1;
			$total_qty = $total_qty + $qty;
			$price = 75.00;
			$total_price = $total_price + $price;
			$count = $count + 1;

			$pdf->SetX(10);
			$pdf->Cell(90,6,$var,1,0,'L',1);
			$pdf->SetX(100);			
			$pdf->Cell(20,6,$qty,1,0,'L',1);
			$pdf->SetX(120);
			$pdf->Cell(20,6,$price,1,0,'L',1);
			$pdf->SetX(140);
			$pdf->Cell(20,6,$price,1,0,'L',1);
			$pdf->Ln();

		}

		if($ddent != '')
		{
			$var = "Digital: Denture" . "       Patient:". $pname;
			$qty = 1;
			$total_qty = $total_qty + $qty;
			$price = 75.00;
			$total_price = $total_price + $price;
			$count = $count + 1;

			$pdf->SetX(10);
			$pdf->Cell(90,6,$var,1,0,'L',1);
			$pdf->SetX(100);			
			$pdf->Cell(20,6,$qty,1,0,'L',1);
			$pdf->SetX(120);
			$pdf->Cell(20,6,$price,1,0,'L',1);
			$pdf->SetX(140);
			$pdf->Cell(20,6,$price,1,0,'L',1);
			$pdf->Ln();

		}

		if($dpart != '')
		{

			$var = "Digital: Partial" . "       Patient:". $pname;
			$qty = 1;
			$total_qty = $total_qty + $qty;
			$price = 75.00;
			$total_price = $total_price + $price;
			$count = $count + 1;

			$pdf->SetX(10);
			$pdf->Cell(90,6,$var,1,0,'L',1);
			$pdf->SetX(100);			
			$pdf->Cell(20,6,$qty,1,0,'L',1);
			$pdf->SetX(120);
			$pdf->Cell(20,6,$price,1,0,'L',1);
			$pdf->SetX(140);
			$pdf->Cell(20,6,$price,1,0,'L',1);
			$pdf->Ln();

		}
		
		if($dsurg != '')
		{

			$var = "Digital: Surgical guide" . "       Patient:". $pname;
			$qty = 1;
			$total_qty = $total_qty + $qty;
			$price = 75.00;
			$total_price = $total_price + $price;
			$count = $count + 1;

			$pdf->SetX(10);
			$pdf->Cell(90,6,$var,1,0,'L',1);
			$pdf->SetX(100);			
			$pdf->Cell(20,6,$qty,1,0,'L',1);
			$pdf->SetX(120);
			$pdf->Cell(20,6,$price,1,0,'L',1);
			$pdf->SetX(140);
			$pdf->Cell(20,6,$price,1,0,'L',1);
			$pdf->Ln();

		}

		if($dalign != '')
		{

			$var = "Digital: Aligner" . "       Patient:". $pname;
			$qty = 1;
			$total_qty = $total_qty + $qty;
			$price = 75.00;
			$total_price = $total_price + $price;
			$count = $count + 1;

			$pdf->SetX(10);
			$pdf->Cell(90,6,$var,1,0,'L',1);
			$pdf->SetX(100);			
			$pdf->Cell(20,6,$qty,1,0,'L',1);
			$pdf->SetX(120);
			$pdf->Cell(20,6,$price,1,0,'L',1);
			$pdf->SetX(140);
			$pdf->Cell(20,6,$price,1,0,'L',1);
			$pdf->Ln();

		}

	
	}

	//$pdf->MultiCell(90,6,'Patient: '.$pname,1,0,'R',flase);
	$pdf->Ln();


	$BY = $pdf->GetY();
	$pdf->Line(10, $BY+5, 200, $BY+5);
	$pdf->SetY($BY+10);
	$pdf->SetX(10);
	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(120,6,'Total Amount',1,0,'L',1);
	$pdf->SetX(120);
	$pdf->Cell(40,6,$total_price,1,0,'L',1);
	$pdf->Ln();

	//$pdf->Output();
	$pdf->Output('invoice' . $oid . '.pdf', 'F');
	$filename = "/var/www/html/invoice" . $oid .".pdf";

	mysql_query("INSERT into `invoice` VALUES ('$oid', '$cid' , '$filename' )") 
	or die('unable to enter invoice data Line #546-547' .mysql_errno());
	ob_end_flush();
	$_SESSION['oid'] = $oid;

?>

</div>
<!--- Creates a go back button and redirect to admin page -->
<div align="right">
<p> View Invoice </p>
<form action="invoice.php">
<input type="submit" value ="View Invoice!">
</form>

</html>