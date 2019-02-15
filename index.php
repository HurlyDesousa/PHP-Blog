<?php
/**
* Prologue of index.php:
* This file is the first file that should be launched when starting the website,and will take the browser to the home page.
*/
include "header.php";
// The header will display ontop of the index page
if (isset($_POST['submit'])) {
  $file = $_FILES['file'];

  $fileName = $_FILES['file']['name'];
  $fileTmpName = $_FILES['file']['tmp_name'];
  $fileSize = $_FILES['file']['size'];
  $fileError = $_FILES['file']['error'];
  $fileType = $_FILES['file']['type'];

  $fileExt = explode('.',$fileName);
  $fileActualExt = strtolower(end($fileExt));

  $allowed = array('jpg', 'jpeg', 'png');

  if (in_array($fileActualExt, $allowed)) {
    if ($fileError === 0) {
      if ($fileSize < 5000000) {
        $fileNameNew = "profile".$id.".".$fileActualExt;
        $fileDestination = 'uploads/'.$fileNameNew;
        move_uploaded_file( $fileTmpName, $fileDestination);
        $sql = "UPDATE profileimage SET imgStatus=0 WHERE userUid='$id';";
        $result = mysqli_query($conn, $sql);
        header("Location: index.php?uploadsuccess");
      }else {
        echo '<p class="uploaderror">Your file is too big!</p>';
      }
    } else {
      echo '<p class="uploaderror">There was an error uploading your file!</p>';
    }
  } else {
    echo '<p class="uploaderror">Choose a correct image file!</p>';
  }

}

?>
<div class="main-home">
  <main>
    <div class="logo-home">
      <div class="logo-txt">
        <br>  <h2>Online Trading Blog</h2>
      </div>
      <section class="">
        <?php
        if (isset($_SESSION['userIdSession'])) {
          echo '<p class="msg">You are logged in!</p>';
        }
        else {
          echo '<p class="msg">You are logged out!</p>';
        }
        ?>
      </section>
    </div>
    <div class="latest-post">
      <h2>Checkout the latest Blog Posts Below:</h2>
      <?php
      $read = "<a class='article-result' href='allposts.php'>Browse all posts</a><br><br>";
      $plslogin = "<a class='article-result' href='pleaselogin.php'>Browse all posts</a><br><br>";

      if (isset($_SESSION['userIdSession'])) {
        echo $read;
      }
      else {
        echo $plslogin;
      }

      $sql = "SELECT * FROM article ORDER BY a_date DESC LIMIT 2";
      $result = mysqli_query($conn, $sql);
      $queryResults = mysqli_num_rows($result);

      if ($queryResults > 0) {
        while ($row = mysqli_fetch_assoc($result)) {

          if (isset($_SESSION['userIdSession'])) {
            $readcontinue = "<a class='article-result' href='article.php?title=".$row['a_title']."&date=".$row['a_date']."'> Continue Reading</a>";
            echo "<div class='article-box'>
            <h3>".$row['a_title']."</h3>
            <p>".substr($row['a_text'], 0, 165).".".$readcontinue."
            </p><br><br>
            <p>Date Created: ".$row['a_date']."</p>
            <p>Author: ".$row['a_author']."</p>
            </div><hr>";
          }
          else {
            $plslogin = "<a class='article-result' href='pleaselogin.php'> Continue Reading</a><br><br>";
            echo "<div class='article-box'>
            <h3>".$row['a_title']."</h3>
            <p>".substr($row['a_text'], 0, 165).".".$plslogin."
            </p><br><br>
            <p>Date Created: ".$row['a_date']."</p>
            <p>Author: ".$row['a_author']."</p>
            </div><hr>";
          }
        }
      }
      ?>
    </p><br>
  </div>
</main>
<aside class="news-container">
  <div style="margin-top: -3px;">
    <h2>Latest Headlines</a></h2>
    <div class="">
      Nov 17, 2018 12:00 am +02:00
    </div>
    <h4 class=""><a href="#"><b>US Oil Has Three Days of Stability Against Six Weeks and 30% Of Trumble</b></a>
    </h4>
    <img class="homeimg" src="images/down.PNG" alt="Markets Are Down!">
    <hr class="">
    <div class="" style="margin-top: 20px;"></div>
    <div class="">
      Nov 16, 2018 8:30 pm +02:00
    </div>
    <h4 class=""><a href="#"><b>Foundations of Technical Analysis: Identifying Embedded Trends</b></a>
      <img class="homeimg" src="images/up.PNG" alt="Markets Are Up!">
      <hr class="">
    </div>
  </aside>
</div>

<?php
require "footer.php";
// The footer will display at the bottom of this page and provide copyright information.
?>
