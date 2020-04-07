<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

/* New aliases. */
use PHPMailer\PHPMailer\OAuth;
use League\OAuth2\Client\Provider\Google;

/* Composer autoload.php file includes all installed libraries. */
require 'C:\Users\SARANYA\Desktop\S\PHP\composer\vendor\autoload.php';

/* If you installed league/oauth2-google in a different directory, include its autoloader.php file as well. */
// require 'C:\xampp\league-oauth2\vendor\autoload.php';

/* Set the script time zone to UTC. */
date_default_timezone_set('Etc/UTC');

/* Information from the XOAUTH2 configuration. */
$google_email = 'saranyanaharoy@gmail.com';
$oauth2_clientId = '665916749506-v7buqu3lvjjd5ljf35ak59lvi9592vgc.apps.googleusercontent.com';
$oauth2_clientSecret = 'xXnDTqdwmzkua7BZDDvjEjff';
$oauth2_refreshToken = '1//0gzGKfjY2fpRbCgYIARAAGBASNwF-L9IrSwPgTrW_VyDhcXBWyoQjhe_L63HzZphQC0sGhROrX_xQ4nKbEZ3y5nZwMMINdgJELIQ';

$mail = new PHPMailer(TRUE);

try {
   
   $mail->setFrom($google_email, 'OpenCQ');
   //$mail->addAddress('aymuosmukherjee@gmail.com ', 'Soumya');
   $mail->addAddress('rishav16ban98@gmail.com');
   $mail->Subject = 'Your result has been out';
   $mail->isHTML(TRUE);
   $mail->Body = '<!DOCTYPE html>

   <html>
       <head>
           
       </head>
       <body>
           <h1>
               OpenCQ
           </h1>
           <img src="https://i.imgur.com/hjW89nr.jpg" alt="logo" width="460" height="345">
           <p>
               Here is your drive link <a href = "https://drive.google.com/folderview?id=1eCWyOYfo3CrmBcSxG5HTWTj7rESTMesO">drive</a> 
               
           </p>
       </body>
   </html>
   
   ';
   //$mail->AltBody = "Result";
   //$message = $mail->msgHTML(file_get_contents('message.html');
   //echo '$message';
   //$mail->addAttachment('C:\xampp\htdocs\new_mcq\result.pdf', 'Result');
   //$mail->addReplyTo('jarvisnaharoy@gmail.com');
   //$mail->addCC('rashedmehdi42@gmail.com', 'Rashed');
   //$mail->addCC('rishav16ban98@gmail.com', 'Rishav');
   //$mail->addCC('knobody731@gmail.com', 'Knobody');
   $mail->isSMTP();
   $mail->Port = 587;
   $mail->SMTPAuth = TRUE;
   $mail->SMTPSecure = 'tls';
   
   /* Google's SMTP */
   $mail->Host = 'smtp.gmail.com';
   
   /* Set AuthType to XOAUTH2. */
   $mail->AuthType = 'XOAUTH2';
   
   /* Create a new OAuth2 provider instance. */
   $provider = new Google(
      [
         'clientId' => $oauth2_clientId,
         'clientSecret' => $oauth2_clientSecret,
      ]
   );
   
   /* Pass the OAuth provider instance to PHPMailer. */
   $mail->setOAuth(
      new OAuth(
         [
            'provider' => $provider,
            'clientId' => $oauth2_clientId,
            'clientSecret' => $oauth2_clientSecret,
            'refreshToken' => $oauth2_refreshToken,
            'userName' => $google_email,
         ]
      )
   );
   
   /* Finally send the mail. */
   $mail->send();
}
catch (Exception $e)
{
   echo $e->errorMessage();
}
catch (\Exception $e)
{
   echo $e->getMessage();
}

?>