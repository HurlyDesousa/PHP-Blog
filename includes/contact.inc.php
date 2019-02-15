<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
//Prologue of contact.inc.php:
//This page is in an includes folder an runs only php code. It sends the Admin the email form the contact form.

if (isset($_POST['submit_contact'])) {
  $name = $_POST['name'];
  $subject = $_POST['subject'];
  $mailFrom = $_POST['mail'];
  $message = $_POST['message'];

  $mailTo = "support@shutterbrave.com";
  $headers = "From: ".$mailFrom;
  $txt = "You have recived an e-mail from ".$name.".\n\n".$message;

  //mail($mailTo, $subject, $txt, $headers);
  //header("Location: ../contact.php?success=mailsent");

  // Email for the user to let them know their account was successfully created.
  require '../credentials/credentials2.php';
  require '../PHPMailer/src/Exception.php';
  require '../PHPMailer/src/PHPMailer.php';
  require '../PHPMailer/src/SMTP.php';

  $mail = new PHPMailer(true);
  try {
    //$mail->SMTPDebug = 4;
    $mail->isSMTP();
    $mail->Host = 'smtp.1and1.com';
    $mail->SMTPAuth = true;
    $mail->Username = EMAIL;
    $mail->Password = PASS;
    $mail->SMTPSecure = 'tls';
    $mail->Port = 25;
    $mail->setFrom($mailFrom, $name);
    $mail->addAddress($mailTo);

    $mail->isHTML(true);
    $mail->Subject = "Trading Blog Account Created";
    $mail->Body = '
    <!DOCTYPE html>
    <html>
    <head>
    <meta charset="UTF-8">
    <title>Online Trading Blog User Message</title>
    </head>
    <body style="margin:0px; font-family:Tahoma, Geneva, sans-serif;">
    <div style="padding:10px; background:#f3f3f3; font-size:24px; color:black;">
    </a>&nbsp;A Message From an Online Trading Blog User.</div><div style="padding:24px; font-size:17px;">
    <br><p>Hi, i\'m '.$name.'</p><br>
    <br>'.$message.',<br><br><br>
    <b>'.$headers.'</b>
    </div>
    </body>
    </html>
    ';
    $mail->AltBody = 'A Message From an Online Trading Blog User.';
    $mail->send();
    header("Location: ../contact.php?success=mailsent");
    exit();
  } catch (Exception $e) {
    //echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
    header("Location: ../contact.php?error=mailnotsent");
    exit();
  }

  /* Get login Credentials from Admin
  require "../credentials/credentials.php";

  // Inclued the PHPMailer Class from Autoloader.php to allow for sending the user an email
  require "../phpmailer/PHPMailerAutoload.php";
  // Create a new instance of the PHPMailer Class
  $mail = new PHPMailer();
  // If mail is not sending enable SMTPDebug to fine the error.
  $mail->SMTPDebug = 4;
  // Set the host
  $mail->Host = "smtp.gmail.com";
  // Enable SMTP
  $mail->isSMTP();
  // Set SMTP Authentication to true
  $mail->SMTPAuth = true;
  // Set login details for the Gmail account
  $mail->Username = EMAIL;
  $mail->Password = PASS;
  // Set the type of protection
  $mail->SMTPSecure = "tls"; // or "ssl"
  // Set a port
  $mail->Port = 587; // or 465 if "tls"
  // Set a subject
  $mail->Subject = $subject;
  // Set mail as HTML
  $mail->isHTML(true);
  // Set a body
  $mail->Body = '
  <!DOCTYPE html>
  <html>
  <head>
  <meta charset="UTF-8">
  <title>Online Trading Blog User Message</title>
  </head>
  <body style="margin:0px; font-family:Tahoma, Geneva, sans-serif;">
  <div style="padding:10px; background:#f3f3f3; font-size:24px; color:black;">
  </a>&nbsp;A Message From an Online Trading Blog User.</div><div style="padding:24px; font-size:17px;">
  <br><p>Hi, i\'m '.$name.'</p><br>
  <br>'.$message.',<br><br><br>
  <b>'.$headers.'</b>
  </div>
  </body>
  </html>
  ';
  // Set who is sending the email
  $mail->setFrom($mailFrom, $name);
  // Set the email recipiant
  $mail->addAddress($mailTo);


  if ($mail->send()) {
    echo "mail was sent";
    //header("Location: ../contact.php?success=mailsent");
    exit();
  } else {
    echo "something went wrong with sending the email :(";
    //header("Location: ../contact.php?error=mailnotsent");
    exit();
  }
}

*/

}
