<?php
//Prologue of myposts.php:
//This page shows the user all of their own posts and allows them to create a new one.
require "header.php";
// The header will display ontop of the page and provide navigation.
?>

<main class="about-container">
  <div>
    <br><br><br><h2>All My Posts</h2><br><br>
  </p>Why not publish your ideas and so the world can read them</p><br><br>
  <form class="create-post" action="createpost.php" method="post">
    <button class="button" type="submit" name="button">Create New Post</button>
  </form>
  <div class="">
    <?php
    $id = $_SESSION['userIdSession'];
    $sqluser = "SELECT * FROM users WHERE userId='$id'";
    $resultuser = mysqli_query($conn, $sqluser);

    if (mysqli_num_rows($resultuser) > 0) {
      while ($row = mysqli_fetch_assoc($resultuser)) {
        $id = $row['userUid'];
        $sql = "SELECT * FROM article WHERE a_author='$id' ORDER BY a_date DESC LIMIT 2";
        $result = mysqli_query($conn, $sql);
        $queryResults = mysqli_num_rows($result);

        if ($queryResults > 0) {
          while ($row = mysqli_fetch_assoc($result)) {
            echo "<div class='article-box'>
            <h3>".$row['a_title']."</h3>
            <p>". substr($row['a_text'], 0, 165)."<a class='article-result' href='article.php?title=".$row['a_title']."&date=".$row['a_date']."'> Continue Reading</a></p><br><br>
            <p>Date Created: ".$row['a_date']."</p>
            <p>Author: ".$row['a_author']."</p>
            </div><hr>";
          }
        } else {
          echo "<br>".$id." you have no posts yet!";
        }
      }
    }
    ?>
  </div>
</div>
</main>




<?php
require "footer.php";
// The footer will display at the bottom of this page and provide copyright information.
?>
