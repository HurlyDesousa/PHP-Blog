<?php
  require 'dbh.inc.php';

if (isset($_POST["resetpwd-submit"])) {

  $selector = $_POST["selector"];
  $validator = $_POST["validator"];
  $password = $_POST["pwd"];
  $passwordRepeat = $_POST["pwd-repeat"];

  if (empty($password) || empty($passwordRepeat)) {
    header("Location: ../createnewpwd.php?newpwd=empty");
    exit();
  } else if ($password != $passwordRepeat) {
    header("Location: ../createnewpwd.php?newpwd=pwdnotsame");
  }

  $currentDate = date("U");

  $sql = "SELECT * FROM pwdReset WHERE pwdResetSelector=? AND pwdResetExpires >=? ;";
  $stmt = mysqli_stmt_init($conn);

  if (!mysqli_stmt_prepare($stmt, $sql)) {
    echo "There was an ERROR 1!";
    exit();

  } else {
    mysqli_stmt_bind_param($stmt, "ss", $selector, $currentDate);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);
    if (!$row = mysqli_fetch_assoc($result)) {
      echo "You need to resubmit your reset request.";
      exit();
    } else {

      $tokenBin = hex2bin($validator);
      $tokenCheck = password_verify($tokenBin, $row["pwdResetToken"]);

      if ($tokenCheck === false) {
        echo "You need to resubmit your reset request.";
        exit();
      } else if ($tokenCheck === true) {

        $tokenEmail = $row['pwdResetEmail'];
        $sql = "SELECT * FROM users WHERE userEmail=? ;";
        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sql)) {
          echo "There was an ERROR 2!";
          exit();

        } else {
          mysqli_stmt_bind_param($stmt, "s", $tokenEmail);
          mysqli_stmt_execute($stmt);

          $result = mysqli_stmt_get_result($stmt);

          if (!$row = mysqli_fetch_assoc($result)) {
            echo "There was an ERROR 3!";
            exit();
          } else {

            $sql = "UPDATE users SET userPwd=? WHERE userEmail=? ;";
            $stmt = mysqli_stmt_init($conn);

            if (!mysqli_stmt_prepare($stmt, $sql)) {
              echo "There was an ERROR 4!";
              exit();

            } else {

              $newpwdHash = password_hash($password, PASSWORD_DEFAULT);
              mysqli_stmt_bind_param($stmt, "ss", $newpwdHash, $tokenEmail);
              mysqli_stmt_execute($stmt);

              $sql = "DELETE FROM pwdReset WHERE pwdResetEmail=? ;";
              $stmt = mysqli_stmt_init($conn);

              if (!mysqli_stmt_prepare($stmt, $sql)) {
                echo "There was an ERROR 5!";
                exit();

              } else {
                mysqli_stmt_bind_param($stmt, "s", $tokenEmail);
                mysqli_stmt_execute($stmt);
                header("Location: ../resetpwd.php?newpwd=updated");
              }
            }
          }
        }
      }
    }
  }
  } else {
    header("Location: ../index.php");
  }
