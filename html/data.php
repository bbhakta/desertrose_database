<html>

<body>


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

/*
mysql_real_escape_string($unsafe_variable ); function is used, it is used to escape special mysql string
characters

*/
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

try {
$conn = new PDO("mysql:host=$ahost;dbname=$database", $auser, $apassword);

// set the PDO error mode to exception
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


//$connect = new mysqli($ahost, $auser, $apassword, $database);
/*
if ($connect->connect_errno) {
    echo "Failed to connect to MySQL: ( Line #319" . $connect->connect_errno . ") " . $connect->connect_error;
}
*/

if ( !$client_data = $conn->prepare("INSERT INTO client (id, fname, mname, lname, sname, city, state, zip, phonenum, email, liencenum)
						VALUES ('', :cfname, '', :clname, :csname, :ccity, :cstate, :czip, :cphone, :cemail, :lnum)") )
	echo "Prepare Error (Preparing Client's Query): ($conn->errno) $conn->error";

if ( !$client_data->bindParam(":cfname", $cfname) )
	echo "Binding Parameter (Client First Name) Error: ($conn->errno) $conn->error";

if ( !$client_data->bindParam(":clname", $clname) )
	echo "Binding Parameter (Client Last Name)Error: ($conn->errno) $conn->error";
//$client_data->bindParam(":clname", $clname);

if ( !$client_data->bindParam(":csname", $csname) )
	echo "Binding Parameter (Client Street Name) Error: ($conn->errno) $conn->error";

if ( !$client_data->bindParam(":ccity", $ccity) )
	echo "Binding Parameter (Client City Name) Error: ($conn->errno) $conn->error";

if ( !$client_data->bindParam(":cstate", $cstate) )
	echo "Binding Parameter (Client Zipcode) Error: ($conn->errno) $conn->error";

if ( !$client_data->bindParam(":czip", $czip) )
	echo "Binding Parameter (Client State) Error: ($conn->errno) $conn->error";

if ( !$client_data->bindParam(":cphone", $cphone) )
	echo "Binding Parameter (Client Phone-number) Error: ($conn->errno) $conn->error";

if ( !$client_data->bindParam(":cemail", $cemail) )
	echo "Binding Parameter (Client Email) Error: ($conn->errno) $conn->error";

if ( !$client_data->bindParam(":lnum", $lnum) )
	echo "Binding Parameter (Client Licence Number) Error: ($conn->errno) $conn->error";

if ( !$client_data->execute() )
	echo "Execute Error (Entering Client's Data): ($client_data->errno) $client_data->error"; 


/* Enter Patient data into database, by getting clinet id first*/

/*
	TODO: Need to find better way to link client and patient, for time being it is getting client information by quering client id when clinet 
	input thier data	
 */

/* Gets client id so we will have foregin key reference to client id*/


if ( !$client_id =  $conn->prepare("SELECT id from client WHERE fname = :fnamec and lname = :lnamec") )
	echo "Prepare Error (Selecting client's id): ($conn->errno) $conn->error";

if ( !$client_id->bindParam(":fnamec", $cfname) )
	echo "Binding Parameter (Client First Name) Error: ($conn->errno) $conn->error";

if ( !$client_id->bindParam(":lnamec", $clname) )
	echo "Binding Parameter (Client Last Name)Error: ($conn->errno) $conn->error";

if ( !$client_id->execute() )
	echo "Execute Error (Executing getting Client ID): ($client_id->errno) $client_id->error";

while($result_cid = $client_id->fetch(PDO::FETCH_ASSOC)){
	$cid = (int)$result_cid['id'];
}

/*
	Enter client contact data after getting client id

*/


if ( !$client_contact = $conn->prepare("INSERT INTO clientcontact (cid, cdate, confirmation)
						VALUES (:cid, :odate, '8930')") )
	echo "Prepare Error (Preparing clientcontact Query): ($conn->errno) $conn->error";

if ( !$client_contact->bindParam(":cid", $cid) )
	echo "Binding Parameter (Client's id in clientcontact) Error: ($conn->errno) $conn->error";

if ( !$client_contact->bindParam(":odate", $odate) )
	echo "Binding Parameter (Order dat in client_contact) Error: ($conn->errno) $conn->error";

if ( !$client_contact->execute() )
	echo "Execute Error (Entering clientcontact Data): ($client_contact->errno) $client_contact->error";
/*
	Enter patient data after getting client id
*/

if ( !$patient_data = $conn->prepare("INSERT INTO patient (id, cid, fname, mname, lname, age, gender, phonenum)
						VALUES ('', :cid, :pfname, '', :plname, :age, :gender, :pphone)" ) )
	echo "Prepare Error (Preparing Patient's Query): ($conn->errno) $conn->error";

if ( !$patient_data->bindParam(":cid", $cid) )
	echo "Binding Parameter (Client's id) Error: ($conn->errno) $conn->error";

if ( !$patient_data->bindParam(":pfname", $pfname) )
	echo "Binding Parameter (Patient First Name)Error: ($conn->errno) $conn->error";

if ( !$patient_data->bindParam(":plname", $plname) )
	echo "Binding Parameter (Patient Last Name) Error: ($conn->errno) $conn->error";

if ( !$patient_data->bindParam(":age", $age) )
	echo "Binding Parameter (Patient age) Error: ($conn->errno) $conn->error";

if ( !$patient_data->bindParam(":gender", $gender) )
	echo "Binding Parameter (Patient gender) Error: ($conn->errno) $conn->error";

if ( !$patient_data->bindParam(":pphone", $pphone) )
	echo "Binding Parameter (Patient phonenum) Error: ($conn->errno) $conn->error";

if ( !$patient_data->execute() )
	echo "Execute Error (Entering Patient's Data): ($patient_data->errno) $patient_data->error"; 

/* 
	Gets Patient ID 
*/

if ( !$patient_id =  $conn->prepare("SELECT id from patient WHERE cid = :cid ") )
	echo "Prepare Error (Selecting Patient's id): ($conn->errno) $conn->error";

if ( !$patient_id->bindParam(":cid", $cid) )
	echo "Binding Parameter (Client's id when getting Patient's id) Error: ($conn->errno) $conn->error";

if ( !$patient_id->execute() )
	echo "Execute Error (Executing getting Patient ID): ($patient_id->errno) $patient_id->error";

while($result_pid = $patient_id->fetch(PDO::FETCH_ASSOC)){
	
	$pid = (int)$result_pid['id'];
}


/* Enter ther placeorder data*/

if ( !$placeorder_data = $conn->prepare("INSERT INTO placeorder (id, cid, odate, ddate, priority)
						VALUES ('', :cid, :odate, :ddate, :priority)" ) )
	echo "Prepare Error (Preparing placeorder Query): ($conn->errno) $conn->error";

if ( !$placeorder_data->bindParam(":cid", $cid) )
	echo "Binding Parameter (Client's id when inserting placeorder) Error: ($conn->errno) $conn->error";

if ( !$placeorder_data->bindParam(":odate", $odate) )
	echo "Binding Parameter (placeorder Order Date) Error: ($conn->errno) $conn->error";

if ( !$placeorder_data->bindParam(":ddate", $ddate) )
	echo "Binding Parameter (placeorder Due Date) Error: ($conn->errno) $conn->error";

if ( !$placeorder_data->bindParam(":priority", $priority) )
	echo "Binding Parameter (placeorder priority) Error: ($conn->errno) $conn->error";

if ( !$placeorder_data->execute() )
	echo "Execute Error (Executing placeorder query): ($placeorder_data->errno) $placeorder_data->error";


/* 
	Gets Order's ID
*/

if ( !$oid_data =  $conn->prepare("SELECT id from placeorder WHERE cid = :cid ") )
	echo "Prepare Error (Selecting Order id): ($conn->errno) $conn->error";

if ( !$oid_data->bindParam(":cid", $cid) )
	echo "Binding Parameter (Client's id when getting Order ID) Error: ($conn->errno) $conn->error";

if ( !$oid_data->execute() )
	echo "Execute Error (Executing getting Order ID): ($oid_data->errno) $oid_data->error";

while($result_oid = $oid_data->fetch(PDO::FETCH_ASSOC)){
	
	$oid = (int)$result_oid['id'];
}

if ($pvs != '')
{

	if ( !$pvs_data = $conn->prepare("INSERT INTO pvsorder (oid, cid, pid)
						VALUES (:oid, :cid, :pid)" ) )
		echo "Prepare Error (Preparing pvs Query): ($conn->errno) $conn->error";

	if ( !$pvs_data->bindParam(":oid", $oid) )
		echo "Binding Parameter (Order ID when insering pvsorder) Error: ($conn->errno) $conn->error";

	if ( !$pvs_data->bindParam(":cid", $cid) )
		echo "Binding Parameter (Clinet ID when insering pvsorder) Error: ($conn->errno) $conn->error";

	if ( !$pvs_data->bindParam(":pid", $pid) )
		echo "Binding Parameter (Patient ID when insering pvsorder) Error: ($conn->errno) $conn->error";

	if ( !$pvs_data->execute() )
		echo "Execute Error (Executing placeorder query): ($pvs_data->errno) $pvs_data->error";


	if($pcrown != '')
	{
		/*
		$pcrow = $pcrown . " " . $pcdia . " " . $pczir . " " .
				$pcemax . " " . $pcgold . " " . $pcsha;
		*/
		
		if ( !$pcrown_data = $conn->prepare("INSERT INTO crown_order (Order_Type, oid, Diagnostic, Zirconia, Emax, Gold, Shad)
						VALUES (:pvs, :oid, :pcdia, :pczir, :pcemax, :pcgold, :pcsha)" ) )
		echo "Prepare Error (Preparing pcrown Query): ($conn->errno) $conn->error";

		if ( !$pcrown_data->bindParam(":pvs", $pvs) )
			echo "Binding Parameter (PVS when inserting pcrown) Error: ($conn->errno) $conn->error";

		if ( !$pcrown_data->bindParam(":oid", $oid) )
			echo "Binding Parameter (Order ID when insering pcrown) Error: ($conn->errno) $conn->error";

		if ( !$pcrown_data->bindParam(":pcdia", $pcdia) )
			echo "Binding Parameter (Diagnostic when inserting pcrown) Error: ($conn->errno) $conn->error";

		if ( !$pcrown_data->bindParam(":pczir", $pczir) )
			echo "Binding Parameter (Zirconia when inserting pcrown) Error: ($conn->errno) $conn->error";

		if ( !$pcrown_data->bindParam(":pcemax", $pcemax) )
			echo "Binding Parameter (Emax when inserting pcrown) Error: ($conn->errno) $conn->error";

		if ( !$pcrown_data->bindParam(":pcgold", $pcgold) )
			echo "Binding Parameter (Gold when inserting pcrown) Error: ($conn->errno) $conn->error";

		if ( !$pcrown_data->bindParam(":pcsha", $pcsha) )
			echo "Binding Parameter (Shade when inserting pcrown) Error: ($conn->errno) $conn->error";

		if ( !$pcrown_data->execute() )
			echo "Execute Error (Executing pcrown query): ($pcrown_data->errno) $pcrown_data->error";
	
	}

	if($pnight != '')
	{
		/*
		$pnig = $pnight . " " . $pnupp . " " . $pnlow . " " . $pnsof . " " . $pnhar 
				. " " . $pnmay . " " . $pnocl;
		*/
		
		if ( !$pnight_data = $conn->prepare("INSERT INTO night_guard (Order_Type, oid, Upper, Lower, Soft, Hard, May_Appliance, Ocllual)
						VALUES (:pvs, :oid, :pnupp, :pnlow, :pnsof, :pnhar, :pnmay, :pnocl)" ) )
		echo "Prepare Error (Preparing pnight Query): ($conn->errno) $conn->error";

		if ( !$pnight_data->bindParam(":pvs", $pvs) )
			echo "Binding Parameter (PVS when inserting pnight) Error: ($conn->errno) $conn->error";

		if ( !$pnight_data->bindParam(":oid", $oid) )
			echo "Binding Parameter (Order ID when insering pnight) Error: ($conn->errno) $conn->error";

		if ( !$pnight_data->bindParam(":pnupp", $pnupp) )
			echo "Binding Parameter (Upper when inserting pnight) Error: ($conn->errno) $conn->error";

		if ( !$pnight_data->bindParam(":pnlow", $pnlow) )
			echo "Binding Parameter (Lower when inserting pnight) Error: ($conn->errno) $conn->error";

		if ( !$pnight_data->bindParam(":pnsof", $pnsof) )
			echo "Binding Parameter (Soft when inserting pnight) Error: ($conn->errno) $conn->error";

		if ( !$pnight_data->bindParam(":pnhar", $pnhar) )
			echo "Binding Parameter (Hard when inserting pnight) Error: ($conn->errno) $conn->error";

		if ( !$pnight_data->bindParam(":pnmay", $pnmay) )
			echo "Binding Parameter (May_Appliance when inserting pnight) Error: ($conn->errno) $conn->error";

		if ( !$pnight_data->bindParam(":pnocl", $pnocl) )
			echo "Binding Parameter (Ocllual when inserting pnight) Error: ($conn->errno) $conn->error";

		if ( !$pnight_data->execute() )
			echo "Execute Error (Executing pnight query): ($pnight_data->errno) $pnight_data->error";

	}

	if($palign != '')
	{
		/*
		$palig = $palign . " " . $paupp . " " . $palow . " " . $parep;
		*/

		if ( !$palign_data = $conn->prepare("INSERT INTO aligner_order (Order_Type, oid, Upper, Lower, Replacement)
						VALUES (:pvs, :oid, :paupp, :palow, :parep)" ) )
		echo "Prepare Error (Preparing palign Query): ($conn->errno) $conn->error";

		if ( !$palign_data->bindParam(":pvs", $pvs) )
			echo "Binding Parameter (PVS when inserting palign) Error: ($conn->errno) $conn->error";

		if ( !$palign_data->bindParam(":oid", $oid) )
			echo "Binding Parameter (Order ID when insering palign) Error: ($conn->errno) $conn->error";

		if ( !$palign_data->bindParam(":paupp", $paupp) )
			echo "Binding Parameter (Upper when inserting palign) Error: ($conn->errno) $conn->error";

		if ( !$palign_data->bindParam(":palow", $palow) )
			echo "Binding Parameter (Lower when inserting palign) Error: ($conn->errno) $conn->error";

		if ( !$palign_data->bindParam(":parep", $parep) )
			echo "Binding Parameter (Replacement when inserting palign) Error: ($conn->errno) $conn->error";

		if ( !$palign_data->execute() )
			echo "Execute Error (Executing palign query): ($palign_data->errno) $palign_data->error";

	}

	if($psurg != '')
	{
		/*
		$psur = $psurg . " " . $psimp . " " . $pstoo . " " . $pssle;

		echo "Psurg" . $psur;
		*/
		
		if ( !$psurg_data = $conn->prepare("INSERT INTO surgical_order (Order_Type, oid, Implant_System, Tooth_Num, Sleeve)
						VALUES (:pvs, :oid, :psimp, :pstoo, :pssle)" ) )
		echo "Prepare Error (Preparing psurg Query): ($conn->errno) $conn->error";

		if ( !$psurg_data->bindParam(":pvs", $pvs) )
			echo "Binding Parameter (PVS when inserting psurg) Error: ($conn->errno) $conn->error";

		if ( !$psurg_data->bindParam(":oid", $oid) )
			echo "Binding Parameter (Order ID when insering psurg) Error: ($conn->errno) $conn->error";

		if ( !$psurg_data->bindParam(":psimp", $psimp) )
			echo "Binding Parameter (Implant_System when inserting psurg) Error: ($conn->errno) $conn->error";

		if ( !$psurg_data->bindParam(":pstoo", $pstoo) )
			echo "Binding Parameter (Tooth_Num when inserting psurg) Error: ($conn->errno) $conn->error";

		if ( !$psurg_data->bindParam(":pssle", $pssle) )
			echo "Binding Parameter (Sleeve when inserting psurg) Error: ($conn->errno) $conn->error";

		if ( !$psurg_data->execute() )
			echo "Execute Error (Executing psurg query): ($psurg_data->errno) $psurg_data->error";

	}

	if($pdent != '')
	{
		/*
		$pden = $pdent . " " . $pdupp . " " . $pdlow . " " . $pdtoo;

		echo "Pdent " . $pden;
		*/
		
		if ( !$pdent_data = $conn->prepare("INSERT INTO denture_order (Order_Type, oid, Upper, Lower, Shade)
						VALUES (:pvs, :oid, :pdupp, :pdlow, :pdtoo)" ) )
		echo "Prepare Error (Preparing pdent Query): ($conn->errno) $conn->error";

		if ( !$pdent_data->bindParam(":pvs", $pvs) )
			echo "Binding Parameter (PVS when inserting pdent) Error: ($conn->errno) $conn->error";

		if ( !$pdent_data->bindParam(":oid", $oid) )
			echo "Binding Parameter (Order ID when insering pdent) Error: ($conn->errno) $conn->error";

		if ( !$pdent_data->bindParam(":pdupp", $pdupp) )
			echo "Binding Parameter (Upper when inserting pdent) Error: ($conn->errno) $conn->error";

		if ( !$pdent_data->bindParam(":pdlow", $pdlow) )
			echo "Binding Parameter (Lower when inserting pdent) Error: ($conn->errno) $conn->error";

		if ( !$pdent_data->bindParam(":pdtoo", $pdtoo) )
			echo "Binding Parameter (Tooth/Shase when inserting pdent) Error: ($conn->errno) $conn->error";

		if ( !$pdent_data->execute() )
			echo "Execute Error (Executing pdent query): ($pdent_data->errno) $pdent_data->error";

	}

	if($ppart != '')
	{
		/*
		$ppar = $ppart . " " . $ppupp . " " . $pplow . " " . $ppmiss . " " . $ppsha;

		echo "Ppart" . $ppar;
		*/
		
		if ( !$ppart_data = $conn->prepare("INSERT INTO partial_order (Order_Type, oid, Upper, Lower, Missing_Teeth, Shade)
						VALUES (:pvs, :oid, :ppupp, :pplow, :ppmiss, :ppsha)" ) )
		echo "Prepare Error (Preparing ppart Query): ($conn->errno) $conn->error";

		if ( !$ppart_data->bindParam(":pvs", $pvs) )
			echo "Binding Parameter (PVS when inserting ppart) Error: ($conn->errno) $conn->error";

		if ( !$ppart_data->bindParam(":oid", $oid) )
			echo "Binding Parameter (Order ID when insering ppart) Error: ($conn->errno) $conn->error";

		if ( !$ppart_data->bindParam(":ppupp", $ppupp) )
			echo "Binding Parameter (Upper when inserting ppart) Error: ($conn->errno) $conn->error";

		if ( !$ppart_data->bindParam(":pplow", $pplow) )
			echo "Binding Parameter (Lower when inserting ppart) Error: ($conn->errno) $conn->error";

		if ( !$ppart_data->bindParam(":ppmiss", $ppmiss) )
			echo "Binding Parameter (Missing_Teeth when inserting ppart) Error: ($conn->errno) $conn->error";

		if ( !$ppart_data->bindParam(":ppsha", $ppsha) )
			echo "Binding Parameter (Shade when inserting ppart) Error: ($conn->errno) $conn->error";

		if ( !$ppart_data->execute() )
			echo "Execute Error (Executing pdent query): ($ppart_data->errno) $ppart_data->error";

	}


}

if ($digi != '')
{

	if ( !$digi_data = $conn->prepare("INSERT INTO digitalorder (oid, cid, pid)
						VALUES (:oid, :cid, :pid)" ) )
		echo "Prepare Error (Preparing digi Query): ($conn->errno) $conn->error";

	if ( !$digi_data->bindParam(":oid", $oid) )
		echo "Binding Parameter (Order ID when insering digiorder) Error: ($conn->errno) $conn->error";

	if ( !$digi_data->bindParam(":cid", $cid) )
		echo "Binding Parameter (Clinet ID when insering digiorder) Error: ($conn->errno) $conn->error";

	if ( !$digi_data->bindParam(":pid", $pid) )
		echo "Binding Parameter (Patient ID when insering digiorder) Error: ($conn->errno) $conn->error";

	if ( !$digi_data->execute() )
		echo "Execute Error (Executing placeorder query): ($digi_data->errno) $digi_data->error";


	if($dcrown != '')
	{
		/*
		$dcrow = $dcrown . " " . $dcdia . " " . $dczir . " " .
				$dcemax . " " . $dcgold . " " . $dcsha;
		*/
		
		if ( !$dcrown_data = $conn->prepare("INSERT INTO crown_order (Order_Type, oid, Diagnostic, Zirconia, Emax, Gold, Shad)
						VALUES (:digi, :oid, :dcdia, :dczir, :dcemax, :dcgold, :dcsha)" ) )
		echo "Prepare Error (Preparing dcrown Query): ($conn->errno) $conn->error";

		if ( !$dcrown_data->bindParam(":digi", $digi) )
			echo "Binding Parameter (Digi when inserting dcrown) Error: ($conn->errno) $conn->error";

		if ( !$dcrown_data->bindParam(":oid", $oid) )
			echo "Binding Parameter (Order ID when insering dcrown) Error: ($conn->errno) $conn->error";

		if ( !$dcrown_data->bindParam(":dcdia", $dcdia) )
			echo "Binding Parameter (Diagnostic when inserting dcrown) Error: ($conn->errno) $conn->error";

		if ( !$dcrown_data->bindParam(":dczir", $dczir) )
			echo "Binding Parameter (Zirconia when inserting dcrown) Error: ($conn->errno) $conn->error";

		if ( !$dcrown_data->bindParam(":dcemax", $dcemax) )
			echo "Binding Parameter (Emax when inserting dcrown) Error: ($conn->errno) $conn->error";

		if ( !$dcrown_data->bindParam(":dcgold", $dcgold) )
			echo "Binding Parameter (Gold when inserting dcrown) Error: ($conn->errno) $conn->error";

		if ( !$dcrown_data->bindParam(":dcsha", $dcsha) )
			echo "Binding Parameter (Shade when inserting dcrown) Error: ($conn->errno) $conn->error";

		if ( !$dcrown_data->execute() )
			echo "Execute Error (Executing dcrown query): ($dcrown_data->errno) $dcrown_data->error";
	
	}

	if($dnight != '')
	{
		/*
		$dnig = $dnight . " " . $dnupp . " " . $dnlow . " " . $dnsof . " " . $dnhar 
				. " " . $dnmay . " " . $dnocl;
		*/
		
		if ( !$dnight_data = $conn->prepare("INSERT INTO night_guard (Order_Type, oid, Upper, Lower, Soft, Hard, May_Appliance, Ocllual)
						VALUES (:digi, :oid, :dnupp, :dnlow, :dnsof, :dnhar, :dnmay, :dnocl)" ) )
		echo "Prepare Error (Preparing dnight Query): ($conn->errno) $conn->error";

		if ( !$dnight_data->bindParam(":digi", $digi) )
			echo "Binding Parameter (PVS when inserting dnight) Error: ($conn->errno) $conn->error";

		if ( !$dnight_data->bindParam(":oid", $oid) )
			echo "Binding Parameter (Order ID when insering dnight) Error: ($conn->errno) $conn->error";

		if ( !$dnight_data->bindParam(":dnupp", $dnupp) )
			echo "Binding Parameter (Upper when inserting dnight) Error: ($conn->errno) $conn->error";

		if ( !$dnight_data->bindParam(":dnlow", $dnlow) )
			echo "Binding Parameter (Lower when inserting dnight) Error: ($conn->errno) $conn->error";

		if ( !$dnight_data->bindParam(":dnsof", $dnsof) )
			echo "Binding Parameter (Soft when inserting dnight) Error: ($conn->errno) $conn->error";

		if ( !$dnight_data->bindParam(":dnhar", $dnhar) )
			echo "Binding Parameter (Hard when inserting dnight) Error: ($conn->errno) $conn->error";

		if ( !$dnight_data->bindParam(":dnmay", $dnmay) )
			echo "Binding Parameter (May_Appliance when inserting dnight) Error: ($conn->errno) $conn->error";

		if ( !$dnight_data->bindParam(":dnocl", $dnocl) )
			echo "Binding Parameter (Ocllual when inserting dnight) Error: ($conn->errno) $conn->error";

		if ( !$dnight_data->execute() )
			echo "Execute Error (Executing dnight query): ($dnight_data->errno) $dnight_data->error";

	}

	if($dalign != '')
	{
		/*
		$dalig = $dalign . " " . $daupp . " " . $dalow . " " . $darep;
		*/

		if ( !$dalign_data = $conn->prepare("INSERT INTO aligner_order (Order_Type, oid, Upper, Lower, Replacement)
						VALUES (:digi, :oid, :daupp, :dalow, :darep)" ) )
		echo "Prepare Error (Preparing dalign Query): ($conn->errno) $conn->error";

		if ( !$dalign_data->bindParam(":digi", $digi) )
			echo "Binding Parameter (PVS when inserting dalign) Error: ($conn->errno) $conn->error";

		if ( !$dalign_data->bindParam(":oid", $oid) )
			echo "Binding Parameter (Order ID when insering dalign) Error: ($conn->errno) $conn->error";

		if ( !$dalign_data->bindParam(":daupp", $daupp) )
			echo "Binding Parameter (Upper when inserting dalign) Error: ($conn->errno) $conn->error";

		if ( !$dalign_data->bindParam(":dalow", $dalow) )
			echo "Binding Parameter (Lower when inserting dalign) Error: ($conn->errno) $conn->error";

		if ( !$dalign_data->bindParam(":darep", $darep) )
			echo "Binding Parameter (Replacement when inserting dalign) Error: ($conn->errno) $conn->error";

		if ( !$dalign_data->execute() )
			echo "Execute Error (Executing dalign query): ($dalign_data->errno) $dalign_data->error";

	}

	if($dsurg != '')
	{
		/*
		$dsur = $dsurg . " " . $dsimp . " " . $dstoo . " " . $dssle;

		echo "Psurg" . $psur;
		*/
		
		if ( !$dsurg_data = $conn->prepare("INSERT INTO surgical_order (Order_Type, oid, Implant_System, Tooth_Num, Sleeve)
						VALUES (:digi, :oid, :dsimp, :dstoo, :dssle)" ) )
		echo "Prepare Error (Preparing dsurg Query): ($conn->errno) $conn->error";

		if ( !$dsurg_data->bindParam(":digi", $digi) )
			echo "Binding Parameter (PVS when inserting dsurg) Error: ($conn->errno) $conn->error";

		if ( !$dsurg_data->bindParam(":oid", $oid) )
			echo "Binding Parameter (Order ID when insering dsurg) Error: ($conn->errno) $conn->error";

		if ( !$dsurg_data->bindParam(":dsimp", $dsimp) )
			echo "Binding Parameter (Implant_System when inserting dsurg) Error: ($conn->errno) $conn->error";

		if ( !$dsurg_data->bindParam(":dstoo", $dstoo) )
			echo "Binding Parameter (Tooth_Num when inserting dsurg) Error: ($conn->errno) $conn->error";

		if ( !$dsurg_data->bindParam(":dssle", $dssle) )
			echo "Binding Parameter (Sleeve when inserting dsurg) Error: ($conn->errno) $conn->error";

		if ( !$dsurg_data->execute() )
			echo "Execute Error (Executing dsurg query): ($dsurg_data->errno) $dsurg_data->error";

	}

	if($ddent != '')
	{
		/*
		$pden = $ddent . " " . $ddupp . " " . $ddlow . " " . $ddtoo;

		echo "Pdent " . $pden;
		*/
		
		if ( !$ddent_data = $conn->prepare("INSERT INTO denture_order (Order_Type, oid, Upper, Lower, Shade)
						VALUES (:digi, :oid, :ddupp, :ddlow, :ddtoo)" ) )
		echo "Prepare Error (Preparing ddent Query): ($conn->errno) $conn->error";

		if ( !$ddent_data->bindParam(":digi", $digi) )
			echo "Binding Parameter (PVS when inserting ddent) Error: ($conn->errno) $conn->error";

		if ( !$ddent_data->bindParam(":oid", $oid) )
			echo "Binding Parameter (Order ID when insering ddent) Error: ($conn->errno) $conn->error";

		if ( !$ddent_data->bindParam(":ddupp", $ddupp) )
			echo "Binding Parameter (Upper when inserting ddent) Error: ($conn->errno) $conn->error";

		if ( !$ddent_data->bindParam(":ddlow", $ddlow) )
			echo "Binding Parameter (Lower when inserting ddent) Error: ($conn->errno) $conn->error";

		if ( !$ddent_data->bindParam(":ddtoo", $ddtoo) )
			echo "Binding Parameter (Tooth/Shase when inserting ddent) Error: ($conn->errno) $conn->error";

		if ( !$ddent_data->execute() )
			echo "Execute Error (Executing ddent query): ($ddent_data->errno) $ddent_data->error";

	}

	if($dpart != '')
	{
		/*
		$ppar = $dpart . " " . $dpupp . " " . $dplow . " " . $dpmiss . " " . $dpsha;

		echo "Ppart" . $ppar;
		*/
	
		if ( !$dpart_data = $conn->prepare("INSERT INTO partial_order (Order_Type, oid, Upper, Lower, Missing_Teeth, Shade)
						VALUES (:digi, :oid, :dpupp, :dplow, :dpmiss, :dpsha)" ) )
		echo "Prepare Error (Preparing dpart Query): ($conn->errno) $conn->error";

		if ( !$dpart_data->bindParam(":digi", $digi) )
			echo "Binding Parameter (PVS when inserting dpart) Error: ($conn->errno) $conn->error";

		if ( !$dpart_data->bindParam(":oid", $oid) )
			echo "Binding Parameter (Order ID when insering dpart) Error: ($conn->errno) $conn->error";

		if ( !$dpart_data->bindParam(":dpupp", $dpupp) )
			echo "Binding Parameter (Upper when inserting dpart) Error: ($conn->errno) $conn->error";

		if ( !$dpart_data->bindParam(":dplow", $dplow) )
			echo "Binding Parameter (Lower when inserting dpart) Error: ($conn->errno) $conn->error";

		if ( !$dpart_data->bindParam(":dpmiss", $dpmiss) )
			echo "Binding Parameter (Missing_Teeth when inserting dpart) Error: ($conn->errno) $conn->error";

		if ( !$dpart_data->bindParam(":dpsha", $dpsha) )
			echo "Binding Parameter (Shade when inserting dpart) Error: ($conn->errno) $conn->error";

		if ( !$dpart_data->execute() )
			echo "Execute Error (Executing ddent query): ($dpart_data->errno) $dpart_data->error";

	}


}

	if ( !$receivedorder_data = $conn->prepare("INSERT INTO receivedorder (oid, cid, rdate)
						VALUES (:oid, :cid, :odate)" ) )
	echo "Prepare Error (Preparing receivedorder Query): ($conn->errno) $conn->error";

	if ( !$receivedorder_data->bindParam(":oid", $oid) )
		echo "Binding Parameter (Order ID when inserting receivedorder) Error: ($conn->errno) $conn->error";

	if ( !$receivedorder_data->bindParam(":cid", $cid) )
		echo "Binding Parameter (Client ID when insering receivedorder) Error: ($conn->errno) $conn->error";

	if ( !$receivedorder_data->bindParam(":odate", $odate) )
		echo "Binding Parameter (Order Date when inserting receivedorder) Error: ($conn->errno) $conn->error";

	if ( !$receivedorder_data->execute() )
		echo "Execute Error (Executing receivedorder_data query): ($receivedorder_data->errno) $receivedorder_data->error";

	/* Execute drose query */
	
	if ( !$query_drose =  $conn->prepare("SELECT * FROM drose ") )
	echo "Prepare Error (Selecting drose data): ($conn->errno) $conn->error";    
	
	if ( !$query_drose->execute() )
		echo "Execute Error (Executing drose query): ($query_drose->errno) $query_drose->error";

	$number_of_rows = $query_drose->fetchColumn(); 


	/* FPDF is used to print data to pdf of view data*/
	//Initialize the 5 columns and the total
	$column_sname = "";
	$column_city = "";
	$column_state = "";
	$column_zip = "";
	$column_phone = "";

	while ($row = $query_drose->fetch(PDO::FETCH_ASSOC)) {
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


	if ( !$invoice_data = $conn->prepare("INSERT INTO invoice (id, cid, file)
						VALUES (:oid, :cid, :filename)" ) )
	echo "Prepare Error (Preparing invoice Query): ($conn->errno) $conn->error";

	if ( !$invoice_data->bindParam(":oid", $oid) )
		echo "Binding Parameter (Order ID when inserting into invoice) Error: ($conn->errno) $conn->error";

	if ( !$invoice_data->bindParam(":cid", $cid) )
		echo "Binding Parameter (Client ID when inserting into invoice) Error: ($conn->errno) $conn->error";

	
	if ( !$invoice_data->bindParam(":filename", $filename) )
		echo "Binding Parameter (File when insering into invoice) Error: ($conn->errno) $conn->error";
	
	if ( !$invoice_data->execute() )
		echo "Execute Error (Executing invoice query): ($invoice_data->errno) $invoice_data->error";

	ob_end_flush();
	$_SESSION['oid'] = $oid;


/*
	Cloes the connnection for the queires
*/
$client_data->close();
$client_id->close();
$client_contact->close();
$patient_data->close();
$patient_id->close();
$placeorder_data->close();
$oid_data->close();
$pvs_data->close();
$pcrown_data->close();
$pnight_data->close();
$palign_data->close();
$psurg_data->close();
$pdent_data->close();
$ppart_data->close();
$digi_data->close();
$dcrown_data->close();
$dnight_data->close();
$dalign_data->close();
$dsurg_data->close();
$ddent_data->close();
$dpart_data->close();
$receivedorder_data->close();
$query_drose->close();
$invoice_data->close();

} catch (Exception $e) {

echo "Error in connection to database" . $e->getMessage() . "</br>";

die();

}



	
?>


<!--- Creates a go back button and redirect to admin page -->
<div align="right">

<p> View Invoice </p>

<form action="invoice.php">

<input type="submit" value ="View Invoice!">

</form>

</div>
</body>

</html>