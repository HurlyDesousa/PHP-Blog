<?php
//Prologue of article.php:
//This page displays the chosen article with the comments below it.
require "header.php";
// The header will display ontop of the page and provide navigation.

?>

<main>
  <div class="search-container">
    <br><br><br><h2>Article</h2><br><br>

    <?php
    $title = mysqli_real_escape_string($conn, $_GET['title']);
    $date = mysqli_real_escape_string($conn, $_GET['date']);

    $sql = "SELECT * FROM article WHERE a_title='$title' AND a_date='$date'";
    $result = mysqli_query($conn, $sql);
    $queryResults = mysqli_num_rows($result);

    if ($queryResults > 0) {
      while ($row = mysqli_fetch_assoc($result)) {
        $articleid = $row['a_id'];
        echo "<div class='article-box'>
        <h3>".$row['a_title']."</h3><br><br>
        <p>".$row['a_text']."</p><br><br>
        <p>Date Created: ".$row['a_date']."</p><br>
        <p>Author: ".$row['a_author']."</p>
        </div><hr>";

      }
    }

    $sqlcomment = "SELECT * FROM comments WHERE articleId='$articleid'";
    $resultcomment = mysqli_query($conn, $sqlcomment);

    if (mysqli_num_rows($resultcomment) > 0) {
      while ($row = mysqli_fetch_assoc($resultcomment)) {
        echo "<div class='usercomments'>";

        $id = $row['userUid'];
        $comment = $row['usercomment'];
        $commentdate = $row['commentdate'];

        $sqlImg = "SELECT * FROM profileimage WHERE userUid='$id'";
        $resultImg = mysqli_query($conn, $sqlImg);
        while ($rowImg = mysqli_fetch_assoc($resultImg)) {

          if ($rowImg['imgStatus'] == 0) {
            $filename = "uploads/profile".$id."*";
            $fileinfo = glob($filename);
            $fileext = explode(".", $fileinfo[0]);
            $fileactualext = $fileext[1];
            echo "<img class='user-image-comment' src='uploads/profile".$id.".".$fileactualext."?".mt_rand()."'>";
          } else {
            echo "<img class='user-image-comment' src='uploads/profiledefault.jpg'>";
          }
        }
        echo "<p>Comment by user $id,</p><br>
        <div class='usercomment-container'>
        $comment
        </div>
        <br><br>$commentdate<hr>";
        echo "</div>";

      }
    } else {
      echo "There are no comments yet! Why not write one below.<hr>";
    }


    if (isset($_GET['error'])) {
      if ($_GET['error'] == "sqlerror") {
        echo '<p class="signuperror" style=" margin-top: 20px;">An SQL error occured?!</p>';
      }
    } elseif (isset($_GET['success'])) {
      if ($_GET['success'] == "createdcomment") {
        echo '<p class="suc" style=" margin-top: 20px;">Comment Created!</p>';
      }
    }

    echo '<form action="includes/comments.inc.php?title='.$title.'&date='.$date.'&id='.$articleid.'" method="post">
    <textarea class="createcommentfield" id="subject" name="user-comment" placeholder="Write your comment here..."></textarea>
    <button class="addfriendbutton" type="subnit" name="create-comment">Post Comment</button>
    </form><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><hr>';
    ?>


  </div>
</main>




<?php
require "footer.php";
// The footer will display at the bottom of this page and provide copyright information.
?>
