<?php
require "Mail.php";
require "Mail/mime.php";

$target_dir = "./temp/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = filesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
		//echo "File is an image - " . $check["mime"] . ".";
		echo "File is a pdf or docx.";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "pdf" && $imageFileType != "docx")
{
    echo "Sorry, only pdf and docx files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} 
else 
{
	if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file))   
	{
		echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";

		//we prepare an email with the attachment:
		$text = 'Text version of email';
		$html = '<html><body>HTML version of email</body></html>';
		$file =  $target_file;
		$crlf = "\n";

		$from = "youremail@gmail.com";
		$to   = 'example@email.com';
		$subject = 'test with attachment';

		$host = "ssl://smtp.gmail.com:465";
		$username = 'youremail@gmail.com';
		$password = 'yourpassword';

		$headers = array ('From' => $from, 'To' => $to,'Subject' => $subject);

		$mime = new Mail_mime($crlf);
		$mime->setTXTBody($text);
		$mime->setHTMLBody($html);
		$mime->addAttachment($file, 'application/octet-stream');

		$body = $mime->get();
		$hdrs = $mime->headers($headers);

		$smtp = Mail::factory('smtp',
			array ('host'	  => $host,
				   'auth'	  => true,
			   	   'username' => $username,
				   'password' => $password));
		$mail = $smtp->send($to, $hdrs, $body);

		if(PEAR::isError($mail))
		{
			echo($mail->getMessage());
		}
		else
		{
			echo("Message successfully sent!\n");
		}
		//email with attached resume was sent

		//we delete the resume from our folder:
		unlink($target_file);
	}
	else
	{
        echo "Sorry, there was an error uploading your file.";
	}
}
?> 
