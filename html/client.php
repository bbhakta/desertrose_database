<!-- This file is sending too much data to data.php need to find consistant/propar way to send data -->
<html>
<!--- This is a style/CSS to make page look pretty -->
<style>

fieldset {
	width: 600px;
	display: none;
}

legend {
	font-size: 16px;
}

label.field{
	text-align: right;
	width: 100px;
	float: center;
	font-weight: bold;
}

input.textbox-300 {
	width:500px;
	float: center;
}

fieldset p{
	clear: both;
	padding: 5px;
	
}
</style>

<head>

  <title> Enter Information </title>

  <script>

  function showhide(show_name, hide_name)
  {
  	var show_div = document.getElementById(show_name);
  	var hide_div = document.getElementById(hide_name);
    
    if (show_div.style.display !== "none" && hide_div.style.display == "block") 
    {
        show_div.style.display = "block";
        hide_div.style.display = "none";
    }

    else 
    {
        show_div.style.display = "none";
        hide_div.style.display = "block";
    }
  }

    
  </script>

 </head>
<!--- This is a data it gets user input  for client information and when user hits submit it gives data to the data.php file-- >
<!--- Html form which get user data -->
	
 <body>
 	 <form action="data.php" method="post">
		<!--- This is fieldset for getting user informatin! Need to do more reaserch on this -->
 
		<button id="button" onclick="showhide('button', 'client'); return false;"> Client Information </button>

		<fieldset id="client" >
			<legend> Enter your information </legend>
			<p><label class="field" for="Cname">Client First Name:</label> <input type="text" name="cfname"></p>
			<p><label class="field" for="Lname">Client Last Name:</label> <input type="text" name="clname"></p>
			<p><label class="field" for="Sname">Street Address:</label> <input type="text" name="csname"></p> 
			<p><label class="field" for="City">City:</label> <input type="text" name="city"></p>
			<p><label class="field" for="State">State:</label> <input type="text" name="state"></p>
			<p><label class="field" for="Zip">Zipcode:</label> <input type="number" name="zip" ></p>
			<p><label class="field" for="Phone">Phone Number:</label> <input type ="text" name="phone"></p>
			<p><label class="field" for="Email">Email:</label> <input type="email" name ="email"></p>
			<p><label class="field" for="Lic">Licence Number:</label> <input type="text" name="lnum"></p>
		
			<button id="button" onclick="showhide('patient', 'client') ; return false;">Patient Information </button>
		</fieldset>		

		<fieldset id ="patient">
			<legend> Enter Patient Information </legend>
			<p><label class="field" for="Pname">Patient First Name:</label> <input type="text" name="pfname"></p>
			<p><label class="field" for="Pname">Patient Last Name:</label> <input type="text" name="plname"></p>
			<p><label class="field" for="Age">Age:</label> <input type="text" name="age"></p> 
			<legend>Choose your gender:</legend>
	        <p><label class="field" for="male">Male</label> <input type="radio" name="gender" id="male" value="M"></p>
	        <p><label class="field" for="fmale">Female</label> <input type="radio" name="gender" id="female" value="F"></p>
			<p><label class="field" for="Phone">Phone Number:</label> <input type ="text" name="pphone"></p>
			<!--- <p><label class="field" for="Email">Email:</label> <input type="email" name ="pemail"></p> -->
			<button id="button" onclick="showhide('type', 'patient') ; return false;">Order Type </button>
		</fieldset>
		
		<fieldset id="type">

			<legend> Please Choose Your Order Type </legend>
			<input type="checkbox" id="chk" onclick="showhide('pvs','pvs')" name="pvs" value="pvs" /> PVS Order
			<hr />

			<fieldset id="pvs">
			<legend>PVS Order</legend>
				<input type="checkbox" id="chk" onclick="showhide('pcrown','pcrown')" name="pcrown" value="pcrown" /> Crown
				<hr />
					<fieldset id="pcrown">

					<input type="checkbox" name="pcdia" id="pcdia" value="dia"/> Diagnostic
					<hr />
					<input type="checkbox" name="pczir" id="pczir" value="zir"/> Zirconia
					<hr />
					<input type="checkbox" name="pcemax" id="pcemax" value="max"/> Emax
					<hr />
					<input type="checkbox" name="pcgold" id="pcgold" value="gol"/> Gold
					<hr />
					Shade <input type="text" name="pcsha" id="pcsha"/>
					<hr />
						
					</fieldset>
				<input type="checkbox" id="chk" onclick="showhide('pnight','pnight')" name ="pnight" value="pnight"/> Night Guard
				<hr />
					<fieldset id="pnight">
					
					<input type="checkbox" name="pnupp" id="pnupp" value="upp"/> Upper
					<hr />
					<input type="checkbox" name="pnlow" id="pnlow" value="low"/> Lower
					<hr />
					<input type="checkbox" name="pnsof" id="pnsof" value="sof"/> Soft
					<hr />
					<input type="checkbox" name="pnhar" id="pnhar" value="har"/> Hard
					<hr />
					<input type="checkbox" name="pnmay" id="pnmay" value="may"/> May Applience
					<hr />
					<input type="checkbox" name="pnocl" id="pnocul" value="ocl"/> Ocllual
					<hr />						
					</fieldset>

				<input type="checkbox" id="chk" onclick="showhide('palign', 'palign')" name = "palign" value="palign"/> Aligner
				<hr />
					<fieldset id="palign">					
					<input type="checkbox" name="paupp" id="paupp" value="upp"/> Upper
					<hr />
					<input type="checkbox" name="palow" id="palow" value="low"/> Lower
					<hr />
					<input type="checkbox" name="parep" id="parep" value="rep"/> Replacement
					<hr />						
					</fieldset>

				<input type="checkbox" id="chk" onclick="showhide('psurg','psurg')" name="psurg" value="psurgi"/> Surgical Guide
				<hr />
					<fieldset id="psurg">					
					<input type="checkbox" name="psimp" id="psimp" value="imp"/> Implant System
					<hr />
					Tooth Number <input type="text" name="pstoo" id="too"/>
					<hr />
					<input type="checkbox" name="pssle" id="pssle" value="sle"/> Sleeve
					<hr />						
					</fieldset>

				<input type="checkbox" id="chk" onclick="showhide('pdent', 'pdent')" name="pdent" value="pdent"/> Denture
				<hr />
					<fieldset id="pdent">					
					<input type="checkbox" name="pdupp" id="pdupp" value="upp"/> Upper
					<hr />
					<input type="checkbox" name="pdlow" id="pdlow" value="low"/> Lower
					<hr />
					Shade <input type="text" name="pdtoo" id="pdtoo"/>
					<hr />						
					</fieldset>
				<input type="checkbox" id="chk" onclick="showhide('ppart','ppart')" name="ppart" value="ppart"/> Partial
				<hr />
					<fieldset id="ppart">					
					<input type="checkbox" name="ppupp" id="ppupp" value="upp"/> Upper
					<hr />
					<input type="checkbox" name="pplow" id="pplow" value="low"/> Lower
					<hr />
					Missing Tooth <input type="text" name="ppmiss" id="miss"/>
					<hr />
					Shade <input type="text" name="ppsha" id="ppsha"/>
					<hr />							
					</fieldset>
			</fieldset>
		
			<input type="checkbox" id="chk" onclick="showhide('digi', 'digi')" name="digi" value="digi"/> Digital Order
			<hr />

			<fieldset id="digi">
			<legend>Digital Order</legend>
				<input type="checkbox" id="chk" onclick="showhide('dcrown','dcrown')" name="dcrown" value="dcrown" /> Crown
				<hr />
					<fieldset id="dcrown">

					<input type="checkbox" name="dcdia" id="dcdia" value="dia"/> Diagnostic
					<hr />
					<input type="checkbox" name="dczir" id="dczir" value="zir"/> Zirconia
					<hr />
					<input type="checkbox" name="dcemax" id="dcemax" value="max"/> Emax
					<hr />
					<input type="checkbox" name="dcgold" id="dcgold" value="gol"/> Gold
					<hr />
					Shade <input type="text" name="dcsha" id="dcsha"/>
					<hr />
						
					</fieldset>
				<input type="checkbox" id="chk" onclick="showhide('dnight','dnight')" name="dnight"value="dnight"/> Night Guard
				<hr />
					<fieldset id="dnight">
					
					<input type="checkbox" name="dnupp" id="dnupp" value="upp"/> Upper
					<hr />
					<input type="checkbox" name="dnlow" id="dnlow" value="low"/> Lower
					<hr />
					<input type="checkbox" name="dnsof" id="dnsof" value="sof"/> Soft
					<hr />
					<input type="checkbox" name="dnhar" id="dnhar" value="har"/> Hard
					<hr />
					<input type="checkbox" name="dnmay" id="dnmay" value="may"/> May Applience
					<hr />
					<input type="checkbox" name="dnocl" id="dnocul" value="ocl"/> Ocllual
					<hr />						
					</fieldset>

				<input type="checkbox" id="chk" onclick="showhide('dalign', 'dalign')" name="dalign" value="dalign"/> Aligner
				<hr />
					<fieldset id="dalign">					
					<input type="checkbox" name="daupp" id="daupp" value="upp"/> Upper
					<hr />
					<input type="checkbox" name="dalow" id="dalow" value="low"/> Lower
					<hr />
					<input type="checkbox" name="darep" id="darep" value="rep"/> Replacement
					<hr />						
					</fieldset>

				<input type="checkbox" id="chk" onclick="showhide('dsurg','dsurg')" name="dsurgi" value="dsurgi"/> Surgical Guide
				<hr />
					<fieldset id="dsurg">					
					<input type="checkbox" name="dsimp" id="dsimp" value="imp"/> Implant System
					<hr />
					Tooth Number <input type="dstext" name="dstoo" id="too"/>
					<hr />
					<input type="checkbox" name="dssle" id="dssle" value="sle"/> Sleeve
					<hr />						
					</fieldset>
					
				<input type="checkbox" id="chk" onclick="showhide('ddent', 'ddent')" name="ddent" value="ddent"/> Denture
				<hr />
					<fieldset id="ddent">					
					<input type="checkbox" name="ddupp" id="ddupp" value="upp"/> Upper
					<hr />
					<input type="checkbox" name="ddlow" id="ddlow" value="low"/> Lower
					<hr />
					Shade <input type="text" name="ddtoo" id="ddtoo"/>
					<hr />						
					</fieldset>
				<input type="checkbox" id="chk" onclick="showhide('dpart','dpart')" name="dpart" value="dpart"/> Partial
				<hr />
					<fieldset id="dpart">					
					<input type="checkbox" name="dpupp" id="dpupp" value="upp"/> Upper
					<hr />
					<input type="checkbox" name="dplow" id="dplow" value="low"/> Lower
					<hr />
					Missing Tooth <input type="text" name="dpmiss" id="miss"/>
					<hr />
					Shade <input type="text" name="dpsha" id="dpsha"/>
					<hr />							
					</fieldset>
			</fieldset>

			
			<legend>Enter the date you want order to be completed</legend>
			<!--- Somehow this gets the date, Magic -->
			<p><input type="date" name="ddate" value="<?php echo date('Y-m-d'); ?>"></p>
			
			<input type="submit" value ="Enter Data">

			</fieldset>

		</fieldset>
				
		
	</form>


</body>

</html>


