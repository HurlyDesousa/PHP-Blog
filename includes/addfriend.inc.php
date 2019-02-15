<?php
//Prologue of addfriend.inc.php:
//This page is in an includes folder an runs only php code. It adds the users chosen friends to the database.
session_start();

if (isset($_SESSION['userIdSession'])) {
  if (isset($_POST['addfriendbutton'])) {

    require 'dbh.inc.php';

    $id = $_SESSION['userIdSession'];
    $sql = "SELECT * FROM users WHERE userId='$id'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
      while ($row = mysqli_fetch_assoc($result)) {
        $id = $row['userUid'];
        $newfriend = $_REQUEST['newfriend'];

        $sqlcheck = "SELECT * FROM friends WHERE userUid='$id' AND (userFriend='$newfriend')";
        $resultfriends = mysqli_query($conn, $sqlcheck);

        if (mysqli_num_rows($resultfriends) > 0) {
          while ($row = mysqli_fetch_assoc($resultfriends)) {
            echo "This guy is already your friend?!";
            print_r($id);
            print_r($newfriend);
            header("Location: ../myfriends.php?error=alredyfriends");
            exit();
          }
        } else {
          echo "This guy is not friend yet!";

          print_r($id);

          $sqladdfriend = "INSERT INTO friends SET userUid='$id', userFriend = '$newfriend'";
          mysqli_query($conn, $sqladdfriend);

          $sqladdfriends = "INSERT INTO friends SET userUid='$newfriend', userFriend = '$id'";
          mysqli_query($conn, $sqladdfriends);

          header("Location: ../myfriends.php?success=friendadded");
          exit();
        }
      }
    } else {
      echo "There are no users yet!";
    }

  }
}
