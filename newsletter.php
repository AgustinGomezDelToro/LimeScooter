<?php


//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require_once '../vendor/autoload.php';


//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = 0;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.hostinger.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'newsletter@agustingomezdeltoro.tech';                     //SMTP username
    $mail->Password   = 'putaMierda2022!';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('newsletter@agustingomezdeltoro.tech', 'Bienvenue');
    $mail->addAddress($_POST['email']);     //Add a recipient


    //Attachments
    $mail->addAttachment('NEWSLETTER EASYSCOOTER.pdf');         //Add attachments
     //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Bienvenue';
    $mail->Body    = 'Bonjour Cher client, <br>

    Merci pour votre inscription à notre newsletter !<br> 
    
    Nous vous souhaitons une très bonne lecture ! <br>
    
    L’équipe de EASYSCOOTER.';
    $mail->AltBody = 'Bonjour Cher client, <br>

    Merci pour votre inscription à notre newsletter !<br> 
    
    Nous vous souhaitons une très bonne lecture ! <br>
    
    L’équipe de EASYSCOOTER.';;

    $mail->send();
    //echo 'Message has been sent';
    header("location:index.php");
} catch (Exception $e) {
    //echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

//contact@agustingomezdeltoro.tech