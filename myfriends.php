<?php
//Prologue of myfriends.php:
//This page shows the user all their friends, and allows the removal of unwanted friends.
require "header.php";
// The header will display ontop of the page and provide navigation.
?>

<main>
  <div class="search-container">
    <br><br><br><h2>All My friends:</h2><br><br>
    <?php

    if (isset($_GET['error'])) {
      if ($_GET['error'] == "alredyfriends") {
        echo '<p class="signuperror" style=" margin-top: 20px;">You are already friends!</p>';
      }
    } elseif (isset($_GET['success'])) {
      if ($_GET['success'] == "friendadded") {
        echo '<p class="suc" style=" margin-top: 20px;">You have added a friend!</p>';
      }
    }

    $sql = "SELECT userFriend FROM friends WHERE userUid='$id' ORDER BY userUid ASC";
    $result = mysqli_query($conn, $sql);
    $queryResults = mysqli_num_rows($result);

    if (mysqli_num_rows($result) > 0) {
      while ($row = mysqli_fetch_assoc($result)) {

        $id = $row['userFriend'];
        $sqlImg = "SELECT * FROM profileimage WHERE userUid='$id'";
        $resultImg = mysqli_query($conn, $sqlImg);
        while ($rowImg = mysqli_fetch_assoc($resultImg)) {

          echo "<div class='user-container-all'>";
          if ($rowImg['imgStatus'] == 0) {
            $filename = "uploads/profile".$id."*";
            $fileinfo = glob($filename);
            $fileext = explode(".", $fileinfo[0]);
            $fileactualext = $fileext[1];
            echo "<img class='user-image-all' src='uploads/profile".$id.".".$fileactualext."?".mt_rand()."'>";
          } else {
            echo "<img class='user-image-all' src='uploads/profiledefault.jpg'>";
          }

          echo "<p class='username-all'>"."Username: ".$row['userFriend']."</p>";

          $sqlprofile = "SELECT * FROM userprofile WHERE userUid='$id'";
          $resultprofile = mysqli_query($conn, $sqlprofile);
          while ($rowprofile = mysqli_fetch_assoc($resultprofile)) {
            if (!$rowprofile['profileStatus'] == '') {
              echo "<p class='userstatus'>"."Status: ".$rowprofile['profileStatus']."</p>"."<br>";
            } else {
              echo "<p class='userstatus'>"."Status: Not Set"."</p>"."<br>";
            }

            echo "<form class='' action='includes/removefriend.inc.php?removefriend=".$rowprofile['userUid']."' method='post'>
            <button type='submit' class='removefriendbutton' name='removefriendbutton'>Remove Friend</button>
            </form>";

            if (!$rowprofile['profileFirstName'] == '') {
              echo "<p class='userfullname'>"."Full Name: ".$rowprofile['profileFirstName']." ".$rowprofile['profileLastName']."</p><br>";
            } else {
              echo "<p class='userfullname'>"."Full Name: Not Set"."</p><br>";
            }
            echo "<a class='article-result' href='userprofile.php?user=".$row['userFriend']."'>View profile</a>";
          }
          echo "</div><hr>";
        }
      }
    } else {
      echo "You have no friends yet!<br>.<hr>";
    }
    ?>
  </div>
</main>




<?php
require "footer.php";
// The footer will display at the bottom of this page and provide copyright information.
?>
