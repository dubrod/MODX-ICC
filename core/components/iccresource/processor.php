<?php
	
	$ip = $_POST['ip'];
	$ref = $_POST['ref'];
	$useragent = $_POST['useragent'];
	$source = $_POST['source'];
	$medium = $_POST['medium'];
	$campaign = $_POST['campaign'];
	$name = $_POST['name'];
	$email = $_POST['email'];
	$phone = $_POST['phone'];
			
//create connection
require_once("../../config/config.inc.php");
$mysqli = new mysqli($database_server, $database_user, $database_password, $dbase);

/* check connection */
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
} 

$insert = "INSERT INTO `modx_icc` (
	`name`,
	`email`,
	`phone`,
	`refer`,
	`ip`,
	`useragent`,
	`source`,
	`medium`,
	`campaign`
	) VALUES (
	'".$name."',
	'".$email."',
	'".$phone."',
	'".$ref."',
	'".$ip."',
	'".$useragent."',
	'".$source."',
	'".$medium."',
	'".$campaign."'
	)";

$result = $mysqli->query($insert);

// START MAIL
	$to .= 'YOUR EMAIL HERE';
	$subject = 'New ICC Submission';
	$message = '
	'.$name.'<br>
	'.$email.'<br>
	Campaign: '.$campaign.'   
	';
	
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	$headers .= 'From: ICC Extra <icc@your-domain.com>' . "\r\n";
	
	mail($to, $subject, $message, $headers);
// EOF EMAIL            
            
if (!$result) {
   printf("%s\n", $mysqli->error);
   exit();
} 
	
$mysqli->close();   
?>	
	