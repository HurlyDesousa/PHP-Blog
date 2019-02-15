<?php
//Prologue of removefriend.inc.php:
//This page runs a function that removes the friend from the database.
session_start();

if (isset($_SESSION['userIdSession'])) {
  if (isset($_POST['removefriendbutton'])) {

    require 'dbh.inc.php';

    $id = $_SESSION['userIdSession'];
    $sql = "SELECT * FROM users WHERE userId='$id'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
      while ($row = mysqli_fetch_assoc($result)) {
        $id = $row['userUid'];
        $oldfriend = $_REQUEST['removefriend'];

        $sqlcheck = "SELECT * FROM friends WHERE userUid='$id' AND (userFriend='$oldfriend')";
        $resultfriends = mysqli_query($conn, $sqlcheck);

        if (mysqli_num_rows($resultfriends) > 0) {
          while ($row = mysqli_fetch_assoc($resultfriends)) {

            echo "This guy was your friend, but now the is not anymore!";

            print_r($id);

            $sqladdfriend = "DELETE FROM friends WHERE userUid='$id' AND (userFriend = '$oldfriend')";
            mysqli_query($conn, $sqladdfriend);

            $sqladdfriends = "DELETE FROM friends WHERE userUid='$oldfriend' AND (userFriend = '$id')";
            mysqli_query($conn, $sqladdfriends);

            header("Location: ../myfriends.php?success=friendremoved");
            exit();
          }
        } else {
          echo "This guy was not you friend so he was not removed.";
          print_r($id);
          print_r($oldfriend);

          header("Location: ../myfriends.php?error=neverfriends");
          exit();
        }
      }
    } else {
      echo "There are no users yet!";
    }

  }
}
