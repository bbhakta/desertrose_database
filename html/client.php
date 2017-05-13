<!-- This file is sending too much data to data.php need to find consistant/propar way to send data -->
<html>
<!--- This is a style/CSS to make page look pretty -->
<style>

fieldset {
	width: 600px;
}

legend {
	font-size: 20px;
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
<!--- This is a data it gets user input  for client information and when user hits submit it gives data to the data.php file-- >
<!--- Html form which get user data -->
	<form action="data.php" method="post">
		<!--- This is fieldset for getting user informatin! Need to do more reaserch on this -->
		<fieldset>
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
		</fieldset>

		<fieldset>
			<legend> Enter Patient Information </legend>
			<p><label class="field" for="Pname">Patient First Name:</label> <input type="text" name="pfname"></p>
			<p><label class="field" for="Pname">Patient Last Name:</label> <input type="text" name="plname"></p>
			<p><label class="field" for="Age">Age:</label> <input type="text" name="age"></p> 
			<legend>Choose your gender:</legend>
	        <p><label class="field" for="male">Male</label> <input type="radio" name="gender" id="male" value="M"></p>
	        <p><label class="field" for="fmale">Female</label> <input type="radio" name="gender" id="female" value="F"></p>
			<p><label class="field" for="Phone">Phone Number:</label> <input type ="text" name="pphone"></p>
			<p><label class="field" for="Email">Email:</label> <input type="email" name ="pemail"></p>
		</fieldset>

		<fieldset>
			<legend> Enter Order Information </legend>

			<legend>Removables</legend>
				<fieldset>
					<p><label class="field" for="bite">Bite Splint</label> <input type="checkbox" name="bite" id="bite" value="Bite Splint"></p>
						<fieldset>
							<p><label class="field" for="pivot">Pivot</label> <input type="checkbox" name="pivot" id="pivot" value="Pivot"></p>
							<p><label class="field" for="night">Night Gurad</label> <input type="checkbox" name="night" id="night" value="Night Gurad"></p>
						</fieldset>
					<p><label class="field" for="bleach">Bleaching Splints</label> <input type="checkbox" name="bleach" id="bleach" value="Bleaching Splints"></p>
					<p><label class="field" for="surgical">Surgical Guide</label> <input type="checkbox" name="surgical" id="surgical" value="Surgical Guide"></p>
				</fieldset>

			<legend>Bite Informaiton</legend>
			<fieldset>
					<p><label class="field" for="bite">Bite Splint</label> <input type="text" name="bclass"></p>
					<legend>Desired Occlusion</legend>
					<p><label class="field" for="ant">Anterior</label> <input type="checkbox" name="ant" id="ant" value="Anterior"></p>
					<p><label class="field" for="post">Posterior</label> <input type="checkbox" name="post" id="post" value="Posterior"></p>
					<legend>Margins</legend>
					<fieldset>
						<p><label class="field" for="bel">Below lingual Gumline</label> <input type="checkbox" name="bel" id="bel" value="Below lingual Gumline"></p>
						<p><label class="field" for="ove">Overlapping anteriors</label> <input type="checkbox" name="ove" id="bel" value="Overlapping anteriors"></p>
					</fieldset>
				</fieldset>

			<legend>Surgical Guide Requirements</legend>
			<fieldset>
				<p><label class="field" for="lab">Lab Form</label> <input type="checkbox" name="lab" id="lab" value="Lab Form"></p>
				<p><label class="field" for="cbc">CBCT, DICOM Files</label> <input type="checkbox" name="cbc" id="cbc" value="CBCT, DICOM Files"></p>
				<p><label class="field" for="pro">Proper Measumrents</label> <input type="checkbox" name="pro" id="pro" value="Proper Measurements"></p>
				<p><label class="field" for="imp">Impressions or Scans (STL)</label> <input type="checkbox" name="imp" id="imp" value="Impressions or Scans (STL)"></p>
			</fieldset>

			<legend>Additional Information (Surgical Guide) </legend>
			<fieldset>
				<p><label class="field" for="cal">Call Doctor</label> <input type="checkbox" name="cal" id="cal" value="Call Doctor"></p>
				<p><label class="field" for="met">Metal Sleeve</label> <input type="checkbox" name="met" id="met" value="Metal Sleeve"></p>
				<p><label class="field" for="iml">Implant System</label> <input type="text" name="iml"></p>
				<p><label class="field" for="pd">Pilot Drill Depth(mm)</label> <input type="text" name="pd"></p>
				<p><label class="field" for="pdd">Pilot Drill Diameter(mm)</label> <input type="text" name="pdd"></p>
				<p><label class="field" for="ld">Longest Drill Length</label> <input type="text" name="ld"></p>
				<p><label class="field" for="sd">Shortest Drill Length</label> <input type="text" name="sd"></p>
				<p><label class="field" for="dd">Drill Diameter(mm)</label> <input type="text" name="dd"></p>
			</fieldset>

			<legend>Enter the date you want order to be completed</legend>
			<!--- Somehow this gets the date, Magic -->
			<p><input type="date" name="ddate" value="<?php echo date('Y-m-d'); ?>"></p>
			<!--- 

				this is test 

			<legend>Bite Informaiton</legend>

			<legend>Indirect Restorations</legend>


			<legend>Shade Informaiton</legend>

			<legend>Special Instructions</legend>
			-->
		</fieldset>

		<input type="submit" value ="Client Information">
	</form>



</html>


