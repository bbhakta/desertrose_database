<html>
<!--- This is a style/CSS to make page look pretty -->



  <title> Enter Information </title>
  <body>


		<!--- This is fieldset for getting user informatin! Need to do more reaserch on this -->


<div class="form-style-2-heading">Shipping information</div>

<form action="info.php" method="post">

<?php

	$dsplint = $_POST['splint'];
	$dcrown = $_POST['crown'];
	$ddenture = $_POST['denture'];
	$dsurgical = $_POST['surgical'];
	$ddmodel = $_POST['dmodel'];
	$dques = $_POST['ques'];



	$cname = $dsplint . " " . $dcrown . " " . $ddenture . " " . $dsurgical. " " . $ddmodel. " ". $dques;


$cfname = $_POST['field1'];
$clname = $_POST['field2'];
$csname = $_POST['field4'];
$ccity = $_POST['field5'];
$cstate = $_POST['field6'];
$czip = $_POST['field7'];
$cphone = $_POST['field9'];
$cemail = $_POST['field3'];
$pro= $_POST['field9'];
$text= $_POST['field11'];

	

	$name = $cfname . $clname . "\n";
	$order = $cname . "\n";
	$street = $csname. $ccity. $cstate. $czip . "\n";
	$phone = $cphone. "\n";
	$email = $cemail. "\n";
	$pro = $pro. "\n";
	$text= $text. "\n";

	echo $name . $order . $street . $phone . $email . $pro. $text;

	


	$currentDir = getcwd();
    $uploadDirectory = "/uploads/";

    $errors = []; // Store all foreseen and unforseen errors here

    $fileExtensions = ['stl']; // Get all the file extensions

    $fileName = $_FILES['userstl']['name'];
    $fileSize = $_FILES['userstl']['size'];
    $fileTmpName  = $_FILES['userstl']['tmp_name'];
    $fileType = $_FILES['userstl']['type'];
    $fileExtension = strtolower(end(explode('.',$fileName)));

    $uploadPath = $currentDir . $uploadDirectory . basename($fileName); 

    if (isset($_POST['submit'])) {
    	
        if (! in_array($fileExtension,$fileExtensions)) {
            $errors[] = "This file extension is not allowed. Please upload a STL File";
        }

        if ($fileSize > 2000000) {
            $errors[] = "This file is more than 2MB. Sorry, it has to be less than or equal to 2MB";
        }

        if (empty($errors)) {
            $didUpload = move_uploaded_file($fileTmpName, $uploadPath);
            echo "filename" . $fileTmpName;
            echo "path" . $uploadPath;
            if ($didUpload) {
                echo "The file " . basename($fileName) . " has been uploaded";
            } else {
                echo "An error occurred somewhere. Try again or contact the admin";
            }
        } else {
            foreach ($errors as $error) {
                echo $error . "These are the errors" . "\n";
            }
        }
    }


	 ?>
	

	</form>

</div>

</body>
</html>
