<?php
//Prologue of updatepwd.inc.php:
//This page is in an includes folder an runs only php code. It changes the users password in the database, and also hashes the new password.

session_start();
include_once 'dbh.inc.php';

if (isset($_SESSION['userIdSession'])) {

  $id = $_SESSION['userIdSession'];
  $sql = "SELECT * FROM users WHERE userId='$id'";
  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
      $id = $row['userUid'];
      $hashedpwd = $row['userPwd'];

      if(isset($_POST['updatepass'])) {

        $result = $conn->query("SELECT * FROM users WHERE userUid='$id'");
        $row = mysqli_fetch_array($result);

        $currentpwd = $_POST['defaultcurrentPass'];

        if(password_verify($currentpwd, $hashedpwd)) {

          $newpwd = $_POST['changenewPass'];
          $hashedpwd = password_hash($newpwd, PASSWORD_DEFAULT);
          $sql = "UPDATE users SET userpwd=? WHERE userUid='$id'";
          $stmt = mysqli_stmt_init($conn);
          if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../changepwd.php?error=sqlerror");
            exit();
          } else {
            mysqli_stmt_bind_param($stmt, "s", $hashedpwd);
            mysqli_stmt_execute($stmt);
          }
          $message = "You have successfully changed your password.";
            echo $message;
            header("Location: ../changepwd.php?changed=successpwdchange");
            exit();
        } else {
          $message = "Current Password is not correct";
            echo $message;
            header("Location: ../changepwd.php?error=currentpwdincorrect");
            exit();
        }
      }
    }
  }
}
