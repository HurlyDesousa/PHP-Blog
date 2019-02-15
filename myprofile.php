<?php
//Prologue of myprofile.php:
//This page shows the user their own personal profile and allows he user to update thir info.
require "header.php";
// The header will display ontop of the page and provide navigation.
?>

<main>
  <div class="myprofile-container">
    <br><br><br>
    <?php
    $id = $_SESSION['userIdSession'];
    $sql = "SELECT * FROM users WHERE userId='$id'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
      while ($row = mysqli_fetch_assoc($result)) {
        $id = $row['userUid'];
        $sqlImg = "SELECT * FROM profileimage WHERE userUid='$id'";
        $resultImg = mysqli_query($conn, $sqlImg);
        while ($rowImg = mysqli_fetch_assoc($resultImg)) {
          echo "<div class='user-container'>";
          if ($rowImg['imgStatus'] == 0) {
            $filename = "uploads/profile".$id."*";
            $fileinfo = glob($filename);
            $fileext = explode(".", $fileinfo[0]);
            $fileactualext = $fileext[1];
            echo "<img class='user-image-my' src='uploads/profile".$id.".".$fileactualext."?".mt_rand()."'>";
          } else {
            echo "<img class='user-image-my' src='uploads/profiledefault.jpg'>";
          }
          echo "</div>";
        }
      }
    } else {
      echo "There are no users yet!";
    } ?>
    <h2 style="margin:auto;">About Me</h2>
    <?php
    if (isset($_GET['success'])) {
      if ($_GET['success'] == "updatedprofile") {
        echo '<p class="suc" style=" margin-top: 20px;">You profile was updated!</p>';
      }
    }
    ?>
    <br><p>Create a profile so other users can connect to you.</p>
    <a class='article-result' href="myfriends.php">View my friends</a><br><br><br>
    <p>First Name:<?php
    $id = $_SESSION['userIdSession'];
    $sql = "SELECT * FROM users WHERE userId='$id'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
      while ($row = mysqli_fetch_assoc($result)) {
        $id = $row['userUid'];
        $sqlfname = "SELECT profileFirstName FROM userprofile WHERE userUid = '$id'";
        $resultfname = mysqli_query($conn, $sqlfname);
        if (mysqli_num_rows($resultfname) > 0) {
          while ($row = mysqli_fetch_assoc($resultfname)) {
            $id = $row['profileFirstName'];
            if ($id === "") {
              echo " "."Not Set";
            } else {
              echo " ".$id;
            }
          }
        }
      }
    }?></p><br>
    <p>Last Name:<?php
    $id = $_SESSION['userIdSession'];
    $sql = "SELECT * FROM users WHERE userId='$id'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
      while ($row = mysqli_fetch_assoc($result)) {
        $id = $row['userUid'];
        $sqllname = "SELECT profileLastName FROM userprofile WHERE userUid = '$id'";
        $resultlname = mysqli_query($conn, $sqllname);
        if (mysqli_num_rows($resultlname) > 0) {
          while ($row = mysqli_fetch_assoc($resultlname)) {
            $id = $row['profileLastName'];
            if ($id === "") {
              echo " "."Not Set";
            } else {
              echo " ".$id;
            }
          }
        }
      }
    }?></p><br>
    <p>Gender:<?php
    $id = $_SESSION['userIdSession'];
    $sql = "SELECT * FROM users WHERE userId='$id'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
      while ($row = mysqli_fetch_assoc($result)) {
        $id = $row['userUid'];
        $sqlgender = "SELECT profileGender FROM userprofile WHERE userUid = '$id'";
        $resultgender = mysqli_query($conn, $sqlgender);
        if (mysqli_num_rows($resultgender) > 0) {
          while ($row = mysqli_fetch_assoc($resultgender)) {
            $id = $row['profileGender'];
            if ($id === "") {
              echo " "."Not Set";
            } else {
              echo " ".$id;
            }
          }
        }
      }
    }?></p><br>
    <p>Phone Number:<?php
    $id = $_SESSION['userIdSession'];
    $sql = "SELECT * FROM users WHERE userId='$id'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
      while ($row = mysqli_fetch_assoc($result)) {
        $id = $row['userUid'];
        $sqlphone = "SELECT profilePhone FROM userprofile WHERE userUid = '$id'";
        $resultphone = mysqli_query($conn, $sqlphone);
        if (mysqli_num_rows($resultphone) > 0) {
          while ($row = mysqli_fetch_assoc($resultphone)) {
            $id = $row['profilePhone'];
            if ($id === "0") {
              echo " "."Not Set";
            } else {
              echo " ".$id;
            }
          }
        }
      }
    }?></p><br>
    <p>Date of Birth:<?php
    $id = $_SESSION['userIdSession'];
    $sql = "SELECT * FROM users WHERE userId='$id'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
      while ($row = mysqli_fetch_assoc($result)) {
        $id = $row['userUid'];
        $sqldob = "SELECT profileBirth FROM userprofile WHERE userUid = '$id'";
        $resultdob = mysqli_query($conn, $sqldob);
        if (mysqli_num_rows($resultdob) > 0) {
          while ($row = mysqli_fetch_assoc($resultdob)) {
            $id = $row['profileBirth'];
            if ($id === "0000-00-00") {
              echo " "."Not Set";
            } else {
              echo " ".$id;
            }
          }
        }
      }
    }?></p><br>
    <p>Skill status:<?php
    $id = $_SESSION['userIdSession'];
    $sql = "SELECT * FROM users WHERE userId='$id'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
      while ($row = mysqli_fetch_assoc($result)) {
        $id = $row['userUid'];
        $sqlstatus = "SELECT profileStatus FROM userprofile WHERE userUid = '$id'";
        $resultstatus = mysqli_query($conn, $sqlstatus);
        if (mysqli_num_rows($resultstatus) > 0) {
          while ($row = mysqli_fetch_assoc($resultstatus)) {
            $id = $row['profileStatus'];
            if ($id === "") {
              echo " "."Not Set";
            } else {
              echo " ".$id;
            }
          }
        }
      }
    }?></p><br><br><br>
    <p>Feal free to contact us if you have any questions.</p><br>
    <a href="contact.php" style="text-decoration: underline">Contact Us here.</a><br><br><br>
    <form class="" action="editmyprofile.php" method="post">
      <input type="submit" class="edit-button"  name="button" value="Edit Profile">
    </form>
    <form class="" action="changepwd.php" method="post">
      <input type="submit" class="pwd-button"  name="button" value="Change Password">
    </form>
  </div>
</main>



<?php
require "footer.php";
// The footer will display at the bottom of this page and provide copyright information.
?>
