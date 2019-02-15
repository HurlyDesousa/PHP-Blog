<?php
//Prologue of comments.inc.php:
//This page is in an includes folder an runs only php code. It adds the users created comments to the database.
session_start();

if (isset($_SESSION['userIdSession'])) {

  if (isset($_POST['create-comment'])) {

    require 'dbh.inc.php';

    $message = $_POST['user-comment'];
    $title = mysqli_real_escape_string($conn, $_GET['title']);
    $date = mysqli_real_escape_string($conn, $_GET['date']);


    if (!preg_match("/[a-zA-Z0-9\s]*/", $message)) {
    header("Location: ".$_SERVER["HTTP_REFERER"]."&error=invalidcomment");
    exit();

    } else {
      $id = $_SESSION['userIdSession'];
      $sql = "SELECT * FROM users WHERE userId='$id'";
      $result = mysqli_query($conn, $sql);

      if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {

          $sqlupdate = "INSERT INTO comments (articleId, userUid, usercomment , commentdate) VALUES (?,?,?,?)";
          $stmt = mysqli_stmt_init($conn);
          if (!mysqli_stmt_prepare($stmt, $sqlupdate)) {
          header("Location: ".$_SERVER["HTTP_REFERER"]."&error=sqlerror");
          exit();

          } else {
            $articleid = mysqli_real_escape_string($conn, $_GET['id']);
            $id = $row['userUid'];
            $comment = $_POST['user-comment'];
            $commentnew = nl2br($comment);
            $date = date("Y-m-d H:i:s");
            mysqli_stmt_bind_param($stmt, "isss", $articleid, $id, $commentnew, $date);
            mysqli_stmt_execute($stmt);
            header("Location: ".$_SERVER["HTTP_REFERER"]."&success=createdcomment");
            exit();
          }
        }
      } else {
        echo "There are no users yet!";
      }
    }

  }
}
