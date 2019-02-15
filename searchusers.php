<?php
//Prologue of searchusers.php:
//This page shows the user all the other users on the webpage and provides a serch field to filter them.
require "header.php";
// The header will display ontop of the page and provide navigation.
?>

<main>
  <div class="search-container">
    <br><br><br><h2>Seach results:</h2><br><br>
    <?php

    if (isset($_POST['submit-search'])) {
      $search = mysqli_real_escape_string($conn, $_POST['search']);
      $sql = "SELECT * FROM userprofile WHERE (userUid LIKE '%$search%' OR profileFirstName LIKE '%$search%' OR profileLastName LIKE '%$search%' OR profileStatus LIKE '%$search%' OR profileGender LIKE '%$search%') AND userUid <> '$id'";

      $result = mysqli_query($conn, $sql);
      $queryResult = mysqli_num_rows($result);

      echo "<p>".$queryResult." result(s) found</p><br><hr>";
      if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
          $id = $row['userUid'];

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

            echo "<p class='username-all'>"."Username: ".$row['userUid']."</p>";

            $sqlprofile = "SELECT * FROM userprofile WHERE userUid='$id'";
            $resultprofile = mysqli_query($conn, $sqlprofile);
            while ($rowprofile = mysqli_fetch_assoc($resultprofile)) {
              if (!$rowprofile['profileStatus'] == '') {
                echo "<p class='userstatus'>"."Status: ".$rowprofile['profileStatus']."</p>"."<br>";
              } else {
                echo "<p class='userstatus'>"."Status: Not Set"."</p>"."<br>";
              }

              echo "<form class='' action='includes/addfriend.inc.php?newfriend=".$row['userUid']."' method='post'>
              <button type='submit' class='addfriendbutton' name='addfriendbutton'>Add Friend</button>
              </form>";

              if (!$rowprofile['profileFirstName'] == '') {
                echo "<p class='userfullname'>"."Full Name: ".$rowprofile['profileFirstName']." ".$rowprofile['profileLastName']."</p><br>";
              } else {
                echo "<p class='userfullname'>"."Full Name: Not Set"."</p><br>";
              }
              echo "<a class='article-result' href='userprofile.php?user=".$row['userUid']."'>View profile</a>";
            }
            echo "</div><hr>";
          }
        }
      } else {
        echo 'There are no users that match the "'.$search.'" search term!<hr>';
      }
    }
    ?>
  </div>
</main>




<?php
require "footer.php";
// The footer will display at the bottom of this page and provide copyright information.
?>
