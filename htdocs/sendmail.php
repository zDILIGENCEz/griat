<?php

//phpinfo();

//ini_set('error_reporting', E_ALL);
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);

//include_once('/usr/local/www/vhosts/cs.kai.ru/htdocs/PHPMailer.php');	
	
	//echo $_SERVER['REQUEST_METHOD'];


//$method="POST";
//$var1=$_SERVER['REQUEST_METHOD'];

//if (strcasecmp($var1, $method) == 0) {
	
	
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;

	require 'PHPMailer.php';
	require 'SMTP.php';
	require 'Exception.php';

	$mail = new PHPMailer(); // create a new object
	$mail->IsSMTP(); // enable SMTP
	$mail->SMTPDebug = 0; // debugging: 1 = errors and messages, 2 = messages only
	$mail->SMTPAuth = true; // authentication enabled
	$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
	$mail->CharSet = 'UTF-8'; // кодировка !!!
	$mail->Host = "smtp.gmail.com";
	$mail->Port = 465; // or 587
	$mail->IsHTML(true);
	$mail->Username = "tematikplans@gmail.com";	
	$mail->Password = "[cfveh@q]";	
	
	$email_sender = $_POST['email'];
	$subject=$_POST['subject'];
	$message=$_POST['message'];
	
	//echo $email_sender;
	//echo $subject;
	//echo $message;
	
	
	$mail->SetFrom("r.miniazev@gmail.com");
	
	//$mail->Subject = "Test";
	$mail->Subject = $subject;
	//$mail->Body = "hello";
	$body=$email_sender."<br/> ".$message;
	$mail->Body = $body;
	
	$mail->AddAddress("r.minyazev@gmail.com");

	 if(!$mail->Send()) {
		echo "Mailer Error: " . $mail->ErrorInfo;
		//echo "<script>alert('Mailer Error!');</script>";
	 } else {
		echo "Ваше сообщение отправлено!";
		//echo "<script>alert('Ваше сообщение отправлено!');</script>";
	 }
	 
	 //header( 'Location: http://cs.kai.ru' ); 
//}

//echo "<br/>aaaaaaaaaaaa<br/>";
echo "<br/><br/><a href=\"http://cs.kai.ru\">http://cs.kai.ru</a>";

?>