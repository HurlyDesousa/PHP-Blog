<?php
//Prologue of pleaselogin.php:
//This page warns the user they are not logged in and provied a sighnup link in case they are not signed up yet.
require "header.php";
// The header will display ontop of the page and provide navigation.
?>

<main>
  <div class="search-container">
    <br><br><br><h1>Please Login!</h1><br><br>
    <p>You have to be logged in to read the full article and browse all posts.</p><br>
    <p>You can sign up for free <a class='article-result' href="signup.php">here</a>.</p><hr>
  </div>
</main>

<?php
require "footer.php";
// The footer will display at the bottom of this page and provide copyright information.
?>
