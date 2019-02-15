<?php
//Prologue of login.inc.php:
//This page is in an includes folder an runs only php code. It sets the session as logged in so the user is logged in.
if (isset($_POST['login-submit'])) {

  include 'dbh.inc.php';

  $mailuid = $_POST['mailuid'];
  $password = $_POST['pwd'];


  if (empty($mailuid) || empty($password)) {
    header("Location: ../index.php?error=emptyfieldslogin");
    exit();
  }
  else {
    $sql = "SELECT * FROM users WHERE userUid=? OR userEmail=?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
      header("Location: ../index.php?error=sqlerror");
      exit();
    }
    else {
      mysqli_stmt_bind_param($stmt, "ss", $mailuid, $mailuid);
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);

      if ($row = mysqli_fetch_assoc($result)) {
        $pwdCheck = password_verify($password, $row['userPwd']);
        if ($pwdCheck == false) {
          header("Location: ../index.php?error=wrongpwd");
          exit();
        }
        elseif ($pwdCheck == true) {
          session_start();
          $_SESSION['userIdSession'] = $row['userId'];
          $_SESSION['userUidSession'] = $row['userUid'];

          header("Location: ../index.php?login=success");
          exit();

        }
        else {
          header("Location: ../index.php?error=wrongpwd");
          exit();
        }
      }
      else {
        header("Location: ../index.php?error=nouser");
        exit();
      }

    }
  }

}
else {
  header("Loaction: ../index.php");
  exit();
}
