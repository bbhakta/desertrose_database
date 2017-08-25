<?
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
		$pdf->Cell(23,6,$column_city);
		$pdf->Cell(7,6,$column_state);
		$pdf->Cell(15,6,$column_zip);
		$pdf->Ln();
		$pdf->Cell(40,6,$column_phone);


		$cquery = "SELECT * FROM `client` WHERE mname = 'w'";
		$cresult = mysql_query($cquery) or die ('A error occured:' .mysql_error());
		$cnumber_of_rows = mysql_numrows($cresult);

		if (!$cresult) {
    		echo "Could not successfully run query ($query) from DB: " . mysql_error();
   		 	exit;
		}

		if (mysql_num_rows($cresult) == 0) {
    		echo "No rows found, nothing to print so am exiting";
    		exit;
		}

		$column_cname = "";
		$column_csname = "";
		$column_ccity = "";
		$column_cstate = "";
		$column_czip = "";
		$column_cphone = "";
		$column_licnum = "";

		while ($crow = mysql_fetch_assoc($cresult)) {
					/* Gets the data from the table and comines the string */
					/* The formating for outpting data needs more work*/
					$column_cid = $crow["id"];
					$cname = $crow["fname"]. " ". $crow["mname"].  " ". $crow["lname"];

					$csname = $crow["sname"];
					/* Combine the name string*/
					$ccity = $crow["city"];
					/* Combine the address string*/
					$cstate = $crow["state"];
					/* Combine the phone and name string m*/
					$czip = $crow["zip"];
					/* Gets Phone number */
					$cphone = $crow["phonenum"];

					$licnum = $crow["liencenum"];

					/* Assign approriate variable so we can print it to pdf*/
					$column_cname = $column_cname.$cname."\n"; 
					$column_csname = $column_csname.$csname."\n";
					$column_ccity= $column_ccity.$ccity.",\n";
					$column_cstate = $column_cstate.$cstate."\n";
					$column_czip = $column_czip.$czip."\n";
					$column_cphone = $column_cphone.$cphone . "\n";
					$column_licnum = $column_licnum.$licnum . "\n";

				}

		$pdf->SetFont('Arial','B',12);
		$pdf->SetY(45);
		//sets the the cell header position
		$pdf->SetX(10);
		//sets the cell size for text
		$pdf->Cell(55,6,'Invoice');
		//offset for next cell 
		$pdf->Ln();
		$pdf->SetFont('Arial','' ,10);
		$pdf->Cell(55,6,$column_cname);
		$pdf->Ln();
		$pdf->Cell(55,6,$column_csname);
		$pdf->Ln();
		$pdf->Cell(17,6,$column_ccity);
		$pdf->Cell(7,6,$column_cstate);
		$pdf->Cell(15,6,$column_czip);
		$pdf->Ln();
		$pdf->Cell(40,6,$column_phone);
		$pdf->Ln();
		$pdf->Cell(35,6,'Licence Number#');
		$pdf->cell(40,6,$column_licnum);
		$pdf->Ln();
		$pdf->Cell(35,6,$column_cid);

	
		$pdf->Output();
		ob_end_flush();

		?>