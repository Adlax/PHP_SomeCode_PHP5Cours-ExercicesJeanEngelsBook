<?php
ini_set("SMTP","ssl:smtp.gmail.com" );
ini_set("smtp_port","465");
ini_set('sendmail_from', 'h.videlier@gmail.com');
$to = "h.videlier@gmail.com";
$subject = "Test mail";
$message = "Hello! This is a simple email message.";
$from = "h.videlier@gmail.com";
$headers = "From:" . $from;
$retval = mail($to,$subject,$message,$headers);
   if( $retval == true )
   {
      echo "Message sent successfully...";
   }
   else
   {
      echo "Message could not be sent...";
   }
?>
