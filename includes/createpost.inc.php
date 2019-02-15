<?php
//Prologue of createpost.inc.php:
//This page is in an includes folder an runs only php code. It adds the users created posts to the database.
session_start();

if (isset($_SESSION['userIdSession'])) {

  if (isset($_POST['create-post'])) {

    require 'dbh.inc.php';

    $title = $_POST['post-title'];
    $message = $_POST['post-message'];

    if ( !preg_match("/[a-zA-Z0-9\s]*/", $title) || !preg_match("/[a-zA-Z0-9\s]*/", $message)) {
      header("Location: ../createpost.php?error=invalidpost");
      exit();

    } else {

      $id = $_SESSION['userIdSession'];
      $sql = "SELECT * FROM users WHERE userId='$id'";
      $result = mysqli_query($conn, $sql);

      if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {

          $sqlupdate = "INSERT INTO article (a_title, a_text, a_author, a_date) VALUES (?,?,?,?)";
          $stmt = mysqli_stmt_init($conn);
          if (!mysqli_stmt_prepare($stmt, $sqlupdate)) {
            header("Location: ../createpost.php?error=sqlerror");
            exit();
          } else {
            $id = $row['userUid'];
            $title = $_POST['post-title'];
            $message = $_POST['post-message'];
            $messagenew = nl2br($message);
            $date = date("Y-m-d H:i:s");
            mysqli_stmt_bind_param($stmt, "ssss", $title, $messagenew, $id, $date);
            mysqli_stmt_execute($stmt);

            header("Location: ../myposts.php?error=successpost");
            exit();
          }
        }
      } else {
        echo "There are no users yet!";
      }
    }

  }
}
