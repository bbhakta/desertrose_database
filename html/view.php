<html>
<!--- This is a fiel where admin can view data and i need to more feature  -->
<!--
	TODO:
	Look up order by date, cid 
	Check if they paid order
	
-->
<div align="center">
<?php

/* http://www.fpdf.org/en/script/script10.php */
ob_start();
require('fpdf/fpdf.php');
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
		$column_id = "";
		$column_cname = "";
		$column_cadd = "";
		$column_cphone = "";
		$column_lnum = "";

		while ($row = mysql_fetch_assoc($result)) {
					/* Gets the data from the table and comines the string */
					/* The formating for outpting data needs more work*/   
					$id = $row["id"];
					/* Combine the name string*/
					$cname = $row["fname"]. " ". $row["mname"].  " ". $row["lname"];
					/* Combine the address string*/
					$cadd = $row["sname"]. " ". $row["city"]. " " .$row["state"]. " " .$row["zip"];
					/* Combine the phone and name string m*/
					$cphone = $row["phonenum"]. "Email:" . $row["email"];
					$lnuum = $row["liencenum"];

					/* Assign approriate variable so we can print it to pdf*/
					$column_id = $column_id.$id."\n";
					$column_cname = $column_cname.$cname."\n";
					$column_cadd = $column_cadd.$cadd."\n";
					$column_cphone = $column_cphone.$cphone."\n";
					$column_lnum = $column_lnum.$lnuum."\n";

				}
		/* Close the conncection */
		//mysql_close($connect);
				
		/* This generate the pdf file still trying to figure out how the formating works*/
		/* Create a new PDF file */
		$pdf=new FPDF();
		$pdf->AddPage();


		//Fields Name position
		$Y_Fields_Name_position = 10;
		//Table position, under Fields Name
		$Y_Table_Position = 16;

		//First create each Field Name
		//Gray color filling each Field Name box
		$pdf->SetFillColor(232,232,232);
		//Bold Font for Field Name
		$pdf->SetFont('Arial','B',12);
		$pdf->SetY($Y_Fields_Name_position);
		//sets the the cell header position
		$pdf->SetX(10);
		//sets the cell size for text
		$pdf->Cell(15,6,'ID',1,0,'L',1);
		//offset for next cell 
		$pdf->SetX(25);
		$pdf->Cell(40,6,'CLIENT NAME',1,0,'L',1);
		$pdf->SetX(65);
		$pdf->Cell(100,6,'CLIENT ADDRESS',1,0,'C',1);
		$pdf->SetX(165);
		$pdf->Cell(20,6,'Licence #',1,0,'C',1);
		$pdf->Ln();

		//Now show the 3 columns
		$pdf->SetFont('Arial','',10);
		$pdf->SetY($Y_Table_Position);
		$pdf->SetX(10);
		$pdf->MultiCell(15,6,$column_id,1);
		$pdf->SetY($Y_Table_Position);
		$pdf->SetX(25);
		$pdf->MultiCell(40,6,$column_cname,1);
		$pdf->SetY($Y_Table_Position);
		$pdf->SetX(65);
		$pdf->MultiCell(100,6,$column_cadd,1);
		$pdf->SetY($Y_Table_Position);
		$pdf->SetX(165);
		$pdf->MultiCell(20,6,$column_lnum,1);

		//Create lines (boxes) for each ROW (value)
		//If you don't use the following code, you don't create the lines separating each row
		

		$i = 0;
		$pdf->SetY($Y_Table_Position);
		while ($i < $number_of_rows)
		{
		    $pdf->SetX(10);
		    //has to be total size of the multiecell 20+40+100
		    $pdf->MultiCell(175,6,'',1);
		    $i = $i +1;
		}

		$pdf->SetFont('Arial','B',12);
		$Y = $pdf->GetY(); 
		//$X = $pdf->GetX();
		$pdf->SetY($Y+10);
		$pdf->SetX(10);
		//sets the cell size for text
		$pdf->Cell(15,6,'ID',1,0,'L',1);
		$pdf->SetX(25);
		$pdf->Cell(100,6,'phonenum#',1,0,'C',1);
		$pdf->Ln();

		$pdf->SetFont('Arial','',10);
		$pdf->SetY($Y_Table_Position+$Y);
		$pdf->SetX(10);
		$pdf->MultiCell(15,6,$column_id,1);
		$pdf->SetY($Y_Table_Position+ $Y);
		$pdf->SetX(25);
		$pdf->MultiCell(100,6,$column_cphone);

		$i = 0;
		$pdf->SetY($Y_Table_Position + $Y);
		while ($i < $number_of_rows)
		{
		    $pdf->SetX(10);
		    //has to be total size of the multiecell 20+40+100
		    $pdf->MultiCell(115,6,'',1);
		    $i = $i +1;
		}
		/* This is end of test*/
		$pdf->Output();
		ob_end_flush();
	/* Closes the connection and frees the data*/
	mysql_free_result($result);
	break;

/* We will have to gothrough same pdf printing process as above but we might need to think above function because most of the code will be repated*/
	case "order due today":
		$tdate = date('Y-m-d');
		$query_oid =  "SELECT `id`, `cid` FROM `placeorder` WHERE ddate='$tdate' ";
		//$query = "select p.id, p.cid, p.odate, p.ddate from `placeorder` p, `receivedorder` r where p.id = r.oid and p.ddate =" .  $tdate;
		$result_oid = mysql_query($query_oid) or die ('A error occured:' .mysql_error());
		$number_of_rows = mysql_numrows($result_oid);
		
		if (!$result_oid) {
    		echo "Could not successfully run query ($query) from DB: " . mysql_error();
   		 	exit;
		}

		if (mysql_num_rows($result_oid) != 0) {
    		echo "No rows found, nothing to print so I am exiting";
    		exit;

			/* FPDF is used to print data to pdf of view data*/
			//Initialize the 5 columns and the total
			$column_oid = "";
			$column_cid = "";
			$column_odate = "";
			$column_ddate = "";

		while ($row = mysql_fetch_assoc($result_oid)) {
					/* Gets the data from the table and comines the string */
					/* The formating for outpting data needs more work*/   
					$oid = $row["id"];
					/* Combine the name string*/
					$cid = $row["cid"];
					/* Combine the address string*/
					$odate = $row["odate"];
					/* Combine the phone and name string m*/
					$ddate = $row["ddate"];

					/* Assign approriate variable so we can print it to pdf*/
					$column_oid = $column_oid.$oid."\n";
					$column_cid= $column_cid.$cid."\n";
					$column_odate = $column_odate.$odate."\n";
					$column_ddate = $column_ddate.$ddate."\n";

				}

		/* Close the conncection */
		//mysql_close($connect);
				
		/* This generate the pdf file still trying to figure out how the formating works*/
		/* Create a new PDF file */
		$pdf=new FPDF();
		$pdf->AddPage();


		//Fields Name position
		$Y_Fields_Name_position = 10;
		//Table position, under Fields Name
		$Y_Table_Position = 16;

		//First create each Field Name
		//Gray color filling each Field Name box
		$pdf->SetFillColor(232,232,232);
		//Bold Font for Field Name
		$pdf->SetFont('Arial','B',12);
		$pdf->SetY($Y_Fields_Name_position);
		//sets the the cell header position
		$pdf->SetX(10);
		//sets the cell size for text
		$pdf->Cell(25,6,'ORDER ID',1,0,'L',1);
		//offset for next cell 
		$pdf->SetX(35);
		$pdf->Cell(25,6,'CLIENT ID',1,0,'L',1);
		$pdf->SetX(60);
		$pdf->Cell(60,6,'ORDER DATE',1,0,'C',1);
		$pdf->SetX(120);
		$pdf->Cell(40,6,'DUE DATE',1,0,'C',1);
		$pdf->Ln();

		//Now show the 3 columns
		$pdf->SetFont('Arial','',10);
		$pdf->SetY($Y_Table_Position);
		$pdf->SetX(10);
		$pdf->MultiCell(25,6,$column_oid,1);
		$pdf->SetY($Y_Table_Position);
		$pdf->SetX(35);
		$pdf->MultiCell(25,6,$column_cid,1);
		$pdf->SetY($Y_Table_Position);
		$pdf->SetX(60);
		$pdf->MultiCell(60,6,$column_odate,1);
		$pdf->SetY($Y_Table_Position);
		$pdf->SetX(120);
		$pdf->MultiCell(40,6,$column_ddate,1);

		$pdf->SetFillColor(232,232,232);
		//Bold Font for Field Name
		$pdf->SetFont('Arial','B',12);
		$pdf->SetY($Y_Fields_Name_position);
		//sets the the cell header position
		$pdf->SetX(10);
		//sets the cell size for text
		$pdf->Cell(15,6,'ID',1,0,'L',1);
		//offset for next cell 
		

		//Create lines (boxes) for each ROW (value)
		//If you don't use the following code, you don't create the lines separating each row
		

		$i = 0;
		$pdf->SetY($Y_Table_Position);
		while ($i < $number_of_rows)
		{
		    $pdf->SetX(10);
		    //has to be total size of the multiecell 20+40+100
		    $pdf->MultiCell(150,6,'',1);
		    $i = $i +1;
		}

		$pdf->Output();
		ob_end_flush();

	}

	break;

	case "view order":

		$query_oid =  "SELECT * FROM `placeorder`";
		//$query = "select p.id, p.cid, p.odate, p.ddate from `placeorder` p, `receivedorder` r where p.id = r.oid and p.ddate =" .  $tdate;
		$result_oid = mysql_query($query_oid) or die ('A error occured:' .mysql_error());
		$number_of_rows = mysql_numrows($result_oid);

		if (mysql_num_rows($result_oid) != 0) { //  pretence 1
    		//echo "No rows found, nothing to print so I am exiting";
    		//exit;

			/* FPDF is used to print data to pdf of view data*/
			//Initialize the 5 columns and the total
			$column_oid = "";
			$column_cid = "";
			$column_odate = "";
			$column_ddate = "";
			//$column_cid = "";
			$column_cname = "";
			$column_cadd = "";
			$column_cphone = "";
			$column_lnum = "";

			while ($row_oid = mysql_fetch_assoc($result_oid)) { //pretence 2
				/* Gets the data from the table and comines the string */
				/* The formating for outpting data needs more work*/   
				$oid = $row_oid["id"];
				/* Combine the name string*/
				$cid = $row_oid["cid"];
				/* Combine the address string*/
				$odate = $row_oid["odate"];
				/* Combine the phone and name string m*/
				$ddate = $row_oid["ddate"];

				/* Assign approriate variable so we can print it to pdf*/
				$column_oid = $column_oid . $oid . "\n";
				$column_cid= $column_cid . $cid . "\n";
				$column_odate = $column_odate . $odate . "\n";
				$column_ddate = $column_ddate . $ddate . "\n";

				$query_cid = "SELECT * FROM `client`";
				$result_cid = mysql_query($query_cid) or die ('A error occured:' .mysql_error());
				$number_of_rows_cid = mysql_numrows($result_cid);
				
				if (mysql_num_rows($result_cid) != 0) { //pretence 3
				/* FPDF is used to print data to pdf of view data*/
				//Initialize the 5 columns and the total		

				while ($row_cid = mysql_fetch_assoc($result_cid)) { //pretence 4
						/* Gets the data from the table and comines the string */
						/* The formating for outpting data needs more work*/   
						$cid = $row_cid["id"];
						/* Combine the name string*/
						$cname = $row_cid["fname"]. " ". $row_cid["mname"].  " ". $row_cid["lname"];
						/* Combine the address string*/
						$cadd = $row_cid["sname"]. " ". $row_cid["city"]. " " .$row_cid["state"]. " " .$row_cid["zip"];
						/* Combine the phone and name string m*/
						$cphone = $row_cid["phonenum"]. "Email:" . $row_cid["email"];
						$lnuum = $row_cid["liencenum"];

						/* Assign approriate variable so we can print it to pdf*/
						//$column_cid = $column_cid.$cid."\n";
						$column_cname = $column_cname.$cname."\n";
						$column_cadd = $column_cadd.$cadd."\n";
						$column_cphone = $column_cphone.$cphone."\n";
						$column_lnum = $column_lnum.$lnuum."\n";

								
				/*
				$query_aligner =  "SELECT `oid` FROM `aligner_order` WHERE oid='$oid'";
				$result_aligner = mysql_query($query_aligner) or die ('A error occured:' .mysql_error());
				
				if (!$result_aligner) {
	    		echo "Could not successfully run query ($query) from DB: " . mysql_error();
	   		 	exit;
				}

				if (mysql_num_rows($result_aligner) != 0) {
	    		
	    		exit;
				}
				*/


					
			/* This generate the pdf file still trying to figure out how the formating works*/
			/* Create a new PDF file */
			$pdf=new FPDF();
			$pdf->AddPage();


			//Fields Name position
			$Y_Fields_Name_position = 10;
			//Table position, under Fields Name
			$Y_Table_Position = 16;

			//First create each Field Name
			//Gray color filling each Field Name box
			$pdf->SetFillColor(232,232,232);
			//Bold Font for Field Name
			$pdf->SetFont('Arial','B',12);
			$pdf->SetY($Y_Fields_Name_position);
			//sets the the cell header position
			$pdf->SetX(10);
			//sets the cell size for text
			$pdf->Cell(25,6,'ORDER ID',1,0,'L',1);
			//offset for next cell 
			$pdf->SetX(35);
			$pdf->Cell(25,6,'CLIENT ID',1,0,'L',1);
			$pdf->SetX(60);
			$pdf->Cell(60,6,'ORDER DATE',1,0,'C',1);
			$pdf->SetX(120);
			$pdf->Cell(40,6,'DUE DATE',1,0,'C',1);
			$pdf->Ln();

			//Now show the 3 columns
			
			$pdf->SetFont('Arial','',10);
			$pdf->SetY($Y_Table_Position);
			$pdf->SetX(10);
			$pdf->MultiCell(25,6,$column_oid,1);
			$pdf->SetY($Y_Table_Position);
			$pdf->SetX(35);
			$pdf->MultiCell(25,6,$column_cid,1);
			$pdf->SetY($Y_Table_Position);
			$pdf->SetX(60);
			$pdf->MultiCell(60,6,$column_odate,1);
			$pdf->SetY($Y_Table_Position);
			$pdf->SetX(120);
			$pdf->MultiCell(40,6,$column_ddate,1);
			$pdf->Ln();

			$Y = $pdf->GetY(); 
			//$pdf->SetX(10);
			$pdf->SetY($Y-6);
			$pdf->SetX(10);
			$pdf->Cell(40,6,'CLIENT NAME',1,0,'L',1);
			$pdf->SetX(65-15);
			$pdf->Cell(100,6,'CLIENT ADDRESS',1,0,'C',1);
			$pdf->SetX(165-15);
			$pdf->Cell(20,6,'Licence #',1,0,'C',1);
			$pdf->Ln();
			

			//Now show the 3 columns
			$pdf->SetFont('Arial','',10);
			$pdf->SetY($Y+6);
			$pdf->SetX(10);
			$pdf->MultiCell(15,6,$column_id,1);
			$pdf->SetY($Y+6);
			$pdf->SetX(25);
			$pdf->MultiCell(40,6,$column_cname,1);
			$pdf->SetY($Y+6);
			$pdf->SetX(65);
			$pdf->MultiCell(100,6,$column_cadd,1);
			$pdf->SetY($Y+6);
			$pdf->SetX(165);
			$pdf->MultiCell(20,6,$column_lnum,1);
			$pdf->Ln();
			
			//Create lines (boxes) for each ROW (value)
			//If you don't use the following code, you don't create the lines separating each row
			

			$i = 0;
			$Y = $pdf->GetY(); 
			//$X = $pdf->GetX();
			$pdf->SetY($Y+10);

			while ($i < $number_of_rows+$number_of_rows_cid)
			{ //pretence 5
			    $pdf->SetX(10);
			    //has to be total size of the multiecell 20+40+100
			    $pdf->MultiCell(150,6,'',1);
			    $i = $i +1;
			} //pretence 5
			}// client if pretence 3
			} //pretence 4
			} //pretence 2

		}//pretence 1
		$pdf->Output();
		ob_end_flush();

	break;

	case "view invoice":
		/* Need to create invoice directory so user can select any invoice*/
		/* TO DO: FIND a way to name invoice so when we get any invoice not just one*/
		 // The location of the PDF file on the server.
		$filename = "/var/www/html/invoice.pdf";

		// Let the browser know that a PDF file is coming.
		header("Content-type: application/pdf");
		header("Content-Length: " . filesize($filename));

		// Send the file to the browser.
		readfile($filename);

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


