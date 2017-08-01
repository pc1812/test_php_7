<?php

namespace App;

class Mail {
	
	public static function mailto($email, $name, )
	{
		$email = "chu.napoleon@gmail.com";
		$nickname = "Paul";
		$href = "href";
		$mydomain = "local";

		$subject = "From Doomeye Support";
		$message = "Hello, ".$nickname."\n\n";
		$message .= "Please click the below link to reset your password.\n\n";
		$message .= $href."\n\n";
		$message .= "Please don't reply this email.\n\n";
		$message = wordwrap($message, strlen($message));
		
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		//$headers .= 'Content-type: text/html; charset=u' . "\r\n";
		
		// Additional headers
		//$headers .= 'To: Mary <mary@example.com>, Kelly <kelly@example.com>' . "\r\n";
		$headers .= "From: Doomeye <autoreply@".$mydomain.">" . "\r\n";
		//$headers .= 'Cc: birthdayarchive@example.com' . "\r\n";
		//$headers .= 'Bcc: birthdaycheck@example.com' . "\r\n";
		
		mail($email, $subject, $message, $headers);
	}
		
}
?>