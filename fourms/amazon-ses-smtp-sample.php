<?php

// Modify the path in the require statement below to refer to the 
// location of your Composer autoload.php file.
require '/var/www/html/vendor/autoload.php';

// Instantiate a new PHPMailer 
$mail = new PHPMailer;

// Tell PHPMailer to use SMTP
$mail->isSMTP();

// Replace sender@example.com with your "From" address. 
// This address must be verified with Amazon SES.
$mail->setFrom('bhavik1292@gmail.com', 'Bhavik Bhakta');

// Replace recipient@example.com with a "To" address. If your account 
// is still in the sandbox, this address must be verified.
// Also note that you can include several addAddress() lines to send
// email to multiple recipients.
$mail->addAddress('bhavik1292@gmail.com', 'Bmoney');

// Replace smtp_username with your Amazon SES SMTP user name.
$mail->Username = 'AKIAJJFR5CPFQ4Q6WEFQ';

// Replace smtp_password with your Amazon SES SMTP password.
$mail->Password = 'AhFehGJOYScExCSBp0eSNDJr7FUw4CZ6AEZ4tqNDQyQX';
    
// Specify a configuration set. If you do not want to use a configuration
// set, comment or remove the next line.
//$mail->addCustomHeader('X-SES-CONFIGURATION-SET', 'ConfigSet');
 
// If you're using Amazon SES in a region other than US West (Oregon), 
// replace email-smtp.us-west-2.amazonaws.com with the Amazon SES SMTP  
// endpoint in the appropriate region.
$mail->Host = 'email-smtp.us-west-2.amazonaws.com';

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
	$street = $csname. " " . $ccity. " ".  $cstate. " " . $czip . "\n";
	$phone = $cphone. "\n";
	$email = $cemail. "\n";
	$pro = $pro. "\n";
	$text= $text. "\n";

	
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

// The subject line of the email
$mail->Subject = 'Amazon SES test (SMTP interface accessed using PHP)';

echo $name;
// The HTML-formatted body of the email
$mail->Body = '<h1>Email Test</h1>
    <p>This customer name: </p>. '<?php echo $name?>'.' 
    <p>This customer order: <?php echo $order; ?>  </p>
    <p>This customer address: <?php echo $stree;?>  </p>
    <p>This customer email: <?php echo $email;?>  </p>
    <p>This customer phone: <?php echo $phone; ?> </p>
    <p>This customer professon: <?php echo $pro;?> </p>
    <p>This customer message: <?php echo $text;?>    </p>';

// Tells PHPMailer to use SMTP authentication
$mail->SMTPAuth = true;

// Enable TLS encryption over port 587
$mail->SMTPSecure = 'tls';
$mail->Port = 587;

// Tells PHPMailer to send HTML-formatted email
$mail->isHTML(true);

// The alternative email body; this is only displayed when a recipient
// opens the email in a non-HTML email client. The \r\n represents a 
// line break.
$mail->AltBody = "Email Test\r\nThis email was sent through the 
    Amazon SES SMTP interface using the PHPMailer class.";

if(!$mail->send()) {
    echo "Email not sent. " , $mail->ErrorInfo , PHP_EOL;
} else {
    echo "Email sent!" , PHP_EOL;
}
?>
