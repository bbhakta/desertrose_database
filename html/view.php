<html>
<!--- This is a fiel where admin can view data and i need to more feature  -->
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
					$cadd = $row["stname"]. " ". $row["city"]. " " .$row["state"]. " " .$row["zip"];
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
		mysql_close($connect);
				
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

		/* This is end of test*/
		$pdf->Output();
		ob_end_flush();
	/* Closes the connection and frees the data*/
	mysql_free_result($result);
	break;

/* We will have to gothrough same pdf printing process as above but we might need to think above function because most of the code will be repated*/
	case "client contact":
		echo "orders";
	break;

	case "complete order":
		echo "complete order";
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


