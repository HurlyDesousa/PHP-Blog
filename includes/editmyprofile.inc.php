<?php
//Prologue of editmyprofile.inc.php:
//This page is in an includes folder an runs only php code. It updates the users status and profile in the database.
session_start();

if (isset($_SESSION['userIdSession'])) {

  if (isset($_POST['update-submit'])) {

    require 'dbh.inc.php';


    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $gender = $_POST['gender'];
    $tel = $_POST['tel'];
    $bday = $_POST['bday'];
    $skill = $_POST['skill'];

    if ( !preg_match("/[a-zA-Z]{3,30}$/", $fname) || !preg_match("/[a-zA-Z]{3,30}$/", $lname)) {
      header("Location: ../editmyprofile.php?error=invalidname");
      exit();

    } else {

      $id = $_SESSION['userIdSession'];
      $sql = "SELECT * FROM users WHERE userId='$id'";
      $result = mysqli_query($conn, $sql);

      if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
          $id = $row['userUid'];

          $sqlupdate = "UPDATE userprofile SET profileFirstName = '$fname', profileLastName = '$lname', profileStatus = '$skill', profileGender = '$gender', profilePhone = '$tel', profileBirth = '$bday' WHERE userUid = '$id'";
          mysqli_query($conn, $sqlupdate);
          header("Location: ../myprofile.php?success=updatedprofile");
          exit();

        }
      } else {
        echo "There are no users yet!";
      }
    }

  }
}
