<?php
//Prologue of deleteprofile.php:
//This runs a php fnction that delets the users profile picture and sets it back to the default one.

//require "../header.php";
// The header will display ontop of the page and provide navigation.
session_start();

require 'dbh.inc.php';

if (isset($_SESSION['userIdSession'])) {

  if (isset($_POST['submit'])) {
    $sessionid = $_SESSION['userUidSession'];

    $filename = "../uploads/profile".$sessionid."*";
    $fileinfo = glob($filename);
    $fileext = explode(".", $fileinfo[0]);
    $fileactualext = $fileext[3];
    //$file = "../uploads/profile".$sessionid.".".$fileactualext;
    $file = "../uploads/profile$sessionid.$fileactualext";


    if (!unlink($file)) {
      //echo "file not deleted";
      header("Location: ../index.php?delete=failed");
      exit();
    } else {
      $sql = "UPDATE profileimage SET imgStatus=1 WHERE userUid='$sessionid';";
      mysqli_query($conn, $sql);
      //echo "file deleted";
      header("Location: ../index.php?delete=success");
      exit();
    }
  }
}
