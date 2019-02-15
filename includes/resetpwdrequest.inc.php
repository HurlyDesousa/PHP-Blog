<?php

if (isset($_POST["reset-request-sumbit"])) {

  $selector = bin2hex(random_bytes(8));
  $token = random_bytes(32);

  $url = "http://www.shutterbrave.com/createnewpwd.php?selector=" . $selector . "&validator=" . bin2hex($token);
  $expires = date("U") + 1800;

  require 'dbh.inc.php';

  $userEmail = $_POST["email"];

  $sql = "DELETE FROM pwdReset WHERE pwdResetEmail=? ;";
  $stmt = mysqli_stmt_init($conn);

  if (!mysqli_stmt_prepare($stmt, $sql)) {
    echo "There was an ERROR 1!";
    exit();

  } else {
    mysqli_stmt_bind_param($stmt, "s", $userEmail);
    mysqli_stmt_execute($stmt);
  }

  $sql = "INSERT INTO pwdReset (pwdResetEmail, pwdResetSelector, pwdResetToken, pwdResetExpires) VALUES(?, ?, ?, ?);";
  $stmt = mysqli_stmt_init($conn);

  if (!mysqli_stmt_prepare($stmt, $sql)) {
    echo "There was an ERROR 2!";
    exit();

  } else {

    $hashedToken = password_hash($token, PASSWORD_DEFAULT);
    mysqli_stmt_bind_param($stmt, "ssss", $userEmail, $selector, $hashedToken, $expires);
    mysqli_stmt_execute($stmt);
  }

mysqli_stmt_close($stmt);
mysqli_close($stmt);

$to = $userEmail;
$subject = 'Reset your password for your Online Trading Blog Account.';
$message = 'Click the passwrod reset link: ';
$message .= '<a href="' . $url . '">' . $url .'</a>';

$headers = "From: support@shutterbrave.com";
$headers .= "Reply-To: support@shutterbrave.com \r\n";
$headers .= "Content-type: text/html \r\n";

mail($to, $subject, $message, $headers);

header("Location: ../resetpwd.php?reset=success");

} else {
  header("Location: ../index.php");
}
