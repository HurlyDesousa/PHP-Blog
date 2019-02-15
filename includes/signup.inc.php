<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
//Prologue of signup.inc.php:
//This page is in an includes folder an runs only php code. It craetes the user in the database and sends the the email eith their username and password.

if (isset($_POST['signup-submit'])) {

  require 'dbh.inc.php';

  $username = $_POST['uid'];
  $email = $_POST['mail'];
  $password = $_POST['pwd'];
  $passwordRepeat = $_POST['pwd-repeat'];

  if (empty($username) || empty($email) || empty($password) || empty($passwordRepeat)) {
    header("Location: ../signup.php?error=emptyfieldssignup&uid=".$username."&mail=".$email);
    exit();

  }
  elseif (!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[A-Za-z0-9-_.+%]+@[A-Za-z0-9-.]+.[A-Za-z]{2,4}$/", $username)) {
    header("Location: ../signup.php?error=invalidmail&uid");
    exit();
  }

  elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header("Location: ../signup.php?error=invalidmail&uid=".$username);
    exit();
  }
  elseif (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
    header("Location: ../signup.php?error=invaliduid&mail=".$email);
    exit();
  }
  elseif ($password !== $passwordRepeat) {
    header("Location: ../signup.php?error=passwordcheck&uid=".$username."&mail=".$email);
    exit();
  } else {
    $sql = "SELECT userUid FROM users WHERE userUid=?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
      header("Location: ../signup.php?error=sqlerror");
      exit();
    } else {
      mysqli_stmt_bind_param($stmt, "s", $username);
      mysqli_stmt_execute($stmt);
      mysqli_stmt_store_result($stmt);
      $resultCheck = mysqli_stmt_num_rows($stmt);
      if ($resultCheck > 0) {
        header("Location: ../signup.php?error=usertaken&=".$email);
        exit();
      } else {
        $sql = "INSERT INTO users (userUid, userEmail, userPwd) VALUES (?,?,?)";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
          header("Location: ../signup.php?error=sqlerror");
          exit();
        } else {
          $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
          mysqli_stmt_bind_param($stmt, "sss", $username, $email, $hashedPwd);
          mysqli_stmt_execute($stmt);

          // Enter user into the profileimage table

          $sql = "INSERT INTO profileimage (userUid, imgStatus) VALUES (?, 1)";
          $stmt = mysqli_stmt_init($conn);

          if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../signup.php?error=sqlerror");
            exit();
          } else {

            mysqli_stmt_bind_param($stmt, "s", $username);
            mysqli_stmt_execute($stmt);

            // Enter user into the userprofile table

            $sql = "INSERT INTO userprofile (userUid) VALUES (?)";
            $stmt = mysqli_stmt_init($conn);

            if (!mysqli_stmt_prepare($stmt, $sql)) {
              header("Location: ../signup.php?error=sqlerror");
              exit();
            } else {

              mysqli_stmt_bind_param($stmt, "s", $username);
              mysqli_stmt_execute($stmt);

              // Email for the user to let them know their account was successfully created.
              require '../credentials/credentials.php';
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
                $mail->setFrom(EMAIL, 'Online Trading Blog');
                $mail->addAddress($email);

                $mail->isHTML(true);
                $mail->Subject = "Trading Blog Account Created";
                $mail->Body = '
                <!DOCTYPE html>
                <html>
                <head>
                <meta charset="UTF-8">
                <title>Account Successfully Created</title>
                </head>
                <body style="margin:0px; font-family:Tahoma, Geneva, sans-serif;">
                <div style="padding:10px; background:#f3f3f3; font-size:24px; color:black;">
                <a href="https://shutterbrave.com/index.php">
                <img src="https://shutterbrave.com/images/logo.png" width="55" height="50" alt="Logo" style="border:none; float:left;">
                </a>&nbsp;Online Trading Blog Account Created</div><div style="padding:24px; font-size:17px;"><br><br>
                Hello '.$username.',
                <br>
                <br>Login using your,<br>E-mail Address: <b>'.$email.'</b><br>Username: '.$username.'<br>Password: <b>'.$password.'</b><br><br><br>
                </b>Your password has been hashed and securely stored in our database.</b></b>
                </div>
                </body>
                </html>
                ';
                $mail->AltBody = 'Online Trading Blog Account Created: Your password has been hashed and securely stored in our database.';
                $mail->send();
                header("Location: ../signup.php?signup=success");
                exit();
              } catch (Exception $e) {
                //echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
                header("Location: ../signup.php?error=mailnotsent");
                exit();
              }
            }
          }
        }
      }
    }
  }
  mysqli_stmt_close($stmt);
  mysqli_close($conn);

}
else {
  header("Loaction: ../signup.php");
  exit();
}
