<?php
//Prologue of allposts.php:
//This page displays all the post on the site and allows the user the search them.
require "header.php";
// The header will display ontop of the page and provide navigation.

?>

<main>
  <div class="search-container">
    <br><br><br><h2>Seach for any Blog Post on the site.</h2><br><br>
    <form class="search" action="search.php" method="post">
      <input type="text" name="search" placeholder="Search">
      <button class="button" type="submit" name="submit-search">Search</button>
    </form>
  </p>Find any article by searching!</p><br><br>
  <p>All articles:</p>
  <div class="article-container">
    <?php
    $sql = "SELECT * FROM article ORDER BY a_date ASC";
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
    }
    ?>

  </div>
</div>
</main>




<?php
require "footer.php";
// The footer will display at the bottom of this page and provide copyright information.
?>
