<?php
//Prologue of allfriends.php:
//This page displays all the other users on the site and allows the user the search them, and add them as friends.
require "header.php";
// The header will display ontop of the page and provide navigation.

?>

<main>
  <div class="search-container">
    <br><br><br><h2>Seach for any user on the site.</h2><br><br>
    <form class="search" action="searchusers.php" method="post">
      <input type="text" name="search" placeholder="Search">
      <button class="button" type="submit" name="submit-search">Search</button>
    </form>
  </p>Find any user by searching! And add them to your friends list.</p><br><br>
  <p>All Users:</p><br><hr>
  <div class="article-container">
    <?php
    $sql = "SELECT * FROM users WHERE NOT userUid='$id' ORDER BY userUid ASC";
    $result = mysqli_query($conn, $sql);
    $queryResults = mysqli_num_rows($result);
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
      echo "There are no users yet!";
    }
    ?>
  </div>
</div>
</main>

<?php
require "footer.php";
// The footer will display at the bottom of this page and provide copyright information.
?>
