<?php
//Prologue of search.php:
//This page shows the user all the other users on the webpage after the seach in the seach field.
require "header.php";
// The header will display ontop of the page and provide navigation.
?>

<main>
  <div class="search-container">
    <br><br><br><h2>Seach results</h2><br><br>
    <?php

    if (isset($_POST['submit-search'])) {
      $search = mysqli_real_escape_string($conn, $_POST['search']);
      $sql = "SELECT * FROM article WHERE a_title LIKE '%$search%' OR a_text LIKE '%$search%' OR a_author LIKE '%$search%' OR a_date LIKE '%$search%'";
      $result = mysqli_query($conn, $sql);
      $queryResult = mysqli_num_rows($result);

      echo "".$queryResult." result(s) found";

      if ($queryResult > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
          echo "<div class='article-box'>
          <h3>".$row['a_title']."</h3>
          <p>". substr($row['a_text'], 0, 165)."<a class='article-result' href='article.php?title=".$row['a_title']."&date=".$row['a_date']."'> Continue Reading</a></p><br><br>
          <p>Date Created: ".$row['a_date']."</p>
          <p>Author: ".$row['a_author']."</p>
          </div><hr>";
        }
      } else {
        echo " :(";
      }


    }
    ?>
  </div>
</main>

<?php
require "footer.php";
// The footer will display at the bottom of this page and provide copyright information.
?>
