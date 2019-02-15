<?php
//Prologue of header.php:
//This page creates the header that is present at the top of each page.

session_start();
include 'includes/dbh.inc.php';

// The header will display ontop of each page and provide navigation.
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="description" content="A trading blog focused on sotck markets, commodities, forex, and cryptocurrency. Trading in this market involves buying and selling world currencies, taking profit from the exchange rates difference. FX trading can yield high profits but is also a very risky endeavor.">
  <meta name="viewprt" content="width = device-width, initial-scale = 1">
  <title>Trading Blog.</title>
  <link rel="stylesheet" href="styles/styles.css">
  <link rel="icon" href="images/favicon.PNG" type="image/gif" sizes="16x16">
</head>

<body>

  <header>
    <nav class="header-nav">
      <a class="header-logo" href="index.php">
        <img src="images/logo.png" alt="logo" style="height: 60px;">
      </a>

      <ul>
        <li><a href="index.php" style="text-decoration: underline;">Home</a></li>

        <?php
        if (isset($_SESSION['userIdSession'])) {
          echo'
          <li><a href="allposts.php">Browse</a></li>
          <li><a href="allfriends.php">Friends</a></li>
          <li><a href="myprofile.php">Profile</a></li>
          <li><a href="myposts.php">My Posts</a></li>';
        }
        else {

          echo '
          <li><a href="about.php">About Us</a></li>
          <li><a href="contact.php">Contact</a></li>';

          echo  '<a class="forgottenpwd" href="resetpwd.php">forgot?</a>';
        }
          ?>
        </ul>
      </nav>
      <div class="">
        <?php
        if (isset($_SESSION['userIdSession'])) {
          echo '<form class="logout-form" action="includes/logout.inc.php" method="post">
          <button class="logout-button" type="submit" name="logout-submit">Logout</button>
          </form>';
          echo '<form class="upload-form" action="index.php" method="post" enctype="multipart/form-data">
          <button class="upload-button" type="submit" name="submit">Upload</button>
          <input class="upload-button-choose" type="file" name="file" value="">
          </form>';
          echo '<form class="delete-form" action="includes/deleteprofile.inc.php" method="post">
          <button class="delete-button" type="submit" name="submit">Delete</button>
          </form>';

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
                  echo "<img class='user-image' src='uploads/profile".$id.".".$fileactualext."?".mt_rand()."'>";
                } else {
                  echo "<img class='user-image' src='uploads/profiledefault.jpg'>";
                }
                echo "<p class='welcome'>"."Welcome ".$row['userUid']."!"."</p>";
                echo "</div>";
              }
            }
          } else {
            echo "There are no users yet!";
          }
        }
        else {
          echo '
          <a href="signup.php" class="signup-button">Sign Up</a>

          <form class="login-form" action="includes/login.inc.php" method="post" autocomplete="on">
          <input type="text" name="mailuid" placeholder="E-mail/Username..." autocomplete="on">
          <input type="password" name="pwd" placeholder="Password..." autocomplete="on">
          <button class="button" type="submit" name="login-submit">Login</button>
          </form>';
        }
        if (isset($_GET['error'])) {
          if ($_GET['error'] == "emptyfieldslogin") {
            echo '<p class="loginerror">All fields must be filled in!</p>';
          }
          elseif ($_GET["error"] == "nouser") {
            echo '<p class="loginerror">Invalid username or e-mail!</p>';
          }
          elseif ($_GET["error"] == "wrongpwd") {
            echo '<p class="loginerror">Invalid Password!</p>';
          }
        }
        ?>
      </div>
    </header>
    <p>
      <?php
      if (isset($_GET['newpwd'])) {
        if ($_GET['newpwd'] == 'updated') {
          echo '<p class="pwdwassucreset">Your password has been reset!</p>';
        }
      }
    ?>
  </p>
</body>



</html>
